@extends('/components/include')

<div class="filter-dropdown">
    <button class="button button_close" aria-label="Закрыть форму Фильтра">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z"
                  fill="black"/>
        </svg>
	</button>
	
	<span class="filter-dropdown__title text text_28 text_brown text_bold">Фильтр</span>

    <form class="filter-dropdown__form" method="GET" action="{{ $route ?? null }}">
        <div class="filter-dropdown__element-container">
            <select name="month" class="popup-select">
                <option value="" selected disabled hidden>Месяц</option>
                <option {{ 1 == app('request')->input('month') ? 'selected':'' }}  value="1">Январь</option>
                <option {{ 2 == app('request')->input('month') ? 'selected':'' }}  value="2">Февраль</option>
                <option {{ 3 == app('request')->input('month') ? 'selected':'' }}  value="3">Март</option>
                <option {{ 4 == app('request')->input('month') ? 'selected':'' }}  value="4">Апрель</option>
                <option {{ 5 == app('request')->input('month') ? 'selected':'' }}  value="5">Май</option>
                <option {{ 6 == app('request')->input('month') ? 'selected':'' }}  value="6">Июнь</option>
                <option {{ 7 == app('request')->input('month') ? 'selected':'' }}  value="7">Июль</option>
                <option {{ 8 == app('request')->input('month') ? 'selected':'' }}  value="8">Август</option>
                <option {{ 9 == app('request')->input('month') ? 'selected':'' }}  value="9">Сентябрь</option>
                <option {{ 10 == app('request')->input('month') ? 'selected':'' }} value="10">Октябрь</option>
                <option {{ 11 == app('request')->input('month') ? 'selected':'' }} value="11">Ноябрь</option>
                <option {{ 12 == app('request')->input('month') ? 'selected':'' }} value="12">Декабрь</option>
            </select>
        </div>
        @php
            $years = range(
            date('Y'),
            \Jenssegers\Date\Date::parse(date('Y'))->subYears(\App\Models\Post\Article::YEAR_INTERVAL_FOR_FILTER)->format('Y')
            );
        @endphp
        <div class="filter-dropdown__element-container">
            <select name="year" class="popup-select">
                <option value="" selected disabled hidden>Год</option>
                @foreach ($years as $year)
                    <option {{ $year == app('request')->input('year') ? 'selected':'' }}  value="{{$year}}">{{$year}}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-dropdown__element-container">
            <button type="reset" class="button button_rounded button_big button_white button_grey-border reset-form"><span
                        class="text text_23 text_white text_PT-font text_bold">Сбросить фильтр</span></button>
        </div>
        <div class="filter-dropdown__element-container">
            <button type="submit" class="button button_rounded button_big button_brown"><span
                        class="text text_23 text_white text_PT-font text_bold">Применить</span></button>
        </div>

    </form>
</div>

@push('scripts')
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>--}}
@endpush
