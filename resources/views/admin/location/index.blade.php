@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Locations</h1>
    <a href="{{ route('admin.location.create') }}" class="btn btn-primary mb-3">Add New Location</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>City</th>
                <th>Branch Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($locations as $location)
            <tr>
                <td>{{ $location->city }}</td>
                <td>{{ $location->branch_name }}</td>
                <td>
                    <a href="{{ route('admin.location.edit', $location->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.location.destroy', $location->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
