<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div style="float: left">
        <img style="position: fixed;margin-left: 146px;" class="img-fluid" width="100px" height="100px" src="http://127.0.0.1:8000/assets/img/login.jpg" alt="Logo">
    </div>
        <div class="text-center mb-5">
            <h6>Republic of the Philippines</h6>
            <h6>Colegio San-Agustin - Bacolod</h6>
            <h6>Benigno S. Aquino Drive, Bacolod City,  Negros Occidental</h6>
            <h6>Contact Number: (034) 434-2471 </h6>
        </div>

    <div class="text-center mb-5">
        <h4>Student Information</h4>
    </div>


    <div class="row">




        <table class="table table-sm">
            <thead>
            <tr>
                <th>ID Number</th>
                <th>Complete Name</th>
                <th>Birthdate</th>
                <th>Contact Number</th>

            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->id_number }}</td>
                <td>{{ $student->complete_name }}</td>
                <td>{{ $student->birthdate }}</td>
                <td>{{ $student->contact_number }}</td>

            </tr>
            @endforeach

            </tbody>
        </table>

    </div>

</div>


</body>
<script>
    window.print();
    window.onafterprint = function(event) {
        window.location.href = '/student'
    };
</script>
</html>