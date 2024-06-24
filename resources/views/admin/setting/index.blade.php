@extends('index')

@section('main-body')
<div class="w-full mx-auto mt-32 h-[40rem] border border-black">
    <div class="w-auto mx-auto">
        <form class="max-w-md mx-auto mt-32" href="/gym-settings" method="POST">
            @csrf
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="gym_name" id="gym_name" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('gym_name') is-invalid @enderror" placeholder=" " value="{{ $lastSetting->gym_name }}" required />
                <label for="gym_name" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Gym Name</label>
            </div>
            @error('gym_name')
                <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                    {{ $message }}
                </div>
            @enderror
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="gym_motto" id="gym_motto" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('gym_motto') is-invalid @enderror" placeholder=" " value="{{ $lastSetting->gym_motto }}" required />
                <label for="gym_motto" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Gym Motto</label>
            </div>
            @error('gym_motto')
                <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                    {{ $message }}
                </div>
            @enderror

            <div class="flex gap-5">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="integer" name="payment_one" id="payment_one" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('payment_one') is-invalid @enderror" placeholder=" " value="{{ $lastSetting->payment_one_month }}" required />
                    <label for="payment_one" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">One Month</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="integer" name="payment_three" id="payment_three" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('payment_three') is-invalid @enderror" placeholder=" " value="{{ $lastSetting->payment_three_month }}" required />
                    <label for="payment_three" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Three Month</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="integer" name="payment_five" id="payment_five" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('payment_five') is-invalid @enderror" placeholder=" " value="{{ $lastSetting->payment_five_month }}" required />
                    <label for="payment_five" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-amber-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Five Month</label>
                </div>
            @error('payment_one')
                <div class="alert-danger mb-5 -mt-10 text-red-400 text-xs">
                    {{ $message }}
                </div>
            @enderror
            @error('payment_three')
                <div class="alert-danger mb-5 -mt-10 text-red-400 text-xs">
                  {{ $message }}
                </div>
            @enderror
            @error('payment_five')
                <div class="alert-danger mb-5 -mt-10 text-red-400 text-xs">
                  {{ $message }}
                </div>
            @enderror
            </div>
            <div class="flex items-baseline mb-5 justify-end">
                <button type="submit" class="mt-8 text-white font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-amber-500 hover:bg-amber-600">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
