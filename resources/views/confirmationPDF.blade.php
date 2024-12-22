<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Confirmation PDF</title>
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
            <th><h2>Sts. Peter and Paul Parish, Warr <br> P. O. Box 135, Nebbi</h2> <b>Confirmation List</b><br>Date: {{ $date }}</th>
        </tr>
    </table>
    </div>
    <table class="table table-striped">
        <tr>
        <th>SNo:</th>
        <th>Christian name</th>
        <th>Surname</th>
       <th>Other Name</th>
       <th>Date</th>
        <th>Place</th>
     </tr>
       

        @php 
        $no = 1;
        @endphp
        @foreach($confirmations as $confirmation)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$confirmation->person->cname}}</td>
            <td>{{$confirmation->person->sname}}</td>
            <td>{{$confirmation->person->oname}}</td>
            <td>{{$confirmation->confirmdate}}</td>
            <td>{{$confirmation->confirmplace}}</td>
            
            
                       
        </tr>
        @endforeach
    </table>
</body>
</html>