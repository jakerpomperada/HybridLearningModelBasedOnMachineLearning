@extends('template.main')

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Welcome {{$student->complete_name}}!</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Course:</h6>
                                <h3>BSIT</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{asset("assets/img/icons/dash-icon-03.svg")}}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Year and Section</h6>
                                <h3>First Year - A</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{asset("assets/img/icons/teacher-icon-02.svg")}}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Total Subject Taken</h6>
                                <h3>5</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{asset("assets/img/icons/student-icon-01.svg")}}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Assignment</h6>
                                <h3>9</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{asset("assets/img/icons/teacher-icon-03.svg")}}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>

        <div class="row">


            <div class="col-md-12 col-lg-6">

                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Comparison of Student Enrollment</h5>
                            </div>
                            <div class="col-6">
                                <ul class="chart-list-out">
                                    <li><span class="circle-green"></span>Current (2023)</li>
                                    <li><span class="circle-blue"></span>Previous (2024)</li>

                                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="bar"></div>
                    </div>
                </div>

            </div>

            <div class="col-md-12 col-lg-6">

                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Subject Performance Index</div>
                                </div>
                                <div class="card-body">
                                    <div class="h-250" id="flotPie2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-xl-6 d-flex">


            </div>

            <!-- Chart -->
            <div class="col-xl-12 d-flex">
                <div class="card flex-fill student-space comman-shadow">
                    <div class="card-header">
                        <h5 class="card-title">Term Grade Summary</h5>
                    </div>
                    <div class="card-body">
                        <div id="s-col-stacked"></div>
                    </div>
                </div>
            </div>
            <!-- /Chart -->


        </div>


    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.fillbetween.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.pie.js')}}"></script>
    {{--    <script src="{{asset("assets/plugins/apexchart/chart-data.js")}}"></script>--}}
    <script>


        // Simple Column Stacked
        if($('#s-col-stacked').length > 0 ){
            var sColStacked = {
                chart: {
                    height: 350,
                    type: 'bar',
                    stacked: true,
                    toolbar: {
                        show: false,
                    }
                },
                // colors: ['#4361ee', '#888ea8', '#e3e4eb', '#d3d3d3'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom',
                            offsetX: -10,
                            offsetY: 0
                        }
                    }
                }],
                plotOptions: {
                    bar: {
                        horizontal: false,
                    },
                },
                series: [{
                    name: 'ITE106',
                    data: [40, 20, 10]
                },{
                        name: 'SA401',
                    data: [30, 20, 35]
                },{
                    name: 'SAI401',
                    data: [20, 30, 20]
                },{
                    name: 'GEE303',
                    data: [10, 25, 35]
                }],
                xaxis: {
                    type: 'text',
                    categories: ['Prelim', 'Midterm', 'Final', ],
                },
                legend: {
                    position: 'right',
                    offsetY: 40
                },
                fill: {
                    opacity: 1
                },
            }

            var chart = new ApexCharts(
                document.querySelector("#s-col-stacked"),
                sColStacked
            );

            chart.render();
        }




        const piedata = [{
            label: 'First Year',
            data: [
                [1, 10]
            ],
            color: '#664dc9'
        }, {
            label: 'Second Year',
            data: [
                [1, 50]
            ],
            color: '#44c4fa'
        }, {
            label: 'Third Year',
            data: [
                [1, 30]
            ],
            color: '#38cb89'
        }, {
            label: 'Fourth Year',
            data: [
                [1, 30]
            ],
            color: '#ef4b4b'
        }
        ];

        $.plot('#flotPie2', piedata, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    innerRadius: 0.5,
                    label: {
                        show: true,
                        radius: 2 / 3,
                        formatter: labelFormatter,
                        threshold: 0.1
                    }
                }
            },
            grid: {
                hoverable: false,
                clickable: true
            }
        });

        function labelFormatter(label, series) {
            return '<div style="font-size:8pt; text-align:center; padding:2px; color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
        }


        if ($('#bar').length > 0) {
            var optionsBar = {
                chart: {
                    type: 'bar',
                    height: 350,
                    width: '100%',
                    stacked: false,
                    toolbar: {
                        show: false
                    },
                },
                dataLabels: {
                    enabled: false
                },
                plotOptions: {
                    bar: {
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: [{
                    name: "Previous (2022)",
                    color: '#70C4CF',
                    data: [420, 532, 516, 575],
                }, {
                    name: "Current (2023)",
                    color: '#3D5EE1',
                    data: [336, 612, 344, 647],
                }],
                labels: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020],
                xaxis: {
                    labels: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: '#777'
                        }
                    }
                },
                title: {
                    text: '',
                    align: 'left',
                    style: {
                        fontSize: '18px'
                    }
                }

            }

            var chartBar = new ApexCharts(document.querySelector('#bar'), optionsBar);
            chartBar.render();
        }


    </script>
@endpush
