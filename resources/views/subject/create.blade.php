

@extends('template.main')
@section('content')

<div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add New Subject</h3>

                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-3 col-sm-2"></div>
        <div class="col-xl-5 col-sm-12 d-flex">
            <div class="card flex-fill">

                <div class="card-body">
                    {!! Form::open(['url' => '/subject', 'method' => 'POST']) !!}
                    @include('template.alert')
                    <br/>
                        <div class="form-group row">
                            {!! Form::label('course_code', 'Code:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                               {!! Form::text('course_code',null, ['class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('course_description', 'Description:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::text('course_description',null, ['class' => 'form-control']); !!}
                            </div>
                        </div>

                        <div class="text-end text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-plus-square"></i>&nbsp;
                                Submit</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</div>


@endsection

