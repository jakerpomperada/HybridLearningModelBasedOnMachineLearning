@extends('template.main')



@push('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title"><i class="fas fa-book-reader"></i>&nbsp;Academic Term Information</h3>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-8 col-sm-12">

                <div class="row">
                    <div class="col-sm-12">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Set Academic Term</h5>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <form class="needs-validation" novalidate="">
                                            <div class="input-group input-group-sm">
                                                <div class="col-3">
                                                    <select name="academic_year" class="form-control col-lg-3">
                                                        <option value="">2024-2025</option>
                                                        <option value="">2023</option>
                                                    </select>
                                                </div>


                                                &nbsp;
                                                <select name="semester" class="form-control">
                                                    <option value="">First Semester</option>
                                                    <option value="">Second Semester</option>
                                                </select>
                                                <button class="btn btn-primary" type="button">Set Default</button>
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
                                    <a href="/academic-term/create" class="btn btn-sm btn-success">Add Academic Term &nbsp;<i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <table class="table table-hover table-center mb-0 table-striped mb-0 text-center">
                            <thead>
                            <tr>
                                <th>Academic Year</th>
                                <th></th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($terms as $term)
                            <tr>
                                <td>{{ $term->academic_year }}</td>
                                <td>&nbsp;</td>
                                <td>
                                    <a href="academic-term/{{$term->id}}" class="btn btn-sm btn-rounded btn-primary">
                                        <i class="feather-edit"></i>&nbsp; Edit
                                    </a>
                                    <a href="javascript:;" id="{{$term->id}}" class="btn btn-sm btn-danger btn-rounded button_delete">
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


