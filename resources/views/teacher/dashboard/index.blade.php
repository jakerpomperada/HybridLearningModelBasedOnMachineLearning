@extends('template.main')

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Welcome Teacher!</h3>
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
                                <h6>Total Students</h6>
                                <h3>73</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{asset('assets/img/icons/dash-icon-01.svg')}}" alt="Dashboard Icon">
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
                                <h6>Total Subject Load</h6>
                                <h3>3</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{asset('assets/img/icons/teacher-icon-02.svg')}}" alt="Dashboard Icon">
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
                                <h6>Total Level Handle</h6>
                                <h3>3</h3>
                            </div>
                            <div class="db-icon">
                                <img src=" {{asset('assets/img/icons/dash-icon-03.svg')}}" alt="Dashboard Icon">
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
                                <h6>Total Section Handled</h6>
                                <h3>8</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{asset('assets/img/icons/student-icon-01.svg')}}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Chart -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Quiz Performance Forecast</h5>
                    </div>
                    <div class="card-body">
                        <div id="s-line"></div>
                    </div>
                </div>
            </div>
            <!-- /Chart -->
            <div class="col-md-12 col-lg-6">

                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Socio Economic Status : Student has Mobile Phones?</div>
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

                <div class="card flex-fill student-space comman-shadow">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title">Top Students</h5>
                        <ul class="chart-list-out student-ellips">
                            <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table star-student table-hover table-center table-borderless table-striped">
                                <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th class="text-center">Marks</th>
                                    <th class="text-center">Percentage</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-nowrap">
                                        <div>PRE2209</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="profile.html">
                                            <img class="rounded-circle" src="{{asset("assets/img/profiles/avatar-02.jpg")}}" width="25" alt="Star Students">
                                            John Smith
                                        </a>
                                    </td>
                                    <td class="text-center">1185</td>
                                    <td class="text-center">98%</td>

                                </tr>
                                <tr>
                                    <td class="text-nowrap">
                                        <div>PRE1245</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="profile.html">
                                            <img class="rounded-circle" src="{{asset("assets/img/profiles/avatar-01.jpg")}}" width="25" alt="Star Students">
                                            Jolie Hoskins
                                        </a>
                                    </td>
                                    <td class="text-center">1195</td>
                                    <td class="text-center">99.5%</td>

                                </tr>
                                <tr>
                                    <td class="text-nowrap">
                                        <div>PRE1625</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="profile.html">
                                            <img class="rounded-circle" src="{{asset("assets/img/profiles/avatar-03.jpg")}}" width="25" alt="Star Students">
                                            Pennington Joy
                                        </a>
                                    </td>
                                    <td class="text-center">1196</td>
                                    <td class="text-center">99.6%</td>

                                </tr>
                                <tr>
                                    <td class="text-nowrap">
                                        <div>PRE2516</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="profile.html">
                                            <img class="rounded-circle" src="{{asset("assets/img/profiles/avatar-04.jpg")}}" width="25" alt="Star Students">
                                            Millie Marsden
                                        </a>
                                    </td>
                                    <td class="text-center">1187</td>
                                    <td class="text-center">98.2%</td>

                                </tr>
                                <tr>
                                    <td class="text-nowrap">
                                        <div>PRE2209</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="profile.html">
                                            <img class="rounded-circle" src="{{asset("assets/img/profiles/avatar-05.jpg")}}" width="25" alt="Star Students">
                                            John Smith
                                        </a>
                                    </td>
                                    <td class="text-center">1185</td>
                                    <td class="text-center">98%</td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">



                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Gender-Based Exam Performance Analysis</h5>
                            </div>
                            <div class="col-6">
                                <ul class="chart-list-out">
                                    <li><span class="circle-green"></span>Male</li>
                                    <li><span class="circle-blue"></span>Female</li>

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



        // Simple Line

        if($('#s-line').length > 0 ){
            var sline = {
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false,
                    }
                },
                // colors: ['#4361ee'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                series: [{
                    name: "Average Scores",
                    data: [10, 41, 35, 51, 38, 62, 69, 91, 90]
                }],
                title: {
                    text: 'Quiz Outcome Predictions',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f1f2f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: ['Quiz 1', 'Quiz 2', 'Quiz 3', 'Quiz 4', 'Quiz 5', 'Quiz 6', 'Quiz 7', 'Quiz 8', 'Quiz 9'],
                }
            }

            var chart = new ApexCharts(
                document.querySelector("#s-line"),
                sline
            );

            chart.render();
        }




        const piedata = [ {
            label: 'Yes',
            data: [
                [1, 30]
            ],
            color: '#38cb89'
        }, {
            label: 'No',
            data: [
                [1, 6]
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
                    name: "Male",
                    color: '#70C4CF',
                    data: [55, 50, 75, 65],
                }, {
                    name: "Female",
                    color: '#3D5EE1',
                    data: [49, 60, 50, 55],
                }],
                labels: ['First Year', 'Second Year', 'Third Year', 'Fourth Year'],
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
