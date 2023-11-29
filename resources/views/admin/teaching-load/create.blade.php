@extends('template.main')

@push('styles')

    <link rel="stylesheet" href="{{asset("assets/css/profile_upload.css")}}">

@endpush



@section('content')

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Teaching Load</h3>

                </div>
            </div>
        </div>

        <div class="row">
        <div class="col-xl-3 col-sm-12"></div>
            <div class="col-xl-7 col-sm-12 d-flex">
                <div class="card flex-fill">

                    <div class="card-body">
                        {!! Form::open(['url' => '/teaching-load', 'method' => 'POST']) !!}
                        @include('template.alert')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">Teacher:</label>
                                   {!!  Form::select('teacher', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">Subject:</label>
                                    {!!  Form::select('subject', $subjects, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="field-2" class="form-label">Course:</label>
                                    {!!  Form::select('course', $courses, null, ['placeholder' => 'Select Course', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-1" class="form-label">Year:</label>
                                    {!!  Form::select('year_level', $year_level, null, ['placeholder' => 'Select Year Level', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="field-2" class="form-label">Section:</label>
                                    {!!  Form::select('section', $sections, null, ['placeholder' => 'Select Section', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">

                                    <label for="field-1" class="form-label">Academic Term:</label>
                                    {!!
                                        Form::select('term', $terms, null, ['placeholder' => 'Select Academic Term', 'class' => 'form-control']); !!}
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
                                                ], null, ['placeholder' => 'Select Semester', 'class' => 'form-control']); !!}
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="text-end text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-plus-square"></i>&nbsp;
                                Save
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@push('scripts')

    <script>
        $(document).ready(function () {
            let readURL = function (input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }

                    let formData = new FormData();
                    formData.append('image', input.files[0]);


                    $.ajax({
                        type: 'POST',
                        url: "/image-upload?_token={{csrf_token()}}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: (res) => {
                            $("#image_name").val(res.image_name);

                        },

                        error: function (response) {
                            alert('Error uploading image!');
                        }

                    });


                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function () {
                readURL(this);
            });

            $(".upload-button").on('click', function () {
                $(".file-upload").click();
            });
        });
    </script>
@endpush
