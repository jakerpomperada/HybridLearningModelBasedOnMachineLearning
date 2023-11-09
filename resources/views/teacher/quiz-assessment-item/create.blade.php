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
    {!! Form::open(['url' => '/teacher/student-quiz-assessment-items?qacategory_id='.$qacategory_id, 'method' => 'POST']) !!}
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col mb-3">
                    <h3 class="page-title"><i class="fas fa-question"></i> &nbsp Create New Quiz Question</h3>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-sm-12">
                @include('template.alert')
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Question:</label>
                                    {{Form::text('title', null, ['class' => 'form-control'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-9">
                <div class="card card-table">
                    <div class="card-body">
                        <table class="table table-hover table-center mb-0 table-striped mb-0 text-center">
                            <thead>
                            <tr>
                                <th>Letter</th>
                                <th>Choices</th>
                                <th>Correct?</th>
                            </tr>
                            </thead>
                            <tbody>
                           @foreach ($choices as $i => $choice):
                            <tr>
                                <td>{{$choice}}</td>
                                <td>
                                    {{Form::text('choices['.$i.']', null, ['class' => 'form-control'])}}
                                </td>
                                <td>
                                    {{Form::radio('answer',$i,['class'=>'form-control'])}}
                                </td>
                            </tr>
                           @endforeach
                            </tbody>

                        </table>

                    </div>
                    <div style="margin-left:auto; margin-right: auto;">

                        <button class="btn btn-dark">
                            <i class="fas fa-holly-berry"></i> &nbsp;
                            Save Question
                        </button>
                    </div>
{{--                    <button class="btn btn-dark"></button>--}}

                </div>
            </div>

        </div>


    </div>
    {!! Form::close() !!}

@endsection

@push('scripts')

@endpush



