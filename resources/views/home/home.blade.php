@extends("index")

@section('main-body')
<section class="bg-center bg-cover bg-no-repeat bg-gray-500 bg-blend-multiply h-screen" style="background-image: url('/storage/home_bg.png')" x-data="{ greeting: 'Hello' }">
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
        <div id="gymIncome" class="fixed top-48 right-36 max-w-sm w-full bg-dark rounded-lg shadow p-6 border border-amber-500" data-weekly-member-income="{{ $weeklyMemIncome }}" data-weekly-class-income="{{ $weeklyClassIncome }}" data-week="{{ $week }}" data-monthly-member-income="{{ $monthlyMemIncome }}" data-monthly-class-income="{{ $monthlyClassIncome }}" data-month="{{ $month }}" data-yearly-member-income="{{ $yearlyMemIncome }}" data-yearly-class-income="{{ $yearlyClassIncome }}" data-year="{{ $year }}">
            <div class="flex justify-between mb-5">
              <div>
                <h5 class="font-extrabold tracking-tight leading-none text-white text-2xl mb-8">Gym Income</h5>
              </div>
            </div>
            <div id="line-chart"></div>
            <div class="grid grid-cols-1 items-center border-gray-200 border-t justify-between" x-data="{ type: 1 }">
              <div class="flex justify-between items-center pt-5">
                <!-- Button -->
                <button
                  id="dropdownDefaultButton"
                  data-dropdown-toggle="lastDaysdropdown"
                  data-dropdown-placement="bottom"
                  class="text-sm font-medium text-white hover:text-gray-200 text-center inline-flex items-center"
                  type="button">
                  <span x-cloak x-show="type == 1" style="display: none">Last 7 days</span>
                  <span x-cloak x-show="type == 2" style="display: none">Last 30 days</span>
                  <span x-cloak x-show="type == 3" style="display: none">Last 1 year</span>

                  <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                      <li>
                        <button class="block px-4 py-2 hover:bg-gray-100" @click="type = 1, changeType($data)">One Week</button>
                      </li>
                      <li>
                        <button class="block px-4 py-2 hover:bg-gray-100" @click="type = 2, changeType($data)">One Month</button>
                      </li>
                      <li>
                        <button class="block px-4 py-2 hover:bg-gray-100" @click="type = 3, changeType($data)">One Year</button>
                      </li>
                    </ul>
                </div>
              </div>
            </div>
          </div>
          <script src="{{ asset('js/apexcharts.js') }}"></script>

          @push('scripts')
          <script>
            let gymIncome = document.getElementById('gymIncome');

            let type = 1;
            let time = $("#gymIncome").data("week");
            let memIncome = $("#gymIncome").data("weeklyMemberIncome")
            let classIncome = $("#gymIncome").data("weeklyClassIncome")

            const options = {
              chart: {
                height: "100%",
                maxWidth: "100%",
                type: "line",
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
                  top: -26
                },
              },
              series: [
                {
                  name: "Membership",
                  data: memIncome,
                  color: "#fcd34d",
                },
                {
                  name: "Class",
                  data: classIncome,
                  color: "#f59e0b",
                },
              ],
              legend: {
                show: false
              },
              stroke: {
                curve: 'smooth'
              },
              xaxis: {
                categories: time,
                labels: {
                  show: false,
                  style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500'
                  }
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
                labels: {
                show: true,
                  style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                  },
                  formatter: function (value) {
                    return Intl.NumberFormat('id-ID', {
                      style: 'currency',
                      currency: 'IDR'
                    }).format(value);
                  }
                }
              },
            }

            if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
              const chart = new ApexCharts(document.getElementById("line-chart"), options);
              chart.render();

              function changeType({ type }) {
                if (type == 1) {
                  time = $("#gymIncome").data("week");
                  memIncome = $("#gymIncome").data("weeklyMemberIncome")
                  classIncome = $("#gymIncome").data("weeklyClassIncome")
                }
                else if (type == 2) {
                  time = $("#gymIncome").data("month");
                  memIncome = $("#gymIncome").data("monthlyMemberIncome");
                  classIncome = $("#gymIncome").data("monthlyClassIncome");
                }
                else {
                  time = $("#gymIncome").data("year");
                  memIncome = $("#gymIncome").data("yearlyMemberIncome");
                  classIncome = $("#gymIncome").data("yearlyClassIncome");
                }

                chart.updateSeries([
                  {
                    data: memIncome
                  },
                  {
                    data: classIncome
                  },
                ])
                chart.updateOptions({
                  xaxis: {
                    categories: time,
                    labels: {
                      show: false,
                      style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500'
                      }
                    },
                    axisBorder: {
                      show: false,
                    },
                    axisTicks: {
                      show: false,
                    },
                  },
                })
              }
            }


          </script>
          @endpush
        @endif

        @endauth

    </div>
</section>
@endsection
