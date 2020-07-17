<!DOCTYPE html>
<html lang="en">

<head>
    <title>EDIT CAR</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
        html,
        body {
           /* background-color: peachpuff;*/
            background-image: radial-gradient(white 80%, peachpuff 20%);
        }
    </style>
</head>

<body>
    <div class="container">

        <h3 style="text-align:center; color:papayawhip;">EDIT CAR DETAILS</h3>

        <form method="post" action="{{action('CarsController@update', $id)}}" enctype="multipart/form-data" style="border: 1px solid black; padding:20px;">
        {{ csrf_field() }}

        <input type="hidden" name="_method" value="PATCH" />
      
        <div class="form-group">
        <label>Car Make:</label>
            <input name="make" type="text" class="form-control" id="make" value="{{$cars->make}}" placeholder="Car Make" >
        </div>

        <div class="form-group ">
        <label>Car Model:</label>
            <input name="model" type="text" class="form-control" id="model" value="{{$cars->model}}" placeholder="Car Model">
        </div>

      
        <div class="form-group ">
        <label>Produced On:</label>
            <input name="produced_on" type="date" class="form-control" id="produced_on" value="{{$cars->produced_on}}" placeholder="Produced On">
        </div>

           <br><br>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">EDIT</button>
        </div>
    </form>

    </div>

    </div>
    </div>

</body>

</html>