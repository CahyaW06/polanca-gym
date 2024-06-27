<div>
    <span>Pembayaran Membership GYM</span><br>
    <span>User ID: {{ $user->id }}</span><br>
    <span>Nama: {{ $user->first_name }} {{ $user->last_name }}</span><br>
    <span>Jenis: Membership Payment
        @if($membership_type == 1)
            1 Bulan ({{ Number::currency($lastSetting->payment_one_month, 'IDR') }})
        @elseif($membership_type == 2)
            3 Bulan ({{ Number::currency($lastSetting->payment_three_month, 'IDR') }})
        @elseif($membership_type == 3)
            5 Bulan ({{ Number::currency($lastSetting->payment_five_month, 'IDR') }})
        @endif
    </span><br>
</div>
