@extends('frontend')

@section('content')

    <div class="container mt-4 px-6 mx-auto">
        <div class="row">
            @foreach ($results as $car)
                @csrf
                @guest
                <div class="col-lg-4">
                    <div class="card">
                        <img class="image" src="{{$car->full_image_url }}" alt="" >
                        <div class="card-body">
                            <h3 class="text-gray-700 uppercase">{{ $car->name }}</h3>
                            <strong class="mt-2">${{ $car->price }}</strong>
                            @else
                                <div class="col-md-6 col-lg-4">
                                    <div class="card">
                                        <img class="image" src="{{$car->full_image_url }}" alt="" >
                                        <div class="card-body">
                                            <h3 class="text-gray-700 uppercase">{{ $car->brand }}</h3>
                                            <strong class="mt-2">{{ $car->model }}</strong><br>
                                            <strong class="mt-2">{{ $car->registration_date }}</strong><br>
                                            <strong class="mt-2">{{ $car->engine_size }}</strong><br>
                                            <strong class="mt-2">${{ $car->price }}</strong>
                                            <br><br>
                                            <a class="btn btn-success" href="{{ route('add.to.cart', $car->id) }}">Add To Card</a>
                                            @endguest
                                        </div>
                                    </div>
                                </div>
            @endforeach
        </div>
    </div>

@endsection
