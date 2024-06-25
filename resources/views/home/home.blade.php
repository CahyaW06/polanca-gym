@extends("index")

@section('main-body')
<section class="bg-center bg-cover bg-no-repeat bg-gray-500 bg-blend-multiply h-screen" style="background-image: url('storage/home_bg.png')" x-data="{ greeting: 'Hello' }">
    <div class="px-4 max-w-screen-md py-24 lg:py-56">
        <h1 class="mt-8 mb-4 ps-48 font-extrabold tracking-tight leading-none text-white text-6xl">{{ $lastSetting->gym_name }}</h1>
        <p class="mb-16 font-normal text-gray-300 text-xl ps-48 pe-20">At {{ $lastSetting->gym_name }}, we believe in the power of transformation. Whether you're a seasoned athlete or just starting your fitness journey, our state-of-the-art facilities and expert trainers are here to help you achieve your goals.</p>

        @guest
        <a href="/login" class="mx-48 inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-amber-500 hover:bg-amber-600">
            Get started
            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
        @endguest
        @auth
        @if (Auth::user()->type == "member")
        <a href="/membership" class="mx-48 inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-amber-500 hover:bg-amber-600">
            Membership
            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>

        @elseif (Auth::user()->type == "admin")
        <div id="gymIncome" class="fixed top-48 right-36 max-w-sm w-full bg-dark rounded-lg shadow p-6 border border-amber-500" data-income="{{ $history }}">
            <div class="flex justify-between">
              <div>
                <h5 class="font-extrabold tracking-tight leading-none text-amber-500 text-2xl">Gym Income</h5>
              </div>
            </div>
            <div id="area-chart"></div>
            <div class="grid grid-cols-1 items-center border-gray-200 border-t justify-between">
              <div class="flex justify-between items-center pt-5">
                <!-- Button -->
                <button
                  id="dropdownDefaultButton"
                  data-dropdown-toggle="lastDaysdropdown"
                  data-dropdown-placement="bottom"
                  class="text-sm font-medium text-white hover:text-gray-200 text-center inline-flex items-center"
                  type="button">
                  Last 7 days
                  <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                      <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">One Week</a>
                      </li>
                      <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">One Month</a>
                      </li>
                      <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">One Year</a>
                      </li>
                    </ul>
                </div>
              </div>
            </div>
          </div>
          <script src="{{ asset('js/apexcharts.js') }}"></script>

          @push('scripts')
          <script>
            // let income = document.getElementById('gymIncome');
            // let info = JSON.parse(income.dataset.income);
            // console.log(info);

            const options = {
              chart: {
                height: "100%",
                maxWidth: "100%",
                type: "area",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                  enabled: false,
                },
                toolbar: {
                  show: false,
                },
              },
              tooltip: {
                enabled: true,
                x: {
                  show: false,
                },
              },
              fill: {
                type: "gradient",
                gradient: {
                  opacityFrom: 0.7,
                  opacityTo: 0,
                  shade: "#FFD54B",
                  gradientToColors: ["#FFD54B"],
                },
              },
              dataLabels: {
                enabled: false,
              },
              stroke: {
                width: 6,
              },
              grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                  left: 2,
                  right: 2,
                  top: 0
                },
              },
              series: [
                {
                  name: "Gym Income",
                  data: [6500, 6418, 6456, 6526, 6356, 6456],
                  color: "#FFD54B",
                },
              ],
              xaxis: {
                // categories: ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February', '07 February'],
                // categories:
                labels: {
                  show: false,
                },
                axisBorder: {
                  show: false,
                },
                axisTicks: {
                  show: false,
                },
              },
              yaxis: {
                show: false,
              },
          }

          if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("area-chart"), options);
            chart.render();
          }

          </script>
          @endpush
        @endif

        @endauth

    </div>
</section>
@endsection
