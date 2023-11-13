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

        <div class="row">

            @foreach($subjects as $subject)
            <div class="col-12 col-md-6 col-lg-4 d-flex">
                <div class="card flex-fill bg-white">
                    <img alt="Card Image" src="{{asset('assets/img/student-subject.jpg')}}" class="card-img-top">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{$subject->subject_code}} ({{$subject->subject_description}})</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="/student/assessment?term-subject-id={{$subject->id}}">Quizzes and Exams Assesstments</a></li>
                        <li class="list-group-item"><a href="/student/subjects-scores?term-subject-id={{$subject->id}}">Academic Scores</a></li>

                    </ul>
                </div>
            </div>
            @endforeach


        </div>


    </div>
@endsection
