<?php


namespace App\Support\Seo;

use App\Models\Tag\Tag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class SeoServiceUtils
 * @package App\Support\Seo
 */
class SeoServiceUtils extends SeoUtils
{
    /**
     * Selected Tag
     * @var Tag|null
     */
    protected $selected_tag;

    /**
     * Additional phrase about tag to page title
     * @var string
     */
    protected $additional_tag_phrase_to_page_title = ' - %s тег';

	/**
	 * SeoServiceUtils constructor.
	 * @param string $type
	 * @param LengthAwarePaginator|null $paginator
	 * @param Tag|null $selected_tag
	 * @throws \ReflectionException
	 */
    public function __construct(string $type, LengthAwarePaginator $paginator = null, Tag $selected_tag = null)
    {
        parent::__construct($type, $paginator);

        $this->selected_tag = $selected_tag;
    }

    /**
     * Get page meta title
     * @return string
     */
    public function getTitle() :string
    {
        $title = $this->additionalTagPhraseToPageTitle($this->meta_tags->title);

        return $this->additionalPaginationPhraseToPageTitle($title);
    }

    /**
     * Add an additional phrase about the tag to the page title
     * @param string $title
     * @return string
     */
    protected function additionalTagPhraseToPageTitle(string $title) :string
    {
        if ($this->selected_tag) {
            $phrase = sprintf($this->additional_tag_phrase_to_page_title, $this->selected_tag->name);
            $title .= $phrase ?? $phrase;
        }

        return $title;
    }
}
