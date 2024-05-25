<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function gotoMember() {
        return view("admin.member.index", [
            "title" => "Member List",
            "members" => User::whereIn("type", ["member", "trainer"])->cursorPaginate(10),
            "total_member" => User::whereIn("type", ["member", "trainer"])->count(),
        ]);
    }

    public function gotoMemberWithSearch(Request $request) {
        if (User::whereIn("type", ["member", "trainer"])->where('id', $request->table_search)->get()) {
            return view("admin.member.index", [
                "title" => "Member List",
                "members" => User::whereIn("type", ["member", "trainer"])->where('id', $request->table_search)->cursorPaginate(10),
                "total_member" => User::whereIn("type", ["member", "trainer"])->count(),
            ]);
        }

        return redirect('/adm-member');
    }

    public function updateMember(Request $request) {
            $targetUser = User::where("id", $request->user_id)->get()->first();

            if ($targetUser->type == "member") {
                if ($request->update) {
                    $targetUser->membership_duration += $request->new_duration;
                    $targetUser->update_membership_at = Carbon::now()->toDate();
                    $targetUser->membership_end_at = Carbon::parse($targetUser->membership_end_at)->addMonth(intval($request->new_duration))->toDate();

                    $targetUser->save();
                }
                else if ($request->activate) {
                    $targetUser->activated = 1;
                    $targetUser->membership_duration += $request->new_duration;
                    $targetUser->update_membership_at = Carbon::now()->toDate();
                    $targetUser->membership_end_at = Carbon::now()->addMonth(intval($request->new_duration))->toDate();

                    $targetUser->save();
                }
                else {
                    $targetUser->activated = 0;
                    $targetUser->membership_duration = 0;
                    $targetUser->update_membership_at = Carbon::now()->toDate();
                    $targetUser->membership_end_at = null;

                    $targetUser->save();
                }
            }
            else {
                if ($request->activate) {
                    $targetUser->activated = 1;
                    $targetUser->update_membership_at = Carbon::now()->toDate();

                    $targetUser->save();
                }
                else {
                    $targetUser->activated = 0;
                    $targetUser->update_membership_at = Carbon::now()->toDate();

                    $targetUser->save();
                }
            }

        return redirect('/adm-member');
    }
}
