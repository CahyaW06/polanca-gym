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

    public function home() {
        if(Auth::user()) {
            if(Auth::user()->type == "admin") {
                $memIncome = History::whereBetween('update_date', [Carbon::now()
                    ->subDays(7), Carbon::now()])
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


                $days = [];
                $dailyMemIncome = [];
                for ($date = Carbon::now()->subDays(7); $date <= Carbon::now(); $date->addDays()) {
                    array_push($days, $date->toFormattedDateString());
                    array_push($dailyMemIncome, $date->toDateString());
                }

                for ($i = 0; $i < sizeof($dailyMemIncome); $i++) {
                    foreach ($memIncome as $key=>$val) {
                        if ($key == $dailyMemIncome[$i]) {
                            $dailyMemIncome[$i] = $val;
                            break;
                        }
                    }

                    if (is_string($dailyMemIncome[$i])) {
                        $dailyMemIncome[$i] = 0;
                    }
                }


                // dd($dailyMemIncome);


                return view('home.home', [
                    "title" => "Home",
                    'lastSetting' => Setting::all()->last(),
                    'dailyMemIncome' => json_encode($dailyMemIncome),
                    'classHistory' => json_encode(ClassHistory::all())
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
