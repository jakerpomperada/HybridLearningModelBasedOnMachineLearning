@php use Illuminate\Support\Facades\Session; @endphp


    <!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        table, th, td {
            text-align: center;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>

<div class="container">
    <div style="float: left">
        <img style="position: fixed;margin-left: 146px;" class="img-fluid" width="100px" height="100px"
             src="http://127.0.0.1:8000/assets/img/login.jpg" alt="Logo">
    </div>
    <div class="text-center mb-5">
        <h6>Republic of the Philippines</h6>
        <h6>Colegio San-Agustin - Bacolod</h6>
        <h6>Benigno S. Aquino Drive, Bacolod City, Negros Occidental</h6>
        <h6>Contact Number: (034) 434-2471 </h6>
    </div>

    <div class="text-center mb-5">
        <h4>Internet Connectivity Status</h4>
    </div>


    <table width="100%">
        <thead>
        <tr>
            <th>ID Number</th>
            <th>Student Name</th>
            <th>Birthdate</th>
            <th>Contact Number</th>
            <th style="width:10%">Has Internet at home?</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{$student->id_number}}</td>
                <td>{{$student->complete_name}}</td>
                <td>{{$student->birthdate}}</td>
                <th>{{$student->contact_number}}</th>
                <th>{{$student->has_internet_connection ? "Yes" : "No"}}</th>
            </tr>

        @endforeach

        </tbody>
    </table>
    <br>
    <table style="font-weight: bold">
        <tr>
            <td width="300px">Student with Internet Connection</td>
            <td width="150px">{{$has_internet}}</td>
        </tr>
        <tr>
            <td>Student with No Internet Connection</td>
            <td>{{$no_internet}}</td>
        </tr>
    </table>

</div>
</body>
<script>
    window.print();
    window.onafterprint = function (event) {
        @if(request()->input('module') == 'admin')
            window.location.href = '/admin/report/socio-economic'
        @else
            window.location.href = '/teacher/report/socio-economic'
        @endif

    };
</script>

</html>


