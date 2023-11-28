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
                        <div class="student-submit mb-4">
                            <a href="/admin/print/socio/mobile-phone" class="btn btn-primary">Mobile Phone</a>
                        </div>
                         <div class="student-submit">
                            <button type="submit" class="btn btn-primary">Internet Connectivity</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


