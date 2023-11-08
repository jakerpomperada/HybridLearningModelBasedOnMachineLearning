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
    {!! Form::open(['url' => '/teacher/student-quiz-assessment?teaching_load_id=' . $teaching_load_id, 'method' => 'POST']) !!}
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col mb-3">
                    <h3 class="page-title"><i class="fas fa-list"></i> &nbsp Create New Quiz Assessment</h3>
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
        <div class="col-3"></div>
            <div class="col-5">
                @include('template.alert')
                <div class="card">

                    <div class="card-body">
                        <form action="#">

                            <div class="form-group local-forms">
                                <label>Date Start</label>
                                <input type="datetime-local" name="date_start" class="form-control">

                            </div>
                            <div class="form-group local-forms">
                                <label>Date End</label>
                                <input type="datetime-local" name="date_end" class="form-control">
                            </div>
                            <div class="form-group local-forms">
                                <label>Quiz Assessment Title</label>
                                {{Form::text('quiz_assessment_title', null, ['class' => 'form-control'])}}
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>


    </div>
    {!! Form::close() !!}

@endsection

@push('scripts')

@endpush



