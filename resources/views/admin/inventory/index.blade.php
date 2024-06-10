@extends("index")

@section('main-body')
@if (session()->has('change_fail'))
<div class="p-4 absolute text-md max-w-md bg-red-500 text-white right-0 bottom-0" role="alert">
    {{ session('change_fail') }}
</div>
@endif

<div class="my-8 w-full" x-data="{target_id: 0, target_inv_id: 0, target_last_name: '', all_checked: false, prev_checked: true, }">
    <div class="relative mx-16 overflow-x-auto shadow-md sm:rounded-lg">
        <div class="pb-4 bg-gray-900 flex gap-5 justify-between">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <form action="/inventory/search" method="POST">
                    @csrf
                    <input type="text" id="table_search" name="table_search" class="block pt-2 ps-10 text-sm rounded-lg w-80 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Search class">
                    <button type="submit" class="hidden"></button>
                </form>
            </div>
            <button data-modal-target="store-modal" data-modal-toggle="store-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 flex items-center text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Inventory</button>
        </div>

        <div class="md:flex mt-5">
            <ul id="inventory-tab" data-tabs-toggle="#inventory-tab-content" role="tablist" class="flex-column space-y space-y-4 min-w-36 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">
                <li>
                    <button id="class-tab" data-tabs-target="#class-content" type="button" role="tab" aria-selected="false" aria-controls="class-content" class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white" aria-current="page">
                        <svg class="w-4 h-4 me-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                        </svg>
                        Class List
                    </button>
                </li>
                <li>
                    <button id="item-tab" data-tabs-target="#item-content" type="button" role="tab" aria-selected="false" aria-controls="item-content" class="inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/></svg>
                        Item List
                    </button>
                </li>
            </ul>
            <div id="inventory-tab-content" class="p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full">
                <div id="class-content" role="tabpanel" aria-labelledby="class-tab" class="hidden">
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
                                        Inventory Number
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
                                <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                                    {{ $class->inventories->count() }}
                                </th>
                                <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white flex">
                                    <button data-modal-target="update-modal-{{ $class->id }}" data-modal-toggle="update-modal-{{ $class->id }}" type="button" class="bg-yellow-400 rounded py-2 px-3 text-white" @click="target_id = {{ $class->id }}">Update Class Inventory</button>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
                        <span class="text-sm font-normal text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-white">1 - {{ $classes->count() }}</span> of <span class="font-semibold text-white">{{ $total_class }}</span></span>
                        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                            {{ $classes->links() }}
                        </ul>
                    </nav>
                </div>

                <div id="item-content" role="tabpanel" aria-labelledby="item-tab" class="hidden max-h-96 overflow-y-scroll">
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
                                        Item Name
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
                            @foreach ($all_inventory as $inventory)
                            <tr class="border-b w-full bg-gray-800 border-gray-700">
                                <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                                    {{ $inventory->id }}
                                </th>
                                <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white">
                                    {{ $inventory->name }}
                                </th>
                                <th scope="row" class="px-6 py-4 text-sm font-normal whitespace-nowrap text-white flex">
                                    <form action="/inventory/{{ $inventory->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 rounded py-2 px-3 text-white" onclick="return confirm('Are you sure to delete this item?')">Delete</button>
                                    </form>
                                </th>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        {{-- inventory modal setting --}}
        @foreach ($classes as $class)

            {{-- inventory modal --}}
            <div id="update-modal-{{ $class->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-6xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative rounded-lg shadow bg-gray-800">
                        <form action="/inventory/{{ $class->id }}" method="POST">
                        @csrf
                        @method('PUT')
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
                                                    <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @click="all_checked = ! all_checked, prev_checked = all_checked">
                                                    <label for="checkbox-all" class="sr-only">checkbox</label>
                                                </div>
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                ID
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Name
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($class->inventories()->get() as $key=>$inventory)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input :checked="prev_checked" id="checkbox-table-1" type="checkbox" name="prev_inv_id[{{ $key }}]" value="{{ $inventory->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $inventory->id }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $inventory->name }}
                                            </td>
                                        </tr>
                                        @endforeach

                                        @foreach ($all_inventory as $key=>$inventory)
                                        @if ($inventory->training_class_id == 0)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input :checked="all_checked" id="checkbox-table-1" type="checkbox" name="new_inv_id[{{ $key }}]" value="{{ $inventory->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $inventory->id }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $inventory->name }}
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

        {{-- store modal --}}
        <div id="store-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative rounded-lg shadow bg-gray-800">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                        <h3 class="text-lg font-semibold text-white">
                            Create New Item
                        </h3>
                    </div>
                    <!-- Modal body -->
                    <form action="/inventory" method="POST" class="my-5 grid px-8 justify-items-start items-center">
                    @csrf
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="new_item_name" id="new_class_name" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer @error('new_class_name') is-invalid @enderror" placeholder=" " required />
                            <label for="new_item_name" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Item Name</label>
                        </div>
                        <button type="submit" class="bg-green-500 rounded py-2 px-3 my-5 mx-auto text-white">Save</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
