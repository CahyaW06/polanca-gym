<?php

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command("update:membership-time", function() {
    foreach(User::where('type', 'member')->get() as $user) {
        if (floor(Carbon::now()->diffInMonths(Carbon::parse($user->membership_end_at))) < $user->membership_duration) {
            $user->membership_duration = floor(Carbon::now()->diffInMonths(Carbon::parse($user->membership_end_at)));
            $user->save();
        }
    }
})->daily();
