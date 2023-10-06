@extends('template.main')
@section('content')

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Update Subject Term</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-sm-2"></div>
            <div class="col-xl-5 col-sm-12 d-flex">
                <div class="card flex-fill">

                    <div class="card-body">
                        {!! Form::open(['url' => '/subject-term/' . $subject_term->id, 'method' => 'PUT']) !!}
                        @include('template.alert')
                        <br/>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">Academic Term:</label>
                                    {!! Form::select('academic_term', $terms,
                            $subject_term->AcademicTermSemester->AcademicTerm->id,
                            ['placeholder' => 'Select Term', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="field-2" class="form-label">Semester:</label>
                                    {!! Form::select('semester', $semesters,
                                      $subject_term->AcademicTermSemester->semester
                                    , ['placeholder' => 'Select Semester', 'class' => 'form-control']); !!}
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">Course:</label>
                                    {!! Form::select('course', $courses, $subject_term->course_id, ['placeholder' => 'Select Course', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-2" class="form-label">Year Level:</label>
                                    {!! Form::select('year_level', $year_level, $subject_term->year_level, ['placeholder' => 'Select Year Level', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="field-3" class="form-label">Subject:</label>
                                    {!! Form::select('subject', $subject, $subject_term->subject_id, ['placeholder' => 'Select Subject', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                        </div>

                        <div class="text-end text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-pen"></i>&nbsp;
                                Update
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

