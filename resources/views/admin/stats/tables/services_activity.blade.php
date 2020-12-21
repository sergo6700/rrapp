@php
use Carbon\Carbon;

$yearsAmount = 10;

@endphp
<div class="text-center">
    <h3 class="inline text-center" style="min-width: 200px;">{{$monthName}} {{$year}}</h3>
    <br/>
    <div style="display: inline-flex; margin: 10px 0;">
        <select id="servicesActivityMonth" onchange="servicesActivityFormUpdated()" class="form-control text-center">
            @php
            foreach (config('lang.months') as $monthNumber => $currentMonthName) {
                $selected = "";
                if ($month == $monthNumber) {
                    $selected = 'selected';
                }
                echo '<option value="' . $monthNumber . '" ' . $selected .  ' >' . $currentMonthName . '</option>';
            }
            @endphp
        </select>
        <select id="servicesActivityYear" onchange="servicesActivityFormUpdated()" class="form-control text-center">
            @php
            for ($i = 0; $i < $yearsAmount; $i++) {
                $currentYear = Carbon::now()->addYears(-$i)->year;
                $selected = "";
                if ($year == $currentYear) {
                    $selected = "selected";
                }
                echo '<option value="' . $currentYear . '" ' . $selected . '>' . $currentYear . '</option>';
            }
            @endphp
        </select>
    </div>
</div>

<table class="table table-striped text-center">
    <tr>
        <td>Название сервиса</td>
        <td>За сегодня</td>
        <td>За последнюю неделю</td>
        <td>За выбранный месяц</td>
    </tr>
    @foreach($records as $record)
    <tr>
        <td>{{$record['title']}}</td>
        <td>{{$record['today']}}</td>
        <td>{{$record['this_week']}}</td>
        <td>{{$record['month']}}</td>
    </tr>
    @endforeach
</table>
