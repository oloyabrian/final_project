<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Marriage PDF</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .none {
            border-collapse: collapse;
            width: 100%;
        }

        .none th, .none td {
            border: none; /* No border */
            text-align: center; /* Center-aligned content */
            padding: 10px;
        }

        /* Optional: style for the table header */
        .none th {
            font-weight: bold;
        }
    </style>
    </head>
<body>

<div class="none">   <table>
<tr>
            <th> <img width="150" height="120" src="images/deal.png" alt=""></th>
            <th><h2>Sts. Peter and Paul Parish, Warr <br> P. O. Box 135, Nebbi</h2> <b>Marriage List</b><br>Date: {{ $date }}</th>
        </tr>
    </table>
    </div>

    <h3>Date: {{ $date }}</h3><hr>
    <table class="table table-striped">
        <tr>
        <th>SNo:</th>
        <th>Christian name</th>
        <th>Surname</th>
       <th>Other Name</th>
       <th>Wedding Date</th>
        <th>Spouse</th>
        <th>Matron</th>
        <th>Patron</th>
        </tr>
        
        @php 
        $no = 1;
        @endphp
        @foreach($marriages as $marriage)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$marriage->person->cname}}</td>
            <td>{{$marriage->person->sname}}</td>
            <td>{{$marriage->person->oname}}</td>
            <td>{{$marriage->marriage_date}}</td>
            <td>{{$marriage->spouse}}</td>
            <td>{{$marriage->matron}}</td>
            <td>{{$marriage->patron}}</td>
            
                       
        </tr>
        @endforeach
    </table>
</body>
</html>