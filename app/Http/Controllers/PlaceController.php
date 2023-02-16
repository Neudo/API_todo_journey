<?php

namespace App\Http\Controllers;


use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlaceController extends Controller
{

    public function create(Request $request, $id)
    {

        $place = new Place();
        $place->name = $request->name;
        $place->location_id = $id;
        $place->lat = $request->lat;
        $place->lng = $request->lng;
        $place->visited = 0;


        $place->save();

        return response()->json($place);

    }

    public function show($id)
    {
        $place= Place::find($id);
        return response()->json($place);
    }

    public function update(Request $request, $id)
    {
        $place = Place::find($id);
        $place->name = $request->name;
        $place->location_id = $request->location_id;
        $place->lat = $request->lat;
        $place->lng = $request->lng;
        $place->visited = $request->visited;
        $place->save();

        return response()->json($place);
    }

    public function delete($id)
    {
        $place = Place::find($id);
        $place->delete();

        return response()->json('place deleted sucessfully.');
    }

}
