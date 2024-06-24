<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use ZipArchive;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Trainer;
use App\Models\TrainingClass;
use Illuminate\Http\Request;

class AdmMemberController extends Controller
{
    public function gotoMember() {

        return view("admin.member.index", [
            "title" => "Member List",
            'lastSetting' => Setting::all()->last(),
            "members" => User::whereIn("type", ["member", "trainer"])->cursorPaginate(8),
            "total_member" => User::whereIn("type", ["member", "trainer"])->count(),
        ]);
    }

    public function gotoMemberWithSearch(Request $request) {
        if ($request->member_class_id) {
            $users = TrainingClass::find($request->member_class_id)->users();
            return view("admin.member.index", [
                "title" => "Member List",
                'lastSetting' => Setting::all()->last(),
                "members" => $users->cursorPaginate(8),
                "total_member" => $users->get()->count(),
            ]);
        }
        else if ($request->trainer_class_id) {
            $users = TrainingClass::find($request->trainer_class_id)->trainers()->get();
            $trainers = User::whereIn("id", $users->pluck("user_id"));
            return view("admin.member.index", [
                "title" => "Trainer List",
                'lastSetting' => Setting::all()->last(),
                "members" => $trainers->cursorPaginate(8),
                "total_member" => $trainers->get()->count(),
            ]);
        }
        else {
            if (User::whereIn("type", ["member", "trainer"])->where('id', $request->table_search)->orWhere('first_name', 'like', '%'.$request->table_search.'%')->orWhere('last_name', 'like', '%'.$request->table_search.'%')->get()) {
                return view("admin.member.index", [
                    "title" => "Member List",
                    'lastSetting' => Setting::all()->last(),
                    "members" => User::whereIn("type", ["member", "trainer"])->where('id', $request->table_search)->orWhere('first_name', 'like', '%'.$request->table_search.'%')->orWhere('last_name', 'like', '%'.$request->table_search.'%')->cursorPaginate(8),
                    "total_member" => User::whereIn("type", ["member", "trainer"])->count(),
                ]);
            }
            return redirect('/adm-member');
        }

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


    public function downloadApplyLetter(Request $request) {
        $zip = new ZipArchive;
        $zipFileName = User::where('id', $request->user_id)->first()->last_name."'s_apply.zip";
        $path = storage_path('app/applicant_datas/');
        $path = str_replace('\\','/', $path);

        $certificates = explode(",", Trainer::where('user_id', $request->user_id)->first()->certificates);

        if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE) {
            $filesToZip = [
                Trainer::where('user_id', $request->user_id)->first()->apply_letter,
                Trainer::where('user_id', $request->user_id)->first()->cv
            ];

            foreach($certificates as $certificate) {
                array_push($filesToZip, $certificate);
            }

            foreach ($filesToZip as $key=>$file) {
                if ($key == 0) {
                    $zip->addFile($path.$file, basename("apply_letter.pdf"));
                }
                else if ($key == 1) {
                    $zip->addFile($path.$file, basename("cv.pdf"));
                }
                else {
                    $zip->addFile($path.$file, basename("certificate".($key-1).".pdf"));
                }
            }

            $zip->close();

            redirect('/adm-member');

            return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
        }
        else {
            return redirect('/adm-member');
        }
    }
}
