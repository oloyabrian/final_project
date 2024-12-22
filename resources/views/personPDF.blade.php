<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Perons PDF</title>
    </head>
<body>
<h1 text-align="center">Sts Peter and Paul, Warr Parish <hr></h1>
    
    <table class="table table-striped">
        <tr>
        <th>SNo:</th>
        <th>Christian name</th>
        <th>Surname</th>
       <th>Gender</th>
        <th>Date of Birth</th>
        <th>Father Name</th>
        <th>Mother Name</th>
        <th>Village</th>
        <th>Address</th>
      
        </tr>
        @php 
        $no = 1;
        @endphp
        @foreach($data as $person)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$person->cname}}</td>
            <td>{{$person->sname}}</td>
            <td>{{$person->gender}}</td>
            <td>{{$person->dob}}</td>
            <td>{{$person->fname}}</td>
            <td>{{$person->mname}}</td>
            <td>{{$person->village}}</td>
            <td>{{$person->address}}</td>
            
        </tr>
        @endforeach
    </table>
</body>
</html>