<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <x-slot name="vendorJs">
        <!-- Vendors JS -->
        <script src="{{ asset('admin/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    </x-slot>
    
    <x-slot name="pageJs">
        <!-- Page JS -->
        {{-- <script src="{{ asset('admin/assets/js/dashboards-analytics.js')}}"></script> --}}
        <script>

          'use strict';

          (function () {
            let cardColor, headingColor, axisColor, shadeColor, borderColor;

            cardColor = config.colors.white;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;
            // Order Statistics Chart
            // --------------------------------------------------------------------
            const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
              orderChartConfig = {
                chart: {
                  height: 165,
                  width: 130,
                  type: 'donut'
                },
                labels: {!! productosVendidosPorNombreArrayMesActual() !!},
                series: {!! productosVendidosPorCantidadArrayMesActual() !!},
                colors: [config.colors.primary, config.colors.secondary, config.colors.info, config.colors.success],
                stroke: {
                  width: 5,
                  colors: cardColor
                },
                dataLabels: {
                  enabled: false,
                  formatter: function (val, opt) {
                    return parseInt(val) + '%';
                  }
                },
                legend: {
                  show: false
                },
                grid: {
                  padding: {
                    top: 0,
                    bottom: 0,
                    right: 15
                  }
                },
                plotOptions: {
                  pie: {
                    donut: {
                      size: '75%',
                      labels: {
                        show: true,
                        value: {
                          fontSize: '1.5rem',
                          fontFamily: 'Public Sans',
                          color: headingColor,
                          offsetY: -15,
                          formatter: function (val) {
                            return parseInt(val) + '%';
                          }
                        },
                        name: {
                          offsetY: 20,
                          fontFamily: 'Public Sans'
                        },
                        total: {
                          show: true,
                          fontSize: '0.8125rem',
                          color: axisColor,
                          label: 'Productos',
                          formatter: function (w) {
                            return '{{ productosVendidosPorNombreConteoMesActual() }}';
                          }
                        }
                      }
                    }
                  }
                }
              };
            if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
              const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
              statisticsChart.render();
            }

            // Income Chart - Area chart
            // --------------------------------------------------------------------
            const incomeChartEl = document.querySelector('#incomeChart'),
              incomeChartConfig = {
                series: [
                  {
                    data: {{ ordenesPorMesAnoActual() }}
                  }
                ],
                chart: {
                  height: 215,
                  parentHeightOffset: 0,
                  parentWidthOffset: 0,
                  toolbar: {
                    show: false
                  },
                  type: 'area'
                },
                dataLabels: {
                  enabled: false
                },
                stroke: {
                  width: 2,
                  curve: 'smooth'
                },
                legend: {
                  show: false
                },
                markers: {
                  size: 6,
                  colors: 'transparent',
                  strokeColors: 'transparent',
                  strokeWidth: 4,
                  discrete: [
                    {
                      fillColor: config.colors.white,
                      seriesIndex: 0,
                      dataPointIndex: 7,
                      strokeColor: config.colors.primary,
                      strokeWidth: 2,
                      size: 6,
                      radius: 8
                    }
                  ],
                  hover: {
                    size: 7
                  }
                },
                colors: [config.colors.primary],
                fill: {
                  type: 'gradient',
                  gradient: {
                    shade: shadeColor,
                    shadeIntensity: 0.6,
                    opacityFrom: 0.5,
                    opacityTo: 0.25,
                    // stops: [0, 95, 100]
                  }
                },
                grid: {
                  borderColor: borderColor,
                  strokeDashArray: 3,
                  padding: {
                    top: -20,
                    bottom: -8,
                    left: 10,
                    right: 8
                  }
                },
                xaxis: {
                  categories: {!! mesesHastaHoyArray() !!},
                  axisBorder: {
                    show: false
                  },
                  axisTicks: {
                    show: false
                  },
                  labels: {
                    show: true,
                    style: {
                      fontSize: '13px',
                      colors: axisColor
                    }
                  }
                },
                yaxis: {
                  labels: {
                    show: false
                  },
                  // min: 10,
                  // max: 50,
                  tickAmount: 4
                }
              };
            if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
              const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
              incomeChart.render();
            }
          })();
        </script>
    </x-slot>

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <div class="col-lg-8 mb-4 order-0">
            <div class="row">
              <div class="col">

                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-12">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Bienvenido {{ Str::title(auth()->user()->name) }}! 🎉</h5>
                          <p class="mb-4">
                            Se han realizado {{ ordenesMesActual()->count() }} ordenes en el mes en curso
                          </p>
      
                          <a class="btn btn-sm btn-outline-primary" href="{{ route('ordenes') }}">Ver Órdenes</a>
                        </div>
                      </div>
                      {{-- <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src=""
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img=""
                            data-app-light-img=""
                          />
                        </div>
                      </div> --}}
                    </div>
                  </div>

              </div>
            </div>
            
          </div>
          <div class="col-md-12 col-lg-4 order-1">
            <div class="row">
              <div class="col-md-6 mb-4 d-flex">
                <div class="card w-100">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img
                          src="{{ asset('admin/assets/img/icons/unicons/chart-success.png')}}"
                          alt="chart success"
                          class="rounded"
                        />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt3"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                          <a class="dropdown-item" href="javascript:void(0);">View More</a>
                          <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Facturado</span>
                    <h4 class="card-title mb-2">${{ ordenesTotalMesActual() }}</h4>
                    {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-4 d-flex">
                <div class="card w-100">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img
                          src="{{ asset('admin/assets/img/icons/unicons/wallet-info.png')}}"
                          alt="Credit Card"
                          class="rounded"
                        />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt6"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                          <a class="dropdown-item" href="javascript:void(0);">View More</a>
                          <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                      </div>
                    </div>
                    <span>Ventas</span>
                    <h4 class="card-title text-nowrap mb-1">{{ ordenesMesActual()->count() }}</h4>
                    {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="row">
          <!-- Order Statistics -->
          <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4 d-flex">
            <div class="card h-100">
              <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                  <h5 class="m-0 me-2">Ventas</h5>
                  <small class="text-muted">{{ productosVendidosMesActual()->count() }} Total Ventas</small>
                </div>
                <div class="dropdown">
                  {{-- <button
                    class="btn p-0"
                    type="button"
                    id="orederStatistics"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button> --}}
                  {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                  </div> --}}
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div class="d-flex flex-column align-items-center gap-1">
                    <h2 class="mb-2">{{ productosVendidosMesActual()->count() }}</h2>
                    <span>Total Ventas</span>
                  </div>
                  <div id="orderStatisticsChart"></div>
                </div>
                <ul class="p-0 m-0">
                  @foreach(productosVendidosPorNombreMesActual() as $grupo)
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-primary"
                          ><i class="bx bx-mobile-alt"></i
                        ></span>
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <h6 class="mb-0">{{ $grupo->nombre }}</h6>
                          <small class="text-muted">Mobile, Earbuds, TV</small>
                        </div>
                        <div class="user-progress">
                          <small class="fw-semibold">{{ $grupo->conteo }}</small>
                        </div>
                      </div>
                    </li>
                  @endforeach
                  {{-- Otros Items --}}
                  {{-- <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <h6 class="mb-0">Fashion</h6>
                        <small class="text-muted">T-shirt, Jeans, Shoes</small>
                      </div>
                      <div class="user-progress">
                        <small class="fw-semibold">23.8k</small>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <h6 class="mb-0">Decor</h6>
                        <small class="text-muted">Fine Art, Dining</small>
                      </div>
                      <div class="user-progress">
                        <small class="fw-semibold">849k</small>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-secondary"
                        ><i class="bx bx-football"></i
                      ></span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <h6 class="mb-0">Sports</h6>
                        <small class="text-muted">Football, Cricket Kit</small>
                      </div>
                      <div class="user-progress">
                        <small class="fw-semibold">99</small>
                      </div>
                    </div>
                  </li> --}}
                </ul>
              </div>
            </div>
          </div>
          <!--/ Order Statistics -->

          <!-- Expense Overview -->
          <div class="col-md-6 col-lg-4 order-1 mb-4">
            <div class="card h-100">
              <div class="card-header">
                <ul class="nav nav-pills" role="tablist">
                  <li class="nav-item">
                    <button
                      type="button"
                      class="nav-link active"
                      role="tab"
                      data-bs-toggle="tab"
                      data-bs-target="#navs-tabs-line-card-income"
                      aria-controls="navs-tabs-line-card-income"
                      aria-selected="true"
                    >
                      Año actual
                    </button>
                  </li>
                  {{-- <li class="nav-item">
                    <button type="button" class="nav-link" role="tab">Expenses</button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab">Profit</button>
                  </li> --}}
                </ul>
              </div>
              <div class="card-body px-0">
                <div class="tab-content p-0">
                  <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                    <div class="d-flex p-4 pt-3">
                      <div class="avatar flex-shrink-0 me-3">
                        <img src="{{ asset('admin/assets/img/icons/unicons/wallet.png')}}" alt="User" />
                      </div>
                      <div>
                        <small class="text-muted d-block">Total Año Actual</small>
                        <div class="d-flex align-items-center">
                          <h6 class="mb-0 me-1">${{ totalOrdenesAnoActual() }}</h6>
                          {{-- <small class="text-success fw-semibold">
                            <i class="bx bx-chevron-up"></i>
                            42.9%
                          </small> --}}
                        </div>
                      </div>
                    </div>
                    <div id="incomeChart"></div>
                    {{-- <div class="d-flex justify-content-center pt-4 gap-2">
                      <div class="flex-shrink-0">
                        <div id="expensesOfWeek"></div>
                      </div>
                      <div>
                        <p class="mb-n1 mt-1">Expenses This Week</p>
                        <small class="text-muted">$39 less than last week</small>
                      </div>
                    </div> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--/ Expense Overview -->

          <!-- Transactions -->
          <div class="col-md-6 col-lg-4 order-2 mb-4">
            <div class="card h-100">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Operaciones</h5>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="transactionID"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                  </div> --}}
                </div>
              </div>
              <div class="card-body">
                <ul class="p-0 m-0">
                  @foreach(ultimasOperaciones() as $operacion)
                    <li class="d-flex mb-4 pb-1">
                      <div class="avatar flex-shrink-0 me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                          <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                          <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                          <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                        </svg>
                      </div>
                      <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                          <small class="text-muted d-block mb-1">{{ Str::title($operacion->nombreCompleto()) }}</small>
                          <h6 class="mb-0">{{ $operacion->estatus() }}</h6>
                        </div>
                        <div class="user-progress d-flex align-items-center gap-1">
                          <span class="text-muted">$</span>
                          <h6 class="mb-0">{{ number_format($operacion->precioConImpuesto() , 2) }}</h6>
                        </div>
                      </div>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          <!--/ Transactions -->
        </div>
      </div>
      <!-- / Content -->
</x-app-layout>
