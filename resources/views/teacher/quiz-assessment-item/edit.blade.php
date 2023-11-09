@extends('template.main')
@section('content')
    {!! Form::open(['url' => '/teacher/student-quiz-assessment-items/'.$assessment->id.'?qacategory_id='.$qacategory_id, 'method' => 'PUT']) !!}
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col mb-3">
                    <h3 class="page-title"><i class="fas fa-question"></i> &nbsp Update Quiz Question</h3>
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
                                    {!! Form::textarea('title', $assessment->title, [
                                    'class'      => 'form-control',
                                    'rows'       => 1,
                                    ]) !!}

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
                           @foreach ($assessment->choices as $choice):
                            <tr>
                                <td>{{$choice->letter}}</td>
                                <td>
                                    {{Form::text('choices['.$choice->order.']', $choice->choice, ['class' => 'form-control'])}}
                                </td>
                                <td>
                                    <input type="radio" name="answer" {{$choice->is_correct ? "checked='checked'" : null}}" value="{{$choice->order}}" />
{{--                                    {{Form::radio('answer',$choice->order,['class'=>'form-control'])}}--}}
                                </td>
                            </tr>
                           @endforeach
                            </tbody>

                        </table>

                    </div>
                    <div style="margin-left:auto; margin-right: auto;">

                        <button class="btn btn-dark">
                            <i class="fas fa-pencil-alt"></i> &nbsp;
                            Update Question
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



