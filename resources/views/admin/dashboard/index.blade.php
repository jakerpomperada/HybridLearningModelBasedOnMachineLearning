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
                                <h3>78</h3>
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
                                <h3>9</h3>
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
                                <h3>5</h3>
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
                                <h3>13</h3>
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
{{--            <div class="col-md-12 col-lg-6">--}}
{{--                <div class="card card-chart">--}}
{{--                    <div class="card-header">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col-6">--}}
{{--                                <h5 class="card-title">Overview</h5>--}}
{{--                            </div>--}}
{{--                            <div class="col-6">--}}
{{--                                <ul class="chart-list-out">--}}
{{--                                    <li><span class="circle-blue"></span>Teacher</li>--}}
{{--                                    <li><span class="circle-green"></span>Student</li>--}}
{{--                                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div id="apexcharts-area"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}

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
        <div class="row">
            <div class="col-xl-6 d-flex">

                <div class="card flex-fill student-space comman-shadow">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title">Star Students</h5>
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
                                    <th class="text-end">Year</th>
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
                                    <td class="text-end">
                                        <div>2019</div>
                                    </td>
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
                                    <td class="text-end">
                                        <div>2018</div>
                                    </td>
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
                                    <td class="text-end">
                                        <div>2017</div>
                                    </td>
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
                                    <td class="text-end">
                                        <div>2016</div>
                                    </td>
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
                                    <td class="text-end">
                                        <div>2015</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 d-flex">
                <div class="card flex-fill comman-shadow">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title ">Student Activity </h5>
                        <ul class="chart-list-out student-ellips">
                            <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="activity-groups">
                            <div class="activity-awards">
                                <div class="award-boxs">
                                    <img src="{{asset("assets/img/icons/award-icon-01.svg")}}" alt="Award">
                                </div>
                                <div class="award-list-outs">
                                    <h4>1st place in "Chess”</h4>
                                    <h5>John Doe won 1st place in "Chess"</h5>
                                </div>
                                <div class="award-time-list">
                                    <span>1 Day ago</span>
                                </div>
                            </div>
                            <div class="activity-awards">
                                <div class="award-boxs">
                                    <img src="{{asset("assets/img/icons/award-icon-02.svg")}}" alt="Award">
                                </div>
                                <div class="award-list-outs">
                                    <h4>Participated in "Carrom"</h4>
                                    <h5>Justin Lee participated in "Carrom"</h5>
                                </div>
                                <div class="award-time-list">
                                    <span>2 hours ago</span>
                                </div>
                            </div>
                            <div class="activity-awards">
                                <div class="award-boxs">
                                    <img src="{{asset("assets/img/icons/award-icon-03.svg")}}" alt="Award">
                                </div>
                                <div class="award-list-outs">
                                    <h4>Internation conference in "St.John School"</h4>
                                    <h5>Justin Leeattended internation conference in "St.John School"</h5>
                                </div>
                                <div class="award-time-list">
                                    <span>2 Week ago</span>
                                </div>
                            </div>
                            <div class="activity-awards mb-0">
                                <div class="award-boxs">
                                    <img src="{{asset("assets/img/icons/award-icon-04.svg")}}" alt="Award">
                                </div>
                                <div class="award-list-outs">
                                    <h4>Won 1st place in "Chess"</h4>
                                    <h5>John Doe won 1st place in "Chess"</h5>
                                </div>
                                <div class="award-time-list">
                                    <span>3 Day ago</span>
                                </div>
                            </div>
                        </div>
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
