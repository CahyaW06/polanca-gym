@extends("index")

@section('main-body')
<section class="bg-center bg-cover bg-no-repeat bg-gray-500 bg-blend-multiply h-screen" style="background-image: url('storage/home_bg.png')">
    <div class="px-4 max-w-screen-md py-24 lg:py-56">
        <h1 class="mb-4 ps-48 font-extrabold tracking-tight leading-none text-white text-6xl">GYM</h1>
        <h1 class="mb-4 ps-48 font-extrabold tracking-tight leading-none text-white text-6xl">POLANCA</h1>
        <p class="mb-16 font-normal text-gray-300 text-xl ps-48 pe-20">At Polanca Gym, we believe in the power of transformation. Whether you're a seasoned athlete or just starting your fitness journey, our state-of-the-art facilities and expert trainers are here to help you achieve your goals.</p>

        @guest
        <a href="/login" class="mx-48 inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-amber-500 hover:bg-amber-600">
            Get started
            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
        @endguest
        @auth
        <a href="/membership" class="mx-48 inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-amber-500 hover:bg-amber-600">
            Membership
            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
        @endauth

    </div>
</section>
@endsection
