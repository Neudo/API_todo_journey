<?php

namespace App\Http\Controllers;


use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LocationController extends Controller
{

    private $validation_rules = [
        'name' => 'required|max:255',
        'lat' => 'required|numeric|between:-90,90',
        'lng' => 'required|numeric|between:-180,180',
    ];

    private function basic_response()
    {
        return [
            'timestamp' => Carbon::now()->toDateTimeString(),
            'status' => 200,
            'message'=> '',
            'results'=> []
        ];
    }

    private $response = [];

    public function __construct()
    {
        $this->response = $this->basic_response();
    }


    public function index()
    {
        try {
            $this->response['results'] = Location::all();
        } catch (\Throwable $th) {
            $this->response['status'] = 500;
            $this->response['message'] = $th->getMessage();
        }

        return response()->json($this->response);

    }

    public function create(Request $request)
    {

        $validator = $this->getValidationFactory()->make($request->post(), $this->validation_rules);
        if ($validator->fails()) {
            $this->response['status'] = 422;
            $this->response['message'] = $validator->errors();
        } else {
            try {
                $slug = Str::slug('location-journey', '-');

                $location = new Location();
                $location->name = $request->name;
                $location->slug = $slug . $request->name ;
                $location->lat = $request->lat;
                $location->lng = $request->lng;
//                $location->save();
                if ($location->save()){
                    $this->response['message'] = "Location added !";
                } else {
                    $this->response['status'] = 500;
                    $this->response['message'] = 'Error ....';
                }
            } catch (\Throwable $th) {
                $this->response['status'] = 500;
                $this->response['message'] = $th->getMessage();
            }
        }
        return response()->json($this->response);
    }

    public function show($id)
    {
        $validator = $this->getValidationFactory()->make(['id' => $id], ['id' => 'required|numeric']);
        if ($validator->fails()) {
            $this->response['status'] = 422;
            $this->response['message'] = $validator->errors();

        } else {
            try {
                $this->response['results'] = Location::find($id);
            } catch (\Throwable $th) {
                $this->response['status'] = 500;
                $this->response['message'] = $th->getMessage();
            }
        }
        return response()->json($this->response);
    }

    public function update(Request $request, $id)
    {
        $validator = $this->getValidationFactory()->make($request->all(), $this->validation_rules);
        if ($validator->fails()){
            $this->response['status'] = 422;
            $this->response['message'] = $validator->errors();
        } else {
            try {
                $location = Location::find($id);
                $location->name = $request->name;
                $location->slug = $request->name;
                $location->lat = $request->lat;
                $location->lng = $request->lng;
                if($location->save()){
                    $this->response['message'] = 'Location edited !!';
                } else {
                    $this->response['status'] = 500;
                    $this->response['message'] = 'Edit fail .....';
                }
            } catch (\Throwable $th){
                $this->response['status'] = 500;
                $this->response['message'] = $th->getMessage();
            }
        }
        return response()->json($this->response);
    }

    public function delete($id)
    {
        $validator = $this->getValidationFactory()->make(['id' => $id], ['id' => 'required|numeric']);
        if($validator->fails()) {
            $this->response['status'] = 422;
            $this->response['message'] = $validator->errors();
        } else {
            try {
                $location = Location::find($id);
                if($location->delete()){
                    $this->response['message'] = 'Location deleted sucessfully !!';
                } else {
                    $this->response['status'] = 500;
                    $this->response['message'] = 'Location isnt deleted ....';
                }
            } catch (\Throwable $th) {
                $this->response['status'] = 500;
                $this->response['message'] = $th->getMessage();
            }
        }

        return response()->json($this->response);
    }

}
