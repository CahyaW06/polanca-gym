<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentConfirmEmail;
use App\Models\History;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MemMembership extends Controller
{
    public function index()
    {
        return view("member.membership.index", [
            'title' => "Membership",
            'lastSetting' => Setting::all()->last(),
        ]);
    }

    public function paymentDone()
    {
        return view("member.membership.paymentDone", [
            'title' => "Membership",
            'lastSetting' => Setting::all()->last(),
        ]);
    }

    public function payment(Request $request)
    {
        $validated =  $request->validate([
            'proof' => 'required|mimetypes:image/jpeg',
        ]);

        // save file
        $proof = $request->file('proof');
        $proof->store('membership_recipients');

        $history = History::create([
            'user_id' => Auth::user()->id,
            'membership_type' => $request->membership_type,
            'update_date' => Carbon::now()->toDateString(),
            'proof' => $proof->hashName(),
        ]);

        Mail::to('yudhacahyawijaya@gmail.com')->send(new PaymentConfirmEmail($history, Setting::all()->last()));

        return redirect('/payment-done');
    }
}
