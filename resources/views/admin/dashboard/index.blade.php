@extends('template.main')

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Welcome Admin!</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Current Term: {{$term}}</h3>
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
                                <h6>Number of Students</h6>
                                <h3>{{$data->number_of_students}}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{asset("assets/img/icons/dash-icon-01.svg")}}" alt="Dashboard Icon">
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
                                <h6>Number of Teachers </h6>
                                <h3>{{$data->number_of_teachers}}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{asset("assets/img/icons/dash-icon-02.svg")}}" alt="Dashboard Icon">
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
                                <h6>Total Courses</h6>
                                <h3>{{$data->total_course}}</h3>
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
                                <h6>Total Subjects</h6>
                                <h3>{{$data->total_subjects}}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{asset("assets/img/icons/teacher-icon-02.svg")}}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card card-chart">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title">Retention Annual Forecast</h5>
                        </div>
                        <div class="col-6">
                            <ul class="chart-list-out">
                                <li><span class="circle-blue"></span>Teacher</li>
                                <li><span class="circle-green"></span>Student</li>
                                <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li></ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="apexcharts-area"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-6">

                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Number of Enrolled Students</div>
                                </div>
                                <div class="card-body">
                                    <div class="h-250" id="flotPie2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-12 col-lg-6">

                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Enrollment Prediction By School Year</h5>
                            </div>
                            <div class="col-6">
                                <ul class="chart-list-out">
                                    <li><span class="circle-green"></span>Current S.Y (2023)</li>
                                    <li><span class="circle-blue"></span>Next S.Y (2024)</li>

                                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="bar"></div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.fillbetween.js')}}"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.pie.js')}}"></script>
{{--    <script src="{{asset("assets/plugins/apexchart/chart-data.js")}}"></script>--}}
    <script>



        if ($('#apexcharts-area').length > 0) {
            var options = {
                chart: {
                    height: 350,
                    type: "line",
                    toolbar: {
                        show: false
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: "smooth"
                },
                series: [{
                    name: "Teachers",
                    color: '#3D5EE1',
                    data: [45, 60, 75, 51, 42, 42, 75]
                }, {
                    name: "Students",
                    color: '#70C4CF',
                    data: [24, 48, 56, 32, 34, 52, 65]
                }],
                xaxis: {
                    categories: ['2022', '2023', '2024', '2025', '2026', '2027', '2028'],
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#apexcharts-area"),
                options
            );
            chart.render();
        }


        const piedata = [{
            label: 'First Year',
            data: [
                [1, {{$data->admission->firstYear}}]
            ],
            color: '#664dc9'
        }, {
            label: 'Second Year',
            data: [
                [1, {{$data->admission->secondYear}}]
            ],
            color: '#44c4fa'
        }, {
            label: 'Third Year',
            data: [
                [1, {{$data->admission->thirdYear}}]
            ],
            color: '#38cb89'
        }, {
            label: 'Fourth Year',
            data: [
                [1, {{$data->admission->fourthYear}}]
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
