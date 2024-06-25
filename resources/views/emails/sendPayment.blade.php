<div>
    <span>Pembayaran Membership GYM</span><br>
    <span>ID: {{ $user->id }}</span><br>
    <span>Nama: {{ $user->first_name }} {{ $user->last_name }}</span><br>
    <span>Jenis: @if($pay_for == "membership") Membership Payment @else Class Payment @endif
        @if($pay_for == "membership" && $membership_type == 1)
            1 Bulan ({{ Number::currency($lastSetting->payment_one_month, 'IDR') }})
        @elseif($pay_for == "membership" && $membership_type == 2)
            3 Bulan ({{ Number::currency($lastSetting->payment_three_month, 'IDR') }})
        @elseif($pay_for == "membership" && $membership_type == 3)
            5 Bulan ({{ Number::currency($lastSetting->payment_five_month, 'IDR') }})
        @endif

        @if($pay_for == "class")
            1 Bulan ({{ Number::currency($class->subs, 'IDR') }})
        @endif
    </span><br>
</div>
