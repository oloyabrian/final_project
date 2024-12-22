<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Details</title>
</head>
<body>
    <center>
        <img width="150" height="120" src="images/deal.png" alt="">
    <div>
        <h3>Christian Name: {{$data->cname}}</h3>
        <h3>Surname: {{$data->sname}}</h3>
        <h3>Given Name: {{$data->oname}}</h3>
        <h3>Gender: {{$data->gender}}</h3>
        <h3>Date of Birth: {{$data->dob}}</h3>
        <h3>Mother's Name: {{$data->mname}}</h3>
        <h3>Village: {{$data->village}}</h3>
        <h3>Address: {{$data->address}}</h3>
        <h3>Telephone Number: {{$data->tel}}</h3>
        <h3>Email: {{$data->email}}</h3>
    </div>
    </center>
</body>
</html>
