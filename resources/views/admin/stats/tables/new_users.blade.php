@php
use Carbon\Carbon;

$yearsAmount = 10;

@endphp

<div class="text-center">
    <h3 class="inline text-center" style="min-width: 200px;">{{$monthName}} {{$year}}</h3>
    <br/>
    <div style="display: inline-flex; margin: 10px 0;">
        <select id="newUsersMonth" onchange="newUsersFormUpdated()" class="form-control text-center">
            @php
            foreach (config('lang.months') as $monthNumber => $currentMonthName) {
                $selected = "";
                if ($month == $monthNumber) {
                    $selected = 'selected';
                    echo "";
                }
                echo '<option value="' . $monthNumber . '" ' . $selected .  ' >' . $currentMonthName . '</option>';
            }
            @endphp
        </select>
        <select id="newUsersYear" onchange="newUsersFormUpdated()" class="form-control text-center">
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
        <td>Сегодня</td>
        <td>Последняя неделя</td>
        <td>Выбранный месяц</td>
    </tr>
    <tr>
        <td>{{ $newUsers['today'] }}</td>
        <td>{{ $newUsers['this_week'] }}</td>
        <td>{{ $newUsers['month'] }}</td>
    </tr>
</table>

<style>
    #newUsersMonth, #newUsersYear, #servicesActivityMonth, #servicesActivityYear {
        width: 110px;
    }
</style>