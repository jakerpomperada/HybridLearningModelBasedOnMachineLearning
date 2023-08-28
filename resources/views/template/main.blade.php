<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from preschool.dreamguystech.com/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2023 08:45:25 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title></title>

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
</head>
<body>

<div class="main-wrapper">

    @include('template.navbar')


    @include('template.sidebar')


    <div class="page-wrapper">
        @yield('content')

        <footer>
            <p>Copyright © 2023 Jake Pomperada.</p>
        </footer>

    </div>

</div>


<script src="{{asset("assets/js/jquery-3.6.0.min.js")}}"></script>

<script src="{{asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

<script src="{{asset("assets/js/feather.min.js")}}"></script>

<script src="{{asset("assets/plugins/slimscroll/jquery.slimscroll.min.js")}}"></script>

<script src="{{asset("assets/plugins/apexchart/apexcharts.min.js")}}"></script>
<script src="{{asset("assets/plugins/apexchart/chart-data.js")}}"></script>

<script src="{{asset("assets/js/script.js")}}"></script>
</body>

<!-- Mirrored from preschool.dreamguystech.com/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 02 Jul 2023 08:45:26 GMT -->
</html>
