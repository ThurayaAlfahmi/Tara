<?php

namespace App\Http\Controllers;

use App\Models\cars;
use App\Models\locations;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    // Display a listing of the cars
    public function index()
    {
       // Fetch cars with their locations (eager load)
    $cars = cars::with('location')->get();

    return view('admin.cars.index', compact('cars'));
    }

    // Show the form for creating a new car
    public function create()
    {
        $locations = locations::all();
        return view('admin.cars.create', compact('locations'));
    }

    // Store a newly created car
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'daily_rate' => 'required|numeric|min:0',
            'availability' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location_id' => 'required|exists:locations,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('car_images', 'public');
        }

        cars::create([
            'name' => $request->name,
            'description' => $request->description,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'daily_rate' => $request->daily_rate,
            'availability' => $request->availability ?? true,
            'image_url' => $imagePath,
            'location_id' => $request->location_id,
            'car_type' => $request->car_type,
        ]);
    
     
        return redirect()->route('admin.cars.index')->with('status', 'Car created successfully!');
    }

    public function show($id)
    {
        //
        $cars = cars::findOrFail($id);
        return view('admin.cars.index');
    }

    // Show the form for editing a car
    public function edit($id)
    {
        $car = cars::findOrFail($id);
        $locations = locations::all(); // Fetch locations for dropdown
        return view('admin.cars.edit', compact('car', 'locations'));
    }

    // Update the specified car
    public function update(Request $request, $id)
    {
       
         $car = cars::findOrFail($id);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('car_images', 'public');
            $car->image_url = $imagePath;
        }
        $car->update([
            'name' => $request->name,
            'description' => $request->description,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'daily_rate' => $request->daily_rate,
            'availability' => $request->availability ?? true,
            'location_id' => $request->location_id,
            'car_type' => $request->car_type,
        ]);
        $car->save();
        return redirect()->route('admin.cars.index')->with('status', 'Car updated successfully!');
    }

    // Remove the specified car
    public function destroy($id)
    {
        $car = cars::findOrFail($id);
        $car->delete();
        return redirect()->route('admin.cars.index')->with('status', 'Car deleted successfully!');
    }
}
