@extends('layouts.extend')

@section('title', $document->name)
@section('description', \App\Support\Seo\SeoUtils::prepareDescription($document->content))
@section('breadcrumbs', Breadcrumbs::render('docs.show', $document))

@section('content.child')
	<div class="section-content">
		<div class="container container_small">

			<div class="template-page-title">
				<h1 class="h2 text_semi-bold">{{ $document->name ?? null }}</h1>
			</div>

			<div class="template-text-container">
				{!! $document->content ?? null !!}

				<ul class="documents-files">
					@foreach ($document->files as $file)
						<li class="documents-files__item">
							@if ($file->mimetype == 'application/pdf')
								<a href="{{asset($file->path)}}" target="_blank" class="documents-files__link text text_red-1 text_28 text_semi-bold">
									{{ $file->filename }}
								</a>
							@else
								<a href="http://view.officeapps.live.com/op/view.aspx?src={{asset($file->path)}}" target="_blank" class="documents-files__link text text_red-1 text_28 text_semi-bold">
									{{ $file->filename }}
								</a>
							@endif
						</li>
					@endforeach
				</ul>
			</div>
		</div> <!-- /.container -->
	</div> <!-- /.section-content -->

	@push('popup')
		@include('components.layouts.sections.popup', ['title' => $document->name])
	@endpush
@endsection
