@extends('index')

@section('main-body')
<section class="bg-center bg-cover bg-no-repeat bg-gray-500 bg-blend-multiply h-screen" style="background-image: url('storage/home_bg.png')" x-data="{ membership: 0 }">
    <form action="/payment" enctype="multipart/form-data" method="POST" class="text-white h-screen pt-48">
        @csrf
        <div class="mb-16">
            <h1 class="text-center font-extrabold tracking-tight leading-none text-6xl text-amber-500">Membership</h1>
        </div>
        <input name="membership_type" class="hidden" x-model="membership">
        <div class="flex justify-center gap-10">
            <div class="w-full max-w-sm border border-amber-500 rounded-3xl p-8" :class="membership == 1 ? 'bg-amber-500' : '' ">
                <h5 class="mb-4 text-xl font-medium text-white">Membership Plan 1</h5>
                <div class="flex items-baseline text-white mb-[52px]">
                    <span class="text-4xl font-extrabold tracking-tight">{{ Number::currency($lastSetting->payment_one_month, 'IDR') }}</span>
                </div>
                <ul class="space-y-5 my-7">
                    <li class="flex items-center">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" :class="membership == 1 ? 'text-white' : 'text-amber-500' ">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span class="text-base font-normal leading-tight text-white ms-3">1 Month Membership Duration</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" :class="membership == 1 ? 'text-white' : 'text-amber-500' ">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span class="text-base font-normal leading-tight text-white ms-3">Free Use Training Machine</span>
                    </li>
                </ul>
                <button type="button" class="font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center" @click="membership = 1" :class="membership == 1 ? 'text-amber-500 bg-white' : 'text-white bg-amber-500 hover:bg-amber-600' ">Choose Membership</button>
            </div>
            <div class="w-full max-w-sm border border-amber-500 rounded-3xl p-8" :class="membership == 2 ? 'bg-amber-500' : '' ">
                <h5 class="mb-4 text-xl font-medium text-white">Membership Plan 2</h5>
                <span class="text-md font-semibold tracking-tight line-through">{{ Number::currency($lastSetting->payment_one_month*3, 'IDR') }}</span>
                <div class="flex items-baseline text-white">
                    <span class="text-4xl font-extrabold tracking-tight">{{ Number::currency($lastSetting->payment_three_month, 'IDR') }}</span>
                </div>
                <ul role="list" class="space-y-5 my-7">
                    <li class="flex items-center">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" :class="membership == 2 ? 'text-white' : 'text-amber-500' ">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span class="text-base font-normal leading-tight text-white ms-3">3 Month Membership Duration</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" :class="membership == 2 ? 'text-white' : 'text-amber-500' ">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span class="text-base font-normal leading-tight text-white ms-3">Free Use Training Machine</span>
                    </li>
                </ul>
                <button type="button" class="font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center" @click="membership = 2" :class="membership == 2 ? 'text-amber-500 bg-white' : 'text-white bg-amber-500 hover:bg-amber-600' ">Choose Membership</button>
            </div>
            <div class="w-full max-w-sm border border-amber-500 rounded-3xl p-8" :class="membership == 3 ? 'bg-amber-500' : '' ">
                <h5 class="mb-4 text-xl font-medium text-white">Membership Plan 3</h5>
                <span class="text-md font-semibold tracking-tight line-through">{{ Number::currency($lastSetting->payment_one_month*5, 'IDR') }}</span>
                <div class="flex items-baseline text-white">
                    <span class="text-4xl font-extrabold tracking-tight">{{ Number::currency($lastSetting->payment_five_month, 'IDR') }}</span>
                </div>
                <ul role="list" class="space-y-5 my-7">
                    <li class="flex items-center">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" :class="membership == 3 ? 'text-white' : 'text-amber-500' ">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span class="text-base font-normal leading-tight text-white ms-3">5 Month Membership Duration</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" :class="membership == 3 ? 'text-white' : 'text-amber-500' ">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span class="text-base font-normal leading-tight text-white ms-3">Free Use Training Machine</span>
                    </li>
                </ul>
                <button type="button" class="font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center" @click="membership = 3" :class="membership == 3 ? 'text-amber-500 bg-white' : 'text-white bg-amber-500 hover:bg-amber-600' ">Choose Membership</button>
            </div>

            <div class="flex justify-center gap-10">
                <div class="w-full max-w-sm border border-amber-500 rounded-3xl p-8">
                    <h5 class="mb-4 text-xl font-medium text-white">Transfer to BNI</h5>
                    <div class="flex items-baseline text-white mb-[52px]">
                        <span class="text-4xl font-extrabold tracking-tight">1424821383</span>
                    </div>
                    <ul role="list" class="space-y-5 my-7">
                        <li class="flex items-center">
                            <div class="relative z-0 w-full mb-5 group">
                                <label class="block mb-3 text-xl font-medium text-white" for="proof">Proof of Payment</label>
                                <input class="block w-full border border-amber-500 rounded-lg cursor-pointer text-amber-500 text-sm bg-white @error('proof') is-invalid @enderror" aria-describedby="proof_help" id="proof" name="proof" type="file" required>
                                <p class="mt-1 text-xs text-white" id="proof_help">Format file: .jpg, .jpeg</p>
                            </div>
                            @error('proof')
                              <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                                  {{ $message }}
                              </div>
                            @enderror
                        </li>
                    </ul>
                    <button type="submit" class="text-white bg-amber-500 hover:bg-amber-600 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center" disabled x-show="membership == 0">Send Confirmation</button>
                    <button type="submit" class="text-white bg-amber-500 hover:bg-amber-600 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center" x-show="membership != 0">Send Confirmation</button>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection
