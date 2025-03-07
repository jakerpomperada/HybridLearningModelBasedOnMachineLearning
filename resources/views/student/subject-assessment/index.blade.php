@extends('template.main')

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">List of Subjects</h3>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">

            <div class="card card-table">
                <div class="card-body">

                    <div class="page-header">
                        <div class="row align-items-center">

                            <div class="col-auto text-end">
                                <h4>Quiz Assessment</h4>
                            </div>
                        </div>
                    </div>
                    @include('template.alert')

                    <table class="table table-hover table-center mb-0 table-striped mb-0 text-center">
                        <thead>
                        <tr>
                            <th>Date Start</th>
                            <th>Date End</th>
                            <th>Title</th>

                            <th>Total Items</th>
                            <th>Scores</th>
                            <th>Status</th>

                        </tr>
                        </thead>

                        <tbody>

                        @if(!$has_quiz)
                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-info"><b>No quiz has been added.</b></div>
                                </td>
                            </tr>


                        @else
                            @foreach($quiz_assessments as $quiz)
                                <tr>
                                    <td>{{$quiz->start_date}}</td>
                                    <td>{{$quiz->end_date}}</td>
                                    <td>{{$quiz->title}}</td>
                                    <td>{{$quiz->total_items}}</td>
                                    <td>{{$quiz->scores}}</td>
                                    <td>
                                        @if($quiz->total_items <= 0 )
                                            No Questions Yet.
                                        @elseif(!$quiz->status)
                                            <a href="take-quiz/{{$quiz->id}}?num=0">
                                                Get Quiz
                                            </a>

                                        @else
                                            Done
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                        @endif




                        </tbody>
                    </table>
                </div>
            </div>


        </div>

        <div class="row">

            <div class="card card-table">
                <div class="card-body">

                    <div class="page-header">
                        <div class="row align-items-center">

                            <div class="col-auto text-end">
                                <h4>Exam Assessment</h4>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover table-center mb-0 table-striped mb-0 text-center">
                        <thead>
                        <tr>
                            <th>Date Start</th>
                            <th>Date End</th>
                            <th>Term</th>

                            <th>Total Items</th>
                            <th>Scores</th>
                            <th>Status</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if(!$has_exam)

                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-info"><b>No exam has been added.</b></div>
                                </td>
                            </tr>
                        @else

                            @foreach($exam_assessments as $quiz)
                                <tr>
                                    <td>{{$quiz->start_date}}</td>
                                    <td>{{$quiz->end_date}}</td>
                                    <td>{{$quiz->term}}</td>
                                    <td>{{$quiz->total_items}}</td>
                                    <td>{{$quiz->scores}}</td>
                                    <td>
                                        @if($quiz->status == "not_taken")
                                            <a href="quiz-assessment/take">Take Quiz</a>
                                        @else
                                            Taken
                                        @endif

                                    </td>

                                </tr>

                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>


        </div>


    </div>
@endsection
