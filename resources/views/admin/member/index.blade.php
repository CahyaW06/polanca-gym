@extends("index")

@section('main-body')
<div class="mt-32 w-full" x-data="{target_id : 0}">
    <div class="relative mx-16 overflow-x-auto sm:rounded-lg">
        <div class="pb-4 bg-gray-900">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <form action="/adm-member" method="POST">
                    @csrf
                    <input type="text" id="table_search" name="table_search" class="block pt-2 ps-10 text-sm rounded-lg w-80 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Search user">
                    <button type="submit" class="hidden"></button>
                </form>
            </div>
        </div>
        <table class="table w-full text-sm text-left rtl:text-right text-gray-400">
            <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            ID
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            First Name
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Last Name
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Email
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Type
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Remaining Membership Duration (Month)
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Last Updated Membership
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Membership End At
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Status
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
                @foreach ($members as $member)
                <tr class="border-b w-full bg-gray-800 border-gray-700">
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        {{ $member->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        {{ $member->first_name }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        {{ $member->last_name }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        {{ $member->email }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white uppercase">
                        {{ $member->type }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        @if ($member->activated == 1 && $member->type == "member")
                            @if ($member->membership_duration > 1)
                                {{ $member->membership_duration }} months
                            @else
                                {{ $member->membership_duration }} month
                            @endif
                        @else
                            -
                        @endif
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        @if ($member->activated == 1)
                            {{ $member->update_membership_at }}
                        @else
                            -
                        @endif
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        @if ($member->activated == 1 && $member->type == "member")
                            {{ $member->membership_end_at }}
                        @else
                            -
                        @endif
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        @if ($member->activated == 1)
                            Active
                        @else
                            Inactive
                        @endif
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        <div class="flex gap-3">
                        @if ($member->type == "member")
                            @if ($member->activated == 1)
                            <button data-modal-target="update-modal" data-modal-toggle="update-modal" type="button" class="bg-yellow-400 rounded py-2 px-3 w-max" @click="target_id = {{ $member->id }}">Update</button>
                            <form action="/adm-update-member" method="POST" class="flex justify-center">
                                @csrf
                                <input type="number" name="user_id" value="{{ $member->id }}" class="hidden">
                                <input type="number" name="unactivate" value="1" class="hidden">
                                <button type="submit" class="bg-red-500 rounded py-2 px-3 w-max">Unactivate</button>
                            </form>

                            @else
                            <button data-modal-target="activate-modal" data-modal-toggle="activate-modal" type="button" class="bg-green-400 rounded py-2 px-3 w-max" @click="target_id = {{ $member->id }}">Activate</button>
                            @endif

                        @else
                            @if ($member->activated == 1)
                            <form action="/adm-update-member" method="POST" class="flex justify-center">
                                @csrf
                                <input type="number" name="user_id" value="{{ $member->id }}" class="hidden">
                                <input type="number" name="unactivate" value="1" class="hidden">
                                <button type="submit" class="bg-red-500 rounded py-2 px-3 w-max">Unactivate</button>
                            </form>

                            @else
                            <form action="/adm-update-member" method="POST" class="flex justify-center">
                                @csrf
                                <input type="number" name="user_id" value="{{ $member->id }}" class="hidden">
                                <input type="number" name="activate" value="1" class="hidden">
                                <button type="submit" class="bg-green-400 rounded py-2 px-3 w-max">Activate</button>
                            </form>
                            <form action="/down-trainer-apply-letter" method="POST" class="flex justify-center">
                                @csrf
                                <input type="number" name="user_id" value="{{ $member->id }}" class="hidden">
                                <button type="submit" class="bg-blue-600 rounded py-2 px-3 w-max">Applicant Data</button>
                            </form>
                            @endif
                        @endif
                        </div>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-white">1 - {{ $members->count() }}</span> of <span class="font-semibold text-white">{{ $total_member }}</span></span>
            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                {{ $members->links() }}
            </ul>
        </nav>
    </div>

    {{-- Update modal --}}
    <div id="update-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative rounded-lg shadow bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                    <h3 class="text-lg font-semibold text-white">
                        Set Membership Duration
                    </h3>
                </div>
                <!-- Modal body -->
                <form action="/adm-update-member" method="POST" class="my-5 grid justify-items-center items-center">
                @csrf
                    <input type="number" name="user_id" x-model="target_id" class="hidden">
                    <input type="number" name="update" value="1" class="hidden">
                    <div class="flex items-baseline mx-20">
                        <input type="number" name="new_duration" id="new_duration" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="0">
                        <label for="new_duration" class="text-md ms-3 text-white">month/s</label>
                    </div>
                    <button type="submit" class="bg-yellow-400 rounded py-2 px-3 my-5 mx-auto text-white">Update</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Activate modal --}}
    <div id="activate-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative rounded-lg shadow bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                    <h3 class="text-lg font-semibold text-white">
                        Set Membership Duration
                    </h3>
                </div>
                <!-- Modal body -->
                <form action="/adm-update-member" method="POST" class="my-5 grid justify-items-center items-center">
                @csrf
                    <input type="number" name="user_id" x-model="target_id" class="hidden">
                    <input type="number" name="activate" value="1" class="hidden">
                    <div class="flex items-baseline mx-20">
                        <input type="number" name="new_duration" id="new_duration" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="0">
                        <label for="new_duration" class="text-md ms-3 text-white">month/s</label>
                    </div>
                    <button type="submit" class="bg-green-400 rounded py-2 px-3 my-5 mx-auto text-white">Activate</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
