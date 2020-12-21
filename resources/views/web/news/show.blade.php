@extends('layouts.extend')

@section('title', $pieceOfNews->title)
@section('description', \App\Support\Seo\SeoUtils::prepareDescription($pieceOfNews->description))
@section('breadcrumbs', Breadcrumbs::render('news.show', $pieceOfNews))
@section('meta_og_image', asset($pieceOfNews->picture->path ?? null))

@section('content.child')
	<div class="section-content">
		<div class="container container_small" itemscope itemtype="http://schema.org/NewsArticle">

			<div class="template-page-title article-page-title">
				<h4 class="h4 text_semi-bold">{{ $pieceOfNews->date->isoFormat('D MMMM, YYYY') ?? null }}</h4>
				<meta itemprop="datePublished" content="{{ $pieceOfNews->date->isoFormat('YYYY-MM-DD') }}">
				<meta itemprop="dateModified"  content="{{ $pieceOfNews->date->isoFormat('YYYY-MM-DD') }}">

				<h1 class="h2 text_semi-bold">{{ $pieceOfNews->title ?? null }}</h1>
			</div>
			<div class="template-text-container">

				<meta itemprop="headline name" content="{{ Str::limit($pieceOfNews->title, 105) }}">
				<meta itemprop="description" content="{{ Str::limit(strip_tags($pieceOfNews->content), 105) }}">
				<meta itemprop="author" content="АНО 'РРАПП'">
				<meta itemprop="image" content="{{ asset($pieceOfNews->picture->path ?? null) }}">
				<link itemprop="mainEntityOfPage" href="{{ route('news') }}" />

				<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="hidden">
					<meta itemprop="name" content="АНО 'РРАПП'">
					<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
						<meta itemprop="url" content="{{ asset($pieceOfNews->picture->path) }}">
					</div>
				</div>

				@if(auth()->guest() && $pieceOfNews->is_partial_visibility)
					<div class="template-page-limit-shadow"></div>
				@endif

				<img src="{{ asset($pieceOfNews->picture->path ?? null) }}" alt="{{ $pieceOfNews->title }}">
				{!! $pieceOfNews->content !!}
			</div>

			@if (auth()->guest() && $pieceOfNews->is_partial_visibility)
				@include('components.layouts.includes.limit-block')
			@elseif (auth()->guest() && $pieceOfNews->is_closed_visibility)
				@include('components.layouts.includes.closed-block')
			@endif

			@if($pieceOfNews->is_unlimited_visibility || Auth::check())
				@include('components.layouts.includes.share-in-social-networks', [
					'url' => Request::url(),
					'title' => $pieceOfNews->title,
					'description' => $pieceOfNews->description,
					'url_image' => asset($pieceOfNews->picture->path ?? null),
				])
			@endif

			<div class="article-page-additional-content">
				<h2 class="h2 section-title">Читайте также</h2>
				<div class="articles-container">
					@foreach($similar ?? [] as $similar_item)
						@include('components.layouts.includes.article-card', ['show_similar_route' => 'news.show', 'item' => $similar_item])
					@endforeach
				</div>
			</div>


		</div> <!-- /.container -->
	</div> <!-- /.section-content -->

	@push('popup')
		@include('components.layouts.sections.popup', ['title' => $pieceOfNews->title])
	@endpush
@endsection
