@extends('index')

@section('main-body')
<section class="bg-center bg-cover bg-no-repeat bg-gray-500 bg-blend-multiply h-screen" style="background-image: url('storage/home_bg.png')" x-data="{ membership: 0 }">
    <div class="text-white h-screen pt-96">
        <div class="mb-16 max-w-4xl mx-auto">
            <h1 class="text-center font-extrabold tracking-tight leading-none text-6xl text-amber-500">Waiting for the Confirmation from Admin</h1>
        </div>
        <div class="max-w-xl mx-auto flex justify-center">
            <a href="/" type="button" class="text-white bg-amber-500 hover:bg-amber-600 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center text-center">Back to Home</a>
        </div>
    </div>
</section>
@endsection
