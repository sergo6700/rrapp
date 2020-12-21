@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>Статистика</h1>
        <ol class="breadcrumb">
            <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">{{ trans('backpack::base.dashboard') }}</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">Статистика</div>
                </div>

                <div class="box-body">
                    <h3>Всего зарегистрированных пользователей: {{ $totalUsersCount }}</h3>
                    <br/>

                    <div class="contentDivider"></div>

                    <h3>Новые пользователи:</h3>
                    <div id="newUsersBlock"></div>
                    <br/>

                    <div class="contentDivider"></div>

                    <h3>Воспользовалось сервисами:</h3>
                    <div id="servicesActivityBlock"></div>
                    <br/>

                    <div class="contentDivider"></div>

                    <h3>Прошедшие мероприятия:</h3>
                    @include('admin.stats.tables.events_activity', ['records' => $eventsActivityRecords])
                </div>
            </div>
        </div>
    </div>
    <style>
        .contentDivider {
            border-bottom: 1px solid #ccc;
        }
    </style>
    <script>
        var selectedYear = new Date().getFullYear();
        var selectedMonth = new Date().getMonth() + 1;
        var csrfToken = "";

        /**
         * Refreshing new users stats block via AJAX request
         * @param year
         * @param month
         */
        function refreshNewUsersTable(year, month) {
            year = year || new Date().getFullYear();
            month = month || new Date().getMonth() + 1;

            $.get("/admin/stats/new-users-table/get?" + $.param({
                _token: csrfToken,
                month: month,
                year: year
            })).done(function( html ) {
                $('#newUsersBlock').html(html);
            });
        }

        /**
         * Refreshing new users stats block when value in select is changed
         */
        function newUsersFormUpdated() {
            refreshNewUsersTable($("#newUsersYear").val(), $("#newUsersMonth").val());
        }

        /**
         * Refreshing services activity stats block via AJAX request
         * @param year
         * @param month
         */
        function refreshServicesActivityTable(year, month) {
            year = year || new Date().getFullYear();
            month = month || new Date().getMonth() + 1;

            $.get("/admin/stats/services-activity-table/get?" + $.param({
                _token: csrfToken,
                month: month,
                year: year
            })).done(function( html ) {
                $('#servicesActivityBlock').html(html);
            });
        }

        /**
         * Refreshing services activity stats block when value in select is changed
         */
        function servicesActivityFormUpdated() {
            refreshServicesActivityTable($("#servicesActivityYear").val(), $("#servicesActivityMonth").val());
        }

        /**
         * storing csrf token and loading stats block after page load
         */
        window.onload = function() {
            csrfToken = $('meta[name="csrf-token"]').attr('content');
            refreshNewUsersTable(selectedYear, selectedMonth);
            refreshServicesActivityTable(selectedYear, selectedMonth);
        };
    </script>
@endsection

