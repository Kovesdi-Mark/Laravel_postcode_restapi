<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountyRequest;
use App\Models\County;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class CountyController extends Controller
{
    public function index(Request $request){
        $query = County::query();

        if ($request->filled('needle')){
            $query->where('name', 'LIKE', '%' .$request->needle.'%');
        }

        $counties = $query->get();

        return response()->json([
            'counties' => $counties
        ]);
    }

    public function show($id){
        $county = County::findOrFail($id);

        return response()->json([
            'county' => $county
        ]);
    }

    public function store(CountyRequest $request){
        $county = County::create($request->all());

        return response()->json([
            'county' => $county
        ]);
    }

    public function update(CountyRequest $request, $id){
        $county = County::findOrFail($id);
        $county->update($request->all());
        
        return response()->json([
            'county' => $county
        ]);
    }

    public function destroy($id){
        $county = County::findOrFail($id);
        $county->delete();

        return response()->json([
            'message' => "County deleted successfully.",
            'id' => $id
        ]);
    }
}
