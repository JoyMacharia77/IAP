@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <p style="color: orange;  text-align:center"><small>You are Now Logged In</small></p>
                   <br>
                    <h4  style="color: grey; text-align:center">ADD A NEW CAR</h4>
                    <br>

                   <p style="color:orange; text-align:center"
                   
                   > <a href="{{route('car.create')}}"><b>Add Car</b></a> </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
