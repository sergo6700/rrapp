<?php


namespace Tests\Feature\Admin\Docs;

use App\Models\Docs\Document;
use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class AbstractDocumentTest
 * @package Tests\Feature\Admin\Docs
 */
class AbstractDocumentTest extends AdminLoginTest
{
    protected $document_data = [
        'name' => 'Портал бизнес-навигатора МСП',
        'content' => 'Презентация «Портал бизнес-навигатора МСП»',
    ];

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp() :void
    {
        parent::setUp();

        Document::create($this->document_data);

        $this->assertDatabaseHas((new Document())->getTable(),
            $this->document_data
        );
    }
}