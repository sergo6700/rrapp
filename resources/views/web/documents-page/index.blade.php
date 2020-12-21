@extends('layouts.extend')

@section('title', $title)
@section('description', $description)
@section('breadcrumbs', Breadcrumbs::render('docs'))

@section('content.child')
		<div class="section-content">
			<div class="container container_small">

				<div class="title-with-filters title-with-filters_documents">
					<div class="title-with-filters__content">
						<div class="title-with-filters__title">
							<h1 class="h2 text_semi-bold">Нормативные документы</h1>
						</div>
					</div>
				</div>

				<div class="documents-block card-hover card-hover_documents">
					<ul class="documents-block__list">
						@foreach ($documents as $item)
							<li class="documents-block__item text_bold">
								<a href="{{ route('docs.show', $item->only('slug')) }}" class="documents-block__link link text text_20">
									{{ $item->name ?? null }}
								</a>
							</li>
						@endforeach
					</ul>
				</div>

				@include('components.layouts.includes.pagination', ['paginator' => $documents])
			</div> <!-- /.container -->
		</div> <!-- /.section-content -->

		@push('popup')
			@include('components.layouts.sections.popup', ['title' => $title])
		@endpush
@endsection
