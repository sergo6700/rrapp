@extends('layouts.app')

@section('content')
    <div class="fade"></div>
    <section class="page-section">
        @section('header')
            @include('components.layouts.includes.header')
            @include('components.layouts.includes.mobile-menu')
        @show
        <div class="collapses-container container container_small">
            @include('components.layouts.includes.collapses')

            @yield('breadcrumbs')
        </div>

        @yield('content.child')

    </section>
    @stack('popup')
@endsection