@extends('template.main')



@push('styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title"><i class="fas fa-building"></i>&nbsp Socio Economic Reports</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-8 col-sm-12">
                @include('template.alert')
                <div class="card card-table">
                    <div class="card-body text-center">

                         <div class="student-submit">
                             <a href="/admin/print/socio/mobile-phone" class="btn btn-primary btn-lg">
                                 <span class="fa fa-print me-2" role="status"></span> &nbsp;
                                 Internet Connectivity Status
                             </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


