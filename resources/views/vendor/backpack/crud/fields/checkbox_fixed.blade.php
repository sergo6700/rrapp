<!-- checkbox field -->

<div @include('crud::inc.field_wrapper_attributes') >
    @include('crud::inc.field_translatable_icon')
    <div class="checkbox">
    	<div>
            <label>
                <input type="hidden" name="{{ $field['name'] }}" value="0">
                <input type="checkbox" value="1" name="{{ $field['name'] }}"
                    @if (old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? false)
                    checked="checked" @endif

                    @if (isset($field['attributes']))
                        @foreach ($field['attributes'] as $attribute => $value)
                            {{ $attribute }}="{{ $value }}"
                        @endforeach
                    @endif
                > {!! $field['label'] !!}
            </label>
        </div>
        <small class="fl-l">Одновременно можно закрепить только один элемент в разделе</small>

        {{-- HINT --}}
        @if (isset($field['hint']))
            <p class="help-block">{!! $field['hint'] !!}</p>
        @endif
    </div>
</div>

<style>
    .fl-l {
        float: left;
    }
</style>