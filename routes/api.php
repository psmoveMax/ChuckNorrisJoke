<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

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



Route::post('/echo', function (Request $request){
    if($request->header('Authorization') !== 'Bearer 1234567890') {
        return response()->json(['error'=>'Unauthorized'], 401);
    }
    return response()->json($request->all());
});


Route::post('/chuck', function (Request $request){
    if($request->header('Authorization') !== 'Bearer 0987654321') {
        return response()->json(['error'=>'Unauthorized'], 401);
    }
    $client= new Client([
        'verify' => false,
    ]);
    $response = $client->get('https://api.chucknorris.io/jokes/random');
    $data = json_decode($response->getBody());

    $value = $data->value;

    return $value;
});


