<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\measurement as MeasurementsResource;
use App\measurements;

class MeasurementsController extends Controller
{
    public function index()
    {
        return measurements::all()->order_by('created_at', 'desc');
        
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
