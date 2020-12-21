@extends('layouts.extend')

@section('title', $article['title'])
@section('description', \App\Support\Seo\SeoUtils::prepareDescription($article['description']))
@section('breadcrumbs', Breadcrumbs::render('articles.show', $article))
@section('meta_og_image', asset($article['picture']['path']))

@section('content.child')
    <div class="section-content">
        <div class="container container_small" itemscope itemtype="http://schema.org/Article">

            <div class="template-page-title article-page-title">
                <h4 class="h4 text_semi-bold">{{Date::parse($article['date'])->format('j F, Y')}}</h4>
                <meta itemprop="datePublished" content="{{Date::parse($article['date'])->format('Y-m-d')}}">
                <meta itemprop="dateModified"  content="{{Date::parse($article['date'])->format('Y-m-d')}}">
                <h2 class="h2 text_semi-bold">{{$article['title']}}</h2>
            </div>

            <meta itemprop="headline name" content="{{ Str::limit($article['title'], 105) }}">
            <meta itemprop="description" content="{{ Str::limit(strip_tags($article['content']), 105) }}">
            <meta itemprop="author" content="АНО 'РРАПП'">
            <link itemprop="mainEntityOfPage" href="{{ route('article.index') }}" />

            <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="hidden">
                <meta itemprop="name" content="АНО 'РРАПП'">
                <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                    <meta itemprop="url" content="{{ asset($article['picture']['path']) }}">
                </div>
            </div>

            <div class="template-text-container">
				@if ($article['auth'])
					<div class="template-page-limit-shadow"></div>
				@endif

                <img itemprop="image" src="{{ asset($article['picture']['path']) }}" alt="{{ $article['title'] }}" class="template-page-preview-img">
                {!! $article['content'] !!}
            </div>

			@if ($article['auth'] && $article['content'])
				@include('components.layouts.includes.limit-block')
			@elseif ($article['auth'] && !$article['content'])
				@include('components.layouts.includes.closed-block')
			@endif

            @if($article['is_unlimited_visibility'] || Auth::check())
                @include('components.layouts.includes.share-in-social-networks', [
                    'url' => Request::url(),
                    'title' => $article['title'],
                    'description' => $article['description'],
                    'url_image' => asset($article['picture']['path']),
                ])
            @endif

            <div class="article-page-additional-content">
                <h2 class="h2 section-title">Читайте также</h2>
                <div class="articles-container">
					@foreach($similar ?? [] as $similar_item)
						@include('components.layouts.includes.article-card', ['show_similar_route' => 'article.show', 'item' => $similar_item])
					@endforeach
                </div>
            </div>

        </div> <!-- /.container -->
    </div> <!-- /.section-content -->

    @push('popup')
        @include('components.layouts.sections.popup', ['title' => $article['title']])
    @endpush
@endsection

