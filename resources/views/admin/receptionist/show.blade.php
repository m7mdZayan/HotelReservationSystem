
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="container d-flex justify-content-center p-4">
        <div class="card bg-dark w-50">
            <div class="card-header bg-secondary text-light mb-2">
                User Details
            </div>
            <div class="card-body bg-dark text-light">
                <h5 class="card-title">Name : {{$user['name']}}</h5>
                <p>E-mail : {{ $user['email'] }}</p>
                <p>mobile : {{ $user['mobile'] }}</p>
                <p>Gender : {{ $user['gender'] }}</p>
                <p>National ID : {{ $user['national_id'] }}</p>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <a href={{route('admin.receptionists')}} class="btn btn-primary">Back</a>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>