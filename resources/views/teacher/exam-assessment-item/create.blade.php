@extends('template.main')
@section('content')
    {!! Form::open(['url' => '/teacher/student-exam-assessment-items?qacategory_id='.$qacategory_id, 'method' => 'POST']) !!}
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col mb-3">
                    <h3 class="page-title"><i class="fas fa-question"></i> &nbsp Create New Exam Question</h3>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-sm-12">
                <div class="col-auto text-start mb-3">
                    <a href="/teacher/student-exam-assessment-items?id={{$qacategory_id}}"
                       class="btn btn-rounded btn-dark">
                        <i class="fas fa-arrow-left"></i> &nbsp Back to Exam Items
                    </a>
                </div>

                @include('template.alert')
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Question:</label>
                                    {!! Form::textarea('question', null, [
                                    'class'      => 'form-control',
                                    'rows'       => 1,
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-9">
                <div class="card card-table">
                    <div class="card-body">
                        <table class="table table-hover table-center mb-0 table-striped mb-0 text-center">
                            <thead>
                            <tr>
                                <th>Letter</th>
                                <th>Choices</th>
                                <th>Correct?</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($choices as $i => $choice)
                                :
                                <tr>
                                    <td>{{$choice}}.</td>
                                    <td>
                                        {{Form::text('choices['.$i.']', null, ['class' => 'form-control'])}}
                                    </td>
                                    <td>
                                        {{Form::radio('answer',$i,['class'=>'form-control'])}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>
                    <div style="margin-left:auto; margin-right: auto;">

                        <button class="btn btn-dark">
                            <i class="fas fa-holly-berry"></i> &nbsp;
                            Save Question
                        </button>
                    </div>
                    {{--                    <button class="btn btn-dark"></button>--}}

                </div>
            </div>

        </div>


    </div>
    {!! Form::close() !!}

@endsection

@push('scripts')

@endpush



