<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/ulogin', 'Auth\UloginRegisterController@register')
    ->middleware('ulogin')
    ->name('ulogin');

Route::post('/registration-step-2', 'Profile\ProfileController@step2updateProfile')
    ->name('register.profile.update');

Route::get('/', 'Main\MainController@index')->name('main.page');

Route::get('/registration/events/{event}/third-party-site', 'Events\RegistrationFromThirdPartySiteController@index')
    ->name('registration.events.index');

Route::post('/registration/events/{event}/third-party-site', 'Events\RegistrationFromThirdPartySiteController@register')
    ->name('registration.events.register');

Route::get('/statistics/events/{event}/{hash}', 'Events\EventStatisticsController@index')
    ->where(['event' => '[0-9]+', 'hash' => '[a-z0-9]+'])
    ->middleware('checkHash')
    ->name('events.statistics.show');

Route::get('/events', 'Events\EventController@index')->name('event');
Route::get('/events/{slug}', 'Events\EventController@show')->name('event.show');

Route::get('/media', 'Media\MediaController@index')->name('media');

Route::get('/services', 'Services\ServiceController@index')->name('service');
Route::get('/services/{slug}', 'Services\ServiceController@show')->name(
    'service.show'
);
Route::post(
    '/services/{service}',
    'Services\ServiceController@sendFeedback'
)->name('service.send-feedback');
Route::post('/service/tags/filter', 'Services\ServiceController@filterByTags')
->name('services.tags.filter');


Route::get('/departments', 'Departments\DepartmentController@index')->name(
    'department'
);
Route::get('/departments/{slug}', 'Departments\DepartmentController@show')->name(
    'department.show'
);

Route::get('/news', 'News\NewsController@index')->name('news');
Route::get('/news/{slug}', 'News\NewsController@show')->name('news.show');

Route::get('/media', 'Media\MediaController@index')->name('media');

Route::get('/articles', 'Articles\ArticleController@index')->name(
    'article.index'
);
Route::get('/articles/{slug}', 'Articles\ArticleController@show')->name(
    'article.show'
);

Route::post('/application', 'Application\ApplicationController@create')->name(
    'application.create'
);

Route::get('/docs', 'Documents\DocumentController@index')->name('docs.index');
Route::get('/docs/{slug}', 'Documents\DocumentController@show')->name(
    'docs.show'
);

Route::group(
    [
        'middleware' => ['auth', 'verified']
    ],
    function () {
        Route::delete(
            '/event-registration/{event}',
            'Application\RegistrationToEventController@destroy'
        )->name('registration.event.cancel');
        Route::get('/profile', 'Profile\ProfileController@index')->name(
            'profile.user.index'
        );
        Route::put('/profile', 'Profile\ProfileController@updateProfile')->name(
            'profile.user.update'
        );
        Route::patch(
            '/profile',
            'Profile\ProfileController@updateNotifications'
        )->name('profile.notifications.update');
        Route::post(
            '/registration-to-event',
            'Application\RegistrationToEventController@create'
        )->name('registration.event.create');
    }
);

/**
 * Подключение произвольных страниц
 * Должен быть в конце списка роутинга
 */

//Route::get('/o-proekte', function () {
//    return view('/web/template-pages/index');
//})->name('template-page');

Route::get('/activities', function () {
    return view('/web/activities/index');
})->name('activities');

Route::get(
    '/activity', function () {
        return view('/web/activity/index');
    }
)->name('activity');

Route::get(
    '/articles-page', function () {
        return view('web/articles-page/index');
    }
)->name('articles-page');

Route::get(
    '/subdivision-page', function () {
        return view('web/subdivision-page/index');
    }
)->name('subdivision-page');

Route::get(
    '/my-activities', function () {
        return view('/web/my-activities/index');
    }
);

Route::get(
    '/service-page', function () {
        return view('web/service-page/index');
    }
);

Route::get('/documents-page', 'Documents\DocumentController@index')->name('documents-page');

Route::get(
    '/404', function () {
        return view('web/pages/404/index');
    }
);

Route::get(
    '/iframe', function () {
        return view('web/iframe/index');
    }
);

Route::get('/microcredit', 'Microcredit\MicrocreditController@index')->name('microcredit');
Route::get('/microcredit/calculation', 'Microcredit\MicrocreditController@calculation')->name('microcredit.calculation');

Route::get('{page}/{subs?}', 'Pages\PageController@index')
    ->where(
        [
        'page' => '^(((?=(?!admin))(?=(?!\/)).))*$',
        'subs' => '.*'
        ]
    )
    ->name('page.show');
