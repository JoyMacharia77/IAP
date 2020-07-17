<!DOCTYPE html>
<html lang="en">

<head>
    <title>VIEW ALL REVIEWS</title>
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
            background-image: url('/images/car2.jfif');
            background-color: powderblue;
            background-position-x: 100%;
            background-size: 100%;
            background-attachment: fixed;
            margin: 0px;
            opacity: 90%;
        }
    </style>
</head>

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

<body>
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <br />
                <h3 style="text-align:center; color:papayawhip;">VIEW ALL REVIEWS</h3>
                

                @if(\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{\Session::get('success')}} </p>
                </div>
                @endif
                
                <div style="text-align:right; margin:5px; color:white;">
                    <button class="btn btn-primary"><a href="{{route('review.create')}}" style="color:white;">ADD NEW CAR REVIEW</a></button>
                </div>
                <div align="right">

                    <table class="table table-bordered">
                        <thead style="background-color:peachpuff;">
                            <tr>
                                <th>Car Id</th>
                                <th>Car Review</th>
                                <th>Car Rating</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="myTable" style="color:white;">
                            @foreach($reviews as $row)
                            <tr>
                                <td><b>{{$row['car_id']}}</b></td>
                                <td><b><i>{{$row['car_review']}}</i></b></td>
                                <td><b>{{$row['car_rating']}}</b></td>
                                <td>
                                    <form method="post" class="delete_form" action="{{action('ReviewsController@destroy',$row['id'])}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <script>
            $(document).ready(function() {
                $('.delete_form').on('submit', function() {
                    if (confirm("Are You Sure You Want To Delete It?")) {
                        return true;
                    } else {
                        return false;
                    }
                });
            });

            $(document).ready(function() {
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>


</body>

</html>