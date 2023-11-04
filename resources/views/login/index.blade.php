<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from preschool.dreamguystech.com/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2023 08:45:27 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Hybrid Learning Model Based on Machine Learning</title>

    <link rel="shortcut icon" href="{{asset("assets/img/favicon.png")}}">

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{asset("assets/plugins/bootstrap/css/bootstrap.min.css")}}">

    <link rel="stylesheet" href="{{asset("assets/plugins/feather/feather.css")}}">

    <link rel="stylesheet" href="{{asset("assets/plugins/icons/flags/flags.css")}}">

    <link rel="stylesheet" href="{{asset("assets/plugins/fontawesome/css/fontawesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/fontawesome/css/all.min.css")}}">

    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
    <style>
        .login-wrapper .loginbox .login-left {
            background: red;
        }
    </style>
</head>
<body>

<div class="main-wrapper login-body">
    <div class="login-wrapper">
        <div class="container">
            <div class="loginbox">
                <div class="login-left">
                    <img class="img-fluid" src="{{asset("assets/img/login.jpg")}}" alt="Logo">
                </div>
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Hybrid Learning Model Based on Machine Learning</h1>
                        <br/>
                        <h2>Sign in</h2>
                        @include('template.alert')
                        <form action="/login" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Username <span class="login-danger">*</span></label>
                                <input name="username" class="form-control" type="text">
                                <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                            </div>
                            <div class="form-group">
                                <label>Password <span class="login-danger">*</span></label>
                                <input name="password" class="form-control pass-input" type="text">
                                <span class="profile-views feather-eye toggle-password"></span>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-danger btn-block" type="submit">Login</button>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{asset("assets/js/jquery-3.6.0.min.js")}}"></script>

<script src="{{asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

<script src="{{asset("assets/js/feather.min.js")}}"></script>

<script src="{{asset("assets/js/script.js")}}"></script>
</body>

<!-- Mirrored from preschool.dreamguystech.com/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2023 08:45:28 GMT -->
</html>
