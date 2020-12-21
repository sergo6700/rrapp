<?php

namespace App\Services\Web;

use App\Models\Post\NewsItem;
use App\Support\Post\TextHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class NewsItemService
 *
 * @package App\Services\Web
 */
class NewsItemService extends AbstractService
{
    const ROUTE_NAME = 'news.show';

    /**
     * Filter by date in news list
     *
     * @param Builder $query  Database query builder
     * @param array   $params Query String
     *
     * @return Builder
     */
    protected function applyFilter(Builder $query, array $params): Builder
    {
        $query->when(
            $params['year'] ?? null, function ($query, $year) use ($params) {
                $query->when(
                    $params['month'] ?? null, function ($query, $month) use ($year) {
                        $query->whereYear('date', $year)->whereMonth('date', $month);
                    }, function ($query) use ($year) {
                        $query->whereYear('date', $year);
                    }
                );
            }, function ($query) use ($params) {
                $query->when(
                    $params['month'] ?? null, function ($query, $month) {
                        $query->whereMonth('date', $month);
                    }
                );
            }
        );

        return $query;
    }

    /**
     * Trim content if full is not allowed
     *
     * @param NewsItem $item Model
     *
     * @return NewsItem
     */
    protected function applyVisibility(NewsItem $item): NewsItem
    {
        if (auth()->guest()) {
            if ($item->is_closed_visibility) {
                $item->content = '';
            } elseif ($item->is_partial_visibility) {
                $item->content = TextHelper::cutTextToLimit(
                    $item->content, NewsItem::SHORT_TEXT_SIZE
                );
            }
        }

        return $item;
    }

    /**
     * News list
     *
     * @param array $params Query String
     *
     * @return LengthAwarePaginator
     */
    public function index(array $params): LengthAwarePaginator
    {
        $query = NewsItem::with(['picture']);
        if (empty($params)) {
            $query = $query->orderBy('fixed', 'desc');
        }

        $query->orderByDesc('date');

        $this->applyFilter($query, $params);

        if (!empty($params['year']) || !empty($params['month'])) {
            return $query->paginate(NewsItem::PER_PAGE)->appends($params);
        }

        $perPage = NewsItem::PER_PAGE;
        $fixedNewsItem = NewsItem::where('fixed', true)->first();

        // если есть закрепленный элемент (fixed==1),
        // то мы его добавляем к каждой странице
        if (!empty($params) && $fixedNewsItem) {
            $query->where('fixed', '=', false);
            $perPage--;
            $query = $query->paginate($perPage);
            $query->prepend($fixedNewsItem);
        } else {
            $query = $query->paginate($perPage);
        }

        //        dd($query->appends($params));
        return $query->appends($params);
    }



    /**
     * News item details
     *
     * @param NewsItem $item Model
     *
     * @return NewsItem
     */
    public function load(NewsItem $item): NewsItem
    {
        $item = $this->applyVisibility($item);

        return $item->loadMissing(['picture']);
    }

    /**
     * Similar news collection
     *
     * @param NewsItem $item Model
     *
     * @return Collection
     */
    public function getSimilar(NewsItem $item): Collection
    {
        return NewsItem::where('id', '!=', $item->id)
            ->with('picture')
            ->orderByDesc('date')
            ->limit(NewsItem::SIMILAR_COUNT)
            ->get();
    }

    /**
     * Get latest news for mini calendar on top of pages
     *
     * @return Collection
     */
    public function getLatestForFixedBlock(): Collection
    {
        if (strpos($this->current_route, self::ROUTE_NAME) !== false) {
            try {
                $news = \Request::route()->parameter('slug');

                return NewsItem::where('id', '!=', $news->id)
                    ->orderBy('date', 'desc')
                    ->limit(NewsItem::LATEST_COUNT)
                    ->get();
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
            }
        }

        return NewsItem::latest()->limit(NewsItem::LATEST_COUNT)->get();
    }
}
