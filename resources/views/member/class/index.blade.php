@extends('index')

@section('main-body')
    <div class="flex w-full pt-40">
        <div class="w-full" x-data="{ selected: false }">
            <div id="class-carousel" class="relative w-full" :data-carousel="selected ? 'static' : 'slide'" data-carousel-interval=7000>
                <!-- Carousel wrapper -->
                <div class="relative overflow-hidden rounded-lg h-[calc(100vh-200px)] w-full mx-auto">

                    @foreach ($classes as $key=>$class)
                    <div class="hidden duration-500 ease-in-out" data-carousel-item>
                        <div class="flex justify-center gap-5">
                            @if ($key > 0)
                                @if ($classes[$key-1]->exists())
                                <div class="relative max-w-sm bg-white border border-amber-500 rounded-lg shadow h-[30rem] grayscale">
                                    <div class="overflow-hidden max-h-[18rem]">
                                        <img src="{{ url('storage/class/'.$classes[$key-1]->img) }}" class="rounded-t-lg object-cover">
                                    </div>
                                    <div class="p-5">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-amber-500">{{ $classes[$key-1]->name }}</h5>
                                        <div class="flex align-baseline">
                                            <span class="material-symbols-outlined text-amber-500">group</span>
                                            <span class="text-gray-700 font-normal ms-3">{{ $classes[$key-1]->users()->count() }}/{{ $classes[$key-1]->max_member }} People</span>
                                        </div>
                                        @if(Auth::user()->trainingClasses->firstWhere('id', $classes[$key-1]->id) != null)
                                        <div class="w-full flex justify-center mt-8">
                                            <button type="button" class="text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-amber-500 hover:bg-amber-600" disabled>
                                                Already Join This Class
                                            </button>
                                        </div>
                                        @else
                                        <div class="w-full flex justify-center mt-8">
                                            <button class="text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-amber-500 hover:bg-amber-600" disabled>
                                                Select this Class
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            @endif

                            <div class="relative max-w-sm bg-white border border-amber-500 rounded-lg shadow h-[30rem]">
                                <div class="overflow-hidden max-h-[18rem]">
                                    <img src="{{ url('storage/class/'.$class->img) }}" class="rounded-t-lg object-cover">
                                </div>
                                <div class="p-5">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-amber-500">{{ $class->name }}</h5>
                                    <div class="flex align-baseline">
                                        <span class="material-symbols-outlined text-amber-500">group</span>
                                        <span class="text-gray-700 font-normal ms-3">{{ $class->users()->count() }}/{{ $class->max_member }} People</span>
                                    </div>

                                    @if($class->users()->count() >= $class->max_member)
                                    <div class="w-full flex justify-center mt-8">
                                        <button type="button" class="text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-amber-500 hover:bg-amber-600" disabled>
                                            Select this Class
                                        </button>
                                    </div>
                                    @elseif(Auth::user()->trainingClasses->firstWhere('id', $class->id) != null)
                                    <div class="w-full flex justify-center mt-8">
                                        <button type="button" class="text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-amber-500 hover:bg-amber-600" disabled>
                                            Already Join This Class
                                        </button>
                                    </div>
                                    @else
                                    <div class="w-full flex justify-center mt-8">
                                        <a type="button" href="/join-class/{{ $class->id }}" class="text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-amber-500 hover:bg-amber-600">
                                            Select this Class
                                        </a>
                                    </div>
                                    @endif
                                </div>
                                <input type="integer" value='{{ $class->id }}' class="hidden" name="classId">
                            </div>

                            @if ($key < $classes->count() - 1)
                                @if ($classes[$key+1]->exists())
                                <div class="relative max-w-sm bg-white border border-amber-500 rounded-lg shadow h-[30rem] grayscale">
                                    <div class="overflow-hidden max-h-[18rem]">
                                        <img src="{{ url('storage/class/'.$classes[$key+1]->img) }}" class="rounded-t-lg object-cover">
                                    </div>
                                    <div class="p-5">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-amber-500">{{ $classes[$key+1]->name }}</h5>
                                        <div class="flex align-baseline">
                                            <span class="material-symbols-outlined text-amber-500">group</span>
                                            <span class="text-gray-700 font-normal ms-3">{{ $classes[$key+1]->users()->count() }}/{{ $classes[$key+1]->max_member }} People</span>
                                        </div>
                                        @if(Auth::user()->trainingClasses->firstWhere('id', $classes[$key+1]->id) != null)
                                        <div class="w-full flex justify-center mt-8">
                                            <button type="button" class="text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-amber-500 hover:bg-amber-600" disabled>
                                                Already Join This Class
                                            </button>
                                        </div>
                                        @else
                                        <div class="w-full flex justify-center mt-8">
                                            <button class="text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-amber-500 hover:bg-amber-600" disabled>
                                                Select this Class
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    @endforeach

                </div>
                <!-- Slider indicators -->
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">

                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    @if ($classes->count() > 1)
                        @foreach ($classes as $key=>$class)
                            @if ($key > 0)
                            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide {{ $key+2 }}" data-carousel-slide-to="{{ $key+1 }}"></button>
                            @endif
                        @endforeach
                    @endif
                </div>
                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
