<?php

namespace Modules\Core\Libraries\Class;

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class StatisticsGenerator
{
    protected mixed $eloquentModel;

    /**
     * StatisticsGenerator.
     * @param  string  $modelClass
     */
    public function __construct(string $modelClass)
    {
        $this->eloquentModel = app($modelClass);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getLastWeekRecords()
    {
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $dailyData = $this->fetchModelCounts($startDate, $endDate, ' روز ');

        $output = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateFormatted = $date->format('Y-m-d');
            $persianDayName = Jalalian::forge($date)->format('%A'); // مثلا "شنبه"

            $count = $dailyData[$dateFormatted] ?? 0;
            $output[] = [
                'label' => $persianDayName,
                'count' => $count,
            ];
        }

        return collect($output);
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function getLastMonthRecords()
    {
        $startDate = Carbon::now()->subDays(29)->startOfDay(); // از 29 روز پیش تا امروز
        $endDate = Carbon::now()->endOfDay();

        $dailyData = $this->fetchModelCounts($startDate, $endDate, ' روز ');

        $output = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateFormatted = $date->format('Y-m-d');
            $persianDay = Jalalian::forge($date)->format('j'); // روز ماه شمسی (مثلاً "۲۱")
            $persianMonth = Jalalian::forge($date)->format('F'); // نام ماه (مثلاً "اردیبهشت")

            $count = $dailyData[$dateFormatted] ?? 0;
            $output[] = [
                'label' => $persianDay . ' ' . $persianMonth,
                'count' => $count,
            ];
        }

        return collect($output);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getLastYearRecords()
    {
        $startDate = Carbon::now()->startOfMonth()->subMonths(11); // ← امروز و ۱۱ ماه قبل = ۱۲ ماه
        $endDate = Carbon::now()->endOfMonth();

        $monthlyData = $this->fetchModelCounts($startDate, $endDate, ' ماه ');

        $output = [];
        for ($i = 0; $i < 12; $i++) {
            $date = Carbon::now()->startOfMonth()->subMonths(11 - $i);
            $dateFormatted = $date->format('Y-m');
            $persianMonthName = Jalalian::forge($date)->format('F'); // مثلاً "اردیبهشت"

            $count = $monthlyData[$dateFormatted] ?? 0;
            $output[] = [
                'label' => $persianMonthName,
                'count' => $count,
            ];
        }

        return collect($output);
    }



    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @param string $timeUnit
     * @return array
     */
    protected function fetchModelCounts($startDate, $endDate, $timeUnit)
    {
        $model = $this->eloquentModel;
        $dateFormat = '';

        if (strpos($timeUnit, 'روز') !== false) {
            $dateFormat = '%Y-%m-%d';
        } elseif (strpos($timeUnit, 'ماه') !== false) {
            $dateFormat = '%Y-%m';
        } else {
            return [];
        }


        $results = $model::query()
        ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->selectRaw("DATE_FORMAT(created_at, '" . $dateFormat . "') as time_unit, count(id) as count")
            ->groupBy('time_unit')
            ->get();

        $counts = [];
        foreach ($results as $result) {
            $counts[$result->time_unit] = $result->count;
        }
        return $counts;
    }
}