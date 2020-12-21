<?php

namespace App\Http\Controllers\Admin\PageMetadata;

use App\Http\Requests\Admin\PageMetadata\PageMetadataRequest;
use App\Http\Controllers\Controller;
use App\Models\PageMetadata\PageMetadata;

/**
 * Class PageMetadataController
 * @package App\Http\Controllers\Admin\PageMetadata
 */
class PageMetadataController extends Controller
{
    public function store(PageMetadataRequest $request)
    {
        $pageMetadata = PageMetadata::where('page_alias', $request->get('page_alias'))->first();
        if ($pageMetadata) {
            $pageMetadata->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }

        return response()->json([
            'status' => 'success'
        ]);
    }
}