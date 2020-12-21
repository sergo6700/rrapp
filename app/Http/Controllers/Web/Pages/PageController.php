<?php

namespace App\Http\Controllers\Web\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\Page;
use Illuminate\View\View;
use App\Support\Seo\SeoUtils;

/**
 * Class PageController
 *
 * @package App\Http\Controllers\Web\Pages
 */
class PageController extends Controller
{
	/**
	 * Page show
	 *
	 * @param Page $page
	 * @return View
	 */
	public function index(Page $page): View
	{
		$pageTemplate = $page->pageTemplate;

		$data = [
			'title' => $page->title,
			'description' => SeoUtils::prepareDescription($page->content),
			'page' => $page->withFakes(),
			'pageTemplateClassName' => $pageTemplate->getRawClassName(),
			'pageTemplateStyles' => $pageTemplate->styles,
		];

		return view('web.pages.' . strtolower($pageTemplate->getViewTemplateName()), $data);
	}
}
