@extends('layouts.extend')

@section('title', $title)
@section('description', $description)
@section('breadcrumbs', Breadcrumbs::render('news'))

@section('content.child')
		<div class="section-content">
			<div class="container container_small">

				<div class="title-with-filters">

					<div class="title-with-filters__content">
						<div class="title-with-filters__title">
							<h1 class="h2 text text_semi-bold">Новости</h1>
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
					@include('components.layouts.includes.filter-dropdown', ['route' => route('news')])
				</div>

				<div class="news-container" >

					@foreach($news as $item)

						<article class="block-news" itemscope itemtype="http://schema.org/NewsArticle">
							<div class="block-news__img-wrap">
								<a href="{{ route('news.show', $item->only(['slug'])) }}" class="block-news__link">
									<img itemprop="image" src="{{ asset($item->picture->path ?? null) }}" alt="{{ $item->title }}"  class="block-news__img">
								</a>
							</div>
							<time class="date-news text text_20" >
								<meta itemprop="datePublished" content="{{ $item->date->isoFormat('YYYY-MM-DD') ?? null }}">
								<meta itemprop="dateModified" content="{{ $item->date->isoFormat('YYYY-MM-DD') ?? null }}">
								{{ $item->date->isoFormat('D MMMM, YYYY') ?? null }}
							</time>
							<a href="{{ route('news.show', $item->only(['slug'])) }}" class="text_28 text_brown-1 text_semi-bold block-news__title">
								{{ $item->title ?? null }}
							</a>
							<meta itemprop="headline name" content="{{ Str::limit($item->title, 105) }}">
							<meta itemprop="description" content="{{ Str::limit(strip_tags($item->content), 105) }}">
							<meta itemprop="author" content="АНО 'РРАПП'">
							<link itemprop="mainEntityOfPage" href="{{ route('news') }}" />

							<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="hidden">
								<meta itemprop="name" content="АНО 'РРАПП'">
								<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
									<meta itemprop="url" content="{{ asset($item->picture->path ?? null) }}">
								</div>
							</div>

						</article>

					@endforeach

				</div>

				@include('components.layouts.includes.pagination', ['paginator' => $news])
			</div> <!-- /.container -->
		</div> <!-- /.section-content -->

		@push('popup')
			@include('components.layouts.sections.popup', ['title' => $title])
		@endpush

@endsection
