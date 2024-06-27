<?php

namespace App\Http\Controllers;

use App\Models\ClassHistory;
use App\Models\History;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private function getMemIncome(Carbon $start, Carbon $end, string $type) {
        if ($type == "yearly") {
            $memIncome = History::whereBetween('update_date', [$start, $end])
                        ->get()
                        ->mapToGroups(function (History $item, int $key) {
                            $lastSetting = Setting::all()->last();

                            if($item->membership_type == 1) {
                                return [Carbon::parse($item->update_date)->format("M Y") => $lastSetting->payment_one_month];
                            }
                            elseif($item->membership_type == 2) {
                                return [Carbon::parse($item->update_date)->format("M Y") => $lastSetting->payment_three_month];
                            }
                            else {
                                return [Carbon::parse($item->update_date)->format("M Y") => $lastSetting->payment_five_month];
                            }
                        })
                        ->map(function (Collection $item, string $key) {
                            return $item->sum();
                        });
        }
        else {
            $memIncome = History::whereBetween('update_date', [$start, $end])
                        ->get()
                        ->mapToGroups(function (History $item, int $key) {
                            $lastSetting = Setting::all()->last();

                            if($item->membership_type == 1) {
                                return [$item->update_date => $lastSetting->payment_one_month];
                            }
                            elseif($item->membership_type == 2) {
                                return [$item->update_date => $lastSetting->payment_three_month];
                            }
                            else {
                                return [$item->update_date => $lastSetting->payment_five_month];
                            }
                        })
                        ->map(function (Collection $item, string $key) {
                            return $item->sum();
                        });
        }

        $timeArray = [];
        $profitArray = [];

        if ($type == "weekly") {
            for ($date = Carbon::now()->subDays(7); $date <= Carbon::now(); $date->addDays()) {
                array_push($timeArray, $date->toFormattedDateString());
                array_push($profitArray, $date->toDateString());
            }

            for ($i = 0; $i < sizeof($profitArray); $i++) {
                foreach ($memIncome as $key=>$val) {
                    if ($key == $profitArray[$i]) {
                        $profitArray[$i] = $val;
                        break;
                    }
                }
                if (is_string($profitArray[$i])) {
                    $profitArray[$i] = 0;
                }
            }
        }
        elseif ($type == "monthly") {
            for ($date = Carbon::now()->subDays(30); $date <= Carbon::now(); $date->addDays()) {
                array_push($timeArray, $date->toFormattedDateString());
                array_push($profitArray, $date->toDateString());
            }

            for ($i = 0; $i < sizeof($profitArray); $i++) {
                foreach ($memIncome as $key=>$val) {
                    if ($key == $profitArray[$i]) {
                        $profitArray[$i] = $val;
                        break;
                    }
                }
                if (is_string($profitArray[$i])) {
                    $profitArray[$i] = 0;
                }
            }
        }
        else {
            for ($date = Carbon::now()->subYear(); $date < Carbon::now(); $date->addMonth()) {
                array_push($timeArray, $date->format('M Y'));
                array_push($profitArray, $date->format('M Y'));
            }

            for ($i = 0; $i < sizeof($profitArray); $i++) {
                foreach ($memIncome as $key=>$val) {
                    if ($key == $profitArray[$i]) {
                        $profitArray[$i] = $val;
                        break;
                    }
                }
                if (is_string($profitArray[$i])) {
                    $profitArray[$i] = 0;
                }
            }
        }

        $ans = [$timeArray, $profitArray];
        return $ans;
    }

    private function getClassIncome(Carbon $start, Carbon $end, string $type) {
        if ($type == "yearly") {
            $classIncome = ClassHistory::whereBetween('update_date', [$start, $end])
            ->get()
            ->mapToGroups(function (ClassHistory $item, int $key) {
                return [Carbon::parse($item->update_date)->format("M Y") => $item->trainingClass->subs];
            })
            ->map(function (Collection $item, string $key) {
                return $item->sum();
            });
        }
        else {
            $classIncome = ClassHistory::whereBetween('update_date', [$start, $end])
                        ->get()
                        ->mapToGroups(function (ClassHistory $item, int $key) {
                            return [$item->update_date => $item->trainingClass->subs];
                        })
                        ->map(function (Collection $item, string $key) {
                            return $item->sum();
                        });
        }

        $timeArray = [];
        $profitArray = [];

        if ($type == "weekly") {
            for ($date = Carbon::now()->subDays(7); $date <= Carbon::now(); $date->addDays()) {
                array_push($timeArray, $date->toFormattedDateString());
                array_push($profitArray, $date->toDateString());
            }

            for ($i = 0; $i < sizeof($profitArray); $i++) {
                foreach ($classIncome as $key=>$val) {
                    if ($key == $profitArray[$i]) {
                        $profitArray[$i] = $val;
                        break;
                    }
                }
                if (is_string($profitArray[$i])) {
                    $profitArray[$i] = 0;
                }
            }
        }
        elseif ($type == "monthly") {
            for ($date = Carbon::now()->subDays(30); $date <= Carbon::now(); $date->addDays()) {
                array_push($timeArray, $date->toFormattedDateString());
                array_push($profitArray, $date->toDateString());
            }

            for ($i = 0; $i < sizeof($profitArray); $i++) {
                foreach ($classIncome as $key=>$val) {
                    if ($key == $profitArray[$i]) {
                        $profitArray[$i] = $val;
                        break;
                    }
                }
                if (is_string($profitArray[$i])) {
                    $profitArray[$i] = 0;
                }
            }
        }
        else {
            for ($date = Carbon::now()->subYear(); $date < Carbon::now(); $date->addMonth()) {
                array_push($timeArray, $date->format('M Y'));
                array_push($profitArray, $date->format('M Y'));
            }

            for ($i = 0; $i < sizeof($profitArray); $i++) {
                foreach ($classIncome as $key=>$val) {
                    if ($key == $profitArray[$i]) {
                        $profitArray[$i] = $val;
                        break;
                    }
                }
                if (is_string($profitArray[$i])) {
                    $profitArray[$i] = 0;
                }
            }
        }

        $ans = [$timeArray, $profitArray];
        return $ans;
    }

    public function home() {
        if(Auth::user()) {
            if(Auth::user()->type == "admin") {
                $weeklyMemIncome = $this->getMemIncome(Carbon::now()->subDays(7), Carbon::now(), "weekly");
                $weeklyClassIncome = $this->getClassIncome(Carbon::now()->subDays(7), Carbon::now(), "weekly");

                $monthlyMemIncome = $this->getMemIncome(Carbon::now()->subMonth(1), Carbon::now(), "monthly");
                $monthlyClassIncome = $this->getClassIncome(Carbon::now()->subMonth(1), Carbon::now(), "monthly");

                $yearlyMemIncome = $this->getMemIncome(Carbon::now()->subYear(1), Carbon::now(), "yearly");
                $yearlyClassIncome = $this->getClassIncome(Carbon::now()->subYear(1), Carbon::now(), "yearly");

                return view('home.home', [
                    "title" => "Home",
                    'lastSetting' => Setting::all()->last(),
                    'week' => json_encode(array_merge_recursive_distinct($weeklyMemIncome[0], $weeklyClassIncome[0])),
                    'month' => json_encode(array_merge_recursive_distinct($monthlyMemIncome[0], $monthlyClassIncome[0])),
                    'year' => json_encode(array_merge_recursive_distinct($yearlyMemIncome[0], $yearlyClassIncome[0])),
                    'weeklyMemIncome' => json_encode($weeklyMemIncome[1]),
                    'weeklyClassIncome' => json_encode($weeklyClassIncome[1]),
                    'monthlyMemIncome' => json_encode($monthlyMemIncome[1]),
                    'monthlyClassIncome' => json_encode($monthlyClassIncome[1]),
                    'yearlyMemIncome' => json_encode($yearlyMemIncome[1]),
                    'yearlyClassIncome' => json_encode($yearlyClassIncome[1]),
                ]);
            }
            else {
                return view('home.home', [
                    "title" => "Home",
                    'lastSetting' => Setting::all()->last(),
                ]);
            }
        }
        else {
            return view('home.home', [
                "title" => "Home",
                'lastSetting' => Setting::all()->last(),
            ]);
        }
    }


}
