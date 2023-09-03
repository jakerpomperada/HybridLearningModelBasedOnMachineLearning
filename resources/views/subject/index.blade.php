@extends('template.main')



@push('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title"><i class="fas fa-book-reader"></i>&nbsp;Subjects Information</h3>

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-8 col-sm-12">
                @include('template.alert')
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">

                                <div class="col-auto text-end">
                                    <a href="/subject/create" class="btn btn-sm btn-success">Add Subject &nbsp;<i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover table-center mb-0 table-striped mb-0 text-center">
                            <thead>
                            <tr>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($subjects as $subject)
                            <tr>
                                <td>{{ $subject->code }}</td>
                                <td>{{ $subject->description }}</td>
                                <td>
                                    <a href="subject/{{$subject->id}}" class="btn btn-sm btn-rounded btn-primary">
                                        <i class="feather-edit"></i>&nbsp; Edit
                                    </a>
                                    <a href="javascript:;" id="{{$subject->id}}" class="btn btn-sm btn-danger btn-rounded button_delete">
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
                            url: `/subject/${id}`,
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


