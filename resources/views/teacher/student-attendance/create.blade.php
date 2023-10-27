

@extends('template.main')

@push('styles')

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
        .ui-datepicker-month {
            display: none;
        }
    </style>
@endpush
@section('content')

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Academic Term</h3>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-sm-2"></div>
            <div class="col-xl-5 col-sm-12 d-flex">
                <div class="card flex-fill">

                    <div class="card-body">
                        {!! Form::open(['url' => '/academic-term', 'method' => 'POST']) !!}
                        @include('template.alert')
                        <br/>
                        <div class="form-group row">
                            {!! Form::label('year_from', 'From Year:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::text('year_from',null, ['class' => 'form-control datepicker-year']); !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('year_to', 'To Year:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::text('year_to',null, ['class' => 'form-control datepicker-year']); !!}
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

@push('scripts')
    <script src="https://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){



            $('.datepicker-year').datepicker( {
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'yy',
                onClose: function(dateText, inst) {
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, month, 1));
                }
            });



        });
    </script>

@endpush

