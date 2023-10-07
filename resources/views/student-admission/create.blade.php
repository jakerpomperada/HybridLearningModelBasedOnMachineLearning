

@extends('template.main')
@section('content')

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add New Student Admission</h3>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-sm-2"></div>
            <div class="col-xl-5 col-sm-12 d-flex">
                <div class="card flex-fill">

                    <div class="card-body">
                        {!! Form::open(['url' => '/student-admission', 'method' => 'POST']) !!}
                        @include('template.alert')
                        <br/>
                        <div class="form-group row">
                            {!! Form::label('academic_term', 'Academic Term:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::select('academic_term',$terms, null, ['placeholder' => '-- Select Academic Term --', 'class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('semester', 'Semester:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::select('semester', $semesters, null, ['placeholder' => '-- Select Semester --', 'class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('student', 'Student:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::select('student', $students, null, ['placeholder' => '-- Select Student --', 'class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('course', 'Course:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::select('course', $courses, null, ['placeholder' => '-- Select Course --', 'class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('year_level', 'Year: ', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::select('year_level', $year_level, null, ['placeholder' => '-- Select Year --', 'class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('section', 'Section: ', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::select('section', $sections, null, ['placeholder' => '-- Select Section --', 'class' => 'form-control']); !!}
                            </div>
                        </div>


                        <div class="text-end text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-plus-square"></i>&nbsp;
                                Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

