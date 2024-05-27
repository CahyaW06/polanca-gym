@extends("index")

@section('main-body')
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
                <form action="/adm-set-class" method="POST">
                    @csrf
                    <input type="text" id="table_search" name="table_search" class="block pt-2 ps-10 text-sm rounded-lg w-80 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Search with ID">
                    <button type="submit" class="hidden"></button>
                </form>
            </div>
            <a href="/" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 flex items-center text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Class</a>
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
                        <button data-modal-target="update-modal" data-modal-toggle="update-modal" type="button" class="bg-yellow-400 rounded py-2 px-3 text-white" @click="target_id = {{ $class->id }}; target_last_name = '{{ $class->name }}'; target_last_max_member = {{ $class->max_member }}; target_last_max_trainer = {{ $class->max_trainer }}; target_last_subs = {{ $class->subs }}">Edit</button>
                        <button class="bg-green-400 rounded py-2 px-3 ms-2 text-white">Member</button>
                        <button class="bg-green-400 rounded py-2 px-3 ms-2 text-white">Trainer</button>
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
        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-white">1 - {{ $classes->count() }}</span> of <span class="font-semibold text-white">{{ $total_class }}</span></span>
            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                {{ $classes->links() }}
            </ul>
        </nav>
    </div>

    {{-- update modal --}}
    <div id="update-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative rounded-lg shadow bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                    <h3 class="text-lg font-semibold text-white">
                        Set Class Properties
                    </h3>
                </div>
                <!-- Modal body -->
                <form action="/adm-set-class/update" method="POST" class="my-5 flex-col px-8 justify-items-start items-center">
                @csrf
                    <input type="number" name="target_id" x-model="target_id" class="hidden">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="new_class_name" id="new_class_name" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer @error('new_class_name') is-invalid @enderror" placeholder=" " x-model="target_last_name" required />
                        <label for="new_class_name" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Class Name</label>
                    </div>
                    <div class="mt-3 flex gap-5">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="number" name="new_max_member" id="new_max_member" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer @error('new_max_member') is-invalid @enderror" placeholder=" " x-model="target_last_max_member" required />
                            <label for="new_max_member" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Max Member</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="number" name="new_max_trainer" id="new_max_trainer" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer @error('new_max_trainer') is-invalid @enderror" placeholder=" " x-model="target_last_max_trainer" required />
                            <label for="new_max_trainer" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Max Trainer</label>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="number" name="new_subs" id="new_subs" class="block py-2.5 px-0 w-full text-sm  bg-transparent border-0 border-b-2 appearance-none text-white border-gray-600 focus:border-blue-500 focus:outline-none focus:ring-0 peer @error('new_subs') is-invalid @enderror" placeholder=" " x-model="target_last_subs" required />
                        <label for="new_subs" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Subscription</label>
                    </div>

                    <button type="submit" class="bg-yellow-400 rounded py-2 px-3 my-5 mx-auto text-white">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
