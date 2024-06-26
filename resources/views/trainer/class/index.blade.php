@extends('index')

@section('main-body')
<section class="bg-center bg-cover bg-no-repeat bg-gray-500 bg-blend-multiply h-screen border border-black" style="background-image: url('/storage/home_bg.png')">
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
                                @if ($class->day == $day && Carbon\Carbon::parse($class->time)->format('H:i') == $time && $class->trainers->pluck('user')->contains(Auth::user()))
                                <button class="px-3 py-2 bg-amber-500 rounded-lg" data-modal-target="member-modal-{{ $class->id }}" data-modal-toggle="member-modal-{{ $class->id }}">
                                    <span class="">{{ $class->name }}</span>
                                </button>

                                {{-- member modal --}}
                                <div id="member-modal-{{ $class->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-6xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative rounded-lg shadow bg-gray-800">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-[#FFF9E1]">
                                                <h3 class="text-lg font-semibold text-amber-500">
                                                    {{ $class->name }}'s Member List
                                                </h3>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="relative overflow-x-auto overflow-y-auto max-h-96">
                                                <table class="w-full text-sm text-left rtl:text-right text-black">
                                                    <thead class="text-xs text-white uppercase bg-amber-500">
                                                        <tr>
                                                            <th scope="col" class="p-4">
                                                                <div class="flex items-center">
                                                                    <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-amber-500 bg-gray-100 border-amber-500 rounded focus:ring-amber-500 focus:ring-2" @click="all_checked_member = ! all_checked_member, prev_checked_member = all_checked_member">
                                                                    <label for="checkbox-all" class="sr-only">checkbox</label>
                                                                </div>
                                                            </th>
                                                            <th scope="col" class="px-6 py-3">
                                                                ID
                                                            </th>
                                                            <th scope="col" class="px-6 py-3">
                                                                First Name
                                                            </th>
                                                            <th scope="col" class="px-6 py-3">
                                                                Last Name
                                                            </th>
                                                            <th scope="col" class="px-6 py-3">
                                                                E-mail
                                                            </th>
                                                            <th scope="col" class="px-6 py-3">
                                                                Member Status
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($class->users()->get() as $key=>$member)
                                                        @if ($class->users->count() < 1)
                                                        <tr class="border-b hover:bg-gray-50 bg-[#FFF9E1]">
                                                            <td class="w-4 p-4">
                                                                <div class="flex items-center">
                                                                    <input :checked="prev_checked_member" id="checkbox-table-1" type="checkbox" name="prev_member_id[{{ $key }}]" value="{{ $member->id }}" class="w-4 h-4 text-amber-500 bg-gray-100 border-amber-500 rounded focus:ring-amber-500 focus:ring-2">
                                                                    <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                empty
                                                            </td>
                                                            <td class="px-6 py-4">

                                                            </td>
                                                            <td class="px-6 py-4">

                                                            </td>
                                                            <td class="px-6 py-4">

                                                            </td>
                                                            <td class="px-6 py-4">

                                                            </td>
                                                        </tr>
                                                        @else
                                                        <tr class="border-b hover:bg-gray-50 bg-[#FFF9E1]">
                                                            <td class="w-4 p-4">
                                                                <div class="flex items-center">
                                                                    <input :checked="prev_checked_member" id="checkbox-table-1" type="checkbox" name="prev_member_id[{{ $key }}]" value="{{ $member->id }}" class="w-4 h-4 text-amber-500 bg-gray-100 border-amber-500 rounded focus:ring-amber-500 focus:ring-2">
                                                                    <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{ $member->id }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{ $member->first_name }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{ $member->last_name }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{ $member->email}}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{ $member->activated ? "Active" : "Inactive" }}
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                            @if ($class->day == $day && Carbon\Carbon::parse($class->time)->format('H:i') == $time && $class->trainers->pluck('user')->contains(Auth::user()))
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
