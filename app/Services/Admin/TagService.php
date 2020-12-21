<?php

namespace App\Services\Admin;

use App\Models\Tag\Tag;

/**
 * Class TagService
 *
 * @package App\Services\Admin
 */
class TagService
{

    /**
     * Remove old tags
     *
     * @return void
     */
	public function removeOldTags(): void
	{
        $tags = Tag::withCount('services')->get();

        $old_tags = $tags->filter(function ($value) {
            return $value->services_count == 0;
        });

        foreach ($old_tags as $tag) {
            $tag->delete();
        }
	}

}
