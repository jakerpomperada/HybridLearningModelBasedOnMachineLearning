@extends('template.main')



@push('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title"><i class="fas fa-hand-paper"></i>&nbsp;&nbsp Student Participation</h3>

                </div>
            </div>
        </div>


        <div class="row">
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
                                        <form class="needs-validation" method="GET" novalidate="">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group">
                                                    &nbsp; <select disabled name="academic_year"
                                                                   class="form-control col-lg-2">
                                                        <option value="">{{$term}} [{{$semester}}]</option>
                                                    </select>
                                                    <div class="col-lg-9">
                                                        {!! Form::select('subject_load', $subject_loads, $subject_load_id, ['placeholder' => '-- Select Subject Load --', 'class' => 'form-control']); !!}
                                                    </div>
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-info">Filter</button>
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
                @if(isset($subject_load_id))
                    <div class="card card-table">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">

                                    <div class="col-auto text-end">
                                        <a href="/teacher/student-participation/create?teaching_load_id={{$subject_load_id}}"
                                           class="btn btn-sm btn-success">
                                            <i class="fas fa-plus"></i> &nbsp; Record Participation
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-hover table-center mb-0 table-striped mb-0 text-center">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Subject</th>
                                    <th>Year and Section</th>
                                    <th>Title</th>
                                    <th>Points</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($student_participations as $sp)
                                    <tr>
                                        <td>{{ $sp->date }}</td>
                                        <td>{{ $sp->subject }}</td>
                                        <td>{{ $sp->year_section }}</td>
                                        <td>{{ $sp->title }}</td>
                                        <td>{{ $sp->points }}</td>
                                        
                                        <td>
                                            <a href="/teacher/student-attendance/edit?date={{$sp->date}}&teaching_load_id={{$sp->teaching_load_id}}"
                                               class="btn btn-sm btn-rounded btn-primary">
                                                <i class="feather-edit"></i>&nbsp; Edit
                                            </a>
                                            <a href="javascript:" date="{{$sp->date}}"
                                               teaching_load_id="{{$sp->teaching_load_id}}"
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
                            {{--                        {!!  $paginate !!}--}}
                        </div>

                    </div>
                @else
                    Please select subject
                @endif
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script src="{{asset('assets/plugins/datatables/datatables.min.js')}}"></script>


    <script>
        $(document).ready(function () {

            $(".button_delete").click(function () {
                if (confirm("Are you sure you want to delete this?")) {
                    let teaching_load_id = $(this).attr("teaching_load_id");
                    let date = $(this).attr("date");
                    $.ajax({
                        url: `/teacher/student-attendance/delete?teaching_load_id=${teaching_load_id}&date=${date}`,
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
    </script>

@endpush


