<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
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

    public function show(int $id){
        $city = City::with('county')->findOrFail($id);
        
        return response()->json([
            'city' => $city
        ]); 
    }

    public function indexByCounty(int $countyId){
        $query = City::with('county');
        $query->where('county_id', '=', $countyId);

        $cities = $query->get();

        return response()->json([
            'cities' => $cities
        ]);
    }

    public function store(CityRequest $request){
        $city = City::create($request->all());
        $city->load('county');

        return response()->json([
            'city' => $city
        ]);
    }

    public function update(CityRequest $request, int $id){
        $city = City::findOrFail($id);
        $city->update($request->all());
        $city->load('county');

        return response()->json([
            'city' => $city
        ]);
    }

    public function destroy(int $id){
        $city = City::findOrFail($id);
        $city->delete();

        return response()->json([
            'message' => 'City deleted successfully.',
            'id' => $id
        ]);
    }
}
