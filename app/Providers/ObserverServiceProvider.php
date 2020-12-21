<?php

namespace App\Providers;

use App\Models\Acl\User;
use App\Models\Application\Application;
use App\Models\Division\Division;
use App\Models\Docs\Document;
use App\Models\Event\Event;
use App\Models\File\File;
use App\Models\File\Picture;
use App\Models\Post\Article;
use App\Models\Post\NewsItem;
use App\Models\Service\Service;
use App\Models\Tag\Tag;
use App\Observers\Models\ApplicationObserver;
use App\Observers\Models\ArticleObserver;
use App\Observers\Models\DivisionObserver;
use App\Observers\Models\DocumentObserver;
use App\Observers\Models\EventObserver;
use App\Observers\Models\FileObserver;
use App\Observers\Models\NewsItemObserver;
use App\Observers\Models\PictureObserver;

use App\Observers\Models\ServiceObserver;
use App\Observers\Models\TagObserver;
use App\Observers\Models\UserObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        File::observe(FileObserver::class);
        Picture::observe(PictureObserver::class);
        Application::observe(ApplicationObserver::class);
        Article::observe(ArticleObserver::class);
        Division::observe(DivisionObserver::class);
        Document::observe(DocumentObserver::class);
        Event::observe(EventObserver::class);
        NewsItem::observe(NewsItemObserver::class);
        Service::observe(ServiceObserver::class);
        Tag::observe(TagObserver::class);
        User::observe(UserObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
