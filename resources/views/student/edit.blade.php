@extends('template.main')

@push('styles')

    <link rel="stylesheet" href="{{asset("assets/css/profile_upload.css")}}">

@endpush


@section('content')

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Update Student</h3>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-2 col-sm-2"></div>
            <div class="col-xl-7 col-sm-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                        {!! Form::open(['url' => '/student/'. $student->id, 'method' => 'PUT']) !!}
                        @include('template.alert')
                        <br/>
                        <div class="form-group row">
                            <div class="profile-user-box">
                                <div class="profile-user-img">
                                    <img class="rounded-circle profile-pic" src="{{$student->image_link}}"
                                         alt="Profile">
                                    <i class="fa fa-camera upload-button" style="    position: absolute;
    margin-top: 66%;
    margin-left: -31%;"></i>
                                    <input id="image" name="image" class="file-upload" type="file" accept="image/*"/>
                                    <input type="hidden" value="{{$student->image_name}}" name="image_name"
                                           id="image_name"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('id_number', 'ID Number:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::text('id_number',$student->id_number, ['class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('username', 'Username:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::text('username',$student->username, ['class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('password', 'Password:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::password('password', ['class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('confirm_password', 'Confirm Password:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::password('confirm_password', ['class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('firstname', 'Firstname:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::text('firstname',$student->firstname, ['class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('middlename', 'Middlename:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::text('middlename',$student->middlename, ['class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('lastname', 'Lastname:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::text('lastname',$student->lastname, ['class' => 'form-control']); !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('birthdate', 'Birthdate:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::date('birthdate',$student->_birthdate, ['class' => 'form-control']); !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('contact_number', 'Contact Number:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!! Form::text('contact_number',$student->contact_number, ['class' => 'form-control']); !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('address', 'Address:', ['class' => 'col-lg-3 col-form-label']); !!}
                            <div class="col-lg-9">
                                {!!
                       Form::textarea('address', $student->address, [
                        'class'      => 'form-control',
                        'rows'       => 1,
                        'name'       => 'address',
                        'id'         => 'address'
                        ]) !!}
                            </div>
                        </div>
                        <div class="text-end text-center">
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-pen"></i>&nbsp;
                                Update
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@push('scripts')

    <script>
        $(document).ready(function() {
            let readURL = function(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }

                    let formData = new FormData();
                    formData.append('image', input.files[0]);


                    $.ajax({
                        type:'POST',
                        url: "/image-upload?_token={{csrf_token()}}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: (res) => {
                            $("#image_name").val(res.image_name);

                        },

                        error: function(response){
                            alert('Error uploading image!');
                        }

                    });


                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function(){
                readURL(this);
            });

            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });
        });
    </script>
@endpush
