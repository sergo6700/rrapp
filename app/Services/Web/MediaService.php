<?php


namespace App\Services\Web;

use App\Models\Media\Media;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class MediaService
 * @package App\Services\Web
 */
class MediaService
{
    /**
     * Articles list
     *
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function index(array $params = []): LengthAwarePaginator
    {
        $query = Media::with('picture')
            ->orderBy('fixed', 'desc')
            ->latest();

        $perPage = Media::PER_PAGE;
        $fixedArticle = Media::where('fixed', true)->first();

        // if there is a pinned element, then we add it to each page
        if (!empty($params) && $fixedArticle) {
            $query->where('fixed', '=', false);
            $perPage--;
            $media = $query->paginate($perPage);
            $media->prepend($fixedArticle);
        } else {
            $media = $query->paginate($perPage);
        }

        return $media;
    }
}
