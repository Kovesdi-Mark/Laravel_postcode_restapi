<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountyRequest;
use App\Models\County;
use Illuminate\Http\Request;


/**
 * @api {get} /api/counties Vármegyék listázása
 * @apiName GetCounties
 * @apiGroup County
 * @apiVersion 1.0.0
 *
 * @apiDescription Az összes vármegye lekérdezése, opcionális név szerinti kereséssel.
 *
 * @apiParam {String} [needle] Keresési kifejezés a vármegye nevéhez.
 * Részleges egyezés alapján keres.
 *
 * @apiSuccess {Object[]} counties A vármegyék listája.
 * @apiSuccess {Number} counties.id A vármegye azonosítója.
 * @apiSuccess {String} counties.name A vármegye neve.
 *
 * @apiSuccessExample {json} Sikeres válasz:
 * HTTP/1.1 200 OK
 * {
 *   "counties": [
 *     {
 *       "id": 1,
 *       "name": "Pest"
 *     },
 *     {
 *       "id": 2,
 *       "name": "Baranya"
 *     }
 *   ]
 * }
 */

/**
 * @api {get} /api/counties/:id Vármegye lekérdezése
 * @apiName GetCounty
 * @apiGroup County
 * @apiVersion 1.0.0
 *
 * @apiDescription Egy vármegye lekérdezése azonosító alapján.
 *
 * @apiParam {Number} id A lekérdezendő vármegye azonosítója.
 *
 * @apiSuccess {Object} county A vármegye adatai.
 * @apiSuccess {Number} county.id A vármegye azonosítója.
 * @apiSuccess {String} county.name A vármegye neve.
 *
 * @apiSuccessExample {json} Sikeres válasz:
 * HTTP/1.1 200 OK
 * {
 *   "county": {
 *     "id": 1,
 *     "name": "Pest"
 *   }
 * }
 *
 * @apiError (404) NotFound A megadott azonosítóval nem található vármegye.
 */

/**
 * @api {post} /api/counties Vármegye létrehozása
 * @apiName CreateCounty
 * @apiGroup County
 * @apiVersion 1.0.0
 *
 * @apiDescription Új vármegye létrehozása a CountyRequest validációs szabályai alapján.
 *
 * @apiBody {String} name A létrehozandó vármegye neve.
 *
 * @apiSuccess {Object} county A létrehozott vármegye adatai.
 * @apiSuccess {Number} county.id A vármegye azonosítója.
 * @apiSuccess {String} county.name A vármegye neve.
 *
 * @apiSuccessExample {json} Sikeres válasz:
 * HTTP/1.1 200 OK
 * {
 *   "county": {
 *     "id": 1,
 *     "name": "Pest"
 *   }
 * }
 *
 * @apiError (422) ValidationError A megadott adatok nem felelnek meg a validációs szabályoknak.
 */

/**
 * @api {put} /api/counties/:id Vármegye módosítása
 * @apiName UpdateCounty
 * @apiGroup County
 * @apiVersion 1.0.0
 *
 * @apiDescription Egy meglévő vármegye adatainak módosítása.
 *
 * @apiParam {Number} id A módosítandó vármegye azonosítója.
 *
 * @apiBody {String} name A vármegye új neve.
 *
 * @apiSuccess {Object} county A módosított vármegye adatai.
 * @apiSuccess {Number} county.id A vármegye azonosítója.
 * @apiSuccess {String} county.name A vármegye neve.
 *
 * @apiSuccessExample {json} Sikeres válasz:
 * HTTP/1.1 200 OK
 * {
 *   "county": {
 *     "id": 1,
 *     "name": "Bács-Kiskun"
 *   }
 * }
 *
 * @apiError (404) NotFound A megadott azonosítóval nem található vármegye.
 * @apiError (422) ValidationError A megadott adatok nem felelnek meg a validációs szabályoknak.
 */

/**
 * @api {delete} /api/counties/:id Vármegye törlése
 * @apiName DeleteCounty
 * @apiGroup County
 * @apiVersion 1.0.0
 *
 * @apiDescription Egy vármegye törlése azonosító alapján.
 *
 * @apiParam {Number} id A törlendő vármegye azonosítója.
 *
 * @apiSuccess {String} message A törlés eredményéről szóló üzenet.
 * @apiSuccess {Number} id A törölt vármegye azonosítója.
 *
 * @apiSuccessExample {json} Sikeres válasz:
 * HTTP/1.1 200 OK
 * {
 *   "message": "County deleted successfully.",
 *   "id": 1
 * }
 *
 * @apiError (404) NotFound A megadott azonosítóval nem található vármegye.
 */


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

    public function show(int $id){
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

    public function update(CountyRequest $request, int $id){
        $county = County::findOrFail($id);
        $county->update($request->all());
        
        return response()->json([
            'county' => $county
        ]);
    }

    public function destroy(int $id){
        $county = County::findOrFail($id);
        $county->delete();

        return response()->json([
            'message' => "County deleted successfully.",
            'id' => $id
        ]);
    }
}
