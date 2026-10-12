<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request){
        $query = City::with('county');

        if ($request->filled('needle')){
            $query->where('name', 'LIKE', '%' .$request->needle. '%');
        }

        if ($request->filled('county')){
            $query->where('county_id', '=', $request->county);
        }
    
        $cities = $query->get();

        return response()->json([
            'cities' => $cities
        ]);
    }

    public function show($id){
        $city = City::with('county')->findOrFail($id);
        
        return response()->json([
            'city' => $city
        ]); 
    }

    public function store(Request $request){
        $city = City::create($request->all());

        return response()->json([
            'city' => $city
        ]);
    }
}
