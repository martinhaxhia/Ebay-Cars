@extends('admin.dashboard')

@section('content')
    <div class="row" >
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Create Product</h3>
                <div class="container">
                    @if($errors->any())
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                    @endif
                    <form action="{{route('cars.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 has-validation">
                            <label for="brand" class="form-label">Brand</label>
                            <input name="brand"  type="text" class="form-control" id="brand" value="{{ old('brand') }}" aria-describedby="brand"/>
                            @error('brand')
                            <div class="invalid">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="model" class="form-label">Model</label>
                            <input name="model" type="text" class="form-control" id="model" value="{{ old('model') }}" aria-describedby="model"/>
                            @error('model')
                            <div class="invalid">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="registration_date" class="form-label">Registration Date</label>
                            <input name="registration_date"  type="date" class="form-control" id="registration_date" value="{{ old('registration_date') }}" aria-describedby="registration_date"/>
                            @error('registration_date')
                            <div class="invalid">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="engine_size" class="form-label">Engine Size</label>
                            <input name="engine_size"  type="text" class="form-control" id="engine_size" value="{{ old('engine_size') }}" aria-describedby="engine_size"/>
                            @error('engine_size')
                            <div class="invalid">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input name="price"  type="text" class="form-control" id="price" value="{{ old('price') }}" aria-describedby="price"/>
                            @error('price')
                            <div class="invalid">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Car image</label>
                            <input name="image"  type="file" class="form-control" id="image" aria-describedby="image"/>
                            @error('image')
                            <div class="invalid">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
