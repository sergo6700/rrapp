<?php


namespace App\Services\Web;


use App\Models\Docs\Document;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class DocumentService
 * @package App\Services\Web
 */
class DocumentService
{
    /**
     * Get documents for main page
     * @return Builder[]|Collection
     */
    public function getDocumentsForMainPage() {
        return Document::with('files')->orderBy('created_at')
            ->limit(Document::COUNT_ON_MAIN_PAGE)->get();
    }

	/**
	 * Documents list
	 *
	 * @param array $params
	 * @return LengthAwarePaginator
	 */
	public function index(array $params = []): LengthAwarePaginator
	{
		$query = Document::latest();

		return $query->paginate(Document::PER_PAGE)->appends($params);
	}

	/**
	 * Load info for certain document
	 *
	 * @param Document $item
	 * @return Document
	 */
	public function load(Document $item): Document
	{
		return $item->loadMissing(['files']);
	}

}
