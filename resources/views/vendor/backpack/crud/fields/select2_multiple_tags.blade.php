<!-- select2 multiple -->
@php
    if (!isset($field['options'])) {
        $options = $field['model']::all();
    } else {
        $options = call_user_func($field['options'], $field['model']::query());
    }
@endphp

<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')
    <select
        name="{{ $field['name'] }}[]"
        id="{{ $field['name'] }}"
        style="width: 100%"
        @include('crud::inc.field_attributes', ['default_class' =>  'form-control select2_multiple'])
        multiple>

        @if (isset($field['allows_null']) && $field['allows_null']==true)
            <option value="">-</option>
        @endif

        @if (isset($field['model']))
            @foreach ($options as $option)
                @php
                    $selected = '';
                    if (is_array(old(square_brackets_to_dots($field["name"]))) && $option->toArray()) {
                        $needle = $option->toArray()['name'];
                        if (false !== array_search($needle, old(square_brackets_to_dots($field["name"])))) {
                            $selected = ' selected';
                        }
                    } elseif ( (old(square_brackets_to_dots($field["name"])) && in_array($option->getKey(), old($field["name"])))
                        || (
                                is_null(old(square_brackets_to_dots($field["name"])))
                                && isset($field['value'])
                                && in_array($option->getKey(), $field['value']->pluck($option->getKeyName(), $option->getKeyName())->toArray())
                           )
                     ) {
                        $selected = ' selected';
                    }
                @endphp

                <option value="{{ $option->{$field['attribute']} }}" {{ $selected }}>{{ $option->{$field['attribute']} }}</option>
            @endforeach
        @endif
    </select>

    @if(isset($field['select_all']) && $field['select_all'])
        <a class="btn btn-xs btn-default select_all" style="margin-top: 5px;"><i class="fa fa-check-square-o"></i> {{ trans('backpack::crud.select_all') }}</a>
        <a class="btn btn-xs btn-default clear" style="margin-top: 5px;"><i class="fa fa-times"></i> {{ trans('backpack::crud.clear') }}</a>
    @endif

    {{-- HINT --}}
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
        <!-- include select2 css-->
        <link href="{{ asset('vendor/adminlte/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- include select2 js-->
        <script src="{{ asset('vendor/adminlte/bower_components/select2/dist/js/select2.min.js') }}"></script>
        <script>
            jQuery(document).ready(function($) {
                // trigger select2 for each untriggered select2_multiple box
                var $obj = $({{ $field['name'] }}).select2({
                    theme: "bootstrap",
                    tags: true,
                    tokenSeparators: [',', ' '],
                    createTag: function (params) {
                        var term = $.trim(params.term);

                        if (term === '') {
                            return null;
                        }

                        var isCoincidence = false;
                        $obj.find('option').each(function(x, item) {
                            if (term === $(item).val()) {
                                isCoincidence = true;
                            }
                        });

                        if (isCoincidence) {
                            return null;
                        }

                        return {
                            id: term,
                            text: term,
                            newTag: true // add additional parameters
                        }
                    }
                });
            });
        </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
