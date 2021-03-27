<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- i added this manually -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <!-- i added this manually -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
  <div class="container">

  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
   @endif
   
    <form method="POST" action="{{ route('rooms.update', ['id' => $room['id']] ) }}">
      @method('PUT')
      @csrf
      <div class="mb-3">
        <label for="number" class="form-label">Number</label>
        <input type="number" class="form-control" id="number" aria-describedby="emailHelp" name="number" value="{{$room["number"]}}">
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Price</label>
        <input type="number" class="form-control" id="Price" aria-describedby="emailHelp" name="price" value="{{$room["price"]}}">
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Capacity</label>
        <input type="number" class="form-control" id="capacity" aria-describedby="emailHelp" name="capacity" value="{{$room["capacity"]}}">
      </div>
      <!-- <div class="mb-3">
        <label for="name" class="form-label">Floor Number</label>
        <input type="number" class="form-control" id="floor_id" aria-describedby="emailHelp" name="floor_id" value="{{$room["floor_id"]}}">
      </div> -->

      <button type="submit" class="btn btn-success">Update</button>
    </form>
  </div>
</body>
</html>

