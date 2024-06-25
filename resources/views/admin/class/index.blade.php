@extends("index")

@section('main-body')
@if (session()->has('change_fail'))
<div class="p-4 absolute text-md max-w-md bg-red-500 text-white right-0 bottom-0" role="alert">
    {{ session('change_fail') }}
</div>
@endif
<div class="mt-32 w-full" x-data="{target_id: 0, target_last_name: '', target_last_max_member: 0, target_last_max_trainer: 0, target_last_subs: 0, all_checked_member: false, prev_checked_member: true, all_checked_trainer: false, prev_checked_trainer: true}">
    <div class="relative mx-16 rounded-lg">
        <div class="p-4 flex gap-5 justify-between">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <form action="/adm-set-class/search" method="POST">
                    @csrf
                    <input type="text" id="table_search" name="table_search" class="pt-2 ps-10 text-sm text-white w-80 bg-transparent border-b border-0 border-white placeholder:text-white focus:outline-none" placeholder="Search class">
                    <button type="submit" class="hidden"></button>
                </form>
            </div>
            <button data-modal-target="store-modal" data-modal-toggle="store-modal" type="button" class="text-white bg-amber-500 hover:bg-amber-600 font-medium rounded-lg text-sm px-4 flex items-center text-center">Add Class</button>
        </div>
        <table class="table w-full text-left rtl:text-right text-gray-400 mt-8">
            <thead class="text-sm uppercase text-amber-500 border-b-2 border-amber-500">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            ID
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Class Name
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Day
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Time
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Member/Max
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Trainer/Max
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Subscription
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Action
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                <tr class="border-b w-full border-white">
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        {{ $class->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        {{ $class->name }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        {{ $class->day }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        {{ $class->time }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        @if ($class->users()->count())
                        <form action="/see-class-member" method="POST">
                            @csrf
                            <input class="hidden" type="text" name="member_class_id" value="{{ $class->id }}">
                            <button type="submit">{{ $class->users()->count() }} / {{ $class->max_member }}</button><span class="ms-2"></span>
                        </form>
                        @else
                            - / {{ $class->max_member }} <span class="ms-2">person</span>
                        @endif
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        @if ($class->trainers()->count())
                        <form action="/see-class-member" method="POST">
                            @csrf
                            <input class="hidden" type="text" name="trainer_class_id" value="{{ $class->id }}">
                            <button type="submit">{{ $class->trainers()->count() }} / {{ $class->max_trainer }}</button><span class="ms-2">person</span>
                        </form>
                        @else
                            - / {{ $class->max_trainer }}<span class="ms-2">person</span>
                        @endif
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white uppercase">
                        {{ Number::currency($class->subs, 'IDR') }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white flex">
                        <button data-modal-target="update-modal" data-modal-toggle="update-modal" type="button" class="bg-amber-500 rounded py-2 px-3 text-white" @click="target_id = {{ $class->id }}; target_last_name = '{{ $class->name }}'; target_last_max_member = {{ $class->max_member }}; target_last_max_trainer = {{ $class->max_trainer }}; target_last_subs = {{ $class->subs }}">Edit</button>
                        <button data-modal-target="member-modal-{{ $class->id }}" data-modal-toggle="member-modal-{{ $class->id }}" class="bg-green-400 rounded py-2 px-3 ms-2 text-white">Member</button>
                        <button data-modal-target="trainer-modal-{{ $class->id }}" data-modal-toggle="trainer-modal-{{ $class->id }}" class="bg-green-400 rounded py-2 px-3 ms-2 text-white">Trainer</button>
                        <form action="/adm-set-class/{{ $class->id }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="bg-red-500 rounded py-2 px-3 ms-2 text-white" onclick="return confirm('Are you sure to delete this class?')">Delete</button>
                        </form>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- member/trainer modal setting --}}
        @foreach ($classes as $class)

            {{-- member modal --}}
            <div id="member-modal-{{ $class->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-6xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative rounded-lg shadow bg-gray-800">
                        <form action="/adm-set-class/{{ $class->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="type" value="member" class="hidden">
                        <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-[#FFF9E1]">
                                <h3 class="text-lg font-semibold text-amber-500">
                                    Select Member for this Class
                                </h3>
                                <button type="button" class="bg-amber-500 rounded py-2 px-3 ms-2 text-white">Update Member</button>
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
                                        @endforeach

                                        @foreach ($all_active_member as $key=>$member)
                                        @if (!$member->trainingClasses->contains($class->id))
                                        <tr class="border-b hover:bg-gray-50 bg-[#FFF9E1]">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input :checked="all_checked_member" id="checkbox-table-1" type="checkbox" name="new_member_id[{{ $key }}]" value="{{ $member->id }}" class="w-4 h-4 text-amber-500 bg-gray-100 border-amber-500 rounded focus:ring-amber-500 focus:ring-2">
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
                        </form>
                    </div>
                </div>
            </div>

            {{-- trainer modal --}}
            <div id="trainer-modal-{{ $class->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-6xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative rounded-lg shadow bg-gray-800">
                        <form action="/adm-set-class/{{ $class->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="type" value="trainer" class="hidden">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-[#FFF9E1]">
                                <h3 class="text-lg font-semibold text-amber-500">
                                    Select Trainer for this Class
                                </h3>
                                <button type="submit" class="bg-amber-500 rounded py-2 px-3 ms-2 text-white">Update Trainer</button>
                            </div>
                            <!-- Modal body -->
                            <div class="relative overflow-x-auto overflow-y-auto max-h-96">
                                <table class="w-full text-sm text-left rtl:text-right text-black">
                                    <thead class="text-xs text-white uppercase bg-amber-500">
                                        <tr>
                                            <th scope="col" class="p-4">
                                                <div class="flex items-center">
                                                    <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-amber-500 bg-gray-100 border-amber-500 rounded focus:ring-amber-500 focus:ring-2" @click="all_checked_trainer = ! all_checked_trainer, prev_checked_trainer = all_checked_trainer">
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
                                                Trainer Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($class->trainers()->get() as $key=>$trainer)
                                        <tr class="border-b hover:bg-gray-50 bg-[#FFF9E1]">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input :checked="prev_checked_trainer" id="checkbox-table-1" type="checkbox" name="prev_trainer_id[{{ $key }}]" value="{{ $trainer->user()->first()->id }}" class="w-4 h-4 text-amber-500 bg-gray-100 border-amber-500 rounded focus:ring-amber-500 focus:ring-2">
                                                    <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $trainer->user()->first()->id }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $trainer->user()->first()->first_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $trainer->user()->first()->last_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $trainer->user()->first()->email}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $trainer->user()->first()->activated ? "Active" : "Inactive" }}
                                            </td>
                                        </tr>
                                        @endforeach

                                        @foreach ($all_trainer as $key=>$trainer)
                                        @if (!$trainer->trainingClasses->contains($class->id))
                                        <tr class="border-b hover:bg-gray-50 bg-[#FFF9E1]">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input :checked="all_checked_trainer" id="checkbox-table-1" type="checkbox" name="new_trainer_id[{{ $key }}]" value="{{ $trainer->id }}" class="w-4 h-4 text-amber-500 bg-gray-100 border-amber-500 rounded focus:ring-amber-500 focus:ring-2">
                                                    <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $trainer->user()->first()->id }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $trainer->user()->first()->first_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $trainer->user()->first()->last_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $trainer->user()->first()->email}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $trainer->user()->first()->activated ? "Active" : "Inactive" }}
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
            <span class="text-sm font-normal text-white mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-white">@if($classes->count() > 0) 1 @else 0 @endif - {{ $classes->count() }}</span> of <span class="font-semibold text-white">{{ $total_class }}</span></span>
            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                {{ $classes->links() }}
            </ul>
        </nav>
    </div>

    {{-- update modal --}}
    <div id="update-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-amber-500">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b-2 rounded-t bg-amber-500 border-white">
                    <h3 class="text-lg font-semibold text-white">
                        Set Class Properties
                    </h3>
                </div>
                <!-- Modal body -->
                <form action="/adm-set-class/update" method="POST" enctype="multipart/form-data" class="py-10 grid px-8 justify-items-start bg-[#FFF9E1]">
                @csrf
                    <input type="number" name="target_id" x-model="target_id" class="hidden">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="new_class_name" id="new_class_name" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-black border-amber-500 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('new_class_name') is-invalid @enderror" placeholder=" " x-model="target_last_name" required />
                        <label for="new_class_name" class="peer-focus:font-medium absolute text-sm text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Class Name</label>
                    </div>
                    <div class="mt-3 flex gap-5 w-full">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="number" name="new_max_member" id="new_max_member" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-black border-amber-500 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('new_max_member') is-invalid @enderror" placeholder=" " x-model="target_last_max_member" required />
                            <label for="new_max_member" class="peer-focus:font-medium absolute text-sm text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Max Member</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="number" name="new_max_trainer" id="new_max_trainer" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-black border-amber-500 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('new_max_trainer') is-invalid @enderror" placeholder=" " x-model="target_last_max_trainer" required />
                            <label for="new_max_trainer" class="peer-focus:font-medium absolute text-sm text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Max Trainer</label>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="number" name="new_subs" id="new_subs" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 appearance-none text-black border-amber-500 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('new_subs') is-invalid @enderror" placeholder=" " x-model="target_last_subs" required />
                        <label for="new_subs" class="peer-focus:font-medium absolute text-sm text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Subscription</label>
                    </div>

                    <div class="flex justify-between w-full">
                        <button id="selectNewDay" data-dropdown-toggle="selectNewDayMenu" class="text-white bg-amber-500 hover:bg-amber-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">Select Day <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="selectNewDayMenu" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow ">
                                <ul class="p-3 space-y-3 text-sm" aria-labelledby="selectNewDay">
                                    <li>
                                        <div class="flex items-center">
                                            <input checked id="day-radio-1" type="radio" value="Monday" name="newDayRadio" class="w-4 h-4 text-amber-500 bg-gray-100 border-gray-300 focus:ring-amber-500">
                                            <label for="day-radio-1" class="ms-2 text-sm font-medium text-amber-500">Monday</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <input id="day-radio-2" type="radio" value="Tuesday" name="newDayRadio" class="w-4 h-4 text-amber-500 bg-gray-100 border-gray-300 focus:ring-amber-500">
                                            <label for="default-radio-2" class="ms-2 text-sm font-medium text-amber-500">Tuesday</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <input id="day-radio-3" type="radio" value="Wednesday" name="newDayRadio" class="w-4 h-4 text-amber-500 bg-gray-100 border-gray-300 focus:ring-amber-500">
                                            <label for="day-radio-3" class="ms-2 text-sm font-medium text-amber-500">Wednesday</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <input id="day-radio-4" type="radio" value="Thursday" name="newDayRadio" class="w-4 h-4 text-amber-500 bg-gray-100 border-gray-300 focus:ring-amber-500">
                                            <label for="day-radio-4" class="ms-2 text-sm font-medium text-amber-500">Thursday</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <input id="day-radio-5" type="radio" value="Friday" name="newDayRadio" class="w-4 h-4 text-amber-500 bg-gray-100 border-gray-300 focus:ring-amber-500">
                                            <label for="day-radio-5" class="ms-2 text-sm font-medium text-amber-500">Friday</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <input id="day-radio-6" type="radio" value="Saturday" name="newDayRadio" class="w-4 h-4 text-amber-500 bg-gray-100 border-gray-300 focus:ring-amber-500">
                                            <label for="day-radio-6" class="ms-2 text-sm font-medium text-amber-500">Saturday</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <input id="day-radio-7" type="radio" value="Sunday" name="newDayRadio" class="w-4 h-4 text-amber-500 bg-gray-100 border-gray-300 focus:ring-amber-500">
                                            <label for="day-radio-7" class="ms-2 text-sm font-medium text-amber-500">Sunday</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        <div class="">
                            <div class="relative">
                                <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <input type="time" id="time" name="time" class="bg-gray-50 border leading-none border-amber-500 text-black text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5" min="09:00" max="18:00" value="00:00" required />
                            </div>
                        </div>

                    </div>

                    <div class="relative z-0 w-full mb-5 group mt-5">
                        <label for="desc" class="block mb-2 text-sm font-medium text-gray-900">Class Description</label>
                        <textarea id="desc" name="newDesc" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg focus:ring-0 focus:outline-0" placeholder="Write this class description"></textarea>
                    </div>

                    <div class="relative z-0 w-full mb-5 group mt-3">
                        <label class="block mb-3 text-xs font-medium text-black" for="classImg">Class Image</label>
                        <input class="block w-full text-xs border rounded-lg cursor-pointer text-black focus:outline-none bg-white border-amber-500 placeholder-gray-400 @error('classImg') is-invalid @enderror" aria-describedby="classImg_help" id="classImg" name="classImg" type="file" required>
                        <p class="mt-1 text-xs text-black" id="classImg_help">Format file: .jpg, .jpeg</p>
                    </div>
                    @error('classImg')
                      <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                          {{ $message }}
                      </div>
                    @enderror

                    <button type="submit" class="bg-amber-500 rounded py-2 px-3 my-5 mx-auto text-white">Update</button>
                </form>
            </div>
        </div>
    </div>

    {{-- store modal --}}
    <div id="store-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b-2 rounded-t bg-amber-500 border-white">
                    <h3 class="text-lg font-semibold text-white">
                        Create New Class
                    </h3>
                </div>
                <!-- Modal body -->
                <form action="/adm-set-class" method="POST" enctype="multipart/form-data" class="py-5 grid px-8 justify-items-start items-center bg-[#FFF9E1]">
                    @csrf
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="new_class_name" id="new_class_name" class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b appearance-none text-black border-amber-500 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('new_class_name') is-invalid @enderror" placeholder=" " required />
                        <label for="new_class_name" class="peer-focus:font-medium absolute text-sm text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Class Name</label>
                    </div>
                    <div class="mt-3 flex gap-5 w-full">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="number" name="new_max_member" id="new_max_member" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b appearance-none text-black border-amber-500 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('new_max_member') is-invalid @enderror" placeholder=" " required />
                            <label for="new_max_member" class="peer-focus:font-medium absolute text-sm text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Max Member</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="number" name="new_max_trainer" id="new_max_trainer" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b appearance-none text-black border-amber-500 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('new_max_trainer') is-invalid @enderror" placeholder=" " required />
                            <label for="new_max_trainer" class="peer-focus:font-medium absolute text-sm text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Max Trainer</label>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="number" name="new_subs" id="new_subs" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b appearance-none text-black border-amber-500 focus:border-amber-500 focus:outline-none focus:ring-0 peer @error('new_subs') is-invalid @enderror" placeholder=" " required />
                        <label for="new_subs" class="peer-focus:font-medium absolute text-sm text-black duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-black peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Subscription</label>
                    </div>

                    <div class="flex justify-between w-full">
                        <button id="selectDay" data-dropdown-toggle="selectDayMenu" class="text-white bg-amber-500 hover:bg-amber-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">Select Day <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="selectDayMenu" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow ">
                                <ul class="p-3 space-y-3 text-sm" aria-labelledby="selectDay">
                                    <li>
                                        <div class="flex items-center">
                                            <input checked id="day-radio-1" type="radio" value="Monday" name="dayRadio" class="w-4 h-4 text-amber-500 bg-gray-100 border-gray-300 focus:ring-amber-500">
                                            <label for="day-radio-1" class="ms-2 text-sm font-medium text-amber-500">Monday</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <input id="day-radio-2" type="radio" value="Tuesday" name="dayRadio" class="w-4 h-4 text-amber-500 bg-gray-100 border-gray-300 focus:ring-amber-500">
                                            <label for="default-radio-2" class="ms-2 text-sm font-medium text-amber-500">Tuesday</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <input id="day-radio-3" type="radio" value="Wednesday" name="dayRadio" class="w-4 h-4 text-amber-500 bg-gray-100 border-gray-300 focus:ring-amber-500">
                                            <label for="day-radio-3" class="ms-2 text-sm font-medium text-amber-500">Wednesday</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <input id="day-radio-4" type="radio" value="Thursday" name="dayRadio" class="w-4 h-4 text-amber-500 bg-gray-100 border-gray-300 focus:ring-amber-500">
                                            <label for="day-radio-4" class="ms-2 text-sm font-medium text-amber-500">Thursday</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <input id="day-radio-5" type="radio" value="Friday" name="dayRadio" class="w-4 h-4 text-amber-500 bg-gray-100 border-gray-300 focus:ring-amber-500">
                                            <label for="day-radio-5" class="ms-2 text-sm font-medium text-amber-500">Friday</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <input id="day-radio-6" type="radio" value="Saturday" name="dayRadio" class="w-4 h-4 text-amber-500 bg-gray-100 border-gray-300 focus:ring-amber-500">
                                            <label for="day-radio-6" class="ms-2 text-sm font-medium text-amber-500">Saturday</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <input id="day-radio-7" type="radio" value="Sunday" name="dayRadio" class="w-4 h-4 text-amber-500 bg-gray-100 border-gray-300 focus:ring-amber-500">
                                            <label for="day-radio-7" class="ms-2 text-sm font-medium text-amber-500">Sunday</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        <div class="">
                            <div class="relative">
                                <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-amber-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <input type="time" id="time" name="time" class="bg-gray-50 border leading-none border-amber-500 text-black text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5" min="09:00" max="18:00" value="00:00" required />
                            </div>
                        </div>

                    </div>

                    <div class="relative z-0 w-full mb-5 group mt-5">
                        <label for="desc" class="block mb-2 text-sm font-medium text-gray-900">Class Description</label>
                        <textarea id="desc" name="desc" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg focus:ring-0 focus:outline-0" placeholder="Write this class description"></textarea>
                    </div>

                    <div class="relative z-0 w-full mb-5 group mt-3">
                        <label class="block mb-3 text-xs font-medium text-black" for="classImg">Class Image</label>
                        <input class="block w-full text-xs border rounded-lg cursor-pointer text-black focus:outline-none bg-white border-amber-500 placeholder-gray-400 @error('classImg') is-invalid @enderror" aria-describedby="classImg_help" id="classImg" name="classImg" type="file">
                        <p class="mt-1 text-xs text-black" id="classImg_help">Format file: .jpg, .jpeg</p>
                    </div>
                    @error('classImg')
                      <div class="alert-danger mb-5 -mt-3 text-red-400 text-xs">
                          {{ $message }}
                      </div>
                    @enderror

                    <button type="submit" class="bg-amber-500 rounded py-2 px-3 my-5 mx-auto text-white">Create</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
