<div>
    <span>Pembayaran Membership GYM</span><br>
    <span>User ID: {{ $user->id }}</span><br>
    <span>Nama: {{ $user->first_name }} {{ $user->last_name }}</span><br>
    <span>Kelas: {{ $class->name }}</span><br>
    <span>Durasi: Payment 1 Bulan ({{ Number::currency($class->subs, 'IDR') }})</span>
</div>
