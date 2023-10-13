@extends('admin.dashboard')

@section('content')
    <main class="my-8">
        @if(!$cars->isEmpty())
        <div class="container px-6 mx-auto">
            <div class="w-full flex justify-center my-6">
                <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                    <h3 class="text-3xl text-bold">Cars </h3>
                    <div class="flex-1">
                        <table class="table" >
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Registration Date</th>
                                    <th>Egnine Size</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach ($cars as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ $item->full_image_url }}" class="cartImg" alt="Thumbnail">
                                        </td>
                                        <td>
                                            <p>{{ $item->brand }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $item->model }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $item->registration_date }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $item->engine_size }}</p>
                                        </td>
                                        <td>
                                            <p>${{ $item->price }}</p>
                                        </td>
                                        <td>
                                            <p>Active</p>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning" href="{{ route('cars.edit', $item->id) }}">Edit</a>
                                            <a class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#deleteModal{{$item->id}}" title="Delete Product">
                                                Delete
                                            </a>
                                            <div class="modal fade" id="deleteModal{{$item->id}}"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Are you sure you want to delete {{ $item->name }} ?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('cars.destroy', $item->id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger">Yes, Delete Product</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <a class="btn btn-primary" href="{{ route('cars.create') }}">Create New Product</a>
        @if(!$trashed->isEmpty())
        <br>
        <div class="container px-6 mx-auto">
            <div class="w-full flex justify-center my-6">
                <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                    <h3 class="text-3xl text-bold">Products that are disabled </h3>
                    <div class="flex-1">
                        <table class="table" >
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Deleted</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach ($trashed as $trash)
                                    <tr>
                                        <td>
                                            <img src="{{ $trash->full_image_url }}" class="cartImg" alt="Thumbnail">
                                        </td>
                                        <td>
                                            <p>{{ $trash->name }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $trash->description }}</p>
                                        </td>
                                        <td>
                                            <p>${{ $trash->price }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $trash->deleted_at }}</p>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning" href="{{ route('cars.restore',$trash->id) }}">Restore</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
                <a class="btn btn-primary" href="{{ route('cars.restoreAll') }}">Restore All Product</a>
            </div>
        </div>
        @endif
    </main>
@endsection
