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
            foreach($sensor_types as $sensor_type){
                $measurements[$sensor_type] = $this->getLocationData($sensor_type, $roomnumber);
            }
            return $measurements;
    }

    public function locationTemperature($roomnumber){
        return $this->getLocationData('temperature', $roomnumber);
    }
    public function locationHumidity($roomnumber){
        return $this->getLocationData('humidity', $roomnumber);
    }
    public function locationMovement($roomnumber){
        return $this->getLocationData('movement', $roomnumber);
    }

    private function getLocationData($sensor_type, $roomnumber) {
        $location = locations::where('roomnumber', $roomnumber)->firstOrFail();
        $device = devices::where('location_id', $location->id)->firstOrFail();

        $sensorId = sensors::where('name' , $sensor_type)->value('id');
        $measurement = measurements::where('sensor_id', $sensorId)
        ->orderBy('created_at', 'desc')
        ->get();
        return $measurement;
    }

}
