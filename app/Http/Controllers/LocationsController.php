<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\locations as LocationsResource;
use App\locations;

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
    public function locationData($location){
        

    }

}
