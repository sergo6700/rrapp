@extends('layouts.app')

@section('title', 'Микрозаймы')

@section('content')
    <div class="fade"></div>
    <section class="activity-page-section">
        @section('header')
            @include('components.layouts.includes.header')
            @include('components.layouts.includes.mobile-menu')
        @show
        <div class="activity-page-content">
            <div class="container container_small">
                @include('components.layouts.includes.collapses')
                <h2 class="h2 section-title activity-page-title">Микрозаймы</h2>
                <div class="template-text-container activity-column-container">
                    <div class="activity-column-text">
                        <p>Результаты калькулятора будут здесь</p>
                        <p>{{ json_encode($products) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
