<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


/**
 * @api {post} /api/login Bejelentkezés
 * @apiName LoginUser
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiDescription Felhasználó bejelentkeztetése e-mail-cím és jelszó segítségével.
 * Sikeres bejelentkezés esetén a rendszer törli a felhasználó korábbi tokenjeit,
 * majd létrehoz egy új hozzáférési tokent.
 *
 * @apiBody {String} email A felhasználó érvényes e-mail-címe.
 * @apiBody {String} password A felhasználó jelszava.
 *
 * @apiSuccess {Object} user A bejelentkezett felhasználó adatai.
 * @apiSuccess {Number} user.id A felhasználó azonosítója.
 * @apiSuccess {String} user.email A felhasználó e-mail-címe.
 * @apiSuccess {String} user.token A létrehozott hozzáférési token.
 *
 * @apiSuccessExample {json} Sikeres válasz:
 * HTTP/1.1 200 OK
 * {
 *   "user": {
 *     "id": 1,
 *     "email": "user@example.com",
 *     "token": "1|exampleAccessToken"
 *   }
 * }
 *
 * @apiError (401) Unauthorized Hibás e-mail-cím vagy jelszó.
 *
 * @apiErrorExample {json} Hibás bejelentkezési adatok:
 * HTTP/1.1 401 Unauthorized
 * {
 *   "message": "Invalid email or password"
 * }
 *
 * @apiError (422) ValidationError Hiányzó vagy érvénytelen e-mail-cím,
 * illetve hiányzó jelszó.
 *
 * @apiErrorExample {json} Validációs hiba:
 * HTTP/1.1 422 Unprocessable Entity
 * {
 *   "message": "The email field is required.",
 *   "errors": {
 *     "email": [
 *       "The email field is required."
 *     ]
 *   }
 * }
 */

/**
 * @api {get} /api/users Felhasználók listázása
 * @apiName GetUsers
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiDescription Az adatbázisban tárolt összes felhasználó lekérdezése.
 *
 * @apiSuccess {Object[]} users A felhasználók listája.
 * @apiSuccess {Number} users.id A felhasználó azonosítója.
 * @apiSuccess {String} users.name A felhasználó neve, ha a modell tartalmazza.
 * @apiSuccess {String} users.email A felhasználó e-mail-címe.
 *
 * @apiSuccessExample {json} Sikeres válasz:
 * HTTP/1.1 200 OK
 * {
 *   "users": [
 *     {
 *       "id": 1,
 *       "name": "Teszt Felhasználó",
 *       "email": "user@example.com"
 *     },
 *     {
 *       "id": 2,
 *       "name": "Másik Felhasználó",
 *       "email": "user2@example.com"
 *     }
 *   ]
 * }
 */


class UserController extends Controller
{
    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $password ? $user->password : '')){
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }

        $user->tokens()->delete();

        $user->token = $user->createToken('access')->plainTextToken;

        return response()->json([
            'user' => $user,
        ]);
    }

    public function index(){
        $users = User::all();
        return response()->json([
            'users' => $users
        ]);
    }
}
