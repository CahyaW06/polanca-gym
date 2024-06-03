@extends("index")

@section('main-body')
@if (session()->has('change_fail'))
<div class="p-4 absolute text-md max-w-md bg-red-500 text-white right-0 bottom-0" role="alert">
    {{ session('change_fail') }}
</div>
@endif

<div class="my-8 w-full" x-data="{target_id: 0, target_last_name: '', target_last_max_member: 0, target_last_max_trainer: 0, target_last_subs: 0}">
    <div class="relative mx-16 overflow-x-auto shadow-md sm:rounded-lg">
        <div class="pb-4 bg-gray-900 flex gap-5 justify-between">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <form action="/adm-set-class/search" method="POST">
                    @csrf
                    <input type="text" id="table_search" name="table_search" class="block pt-2 ps-10 text-sm rounded-lg w-80 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Search class">
                    <button type="submit" class="hidden"></button>
                </form>
            </div>
            <button data-modal-target="store-modal" data-modal-toggle="store-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 flex items-center text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Class</button>
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
                            Class Name
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
                <tr class="border-b w-full bg-gray-800 border-gray-700">
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        {{ $class->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        {{ $class->name }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        10
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                        10
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white uppercase">
                        {{ Number::currency($class->subs, 'IDR') }}
                    </th>
                    <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white flex">
                        <button data-modal-target="update-modal-{{ $class->id }}" data-modal-toggle="update-modal-{{ $class->id }}" type="button" class="bg-yellow-400 rounded py-2 px-3 text-white" @click="target_id = {{ $class->id }}; target_last_name = '{{ $class->name }}'; target_last_max_member = {{ $class->max_member }}; target_last_max_trainer = {{ $class->max_trainer }}; target_last_subs = {{ $class->subs }}">Update Class Inventory</button>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- inventory modal setting --}}
        @foreach ($classes as $class)

            {{-- inventory modal --}}
            <div id="update-modal-{{ $class->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-6xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative rounded-lg shadow bg-gray-800">
                        <form action="/adm-set-class/{{ $class->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="type" value="update" class="hidden">
                        <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                                <h3 class="text-lg font-semibold text-white">
                                    Select Inventory for this Class
                                </h3>
                                <button type="submit" class="bg-yellow-500 rounded py-2 px-3 ms-2 text-white">Update Inventory</button>
                            </div>
                        <!-- Modal body -->
                            <div class="relative overflow-x-auto overflow-y-auto max-h-96 shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="p-4">
                                                <div class="flex items-center">
                                                    <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input checked id="checkbox-table-1" type="checkbox" name="prev_member_id[{{ $key }}]" value="{{ $member->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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

                                        {{-- @foreach ($all_active_member as $key=>$member)
                                        @if (!$member->trainingClasses->contains($class->id))
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input id="checkbox-table-1" type="checkbox" name="new_member_id[{{ $key }}]" value="{{ $member->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-white">1 - {{ $classes->count() }}</span> of <span class="font-semibold text-white">{{ $total_class }}</span></span>
            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                {{ $classes->links() }}
            </ul>
        </nav>
    </div>
</div>
@endsection
