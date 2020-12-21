@extends('layouts.extend')

@section('title', $title)
@section('description', $description)
@section('breadcrumbs', Breadcrumbs::render('page.show', $page))

@section('css')
	<styles>
		{!! $pageTemplateStyles !!}
	</styles>
@endsection

@section('content.child')
	<div class="section-content">
		<div class="container container_small">

			<div class="template-page-title">
				<h1 class="h2 text_semi-bold">{{ $page->title ?? null }}</h1>
			</div>
			<div class="template-text-container">
				{!! $page->content ?? null !!}
			</div>

		</div> <!-- /.container -->
	</div> <!-- /.section-content -->

	@push('popup')
		@include('components.layouts.sections.popup', ['title' => $title])
	@endpush

@endsection
