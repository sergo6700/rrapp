@extends('layouts.extend')

@section('title', $title)
@section('description', $description)
@section('breadcrumbs', Breadcrumbs::render('media'))

@section('content.child')
        <div class="section-content">

            <div class="container container_small">

				<div class="title-with-filters title-with-filters_small">
					<div class="title-with-filters__content">
						<div class="title-with-filters__title">
							<h2 class="h2 text_semi-bold">СМИ о нас</h2>
						</div>
					</div>
				</div>

				<div class="media-container">
					@foreach($media as $item)
						@component('components.card-media.card-media',["mediaItem" => $item])
						@endcomponent
					@endforeach
				</div>
                @include('components.layouts.includes.pagination', ['paginator' => $media])
            </div> <!-- /.container -->
        </div> <!-- /.section-content -->

        @push('popup')
            @include('components.layouts.sections.popup', ['title' => $title])
        @endpush

@endsection
