@extends("index")

@section('main-body')
@if (session()->has('change_fail'))
<div class="p-4 absolute text-md max-w-md bg-red-500 text-white right-0 bottom-0" role="alert">
    {{ session('change_fail') }}
</div>
@endif

<div class="mt-32 w-full" x-data="{target_id: 0, target_inv_id: 0, target_last_name: '', all_checked: false, prev_checked: true, }">
    <div class="relative mx-16 overflow-x-auto sm:rounded-lg">
        <div class="flex justify-end">
            <button data-modal-target="store-modal" data-modal-toggle="store-modal" type="button" class="text-white bg-amber-500 hover:bg-amber-600 font-medium rounded-lg text-sm px-4 flex items-center text-center py-3">Add Inventory</button>
        </div>

        <div class="md:flex mt-8">
            <ul id="inventory-tab" data-tabs-toggle="#inventory-tab-content" role="tablist" class="flex-column space-y space-y-4 min-w-36 text-sm font-medium text-gray-400 me-4 mb-0">
                <li>
                    <button id="class-tab" data-tabs-target="#class-content" type="button" role="tab" aria-selected="false" aria-controls="class-content" class="inline-flex items-center px-4 py-2 hover:text-white border-r-2 w-full text-base" aria-current="page">
                        <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/></svg>
                        Class List
                    </button>
                </li>
                <li>
                    <button id="item-tab" data-tabs-target="#item-content" type="button" role="tab" aria-selected="false" aria-controls="item-content" class="inline-flex items-center px-4 py-2 hover:text-white border-r-2 w-full text-base">
                        <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/></svg>
                        Item List
                    </button>
                </li>
            </ul>
            <div id="inventory-tab-content" class="px-6 w-full">
                <div id="class-content" role="tabpanel" aria-labelledby="class-tab" class="hidden">
                    <table class="table w-full text-left rtl:text-right text-gray-400">
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
                            <tr class="border-b w-full border-white">
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
                                    <button data-modal-target="update-modal-{{ $class->id }}" data-modal-toggle="update-modal-{{ $class->id }}" type="button" class="bg-amber-500 rounded py-2 px-3 text-white" @click="target_id = {{ $class->id }}">Update Class Inventory</button>
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
                    <table class="table w-full text-left rtl:text-right text-gray-400">
                        <thead class="text-sm uppercase text-amber-500 border-b-2 border-amber-500">
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
                            <tr class="border-b w-full border-white">
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

            {{-- <div class="min-w-96 ms-5 rounded-lg">
                <div class="my-auto" id="pie-chart"></div>
            </div> --}}
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
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-[#FFF9E1]">
                                <h3 class="text-lg font-semibold text-amber-500">
                                    Select Inventory for this Class
                                </h3>
                                <button type="submit" class="bg-amber-500 rounded py-2 px-3 ms-2 text-white">Update Inventory</button>
                            </div>
                        <!-- Modal body -->
                            <div class="relative overflow-x-auto overflow-y-auto max-h-96">
                                <table class="w-full text-sm text-left rtl:text-right text-black">
                                    <thead class="text-xs text-white uppercase bg-amber-500">
                                        <tr>
                                            <th scope="col" class="p-4">
                                                <div class="flex items-center">
                                                    <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-amber-500 bg-gray-100 border-amber-500 rounded focus:ring-amber-500 focus:ring-2" @click="all_checked = ! all_checked, prev_checked = all_checked">
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
                                        <tr class="border-b hover:bg-gray-50 bg-[#FFF9E1]">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input :checked="prev_checked" id="checkbox-table-1" type="checkbox" name="prev_inv_id[{{ $key }}]" value="{{ $inventory->id }}" class="w-4 h-4 text-amber-500 bg-gray-100 border-amber-500 rounded focus:ring-amber-500 focus:ring-2">
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
                                        <tr class="border-b hover:bg-gray-50 bg-[#FFF9E1]">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input :checked="all_checked" id="checkbox-table-1" type="checkbox" name="new_inv_id[{{ $key }}]" value="{{ $inventory->id }}" class="w-4 h-4 text-amber-500 bg-gray-100 border-amber-500 rounded focus:ring-amber-500 focus:ring-2">
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

{{-- @push('scripts')
<script src="{{ asset('js/inventory_chart.js') }}"></script>
@endpush --}}
