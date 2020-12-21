<?php


namespace App\Support\Seo;

use App\Models\PageMetadata\PageMetadata;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use App\Support\Contracts\Seo\SeoUtils as FactoryContract;

/**
 * Class SeoUtils
 *
 * @package App\Support\Seo
 */
class SeoUtils implements FactoryContract
{
    /**
     * Max description length
     *
     * @var int
     */
    const MAX_LENGTH_DESCRIPTION = 150;

    /**
     * Page meta tags
     *
     * @var PageMetadata|null
     */
    protected $meta_tags;

    /**
     * LengthAwarePaginator object (Manual Paginator)
     *
     * @var LengthAwarePaginator|null
     */
    protected $paginator;

    /**
     * Additional pagination phrase to page title
     *
     * @var string
     */
    protected $additional_pagination_phrase_to_page_title = ' - Страница %d';

    
    /**
     * SeoUtils constructor.
     *
     * @param string                    $type      Page alias
     * @param LengthAwarePaginator|null $paginator Paginator
     */
    public function __construct(string $type, LengthAwarePaginator $paginator = null)
    {
        $this->paginator = $paginator;
        $this->meta_tags = PageMetadata::where('page_alias', $type)->first();
        if (!$this->meta_tags) {
            throw new \InvalidArgumentException('Invalid type in class ' . __CLASS__);
        }
    }

    /**
     * Get page meta title
     *
     * @return string
     */
    public function getTitle() :string
    {
        return $this->additionalPaginationPhraseToPageTitle($this->meta_tags->title);
    }

    /**
     * Add an additional phrase about pagination to the page title
     *
     * @param string $title Page title
     *
     * @return string
     */
    protected function additionalPaginationPhraseToPageTitle(string $title) :string
    {
        if ($this->paginator && $this->paginator->currentPage() > 1) {
            $title .= sprintf($this->additional_pagination_phrase_to_page_title, $this->paginator->currentPage());
        }

        return $title;
    }

    /**
     * Get page meta description
     *
     * @return string
     */
    public function getDescription() :string
    {
        return self::prepareDescription($this->meta_tags->description);
    }

    /**
     * Prepare $description for output to page
     *
     * @param string $description Page description
     *
     * @return string
     */
    public static function prepareDescription($description) :string
    {
        $description = trim(strip_tags((string)$description));
        $description = trim(preg_replace('/\s\s+/', ' ', $description));

        return Str::limit(
            $description,
            self::MAX_LENGTH_DESCRIPTION
        );
    }
}
