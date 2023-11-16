@extends('template.main')
@section('content')
    {!! Form::open(['url' => '/student/take-quiz', 'method' => 'POST']) !!}
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Question:</label>
                                    {!! Form::textarea('title', $question->question, [
                                    'class'      => 'form-control',
                                    'cols'       => 5,
                                    'disabled' => true
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
                                <th>Answer</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($question->choices as $choice):
                                <tr>
                                    <td>{{$choice->letter}}</td>
                                    <td>
                                        {{Form::text('choices['.$choice->id.']', $choice->choice, ['class' => 'form-control', 'disabled' => true])}}
                                    </td>
                                    <td>
                                        {{Form::radio('answer',$choice->id,['class'=>'form-control'])}}
                                    </td>
                                </tr>
                            @endforeach

                            <input type="hidden" name="current_num" value="{{$num}}"/>
                            <input type="hidden" name="teaching_load_id" value="{{$teaching_load_id}}"/>
                            <input type="hidden" name="quiz_category_id" value="{{$quiz_category_id}}"/>
                            <input type="hidden" name="question_id" value="{{$question->id}}">

                            </tbody>

                        </table>

                    </div>
                    <div style="margin-left:auto; margin-right: auto;">

                        <button class="btn btn-dark">
                            <i class="fas fa-arrow-right"></i> &nbsp;
                            Save and Proceed to Next Question
                        </button>
                    </div>

                </div>
            </div>

        </div>


    </div>
    {!! Form::close() !!}

@endsection

@push('scripts')

@endpush



