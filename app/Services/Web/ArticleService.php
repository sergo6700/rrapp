<?php


namespace App\Services\Web;

use App\Models\Post\Article;
use App\Support\Enum\Post\VisibilityType;
use App\Support\Filter\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ArticleService
 *
 * @package App\Services\Web
 */
class ArticleService
{
    /**
     * One hundred percent
     *
     * @var int
     */
    public const ONE_HUNDRED_PERCENT = 100; // %

    /**
     * Get content with access rights
     *
     * @param Article $article
     * @param bool    $isAuthorized
     * @param int     $contentLimit
     *
     * @return array
     */
    public function getArticleWithAccessRights(Article $article, bool $isAuthorized, int $contentLimit): array
    {
        $article['is_unlimited_visibility'] = $article->is_unlimited_visibility;
        $article['auth'] = false;

        $article = $article->toArray();
        if ($article['visibility_type_id'] === VisibilityType::AUTH_ONLY && !$isAuthorized) {
            $article['content'] = '';
            $article['auth'] = true;
        } elseif ($article['visibility_type_id'] === VisibilityType::PARTIAL && !$isAuthorized) {
            $article['auth'] = true;
            $article['content'] = truncateHTML($contentLimit, $article['content']);
        }

        return $article;
    }


    /**
     * Articles list
     *
     * @param Filter $filter
     * @return array
     */
	public function index(Filter $filter): array
	{
		$perPage = Article::PER_PAGE;
		$article_view_type_temp = config('handbook.article_view_type');
		$article_view_type = array_flip(array_column($article_view_type_temp, 'id', 'class_postfix'));

		$query = Article::with('picture');
        if (!$filter->getValues()) {
            $query = $query->orderBy('fixed', 'desc');
        }

        $query->orderBy('date', 'desc');

        if (!$filter->getValues()) {
            $article_pinned = Article::where('fixed', true)->first();

            if ($article_pinned) {
                $query->where('fixed', '=', false);
                $perPage--;
                $articles = $query->paginate($perPage);
                $articles->prepend($article_pinned);
            } else {
                $articles = $query->paginate($perPage);
            }

            return [
                'articles' => $articles,
                'article_view_type' => $article_view_type,
            ];
        }

        $query->when($filter->getYear(), function ($q) use($filter) {
            return $q->whereYear('date', $filter->getYear());
        });

        $query->when($filter->getMonth(), function ($q) use($filter) {
            return $q->whereMonth('date', $filter->getMonth());
        });

        $query->when($filter->getShowVideo(), function ($q) use($filter) {
            return $q->where('is_video', $filter->getShowVideo());
        });

        $articles = $query->paginate($perPage)
            ->appends($filter->getValues());

        return [
            'articles' => $articles,
            'article_view_type' => $article_view_type,
        ];
	}

    /**
     * Get articles for main page
     *
     * @return Builder[]|Collection
     */
    public function getArticlesForMainPage() {
        return Article::with('picture')
            ->orderBy('date', 'desc')
            ->limit(Article::COUNT_ON_MAIN_PAGE)->get();
    }

    /**
     * Load Article info for details page
     *
     * @param Article $article
     *
     * @return array
     */
    public function load(Article $article): array
    {
        $article->loadMissing('picture');
        $article = $this->getArticleWithAccessRights(
            $article,
            auth()->check(),
            $this->calculateContentLimit($article->toArray())
        );

        return $article;
    }

    /**
     * Calculate article content limit
     *
     * @param array $article
     *
     * @return int
     */
    public function calculateContentLimit(array $article): int
    {
        if (!key_exists('content', $article)) {
            return 0;
        }

        $content = strip_tags($article['content']);
        $contentLimit = mb_strlen($content) * (Article::LIMIT_TEXT_SIZE_IN_PERCENT / self::ONE_HUNDRED_PERCENT);

        return (int)ceil($contentLimit);
    }

    /**
     * Similar articles collection
     *
     * @param Article $item Model
     *
     * @return Collection
     */
    public function getSimilar(Article $item): Collection
    {
        return Article::where('id', '!=', $item->id)
            ->with('picture')
            ->latest('date')
            ->limit(Article::SIMILAR_COUNT)
            ->get();
    }
}
