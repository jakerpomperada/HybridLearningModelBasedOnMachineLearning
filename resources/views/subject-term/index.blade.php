@extends('template.main')



@push('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title"><i class="fas fa-book-reader"></i>&nbsp;&nbsp; Subject Terms Information</h3>

                </div>
            </div>
        </div>


        <div class="row">
            {{--            <div class="col-lg-1"></div>--}}
            <div class="col-lg-12 col-sm-12">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Filter:</h5>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <form class="needs-validation" novalidate="">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group">
                                                    <select name="academic_year" class="form-control col-lg-3">
                                                        <option value="">--Academic Year--</option>
                                                        <option value="">2024-2025</option>
                                                        <option value="">2023</option>
                                                    </select>
                                                    &nbsp;
                                                    <select name="academic_year" class="form-control col-lg-3">
                                                        <option value="">--Semester--</option>
                                                        <option value="">2024-2025</option>
                                                        <option value="">2023</option>
                                                    </select>
                                                    &nbsp;
                                                    <select name="academic_year" class="form-control col-lg-3">
                                                        <option value="">--Course--</option>
                                                        <option value="">2024-2025</option>
                                                        <option value="">2023</option>
                                                    </select>
                                                    &nbsp;
                                                    <select name="year_level" class="form-control col-lg-3">
                                                        <option value="">--Year Level--</option>
                                                        <option value="">2024-2025</option>
                                                        <option value="">2023</option>
                                                    </select>
                                                    &nbsp;


                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-info">Filter</button>
                                                        <button type="button" class="btn btn-outline-light">Clear
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                @include('template.alert')
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">

                                <div class="col-auto text-end">
                                    {{--                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#con-close-modal">Responsive Modal</button>--}}
                                    <button id="cu_subject_term_add_button" class="btn btn-sm btn-success"
                                            data-bs-toggle="modal" data-bs-target="#con-close-modal"><i
                                            class="fas fa-plus"></i> &nbsp; Add Subject Term
                                    </button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover table-center mb-0 table-striped mb-0 text-center">
                            <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Description</th>
                                <th>Academic Term</th>
                                <th>Semester</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->subject_code }}</td>
                                    <td>{{ $subject->description }}</td>
                                    <td>{{ $subject->term }}</td>
                                    <td>{{ $subject->semester }}</td>
                                    <td>{{ $subject->course }}</td>
                                    <td>{{ $subject->year }}</td>
                                    <td>
                                        <a href="subject-term/{{$subject->id}}" class="btn btn-sm btn-rounded btn-primary">
                                            <i class="feather-edit"></i>&nbsp; Edit
                                        </a>
                                        <a href="javascript:" id="{{$subject->id}}"
                                           class="btn btn-sm btn-danger btn-rounded button_delete">
                                            <i class="feather-trash"></i>&nbsp; Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                    <div style="margin-left:auto; margin-right: auto;">
                                                {!!  $paginate !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@include('subject-term.cu')

@push('scripts')

    <script src="{{asset('assets/plugins/datatables/datatables.min.js')}}"></script>


    <script>
        $(document).ready(function () {

            $(".button_delete").click(function () {
                if (confirm("Are you sure you want to delete this?")) {
                    let id = $(this).attr("id");
                    $.ajax({
                        url: `/subject-term/${id}`,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (result) {
                            location.reload();
                        }
                    });
                } else {
                    return false;
                }
            });
        });


        $("#cu_subject_term_add_button").click(function () {
            $('#cu_subject_term_modal').modal('show');
            $.ajax({
                url: `/subject-term/get/data`,
                type: 'GET',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (result) {
                    const d = result.data;
                    display_courses(d.courses);
                    display_terms(d.terms);
                    display_yearLevel(d.year_level);
                    display_subjects(d.subjects);
                }
            });

        });


        $("#save_subject_term").click(function () {

            const course = $("#courses").val();
            const academic_term = $("#academic_terms").val();
            const year_level = $("#year_level").val();
            const subject = $("#subjects").val();
            const semester = $("#semesters").val();

            if (course == -1 || academic_term == -1 || year_level == -1 || subject == -1 || semester == -1) {
                alert("Some fields cannot be empty!");
                return;
            }

            const formData = {
                course: course,
                academic_term: academic_term,
                year_level: year_level,
                subject: subject,
                semester: semester,
                "_token": "{{ csrf_token() }}",
            };

            $.ajax({
                type: "POST",
                url: `/subject-term`,
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                location.reload();
            });


        })


        function display_courses(courses) {
            var s = '<option value="-1">Select Course</option>';
            for (var i = 0; i < courses.length; i++) {
                s += '<option value="' + courses[i].id + '">' + courses[i].code + '</option>';
            }
            $("#courses").html(s);
        }

        function display_terms(terms) {
            var s = '<option value="-1">Select Academic Year</option>';
            for (var i = 0; i < terms.length; i++) {
                s += '<option value="' + terms[i].id + '">' + terms[i].academic_year + '</option>';
            }
            $("#academic_terms").html(s);
        }

        function display_yearLevel(year_levels) {
            let s = '<option value="-1">Select Year Level</option>';
            for (const key in year_levels) {
                s += '<option value="' + key + '">' + year_levels[key] + '</option>';
            }
            $("#year_level").html(s);
        }

        function display_subjects(subjects) {
            let s = '<option value="-1">Select Subject</option>';
            for (var i = 0; i < subjects.length; i++) {
                s += '<option value="' + subjects[i].id + '">' + subjects[i].code + ' - ' + subjects[i].description + '</option>';
            }
            $("#subjects").html(s);
        }


    </script>
@endpush


