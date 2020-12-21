@extends('layouts.extend')

@section('title', $title)
@section('description', $description)
@section('breadcrumbs', Breadcrumbs::render('articles'))

@section('content.child')
    <div class="section-content">
        <div class="container container_small">

            <div class="title-with-filters">
                <div class="title-with-filters__content">
                    <div class="title-with-filters__title">
                        <h2 class="h2 text_semi-bold">База знаний</h2>
                    </div>
                    <div class="title-with-filters__buttons">
                        <button class="button button_rounded button_grey-border-tr button_filter">
                            <svg width="18" height="18" class="svg-filter" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.5833 17.25H15.4167V11.75H13.5833V17.25ZM2.58333 17.25H4.41667V8.08333H2.58333L2.58333 17.25ZM17.25 8.08333H15.4167L15.4167 0.75H13.5833L13.5833 8.08333H11.75V9.91667H17.25V8.08333ZM6.25 13.5833H8.08333V17.25H9.91667V13.5833H11.75V11.75H6.25V13.5833ZM9.91667 0.75H8.08333V9.91667H9.91667L9.91667 0.75ZM6.25 6.25V4.41667H4.41667V0.75H2.58333V4.41667H0.75L0.75 6.25H6.25Z" fill="black"/>
                            </svg>
                            <span class="text text_bold text_17 text_black">Фильтр</span>
                        </button>
                    </div>
                </div>
                @include('components.layouts.includes.filter-dropdown-with-option-video')
            </div>

            <div class="articles-section-container">
                @foreach ($articles->items() as $article)
                    <article class="articles-block articles-block{{$article_view_type[$article->view_id]}}"
                             style="background: url('{{ asset($article->picture['path']) }}') center center no-repeat; background-size: cover;"
                             itemscope itemtype="http://schema.org/Article">
                        <meta itemprop="image" content="{{ asset($article->picture['path']) }}">
                        <div class="articles-card__gradient"></div>
                        <div class="articles-block__content">
                            <time class="articles-block__date text text_17 text_white">{{Date::parse($article->date)->format('j F, Y')}}</time>
                            <meta itemprop="datePublished" content="{{ $article->date->isoFormat('YYYY-MM-DD') ?? null }}">
                            <meta itemprop="dateModified" content="{{ $article->date->isoFormat('YYYY-MM-DD') ?? null }}">
                            <meta itemprop="headline name" content="{{ Str::limit($article->title, 105) }}">
                            <meta itemprop="description" content="{{ Str::limit(strip_tags($article->content), 105) }}">
                            <meta itemprop="author" content="АНО 'РРАПП'">
                            <link itemprop="mainEntityOfPage" href="{{ route('article.index') }}" />

                            <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="hidden">
                                <meta itemprop="name" content="АНО 'РРАПП'">
                                <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                                    <meta itemprop="url" content="{{ asset($article->picture['path']) }}">
                                </div>
                            </div>

                            <a href="{{route('article.show', $article->slug)}}" class="articles-block__title text_20 text_semi-bold text_white">{{$article->title}}</a>
                            <div class="section-link-arrow">
                                <a href="{{route('article.show', $article->slug)}}" class="section-link link_underline-hover text-solid text_23 text_beige text_bold ">Читать</a>
                                <svg width="23" height="15" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrow-icon">
                                    <path d="M0.624997 8.70833L17.7471 8.70834L13.4212 13.0463L15.125 14.75L22.375 7.5L15.125 0.250006L13.4213 1.95375L17.7471 6.29167L0.624997 6.29167L0.624997 8.70833Z" fill="#C59368"></path>
                                </svg>
                            </div>
                        </div>
                    </article>
                @endforeach

            </div>
        @include('components.layouts.includes.pagination', ['paginator' => $articles])
        </div> <!-- /.container -->
    </div> <!-- /.section-content -->

    @push('popup')
        @include('components.layouts.sections.popup', ['title' => $title])
    @endpush

@endsection
