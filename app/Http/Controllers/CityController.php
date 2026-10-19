<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;


/**
 * @api {get} /api/cities Városok listázása
 * @apiName GetCities
 * @apiGroup City
 * @apiVersion 1.0.0
 *
 * @apiDescription Városok listázása, opcionális név szerinti kereséssel és vármegye szerinti szűréssel.
 *
 * @apiParam {String} [needle] Keresés a város nevében, részleges egyezéssel.
 * @apiParam {Number} [county] Szűrés vármegye azonosítója alapján.
 *
 * @apiSuccess {Object[]} cities A városok listája.
 * @apiSuccess {Number} cities.id A város azonosítója.
 * @apiSuccess {String} cities.name A város neve.
 * @apiSuccess {Number} cities.county_id A vármegye azonosítója.
 * @apiSuccess {Object} cities.county A kapcsolódó vármegye adatai.
 *
 * @apiSuccessExample {json} Sikeres válasz:
 * HTTP/1.1 200 OK
 * {
 *   "cities": [
 *     {
 *       "id": 1,
 *       "name": "Budapest",
 *       "county_id": 1,
 *       "county": {
 *         "id": 1,
 *         "name": "Pest"
 *       }
 *     }
 *   ]
 * }
 */

/**
 * @api {get} /api/cities/:id Város lekérdezése
 * @apiName GetCity
 * @apiGroup City
 * @apiVersion 1.0.0
 *
 * @apiDescription Egy város lekérdezése azonosító alapján.
 *
 * @apiParam {Number} id A város azonosítója.
 *
 * @apiSuccess {Object} city A lekérdezett város adatai.
 * @apiSuccess {Number} city.id A város azonosítója.
 * @apiSuccess {String} city.name A város neve.
 * @apiSuccess {Number} city.county_id A vármegye azonosítója.
 * @apiSuccess {Object} city.county A kapcsolódó vármegye adatai.
 *
 * @apiSuccessExample {json} Sikeres válasz:
 * HTTP/1.1 200 OK
 * {
 *   "city": {
 *     "id": 1,
 *     "name": "Budapest",
 *     "county_id": 1,
 *     "county": {
 *       "id": 1,
 *       "name": "Pest"
 *     }
 *   }
 * }
 *
 * @apiError (404) NotFound A város nem található.
 */

/**
 * @api {get} /api/counties/:countyId/cities Városok listázása vármegye alapján
 * @apiName GetCitiesByCounty
 * @apiGroup City
 * @apiVersion 1.0.0
 *
 * @apiDescription Az adott vármegyéhez tartozó városok listázása.
 *
 * @apiParam {Number} countyId A vármegye azonosítója.
 *
 * @apiSuccess {Object[]} cities A városok listája.
 * @apiSuccess {Number} cities.id A város azonosítója.
 * @apiSuccess {String} cities.name A város neve.
 * @apiSuccess {Number} cities.county_id A vármegye azonosítója.
 * @apiSuccess {Object} cities.county A kapcsolódó vármegye adatai.
 *
 * @apiSuccessExample {json} Sikeres válasz:
 * HTTP/1.1 200 OK
 * {
 *   "cities": [
 *     {
 *       "id": 1,
 *       "name": "Budapest",
 *       "county_id": 1,
 *       "county": {
 *         "id": 1,
 *         "name": "Pest"
 *       }
 *     }
 *   ]
 * }
 */

/**
 * @api {post} /api/cities Város létrehozása
 * @apiName CreateCity
 * @apiGroup City
 * @apiVersion 1.0.0
 *
 * @apiDescription Új város létrehozása validált kérésadatok alapján.
 *
 * @apiBody {String} name A város neve.
 * @apiBody {Number} county_id A vármegye azonosítója.
 *
 * @apiSuccess {Object} city A létrehozott város adatai.
 * @apiSuccess {Number} city.id A város azonosítója.
 * @apiSuccess {String} city.name A város neve.
 * @apiSuccess {Number} city.county_id A vármegye azonosítója.
 * @apiSuccess {Object} city.county A kapcsolódó vármegye adatai.
 *
 * @apiSuccessExample {json} Sikeres válasz:
 * HTTP/1.1 200 OK
 * {
 *   "city": {
 *     "id": 1,
 *     "name": "Budapest",
 *     "county_id": 1,
 *     "county": {
 *       "id": 1,
 *       "name": "Pest"
 *     }
 *   }
 * }
 *
 * @apiError (422) ValidationError A megadott adatok nem megfelelőek.
 */

/**
 * @api {put} /api/cities/:id Város módosítása
 * @apiName UpdateCity
 * @apiGroup City
 * @apiVersion 1.0.0
 *
 * @apiDescription Egy meglévő város adatainak módosítása.
 *
 * @apiParam {Number} id A módosítandó város azonosítója.
 *
 * @apiBody {String} name A város neve.
 * @apiBody {Number} county_id A vármegye azonosítója.
 *
 * @apiSuccess {Object} city A módosított város adatai.
 * @apiSuccess {Number} city.id A város azonosítója.
 * @apiSuccess {String} city.name A város neve.
 * @apiSuccess {Number} city.county_id A vármegye azonosítója.
 * @apiSuccess {Object} city.county A kapcsolódó vármegye adatai.
 *
 * @apiSuccessExample {json} Sikeres válasz:
 * HTTP/1.1 200 OK
 * {
 *   "city": {
 *     "id": 1,
 *     "name": "Szeged",
 *     "county_id": 2,
 *     "county": {
 *       "id": 2,
 *       "name": "Csongrád-Csanád"
 *     }
 *   }
 * }
 *
 * @apiError (404) NotFound A város nem található.
 * @apiError (422) ValidationError A megadott adatok nem megfelelőek.
 */

/**
 * @api {delete} /api/cities/:id Város törlése
 * @apiName DeleteCity
 * @apiGroup City
 * @apiVersion 1.0.0
 *
 * @apiDescription Egy város törlése azonosító alapján.
 *
 * @apiParam {Number} id A törlendő város azonosítója.
 *
 * @apiSuccess {String} message A művelet eredményéről szóló üzenet.
 * @apiSuccess {Number} id A törölt város azonosítója.
 *
 * @apiSuccessExample {json} Sikeres válasz:
 * HTTP/1.1 200 OK
 * {
 *   "message": "City deleted successfully.",
 *   "id": 1
 * }
 *
 * @apiError (404) NotFound A város nem található.
 */


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
