<?php

namespace App\Http\Controllers;

use App\Models\locations;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
   // Fetch all locations in descending order of their creation date
   $locations = locations::latest()->get();

   // Pass the locations collection to the view
   return view('admin.location.index', ['locations' => $locations]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.location.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $locations= new locations();
 
       $locations->city=$request->city;
       $locations->branch_name=$request->branch_name;
         $locations->save();
        


        return redirect()->route('admin.location.index')->with('success', 'Location saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    // 
    public function show(locations $locations)
     {
    
       $locations = locations::find($locations->id);
    return view('admin.location.show',['locations' => $locations]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $locations = locations::findOrFail($id);
        return view('admin.location.edit', compact('locations'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        $locations = locations::findOrFail($id);
        $locations->update([
            'city' => $request->city,
            'branch_name' => $request->branch_name,
        ]);
        $locations->save();
        return redirect()->route('admin.location.index')->with('success', 'Location updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $locations = locations::find($id);
        $locations->delete();
        return redirect()->route('admin.location.index')->with('success', 'Location deleted successfully!');
    }
}
