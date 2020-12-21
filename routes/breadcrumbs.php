<?php

use App\Models\PageMetadata\PageMetadata;
use App\Support\Seo\SeoUtils;

/**
 * Home
 */
Breadcrumbs::for('home', function ($trail) {
    $seoUtils = new SeoUtils(PageMetadata::MAIN_ALIAS);
    $trail->push($seoUtils->getTitle(), route('main.page'));
});

/**
 * News
 */
Breadcrumbs::for('news', function ($trail) {
    $trail->parent('home');

    $seoUtils = new SeoUtils(PageMetadata::NEWS_ALIAS);
    $trail->push($seoUtils->getTitle(), route('news'));
});

/**
 * Home > News > [piece of News]
 */
Breadcrumbs::for('news.show', function ($trail, $news) {
    $trail->parent('news');
    $trail->push($news->title, route('news.show', $news->id));
});

/**
 * Departments
 */
Breadcrumbs::for('departments', function ($trail) {
    $trail->parent('home');

    $seoUtils = new SeoUtils(PageMetadata::DEPARTMENTS_ALIAS);
    $trail->push($seoUtils->getTitle(), route('news'));
});

/**
 * Home > Departments > [department]
 */
Breadcrumbs::for('departments.show', function ($trail, $department) {
    $trail->parent('departments');
    $trail->push($department->name, route('news.show', $department->id));
});


/**
 * Services
 */
Breadcrumbs::for('services', function ($trail) {
    $trail->parent('home');

    $seoUtils = new SeoUtils(PageMetadata::SERVICES_ALIAS);
    $trail->push($seoUtils->getTitle(), route('service'));
});

/**
 * Home > Services > [service]
 */
Breadcrumbs::for('services.show', function ($trail, $service) {
    $trail->parent('services');
    $trail->push($service->title, route('service.show', $service->id));
});


/**
 * Events
 */
Breadcrumbs::for('events', function ($trail) {
    $isPast = (int) request('past');
    $type = $isPast ? PageMetadata::PAST_EVENTS_ALIAS : PageMetadata::UPCOMING_EVENTS_ALIAS;
    $seoUtils = new SeoUtils($type);

    $trail->parent('home');
    $trail->push($seoUtils->getTitle(), route('event'));
});

/**
 * Home > Events > [event]
 */
Breadcrumbs::for('events.show', function ($trail, $event) {
    $type = $event->getPassedAttribute() ? PageMetadata::PAST_EVENTS_ALIAS : PageMetadata::UPCOMING_EVENTS_ALIAS;
    $seoUtils = new SeoUtils($type);

    $trail->parent('home');
    $trail->push($seoUtils->getTitle(), route('event', ['past' => 1]));
    $trail->push($event->title, route('event.show', $event->id));
});


/**
 * Articles
 */
Breadcrumbs::for('articles', function ($trail) {
    $trail->parent('home');

    $seoUtils = new SeoUtils(PageMetadata::ARTICLES_ALIAS);
    $trail->push($seoUtils->getTitle(), route('article.index'));
});

/**
 * Home > Articles > [article]
 */
Breadcrumbs::for('articles.show', function ($trail, $article) {
    $trail->parent('articles');
    $trail->push($article['title'], route('article.show', $article['id']));
});


/**
 * Docs
 */
Breadcrumbs::for('docs', function ($trail) {
    $trail->parent('home');

    $seoUtils = new SeoUtils(PageMetadata::DOCS_ALIAS);
    $trail->push($seoUtils->getTitle(), route('docs.index'));
});

/**
 * Home > Docs > [document]
 */
Breadcrumbs::for('docs.show', function ($trail, $document) {
    $trail->parent('docs');
    $trail->push($document->name, route('docs.show', $document->id));
});

/**
 * Media
 */
Breadcrumbs::for('media', function ($trail) {
    $trail->parent('home');

    $seoUtils = new SeoUtils(PageMetadata::MEDIA_ALIAS);
    $trail->push($seoUtils->getTitle(), route('media'));
});

/**
 * Profile
 */
Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('home');

    $seoUtils = new SeoUtils(PageMetadata::PROFILE_ALIAS);
    $trail->push($seoUtils->getTitle(), route('profile.user.index'));
});


/**
 * Page
 */
Breadcrumbs::for('page.show', function ($trail, $page) {
    $trail->parent('home');
    $trail->push($page->title, route('page.show', $page->id));
});