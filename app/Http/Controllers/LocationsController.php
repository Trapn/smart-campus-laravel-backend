<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\locations as LocationsResource;
use App\measurements;
use App\sensors;
use App\locations;
use App\devices;


class LocationsController extends Controller
{
    public function index()
    {
        return locations::all();
    }
 
    public function show($id)
    {
        return locations::find($id);
    }

    public function store(Request $request)
    {
        if ($request->has(['name', 'roomnumber'])) {
            return locations::create($request->all());
        } else {
            echo "Wrong format to store";
        }
    }
    public function locationData($roomnumber){
        // Retrieve latest temperature, humidity, movement on location
        // get all latest measurements on that types, Get all 3 sensor types, get all devices on the location
        $sensor_types = ['temperature', 'humidity', 'movement'];
        $location = locations::where('roomnumber', $roomnumber)->firstOrFail();
        $device = devices::where('location_id', $location->id)->firstOrFail();
        

        foreach($sensor_types as $sensor_type){
            $sensorId = sensors::where('name' , $sensor_type)->value('id');
            var_dump($sensorId);
            //$measurements[$sensor_type] = measurements::where('sensor_id', $sensorId)->get();
          }
          //return $measurements;
    }

}
