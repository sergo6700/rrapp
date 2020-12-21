<?php

namespace Tests\Feature\Web\Breadcrumbs;

use Tests\Feature\BaseFeatureTest;

/**
 * Class BreadcrumbsTest
 *
 * @package Tests\Feature\Web\Breadcrumbs
 */
class BreadcrumbsTest extends BaseFeatureTest
{
    const FRAGMENT = 'schema.org/BreadcrumbList';

    /**
     * Check for breadcrumbs on page
     *
     * @return void
     */
    public function testExist()
    {
        $response = $this->get(route('article.index'));

        $response->assertStatus(200);

        $this->assertContains(self::FRAGMENT, $response->content());
    }

    /**
     * Check missing breadcrumbs on page
     *
     * @return void
     */
    public function testNotExist()
    {
        $response = $this->get(route('main.page'));
        $response->assertStatus(200);
        $this->assertNotContains(self::FRAGMENT, $response->content());
    }
}
