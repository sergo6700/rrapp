@php
use App\Support\Acl\PermissionUtils;
$me = auth('backpack')->user();
@endphp

@if (backpack_auth()->check())
    <aside class="main-sidebar">
        <section class="sidebar">
            <!-- Sidebar user panel -->
        @include('backpack::inc.sidebar_user_panel')

            <ul class="sidebar-menu" data-widget="tree">
                <li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>

				{{-----------------------------  SECTION SLIDER ON MAIN PAGE -----------------------------------}}

				@can('admin_slider')
				<li class="header">НАСТРОКА ГЛАВНОЙ СТРАНИЦЫ</li>
				<li><a href="{{ backpack_url('slider') }}"><i class="fa fa-qrcode"></i> <span>Слайдер</span></a></li>
				@endcan

                <li><a href="{{ backpack_url('main') }}"><i class="fa fa-home"></i> <span>Главная страница</span></a></li>

                {{-----------------------------  SECTION BLOG -----------------------------------}}
                {!! PermissionUtils::userHasAnyPermission($me, ['admin_article', 'admin_news']) ? '<li class="header">БЛОГ</li>' :  "" !!}

                <li class="treeview">
                    <a href="#"><i class="fa fa-book"></i> <span>База знаний</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ backpack_url('articles') }}">
                                <i class="fa fa-newspaper-o"></i> <span>Статьи</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ backpack_url('article-video') }}">
                                <i class="fa fa-play"></i>
                                <span>Видео</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li><a href="{{ backpack_url('news') }}"><i class="fa fa-newspaper-o"></i><span>Новости</span></a></li>

                {{-----------------------------  SECTION CONTENT -----------------------------------}}

                {!! PermissionUtils::userHasAnyPermission($me, ['admin_page', 'admin_page_template', 'admin_documents']) ? '<li class="header">КОНТЕНТ</li>' :  "" !!}
                <li><a href="{{ backpack_url('page') }}"><i class="fa fa-file-o"></i> <span>Страницы</span></a></li>

                <li><a href="{{ backpack_url('media') }}"><i class="fa fa-medium"></i> <span>СМИ о нас</span></a></li>

                @can('admin_documents')
                <li><a href="{{ backpack_url('docs') }}"><i class="fa fa-folder-open-o"></i><span>Документы</span></a></li>
                @endcan

                @can('admin_divisions')
                <li><a href="{{ backpack_url('departments') }}"><i class="fa fa-file-o"></i> <span>Подразделения</span></a></li>
                @endcan

                <li class="treeview">

                    <a href="#"><i class="fa fa-calendar"></i> <span>Мероприятия</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/upcoming-events') }}">
                                <i class="fa fa-calendar-plus-o"></i> <span>Будущие</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/past-events') }}">
                                <i class="fa fa-calendar-times-o"></i> <span>Прошедшие</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li><a href="{{ backpack_url('services') }}"><i class="fa fa-shirtsinbulk"></i> <span>Меры поддержки</span></a></li>

                {{-----------------------------  SECTION APPLICATIONS -----------------------------------}}

                {!! PermissionUtils::userHasAnyPermission($me, ['admin_page', 'admin_page_template']) ? '<li class="header">ЗАЯВКИ</li>' :  "" !!}
                <li><a href="{{ backpack_url('application-service') }}"><i class="fa fa-envelope"></i> <span>Меры поддержки</span></a></li>
                <li><a href="{{ backpack_url('application-feedback') }}"><i class="fa fa-envelope"></i> <span>Обратная связь</span></a></li>
                <li><a href="{{ backpack_url('registration-to-event') }}"><i class="fa fa-envelope"></i> <span>Мероприятия</span></a></li>

                {{-----------------------------  SECTION PERMISSIONS --------------------------------}}

                {!! PermissionUtils::userHasAnyPermission($me, ['admin_page', 'admin_page_template']) ? '<li class="header">ПОЛЬЗОВАТЕЛИ</li>' :  "" !!}
                @can('admin_users')
                <li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>Пользователи</span></a></li>
                @endcan
                @can('admin_roles')
                <li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Роли</span></a></li>
                @endcan
                @can('admin_permissions')
                <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-lock"></i> <span>Права</span></a></li>
                @endcan

                {{-----------------------------  SECTION SYSTEMS -----------------------------------}}

                @can('admin_settings')
                <li class="header">СИСТЕМА</li>
                <li><a href='{{ url(config('backpack.base.route_prefix', 'admin') . '/setting') }}'><i class='fa fa-cog'></i> <span>Настройки</span></a></li>
                <li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-sitemap"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
                <li><a href="{{ backpack_url('page-template') }}"><i class="fa fa-wpforms"></i> <span>Шаблоны страниц</span></a></li>
                <li><a href="{{ backpack_url('email-template') }}"><i class="fa fa-envelope-square"></i> <span>E-mail шаблоны</span></a></li>
                @endcan

                @can('admin_stats')
                    <li><a href="{{ backpack_url('statistics') }}"><i class="fa fa-bar-chart"></i><span>Статистика</span></a></li>
                @endcan
            </ul>
        </section>
<!-- /.sidebar -->
    </aside>
@endif
