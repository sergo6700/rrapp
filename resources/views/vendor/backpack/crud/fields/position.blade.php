<!-- number input -->
<div @include('crud::inc.field_wrapper_attributes') >
    <label for="{{ $field['name'] }}">{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')

    <div>
    @if(isset($field['prefix']) || isset($field['suffix'])) <div class="input-group"> @endif
        @if(isset($field['prefix'])) <div class="input-group-addon">{!! $field['prefix'] !!}</div> @endif
            <input
                name="{{ $field['name'] }}"
                id="{{ $field['name'] }}"
                value="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '' }}"
                type="number" min="0" max="4000000000"
                placeholder="Введите число от 0 до 4 000 000 000"
                class="form-control"
            >

        @if(isset($field['suffix'])) <div class="input-group-addon">{!! $field['suffix'] !!}</div> @endif

        @if(isset($field['prefix']) || isset($field['suffix'])) </div> @endif
    </div>
    
    <small>
        Введите положительное число. Элемент с наименьшим числом будет отображаться первым на странице
    </small>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif

    {{-- Extra CSS and JS for this particular field --}}
    {{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- include checklist_dependency js-->
            <script>
                jQuery(document).ready(function($) {
                    document.querySelector("#{{ $field['name'] }}").addEventListener("input", function (evt) {
                        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
                        {
                            evt.preventDefault();
                        }
                    });
                });
            </script>
    @endpush
</div>