@extends('index')

@section('main-body')
<section class="bg-center bg-cover bg-no-repeat bg-blend-multiply h-screen" style="background-image: url('storage/home_bg.png')">
    <form action="/join-class" enctype="multipart/form-data" method="POST" class="text-white h-screen pt-48">
        @csrf
        <div class="mb-16">
            <h1 class="text-center font-extrabold tracking-tight leading-none text-6xl text-amber-500">Class Payment</h1>
        </div>
        <div class="flex justify-center gap-10">
            <div class="w-full max-w-5xl border border-amber-500 rounded-3xl flex">
                <div class="overflow-hidden max-w-xl max-h-[28rem]">
                    <img src="{{ url('storage/class/'.$class->img) }}" class="rounded-s-lg object-cover">
                </div>
                <div class="p-8 pb-0">
                    <h5 class="mb-4 text-xl font-medium text-white">{{ $class->name }}</h5>
                    <div class="flex items-baseline text-white mb-[52px]">
                        <span class="text-4xl font-extrabold tracking-tight">{{ Number::currency($class->subs, 'IDR') }}</span>
                    </div>
                    <div class="flex align-baseline">
                        <span class="material-symbols-outlined text-amber-500">group</span>
                        <span class="font-normal text-base ms-3">{{ $class->users()->count() }}/{{ $class->max_member }} People</span>
                    </div>
                    <div class="overflow-y-auto mt-7 h-48">
                        <p class="">
                            {{ $class->desc }}
                        </p>
                    </div>
                </div>
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
                    <input type="integer" value="{{ $class->id }}" name="classId" class="hidden">
                    <button type="submit" class="text-white bg-amber-500 hover:bg-amber-600 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center" x-show="membership != 0">Send Confirmation</button>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection
