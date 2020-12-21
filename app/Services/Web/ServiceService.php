<?php

namespace App\Services\Web;

use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;

/**
 * Class ServiceService
 *
 * @package App\Services\Web
 */
class ServiceService extends AbstractService
{
    const ROUTE_NAME = 'service.show';

	/**
	 * Get latest services for mini calendar on top of pages
	 *
	 * @return Collection
	 */
	public function getLatestForFixedBlock(): Collection
	{
        if (strpos($this->current_route, self::ROUTE_NAME) !== false) {
            try {
                $service = \Request::route()->parameter('slug');

                return Service::where('id', '!=', $service->id)
                    ->orderBy('created_at', 'desc')
                    ->limit(Service::LATEST_COUNT)
                    ->get();
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
            }
        }

		return Service::latest()->limit(Service::LATEST_COUNT)->get();
	}

	/**
	 * Services list
	 * For example, we have 4 elements with a position field: 2, 0, 1, 0.
	 * It should display: 1, 2, 0, 0.
	 * Elements with 0 - were displayed after the elements to which the number was affixed.
	 *
	 * @param array $params
	 * @return LengthAwarePaginator
	 */
	public function index(array $params): LengthAwarePaginator
	{
		// SQL queries
		$priorityQuery = Service::with(['tags'])
			->where('position', '>', 0)
			->orderBy('position', 'ASC')
			->latest();

		$this->applyFilter($priorityQuery, $params);

		$secondaryQuery = Service::with(['tags'])
			->where('position', '=', 0)
			->latest();

		$this->applyFilter($secondaryQuery, $params);

		// get a collections
		$priorityCollection = $priorityQuery->get();
		$secondaryCollection = $secondaryQuery->get();

		$unionCollection = $priorityCollection->merge($secondaryCollection);

        return $this->createLengthAwarePaginator($unionCollection, $params);
	}

	/**
	 * Load info on certain service
	 *
	 * @param Service $service
	 * @return Service
	 */
	public function load(Service $service): Service
	{
		return $service->loadMissing(['division', 'tags' => function ($query) {
			$query->withCount('services');
		}]);
	}

    /**
     * Filter services by tags
     *
     * @param array $tags
     * @return LengthAwarePaginator
     */
	public function filter(array $tags): LengthAwarePaginator
    {
        $collection = collect();
        if ($service_identifiers_array = $this->getServiceIdsByTags($tags)) {
            $collection = Service::with(['tags'])
                ->whereIn('id', $service_identifiers_array)
                ->latest()
                ->get();
        }

        return $this->createLengthAwarePaginator($collection, $tags);
    }

    /**
     * Filter by tag names in services list
     *
     * @param Builder $query
     * @param array $params
     * @return Builder
     */
    protected function applyFilter(Builder $query, array $params): Builder
    {
        if (key_exists('tags', $params)) {
            $query->when($params['tags'] ?? null, function ($query, $tags) {
                $query->whereHas('tags', function ($query) use ($tags) {
                    $query->whereIn('name', $tags);
                });
            });
        }

        return $query;
    }


    /**
     * Create new instance of LengthAwarePaginator
     *
     * @param SupportCollection $collection
     * @param array $params
     * @return LengthAwarePaginator
     */
    private function createLengthAwarePaginator(SupportCollection $collection, array $params): LengthAwarePaginator
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $paginator = new LengthAwarePaginator(
            $collection->forPage($currentPage, Service::PER_PAGE),
            $collection->count(),
            Service::PER_PAGE,
            $currentPage,
            [
                'path' => route('service'),
            ]
        );

        return $paginator->appends($params);
    }


    /**
     * сделать выборку идентификаторов услуг по тегам.
     * Теги ищем по условию "ПЕРЕСЕЧЕНИЯ"
     *
     * @param array $tags
     * @return array
     */
    private function getServiceIdsByTags(array $tags): array
    {
        // фильтрация должна быть по непустому массиву
        if (!$tags) { return []; }

        // получаем коллекцию всех возможных значений тегов->услуг
        $result = \DB::table('taggables')
            ->join('services', 'taggables.taggable_id', '=', 'services.id')
            ->whereNull('deleted_at')
            ->whereIn('tag_id', function ($query) use($tags) {
                $query->select('id')
                    ->from('tags')
                    ->whereIn('name', $tags);
            })->get();


        // создаём двухмерный массив, где ключами будут ИД тегов, а значениями будет массивы с ИД сервисов
        $tags_arr = [];
        $result->each(function ($item, $key) use(&$tags_arr) {
            $tags_arr[$item->tag_id][] = $item->taggable_id;
        });


        // Ищем пересекающиеся id's сервисов
        $services_ids_arr = [];
        while($array = current($tags_arr))
        {
            while($id = array_shift($array)) {
                if ($this->array_search_all($id, $tags_arr) === true) {
                    $services_ids_arr[] = $id;
                }
            }

            next($tags_arr);
        }

        return array_unique($services_ids_arr);
    }

    /**
     * Осуществляет поиск данного значения в двух-мерном массиве (two-dimensional array)
     * и возвращает true если значение есть в каждом под-массиве
     *
     * @param int $id
     * @param array $array
     * @return bool
     */
    private function array_search_all(int $id, array $array): bool
    {
        foreach ($array as $item) {
            if (!is_array($item) || !$item) {
                return false;
            }

            if (array_search($id, $item) === false) {
                return false;
            }
        }

        return true;
    }
}
