@extends('template.main')

@push('styles')

    <link rel="stylesheet" href="{{asset("assets/css/profile_upload.css")}}">

@endpush



@section('content')

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Update Teaching Load</h3>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-sm-12"></div>
            <div class="col-xl-7 col-sm-12 d-flex">
                <div class="card flex-fill">

                    <div class="card-body">
                        {!! Form::open(['url' => '/teaching-load/'.$tl->id, 'method' => 'PUT']) !!}
                        @include('template.alert')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">Teacher:</label>
                                    {!!  Form::select('teacher', $teachers, $tl->teacher_id, ['placeholder' => 'Select Teacher', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">Subject:</label>
                                    {!!  Form::select('subject', $subjects, $tl->subject_id, ['placeholder' => 'Select Subject', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="field-2" class="form-label">Course:</label>
                                    {!!  Form::select('course', $courses, $tl->course_id, ['placeholder' => 'Select Course', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">Year:</label>
                                    {!!  Form::select('year_level', $year_level, $tl->year_level, ['placeholder' => 'Select Year Level', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-2" class="form-label">Section:</label>
                                    {!!  Form::select('section', $sections, $tl->section, ['placeholder' => 'Select Section', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">

                                    <label for="field-1" class="form-label">Academic Term:</label>
                                    {!!
                                        Form::select('term', $terms, $term_id, ['placeholder' => 'Select Academic Term', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="field-1" class="form-label">Semester:</label>
                                        {!!
                                            Form::select('semester', [
                                                '1st' => 'First Semester',
                                                '2nd' => 'Second Semester'
                                                ], $tl->semester, ['placeholder' => 'Select Semester', 'class' => 'form-control']); !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end text-center">
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-plus-square"></i>&nbsp;
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

