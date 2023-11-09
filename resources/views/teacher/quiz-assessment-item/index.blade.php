@extends('template.main')



@push('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col mb-3">
                    <h3 class="page-title"><i class="fas fa-clipboard-list"></i>&nbsp;&nbsp Student Quiz Assessment
                        Items</h3>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-4">
                    <h3 class="page-title">Date Start: Test</h3>
                </div>
                <div class="col-4">
                    <h3 class="page-title">Title: New titlae</h3>
                </div>
                <div class="col-4">
                    <h3 class="page-title">Status: Given</h3>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-4">
                    <h3 class="page-title">Date End: Test</h3>
                </div>
                <div class="col-4">
                    <h3 class="page-title">Total Questions: 10 </h3>
                </div>

            </div>
        </div>


        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Date Start:</h5>
                                <h5 class="card-title">Date Start:</h5>
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
                                    <a href="/teacher/student-quiz-assessment-items/create?qacategory_id={{$qacategory_id}}"
                                       class="btn btn-sm btn-dark">
                                        <i class="fas fa-plus"></i> &nbsp Create New Question
                                    </a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-hover table-center mb-0 table-striped mb-0 text-center">
                            <thead>
                            <tr>
                                <th>Question</th>
                                <th>Correct Answer</th>
                                <th>View Choices</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($assessments as $assessment)
                                <tr>
                                    <td>{{ $assessment->question }}</td>
                                    <td>{{ $assessment->correct_answer }}</td>
                                    <td><a href="/teacher/student-quiz-assessment/edit?id={{$assessment->id}}"
                                           class="btn btn-sm btn-rounded btn-info">
                                            <i class="feather-list"></i>&nbsp; Show Items
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
                        url: `/teacher/student-exam/delete?teaching_load_id=${teaching_load_id}&date=${date}`,
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


