@extends('template.main')



@push('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title"><i class="fas fa-book-reader"></i>&nbsp;Teacher Subject Load</h3>

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12 col-sm-12">

                @include('template.alert')
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">

                                <div class="col-auto text-end">
                                    <a href="/teaching-load/create" class="btn btn-sm btn-success"><i
                                                class="fas fa-plus"></i> &nbsp;<b>Add Teaching Load</b>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover table-center mb-0 table-striped mb-0 text-center">
                            <thead>
                            <tr>
                                <th>Teacher Name</th>
                                <th>Subject Code</th>
                                <th>Subject Description</th>
                                <th>Semester</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($teaching_loads as $teaching_load)
                                <tr>
                                    <td>{{ $teaching_load->teacher }}</td>
                                    <td>{{ $teaching_load->subject_code }}</td>
                                    <td>{{ $teaching_load->subject_description }}</td>
                                    <td>{{ $teaching_load->semester }}</td>
                                    <td>{{ $teaching_load->course }}</td>
                                    <td>{{ $teaching_load->year_level }}</td>
                                    <td>
                                        <a href="teaching-load/{{$teaching_load->id}}"
                                           class="btn btn-sm btn-rounded btn-primary">
                                            <i class="feather-edit"></i>&nbsp; Edit
                                        </a>
                                        <a href="javascript:" id="{{$teaching_load->id}}"
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
                        url: `/teaching-load/${id}`,
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


