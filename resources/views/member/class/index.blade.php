@extends('index')

@section('main-body')
    <div class="flex w-full mt-10">
        <div class="w-full" x-data="{ selected: false }">
            <div id="class-carousel" class="relative w-full" :data-carousel="selected ? 'static' : 'slide'" data-carousel-interval=7000>
                <!-- Carousel wrapper -->
                <div class="relative overflow-hidden rounded-lg h-[calc(100vh-150px)] w-full mx-auto">

                    @foreach ($classes as $key=>$class)
                    <div class="hidden duration-500 ease-in-out" data-carousel-item data-name="{{ $class->name }}" data-desc="{{ $class->desc }}">
                        @if ($key < $classes->count() - 1)
                            @if ($classes[$key+1]->exists())
                            <div class="object-scale-down absolute block translate-x-[175px] -translate-y-1/2 top-1/2 left-1/2">
                                <img src="{{ url('storage/class/'.$classes[$key+1]->img) }}" class="rounded-lg grayscale">
                                <h1 class="absolute block bottom-1/4 left-0 text-4xl -rotate-90 font-bold grayscale">{{ $classes[$key+1]->name }}</h1>
                            </div>
                            @endif
                        @endif
                        @if ($key > 0)
                            @if ($classes[$key-1]->exists())
                            <div class="object-scale-down absolute block -translate-x-[475px] -translate-y-1/2 top-1/2 left-1/2">
                                <img src="{{ url('storage/class/'.$classes[$key-1]->img) }}" class="rounded-lg grayscale">
                                <h1 class="absolute block bottom-1/4 left-0 text-4xl -rotate-90 font-bold grayscale">{{ $classes[$key-1]->name }}</h1>
                            </div>
                            @endif
                        @endif
                        <button type="button" class="object-scale-down absolute block -translate-x-1/2 -translate-y-2/3 top-1/2 left-1/2 focus:outline-4 focus:outline focus:outline-amber-500" @click="selected = ! selected" onclick="return tes()">
                            <img src="{{ url('storage/class/'.$class->img) }}" class="rounded-lg">
                            <h1 class="absolute block bottom-1/4 left-0 text-4xl text-amber-500 -rotate-90 font-bold">{{ $class->name }}</h1>
                        </button>
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

        {{-- <div class="w-1/2 ms-5 me-10 text-center my-auto">
            <div class="block p-6 border rounded-lg shadow bg-gray-800 border-gray-700">
                <h5 id="classTitle" class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                <p id="classDesc" class="font-normal text-gray-700 dark:text-gray-400 text-left">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
            </div>
        </div> --}}
    </div>
@endsection

@push('scripts')
{{-- <script>
    function tes() {
        let carousel = FlowbiteInstances.getInstance('Carousel', 'class-carousel');

        let classTitle = document.getElementById('classTitle');
        classTitle.innerHTML = carousel._activeItem.el.dataset.name;
        let classDesc = document.getElementById('classDesc');
        classDesc.innerHTML = carousel._activeItem.el.dataset.desc;
    }
</script> --}}
@endpush
