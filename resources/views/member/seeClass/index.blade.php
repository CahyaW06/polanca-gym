@extends('index')

@section('main-body')
<section class="bg-center bg-cover bg-no-repeat bg-gray-500 bg-blend-multiply h-screen border border-black" style="background-image: url('storage/home_bg.png')">
    <div class="mt-16 w-full h-5/6">
        <div class="flex gap-10 justify-center h-full">
            <div class="">
                <table class="table w-full text-center text-gray-400 mt-8 max-w-xl h-full">
                    <thead class="text-sm text-amber-500 border-b-2 border-amber-500">
                        <tr>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Time
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Monday
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Tuesday
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Wednesday
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Thursday
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Friday
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Saturday
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Sunday
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($times1 as $time)
                        <tr class="border-b w-full border-white">
                            <th scope="row" class="px-4 py-3 text-sm font-normal whitespace-nowrap text-white">
                                {{ $time }} - {{ Carbon\Carbon::parse($time)->add(59, 'minute')->format('H:i') }}
                            </th>
                            @foreach ($days as $day)
                            <th scope="row" class="px-4 py-3 text-sm font-normal whitespace-nowrap text-white">
                                @foreach ($classes as $class)
                                @if ($class->day == $day && Carbon\Carbon::parse($class->time)->format('H:i') == $time && $class->users->contains(Auth::user()))
                                <button class="px-3 py-2 bg-amber-500 rounded-lg" disabled>
                                    <span class="">{{ $class->name }}</span>
                                </button>
                                @endif
                                @endforeach
                            </th>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="">
                <table class="table w-full text-left rtl:text-right text-gray-400 mt-8 max-w-xl h-full">
                    <thead class="text-sm text-amber-500 border-b-2 border-amber-500">
                        <tr>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Time
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Monday
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Tuesday
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Wednesday
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Thursday
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Friday
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Saturday
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <div class="flex items-center">
                                    Sunday
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($times2 as $time)
                    <tr class="border-b w-full border-white">
                        <th scope="row" class="px-4 py-3 text-sm font-normal whitespace-nowrap text-white">
                            {{ $time }} - {{ Carbon\Carbon::parse($time)->add(59, 'minute')->format('H:i') }}
                        </th>
                        @foreach ($days as $day)
                        <th scope="row" class="px-4 py-3 text-sm font-normal whitespace-nowrap text-white">
                            @foreach ($classes as $class)
                            @if ($class->day == $day && Carbon\Carbon::parse($class->time)->format('H:i') == $time && $class->users->contains(Auth::user()))
                            <button class="px-3 py-2 bg-amber-500 rounded-lg" disabled>
                                <span class="">{{ $class->name }}</span>
                            </button>
                            @endif
                            @endforeach
                        </th>
                        @endforeach
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
