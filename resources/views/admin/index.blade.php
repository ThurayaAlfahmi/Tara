@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    <h1>Welcome to Car Rental Admin Dashboard</h1>

                    <h2>Cars</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cars as $car)
                            <tr>
                                <td>{{ $car->name }}</td>
                                <td>{{ $car->brand }}</td>
                                <td>{{ $car->location->city }}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">View More Cars</a>

                    <h2>Locations</h2>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>City</th>
                                <th>Branch Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($locations as $location)
                            <tr>
                                <td>{{ $location->city }}</td>
                                <td>{{ $location->branch_name }}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('admin.location.index') }}" class="btn btn-secondary">View More Locations</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

