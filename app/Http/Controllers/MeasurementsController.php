<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\measurement as MeasurementsResource;
use App\measurements;

class MeasurementsController extends Controller
{
    public function index()
    {
        return measurements::orderBy('created_at', 'desc')->take(10)-get();
        
    }
 
    public function show($id)
    {
        return measurements::find($id);
    }

    public function store(Request $request)
    {
        if ($request->has(['value', 'sensor_id'])) {
            return measurements::create($request->all());
        } else {
            echo "Wrong format to store";
        }
        
    }
}
