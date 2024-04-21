<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', function () {
    return view('wellcome');
});

// Route::get("/hello", function (){
//     return Response('<h2>hello</h2>',200)
//         ->header('content-type', 'text/plain')
//         ->header('foo', 'bar');
// });

// Route::get("/post/{id}", function ($id) {
//     ddd($id);
//     return Response('post '. $id);
// })->where('id', '[0-9]+');

// Route::get("/search", function (Request $request) {
//     dd($request);
// });

// Route::get("/post", function () {
//     return response()->json([
//         'post' => [
//             'title' => 'Posr one',
//         ]
//     ]);
// });

// Route::post("/post/create", [PostController::class, 'create']);
// Route::put("/post/update/{id}", [PostController::class, 'update']);
// Route::delete("/post/delete/{id}", [PostController::class, 'delete']);


Route::middleware(['web', 'throttle:60,1'])->group(function () {
    Route::get("/all", [AuthManager::class, 'select']);
});