<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Communion Details</title>
</head>
<body>
    <center>
        <img width="150" height="120" src="images/deal.png" alt="">
    <div>
        <h3>Christian Name: {{$data->person->cname}}</h3>
        <h3>Surname: {{$data->person->sname}}</h3>
        <h3>Given Name: {{$data->person->oname}}</h3>
        <h3>Communion Date: {{$data->cdate}}</h3>
        <h3>Place: {{$data->cplace}}</h3>
        
       
      
    </div>
    </center>
</body>
</html>
