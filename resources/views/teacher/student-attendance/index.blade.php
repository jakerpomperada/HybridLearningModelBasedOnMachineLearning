@extends('template.main')



@push('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title"><i class="fas fa-users"></i>&nbsp;&nbsp Student Attendance</h3>

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
                                                        {!! Form::select('subject_load', $subject_loads, null, ['placeholder' => '-- Select Subject Load --', 'class' => 'form-control']); !!}
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
                                        <a href="student-attendance/create?subject_load={{$subject_load_id}}" class="btn btn-sm btn-success">
                                            <i class="fas fa-plus"></i> &nbsp;Record Attendance </a>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-hover table-center mb-0 table-striped mb-0 text-center">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Subject</th>
                                    <th>Year and Section</th>
                                    <th>Present</th>
                                    <th>Absent</th>
                                    <th>Excuse</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach([] as $subject)
                                    <tr>
                                        <td>{{ $subject->subject_code }}</td>
                                        <td>{{ $subject->description }}</td>
                                        <td>{{ $subject->term }}</td>
                                        <td>{{ $subject->semester }}</td>
                                        <td>{{ $subject->course }}</td>
                                        <td>{{ $subject->year }}</td>
                                        <td>
                                            <a href="subject-term/{{$subject->id}}"
                                               class="btn btn-sm btn-rounded btn-primary">
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

@endpush


