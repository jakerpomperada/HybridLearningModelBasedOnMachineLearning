@extends('template.main')

@push('styles')

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css"/>
    <style>
        .ui-datepicker-calendar {
            display: none;
        }

        .ui-datepicker-month {
            display: none;
        }
    </style>
@endpush
@section('content')
    {!! Form::open(['url' => '/teacher/student-attendance/update?teaching_load_id=' . $teaching_load_id.'&date='.$date, 'method' => 'PUT']) !!}
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Update Student Attendance </h3>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-4">
                    <h3 class="page-title">Subject: lakjdf</h3>
                </div>
                <div class="col-4">
                    <h3 class="page-title">Year: lakjdf</h3>
                </div>
                <div class="col-4">
                    <h3 class="page-title">Section: lakjdf</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm">
                                <form class="needs-validation" method="GET" novalidate="">
                                    <div class="input-group input-group-sm">

                                        <div class="input-group">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4">
                                                {!! Form::date('date', $date, ['class' => 'form-control']); !!}
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="card card-table">
                <div class="card-body">
                    <table class="table table-hover table-center mb-0 table-striped mb-0 text-center">
                        <thead>
                        <tr>
                            <th>ID Number</th>
                            <th>Student Name</th>
                            <th class="col-1">Present</th>
                            <th class="col-1">Absent</th>
                            <th class="col-1">Excuse</th>
                            <th>Note</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <input id="attendance_date" type="hidden" name="status[{{$student->admission_id}}]['date]"  value="{{now()}}">
                            <tr>
                                <td>{{$student->id_number}}</td>
                                <td>{{$student->complete_name}}</td>
                                <td><input {{$student->attendance->isChecked('present')}} name="status[{{$student->admission_id}}][attendance]" required type="radio" value="present"></td>
                                <td><input {{$student->attendance->isChecked('absent')}} name="status[{{$student->admission_id}}][attendance]" required type="radio" value="absent"></td>
                                <td><input {{$student->attendance->isChecked('excuse')}} name="status[{{$student->admission_id}}][attendance]" required type="radio" value="excuse"></td>
                                <td><input  name="status[{{$student->admission_id}}][note]" class="form-control" type="text" value="{{$student->attendance->note}}"></td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>
                <div style="margin-left:auto; margin-right: auto;">
                    {{Form::submit('Update',['class' => 'btn btn-info'])}}
                </div>

            </div>
        </div>


    </div>
    {!! Form::close() !!}

@endsection

@push('scripts')

@endpush



