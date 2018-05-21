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
        $sensor_types = ['temperature', 'humidity', 'movement'];
        $location = locations::where('roomnumber', $roomnumber)->firstOrFail();
        $device = devices::where('location_id', $location->id)->firstOrFail();
            foreach($sensor_types as $sensor_type){
                $sensorId = sensors::where('name' , $sensor_type)->value('id');
                $measurements[$sensor_type] = measurements::where('sensor_id', $sensorId)
                ->orderBy('created_at', 'desc')
                ->get();
            }
            return [$measurements];
    }
    public function locationTemperature($roomnumber){
        getLocationData('temperature', $roomnumber);
    }

    public function getLocationData($sensor_type, $roomnumber) {
        $location = locations::where('roomnumber', $roomnumber)->firstOrFail();
        $device = devices::where('location_id', $location->id)->firstOrFail();

        $sensorId = sensors::where('name' , $sensor_type)->value('id');
        $measurement = measurements::where('sensor_id', $sensorId)
        ->orderBy('created_at', 'desc')
        ->get();
        return $measurement;

    }

}
