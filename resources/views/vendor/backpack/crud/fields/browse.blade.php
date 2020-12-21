<!-- browse server input -->

@php

use App\Support\Model\ModelUtils;
use App\Models\Post\Article;
use App\Models\Post\NewsItem;
use App\Models\Media\Media;
use App\Models\Slider\Slider;
use App\Models\Event\Event;

/** @var Backpack\CRUD\CrudPanel $crud */

if ($crud->entry) {
	$relation = '';
	switch (get_class($crud->entry)) {
		case Article::class:
		case NewsItem::class:
		case Media::class:
			$relation = 'picture';
			break;
		case Event::class:
			$relation = 'report_file';
		break;
	}

	if ($relation) {
		$field['value'] = ModelUtils::getCustomFieldValue($crud->entry, $relation, 'path');
	}
}

@endphp

<div @include('crud::inc.field_wrapper_attributes') >

    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')
	<input
		type="text"
		id="{{ $field['name'] }}-filemanager"

		name="{{ $field['name'] }}"
        value="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '' }}"
        @include('crud::inc.field_attributes')

		@if(!isset($field['readonly']) || $field['readonly']) readonly @endif
	>

	<div class="btn-group" role="group" aria-label="..." style="margin-top: 3px;">
	  <button type="button" data-inputid="{{ $field['name'] }}-filemanager" class="btn btn-default popup_selector">
		<i class="fa fa-cloud-upload"></i> {{ trans('backpack::crud.browse_uploads') }}</button>
		<button type="button" data-inputid="{{ $field['name'] }}-filemanager" class="btn btn-default clear_elfinder_picker">
		<i class="fa fa-eraser"></i> {{ trans('backpack::crud.clear') }}</button>
	</div>

	@if (!empty($crud->model) && $crud->model->getTable() === "articles")
	<small class="fl-r">Изображение будет выравнено по центру и растянуто на всю ширину статьи. Максимальная высота - 340px</small>
	@endif

	@if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif

</div>

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field))

	{{-- FIELD CSS - will be loaded in the after_styles section --}}
	@push('crud_fields_styles')
		<!-- include browse server css -->
		<link href="{{ asset('vendor/backpack/colorbox/example2/colorbox.css') }}" rel="stylesheet" type="text/css" />
		<style>
			#cboxContent, #cboxLoadedContent, .cboxIframe {
				background: transparent;
			}
			.fl-r {
				float: right;
			}
		</style>
	@endpush

	@push('crud_fields_scripts')
		<!-- include browse server js -->
		<script src="{{ asset('vendor/backpack/colorbox/jquery.colorbox-min.js') }}"></script>
	@endpush

@endif

{{-- FIELD JS - will be loaded in the after_scripts section --}}
@push('crud_fields_scripts')
	<script>
		$(document).on('click','.popup_selector[data-inputid={{ $field['name'] }}-filemanager]',function (event) {
		    event.preventDefault();

		    // trigger the reveal modal with elfinder inside
		    var triggerUrl = "{{ url(config('elfinder.route.prefix').'/popup/'.$field['name']."-filemanager") }}";
		    $.colorbox({
		        href: triggerUrl,
		        fastIframe: true,
		        iframe: true,
		        width: '80%',
		        height: '80%'
		    });
		});

		// function to update the file selected by elfinder
		function processSelectedFile(filePath, requestingField) {
		    $('#' + requestingField).val(filePath.replace(/\\/g,"/"));
		}

		$(document).on('click','.clear_elfinder_picker[data-inputid={{ $field['name'] }}-filemanager]',function (event) {
		    event.preventDefault();
		    var updateID = $(this).attr('data-inputid'); // Btn id clicked
		    $("#"+updateID).val("");
		});
	</script>
@endpush

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
