<?php


namespace Tests\Feature\Admin\Pages;


use App\Models\Pages\Page;
use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class AbstractPagesTest
 * @package Tests\Feature\Admin\Pages
 */
abstract class AbstractPagesTest extends AdminLoginTest
{
    /**
     * Example page data
     *
     * @var array $page_data
     */
    protected $page_data = [
        'title' => 'О проекте',
        'content' => 'Сервисный центр для предпринимателей «Мой бизнес» - уникальная площадка и новый формат, который предполагает оказание широкого комплекса услуг для бизнеса в режиме «одного окна». ',
        'template_id' => 1,
    ];

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp() :void
    {
        parent::setUp();

        Page::create($this->page_data);

        $this->assertDatabaseHas((new Page())->getTable(),
            $this->page_data
        );
    }
}