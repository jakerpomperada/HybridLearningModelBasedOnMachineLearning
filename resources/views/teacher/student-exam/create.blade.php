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
    {!! Form::open(['url' => '/teacher/student-exam?teaching_load_id=' . $teaching_load_id, 'method' => 'POST']) !!}
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col mb-3">
                    <h3 class="page-title"><i class="fas fa-list"></i> &nbsp Record New Student Exams</h3>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-4">
                    <h3 class="page-title">Subject: {{$load->subject}}</h3>
                </div>
                <div class="col-4">
                    <h3 class="page-title">Year: {{$load->year}}</h3>
                </div>
                <div class="col-4">
                    <h3 class="page-title">Section: {{$load->section}}</h3>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-12">
                @include('template.alert')
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date:</label>
                                    {{Form::date('date', null, ['class' => 'form-control'])}}
                                </div>

                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Exam Title:</label>
                                            {{Form::text('title', null, ['class' => 'form-control'])}}
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Total Points:</label>
                                            {{Form::number('points', 100, ['class' => 'form-control'])}}
                                        </div>
                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-7">
                <div class="card card-table">
                    <div class="card-body">
                        <table class="table table-hover table-center mb-0 table-striped mb-0 text-center">
                            <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Student Name</th>

                                <th>Score</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)

                                <tr>
                                    <td>{{$student->id_number}}</td>
                                    <td>{{$student->complete_name}}</td>

                                    <td width="150px">
                                    {{Form::number("scores[$student->admission_id]", null, ['class' => 'form-control'])}}
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>
                    <div style="margin-left:auto; margin-right: auto;">
                        {{Form::submit('Save Exam',['class' => 'btn btn-success'])}}
                    </div>

                </div>
            </div>

        </div>


    </div>
    {!! Form::close() !!}

@endsection

@push('scripts')

@endpush



