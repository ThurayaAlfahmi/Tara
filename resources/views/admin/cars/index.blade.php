@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>All Cars</h1>
    <a href="{{ route('admin.cars.create') }}" class="btn btn-primary mb-3">Add New Car</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
            <tr>
                <td><img src="{{ asset('storage/' . $car->image_url) }}" alt="Car Image" width="100"></td>
                <td>{{ $car->name }}</td>
                <td>{{ $car->brand }}</td>
                <td>{{ $car->location->city }}</td>
                <td>
                    <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.index') }}" class="btn btn-secondary mb-3">Back</a>
</div>
@endsection

