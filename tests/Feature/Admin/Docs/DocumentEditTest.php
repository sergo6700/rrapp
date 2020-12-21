<?php


namespace Tests\Feature\Admin\Docs;

use App\Models\Docs\Document;

/**
 * Class DocumentEditTest
 *
 * @package Tests\Feature\Admin\Docs
 * @coversDefaultClass \App\Http\Controllers\Admin\Docs\DocumentCrudController
 */
class DocumentEditTest extends AbstractDocumentTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Docs\DocumentCrudController::edit
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $document = Document::where($this->document_data)->first();
        $response = $this->get(route('crud.document.edit', ['id' => $document->id]));

        $response->assertOk();
        $response->assertViewIs("crud::edit");
    }
}