<?php

namespace App\Services\Web;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TagService
 *
 * @package App\Services\Web
 */
class TagService
{
	/**
	 * Tags list
	 *
	 * @return Collection
	 */
	public function index(): Collection
	{
		return Tag::withCount('services')->orderBy('name')->get();
	}

	/**
	 * Load tag info by slug
	 *
	 * @param string $slug
	 * @return Tag
	 */
	public function loadBySlug(string $slug): Tag
	{
		return Tag::withCount('services')
			->where(compact('slug'))
			->first();
	}

    /**
     * Load tag collection by names
     * @param array $array
     * @return Collection
     */
    public function loadByName(array $array): Collection
    {
        return Tag::withCount('services')
            ->whereIn('name', $array)
            ->get();
    }
}
