<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () {
    // custom admin routes
    Route::group(['middleware' => 'has_permission:admin_users'], function () {
        Route::get('user/ajax-column-search/{column}', 'User\UserCrudController@columnSearch');
        Route::post('/pagemetadata', 'PageMetadata\PageMetadataController@store')->name('admin.pagemetadata.store');
    });

    Route::get('user/{user}/show', 'User\UserCrudController@show');

    Route::group(['middleware' => ['has_permission:admin_article']], function () {
        Route::get('article/ajax-name-search', 'Post\ArticleCrudController@nameSearch');
        CRUD::resource('main', 'Main\MainCrudController');
        CRUD::resource('articles', 'Post\ArticleCrudController');
        CRUD::resource('article-video', 'Post\ArticleVideoCrudController');
    });

    Route::group(['middleware' => ['has_permission:admin_slider']], function () {
        CRUD::resource('slider', 'Slider\SliderCrudController');
    });

    Route::group(['middleware' => ['has_permission:admin_news']], function () {
        Route::get('news/ajax-name-search', 'Post\NewsCrudController@nameSearch');
        CRUD::resource('news', 'Post\NewsCrudController');
    });
    Route::group(['middleware' => ['has_permission:admin_page']], function () {
        CRUD::resource('page', 'Pages\PageCrudController');
    });

    Route::group(['middleware' => ['has_permission:admin_media']], function () {
        Route::get('media/ajax-description-search', 'Media\MediaCrudController@descriptionSearch');
        Route::get('media/ajax-link-search', 'Media\MediaCrudController@linkSearch');
        CRUD::resource('media', 'Media\MediaCrudController');
    });

    Route::group(['middleware' => ['has_permission:admin_page_template']], function () {
        CRUD::resource('page-template', 'Pages\PageTemplateCrudController');
    });

    Route::get(
        'upcoming-events/ajax-name-event-search',
        'Event\UpcomingEventCrudController@nameEventSearch'
    );
    CRUD::resource('upcoming-events', 'Event\UpcomingEventCrudController');

    Route::get('past-events/ajax-name-event-search', 'Event\PastEventCrudController@nameEventSearch');
    CRUD::resource('past-events', 'Event\PastEventCrudController');
    CRUD::resource('events/{event}/users', 'User\RegisteredUsersToEventCrudController');

    CRUD::resource('services', 'Service\ServiceCrudController');

    CRUD::resource('application-service', 'Application\ApplicationServiceCrudController');
    Route::get(
        'application-service/{application}/complete',
        'Application\ApplicationServiceCrudController@complete'
    );
    Route::get(
        'application-service/{application}/return_to_work',
        'Application\ApplicationServiceCrudController@returnToWork'
    );

    CRUD::resource('application-feedback', 'Application\ApplicationFeedbackCrudController');
    Route::get(
        'application-feedback/{application}/complete',
        'Application\ApplicationFeedbackCrudController@complete'
    );
    Route::get(
        'application-feedback/{application}/return_to_work',
        'Application\ApplicationFeedbackCrudController@returnToWork'
    );

    CRUD::resource('email-template', 'Email\EmailTemplateCrudController');

    CRUD::resource('registration-to-event', 'Application\RegistrationToEventCrudController');

    Route::group(['middleware' => ['has_permission:admin_divisions']], function () {
        CRUD::resource('departments', 'Division\DivisionCrudController');
    });
    Route::group(['middleware' => ['has_permission:admin_documents']], function () {
        CRUD::resource('docs', 'Docs\DocumentCrudController');
    });
    Route::group(['middleware' => ['has_permission:admin_stats']], function () {
        Route::get('statistics', 'Stats\StatisticsController@index');
        Route::get('stats/new-users-table/get', 'Stats\StatisticsController@newUsersTable');
        Route::get('stats/services-activity-table/get', 'Stats\StatisticsController@servicesActivityTable');
    });
}); // this should be the absolute last line of this file
