<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sensors;

class SensorsController extends Controller
{
    public function index()
    {
        return sensors::all();
    }
 
    public function show($id)
    {
        return sensors::find($id);
    }

    public function store(Request $request)
    {
        if ($request->has(['sensor_name', 'measurement_unit'])) {

            $sensor = new sensors;

            $sensor->sensor_name         = $request->input('sensor_name');
            $sensor->measurement_unit         = $request->input('measurement_unit');
            $sensor->device_id        = 1;

            $sensor->save();

        } else {
            echo "Wrong format to store";
        }
        
    }
}
