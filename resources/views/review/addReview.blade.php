<!DOCTYPE html>
<html lang="en">

<head>
    <title>ADD REVIEW</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            background-image: url('/images/car1.jfif');
            background-color: powderblue;
            background-position-x: 100%;
            background-size: 100%;
            background-attachment: fixed;
            margin: 0px;
            opacity: 90%;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark bg-primary"">
  <div class=" container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/" style="color:white;">HOME</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="{{route('car.create')}}" style="color:white;"><b>Add Car</b></a></li>
            <li><a href="{{route('car.index')}}" style="color:white;"><b>View All Cars</b></a></li>
            <li><a href="{{route('review.create')}}" style="color:white;"><b>Add Review</b></a></li>
            <li><a href="{{route('review.index')}}" style="color:white;"><b>View All Reviews</b></a></li>

        </ul>
        <form class="navbar-form navbar-left">
            <input class="form-control" id="myInput" type="text" placeholder="Search.."><i class="glyphicon glyphicon-search"></i>

        </form>
        </div>
    </nav>

    <div class="container">

        <h3 style="text-align:center; color:papayawhip;">ENTER REVIEW</h3>
        <form method="post" action="{{url('review')}}" enctype="multipart/form-data" style="margin:auto;   border: 1px solid grey;  border-radius: 50px 20px; padding-top:20px; padding-left:38%; ">
            {{ csrf_field() }}

            @include('inc.messages')

           
            <div class="form-group">
                <label for="car_id">Car ID:</label>
                <input style="width:50%;"  type="text" class="form-control" name="car_id" id="car_id" value="{{$reviews->car_id}}" >
            </div>
            

        
            <div class="form-group">
                <label for="car_review">Car Review:</label>
                <input style="width:50%;"  type="text" class="form-control" name="car_review" id="car_review" >
            </div>

            <div class="form-group">
                <label for="car_rating">Car Rating:</label>
                <input style="width:50%;"  type="number" class="form-control" name="car_rating" id="car_rating" min="1" max="5" step="0.5">
            </div>

            <br><br>

            <button type="submit" class="btn btn-primary">REVIEW</button>
        </form>

    </div>

    </div>
    </div>

</body>

</html>