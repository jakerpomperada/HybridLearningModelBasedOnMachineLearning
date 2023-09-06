@extends('template.main')



@push('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title"><i class="fas fa-book-reader"></i>&nbsp;Teachers Information</h3>

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
                                    <a href="/teacher/create" class="btn btn-sm btn-success">Add Teacher &nbsp;<i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover table-center mb-0 table-striped mb-0 text-center">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>ID Number</th>
                                <th>Complete Name</th>
                                <th>Birthdate</th>
                                <th>Contact Number</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($teachers as $teacher)
                                <tr>
                                    <td>
                                        <img style="width: 60px" class="rounded-circle profile-pic"
                                             src="{{$teacher->image}}" alt="Profile">
                                    </td>
                                    <td>{{ $teacher->id_number }}</td>
                                    <td>{{ $teacher->complete_name }}</td>
                                    <td>{{ $teacher->birthdate }}</td>
                                    <td>{{ $teacher->contact_number }}</td>
                                    <td>{{ $teacher->address }}</td>
                                    <td>
                                        <a href="teacher/{{$teacher->id}}" class="btn btn-sm btn-rounded btn-primary">
                                            <i class="feather-edit"></i>&nbsp; Edit
                                        </a>
                                        <a href="javascript:;" id="{{$teacher->id}}" class="btn btn-sm btn-danger btn-rounded button_delete">
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


@push('scripts')

    <script src="{{asset('assets/plugins/datatables/datatables.min.js')}}"></script>


    <script>
        $(document).ready(function () {

            $(".button_delete").click(function () {
                if (confirm("Are you sure you want to delete this?")) {
                    let id = $(this).attr("id");
                    $.ajax({
                        url: `/teacher/${id}`,
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


