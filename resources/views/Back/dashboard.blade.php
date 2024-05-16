@extends('back.layouts.master')
@section('content')
    <script src="{{URL::asset('Back/assets/js/apxCharts.js')}}"></script>
    <script>
        // Replace Math.random() with a pseudo-random number generator to get reproducible results in e2e tests
        // Based on https://gist.github.com/blixt/f17b47c62508be59987b
        var _seed = 42;
        Math.random = function() {
            _seed = _seed * 16807 % 2147483647;
            return (_seed - 1) / 2147483646;
        };
    </script>

    <script>
        var colors = [
            '#008FFB',
            '#00E396',
            '#FEB019',
            '#FF4560',
            '#775DD0',
            '#546E7A',
            '#26a69a',
            '#D10CE8',
            '#008FFB',
            '#00E396',
            '#FEB019',
            '#FF4560',
            '#775DD0',
            '#546E7A',
            '#26a69a',
            '#D10CE8',
        ]
    </script>
    <div class="container-fluid">

     <div class="shadow py-2 mb-2 bg-white">
            <h1 class="h3 mb-2  ml-4 text-gray-800"><a href="{{ route('back.dashboard') }}"
                    class="text-gray-800">Dashboard </a></h1>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Number Of Orders</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 counter text-center">{{ $orderCount }}
                                </div>
                            </div>
                            <div class="col-auto ">
                                <i class="fa-solid fa-bag-shopping fa-2x text-primary "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Number Of Products</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 counter text-center">{{ $productCount }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-shield-heart fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Number Of Brands
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-2"></div>
                                    <div class="col-10">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-dark counter text-center">
                                            {{ $brandCount }}</div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-sheet-plastic fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Number Of Categories</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 counter text-center">{{ $categoryCount }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-shield-heart fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4" style="border-radius:0px;">
                    <div class="card-header" style="background-color:#FFD333 !important;border-radius:0px;">
                        <i class="fas fa-chart-area me-1"></i>
                        Number Of Orders For Each Product
                    </div>

                    <div class="card-body">
                        <div id="chart" style="width:100%;max-width:700px"></div>

                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4" style="border-radius:0px;height: 485px !important;">
                    <div class="card-header" style="background-color:#FFD333 !important;border-radius:0px;">
                        <i class="fas fa-chart-area me-1 text-capitalize"></i>
                        Number Of Products For Each Category
                    </div>
                    <div id="chart2"></div>

                    <div class="card-body">

                    </div>
                </div>
            </div>

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var orderCount = <?php echo json_encode($orderCountsForEachProduct); ?>;
        var productName = Object.keys(orderCount);
        var orderNumbers = Object.values(orderCount);
        var options = {
            series: [{
                data:orderNumbers
            }],
            chart: {
                type: 'bar',
                height: 380
            },
            plotOptions: {
                bar: {
                    barHeight: '100%',
                    distributed: true,
                    horizontal: true,
                    dataLabels: {
                        position: 'bottom'
                    },
                }
            },
            colors: ['#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e',
                '#f48024', '#69d2e7'
            ],
            dataLabels: {
                enabled: true,
                textAnchor: 'start',
                style: {
                    colors: ['#fff']
                },
                formatter: function(val, opt) {
                    return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                },
                offsetX: 0,
                dropShadow: {
                    enabled: true
                }
            },
            stroke: {
                width: 1,
                colors: ['#fff']
            },
            xaxis: {
                categories: productName,
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            title: {
                text: 'Order/product',
                align: 'center',
                floating: true
            },
            subtitle: {
                text: 'Number of orders for each product',
                align: 'center',
            },
            tooltip: {
                theme: 'dark',
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function() {
                            return ''
                        }
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>

    <script>
        var productCounts = <?php echo json_encode($productCounts); ?>;
        var categories = Object.keys(productCounts);
        var productNumbers = Object.values(productCounts);
        var options = {
            series: [{
                data: productNumbers
            }],
            chart: {
                height: 350,
                type: 'bar',
                events: {
                    click: function(chart, w, e) {
                        // console.log(chart, w, e)
                    }
                }
            },
            colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            xaxis: {
                categories: categories,
                labels: {
                    style: {
                        colors: colors,
                        fontSize: '12px'
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();
    </script>






    <!-- To Counter Up the Nbrs in the cards -->
    <script>
        $(document).ready(function() {

            $('.counter').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });

        });
    </script>
@endsection
