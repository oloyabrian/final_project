<!DOCTYPE html>
<html>
<head>
    <title>Person Data</title>
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
            <th><h2>Sts. Peter and Paul Parish, Warr <br> P. O. Box 135, Nebbi</h2> <b>Persons registered for Baptism</b><br>Date: {{ $date }}</th>
        </tr>
    </table>
    </div>
 
        <div>
   <table>
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
            <td>{{ $no++ }}</td>
            <td>{{ $person->cname }}</td>
            <td>{{ $person->sname }}</td>
            <td>{{ $person->gender }}</td>
            <td>{{ $person->dob }}</td>
            <td>{{ $person->fname }}</td>
            <td>{{ $person->mname }}</td>
            <td>{{ $person->village }}</td>
            <td>{{ $person->address }}</td>
        </tr>
        @endforeach
    </table>
    </div>
</body>
</html>
