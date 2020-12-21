@extends('layouts.app')

@section('title', 'Проверьте свой адрес электронной почты')

@section('content')
    <div class="fade"></div>
    <section class="my-activities-section">
        @section('header')
            @include('components.layouts.includes.header')
            @include('components.layouts.includes.mobile-menu')
        @show
        <div class="my-activities-content container container_small">
            @include('components.layouts.includes.collapses')
            <h2 class="h2 section-title">{{ __('Verify Your Email Address') }}</h2>


            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                {{ __('Before proceeding, please check your email for a verification link.') }}<br>
                {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
            </div>

        </div>

    </section>
    @include('components.layouts.sections.popup', ['title' => 'Проверьте свой адрес электронной почты'])
@endsection

