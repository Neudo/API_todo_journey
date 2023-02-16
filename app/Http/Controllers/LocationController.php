<?php

namespace App\Http\Controllers;


use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return response()->json($locations);

    }

    public function create(Request $request)
    {
        $slug = Str::slug('location-journey', '-');

        $location = new Location();
        $location->name = $request->name;
        $location->slug = $slug . $request->name ;
        $location->lat = $request->lat;
        $location->lng = $request->lng;
        $location->save();

        return response()->json($location);

    }

    public function show($id)
    {
        $location= Location::find($id);
        return response()->json($location);
    }

    public function update(Request $request, $id)
    {
        $location = Location::find($id);
        $location->name = $request->name;
        $location->slug = $request->name;
        $location->lat = $request->lat;
        $location->lng = $request->lng;
        $location->save();

        return response()->json($location);
    }

    public function delete($id)
    {
        $location = Location::find($id);
        $location->delete();

        return response()->json('location deleted sucessfully.');
    }

}
