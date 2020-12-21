<?php

namespace App\Observers\Models;

use App\Models\Post\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class ArticleObserver
 *
 * @package App\Observers\Models
 */
class ArticleObserver
{
    /**
     * Handle the article "created" event.
     *
     * @param Article $article
     *
     * @return void
     */
    public function created(Article $article)
    {
        $article->update(
            [
            'slug' => $article->id . '-' . $article->slug
            ]
        );
    }

    /**
     * Handle the article "updated" event.
     *
     * @param  Article $article
     * @return void
     */
    public function updated(Article $article)
    {
        DB::table($article->getTable())
            ->where('id', $article->id)
            ->update(['slug' => $article->id . '-' . Str::slug($article->title)]);
    }
}
