<!DOCTYPE html>
<html>
<title>View All Cars</title>
</head>
<body>
<table>
<tr>
<td>Car ID</td>
<td>Car Make</td>
<td>Car Model</td>
<td>Produced On</td>
</tr>
@foreach ($cars as $car)
<tr>
<td>{{$car->id}}</td>
<td>{{$car->make}}</td>
<td>{{$car->model}}</td>
<td>{{$car->produced_on}}</td>
</tr>
@endforeach
</table>
</body>
</html>