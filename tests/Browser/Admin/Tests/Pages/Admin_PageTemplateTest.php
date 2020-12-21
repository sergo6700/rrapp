<?php
namespace Tests\Browser\Admin\Tests\Pages;

use App\Models\Pages\PageTemplate;
use Laravel\Dusk\Browser;
use Tests\Browser\Admin\AdminTestCase;
use Tests\Browser\Admin\Pages\PageTemplate\BackpackPageTemplate;
use Tests\Browser\Admin\Pages\PageTemplate\BackpackPageTemplateCreate;
use Tests\Browser\Admin\Pages\PageTemplate\BackpackPageTemplateEdit;

class AdminPageTemplateTest extends AdminTestCase
{

    public function setUp() : void
    {
        parent::setUp();

        $this->pages = (object) [
            'list'  => new BackpackPageTemplate(),
            'create' => new BackpackPageTemplateCreate(),
            'edit' => new BackpackPageTemplateEdit(1),
        ];
    }

    /**
     * test Route('/admin/page-template')
     *
     * @throws \Throwable
     */
    public function testPageTemplateList()
    {
        $this->browse(function(Browser $browser) {
            $browser
                ->loginAs($this->admin, 'backpack')
                ->visit($this->pages->list);
        });
    }

    /**
     * test Route('/admin/page-template/create')
     *
     * @throws \Throwable
     */
    public function testPageTemplateCreate()
    {
        $templates = PageTemplate::getTemplates();

        $this->browse(function(Browser $browser) use($templates) {
            $browser
                ->loginAs($this->admin, 'backpack')
                ->visit($this->pages->create)
                    ->submitCreateForm()
//                    ->assertUrlIs($this->pages->list->url())
;
                // go to list
            $browser->loginAs($this->admin, 'backpack')
                ->visit($this->pages->list)
                    ->with('#crudTable', function(Browser $brws) {
                        $brws->assertSee('TEMPLATE_NAME');
                        $brws->assertSee('.test-classname');
                    })

                // check edit
//                ->on($this->pages->edit)
//                    ->assertSelectHasOptions('template', $templates)
//                    ->submitEditForm()
//                    ->assertUrlIs($this->pages->list->url())
                ;
        });
    }

}
