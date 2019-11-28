<!-- In Routes api.php -->
1. GET Method
Route::get('country' , 'country\CountryController@country');

2. GET Page
Route::get('country/{id}' , 'country\CountryController@countryByID');

3. POST Method
Route::Post('country' , 'country\CountryController@countrySave');

4. PUT Method
Route::put('country/{country}' , 'country\CountryController@countryUpdate');

5. DELETE Method
Route::delete('country/{country}' , 'country\CountryController@countryDelete');

--------------------- API Resource -------------------
Route::apiResource('country' , 'country\CountryResoureController');
<!-- In Controller -->
--> GET Method
    public function country(){
        return response()->json(Model::get() , 200);
    }
    // 200 --> For success

--> GET Page
	public function countryByID($id){
	        $country = Student_register::find($id);
	        if (is_null($country)) {
	            return response()->json( 'Record Not Found', 404);
	        }
	        return response()->json( $country, 200);

	    }
--> POST Method
	    public function countrySave(Request $request){
        $country = Model::create($request->all());
        return response()->json($country , 201);
    }

--> PUT Method
	    public function countryUpdate(Request $request , Student_register $country){
        $country->update($request->all());
        return response()->json($country , 200);
    }

--> DELETE Method
	    public function countryDelete(Request $request , Student_register $country){
        $country->delete();
        return response()->json($country , 204);
    }
    // 200 --> For NO Content

<!-- Validation Data -->
use Illuminate\Support\Facades\Validator;

        $rules = [
            'name'  => 'required|min:3',
            'iso'   => 'required|min:2|max:2',

        ];

        $validator = validator::make($request->all() , $rules);
	        if ($validator->fails()) {
	            return response()->json($validator->errors() , 400);
        }

--------------------- API Resource -------------------
<?php

namespace App\Http\Controllers\country;

use App\Http\Controllers\Controller;
use App\Student_register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryResoureController extends Controller
{
    public function index()
    {
        return response()->json(Student_register::get() , 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = [
            'name'  => 'required|min:3',
            'iso'   => 'required|min:2|max:2',

        ];
        $validator = validator::make($request->all() , $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors() , 400);
        }
        $country = Student_register::create($request->all());
        return response()->json($country , 201);
    }

    public function show($id)
    {
        $country = Student_register::find($id);
        if (is_null($country)) {
            return response()->json(["message" => "Record Not Found"], 404);
        }
        return response()->json( $country, 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request,  Student_register $country , $id)
    {
        $country->update($request->all());
        return response()->json($country , 200);
    }

    public function destroy($id)
    {
        $country = Student_register::find($id);
        if (is_null($country)) {
            return response()->json(["message" => "Record Not Found"], 404);
        }
        return response()->json($country , 204);
    }
}

---------------------------- Authentication -------------------------------------
php artisan make:middleware AuthKey
	--> in handel function
	        $token = $request->header('APP_KEY');
        if ($token != 'ABCDEFGHIJK') {
            return response()->json(['message' => 'APP Key Not Found'] , 401);
2. In Kernal.php
	In API array 
	\App\Http\Middleware\AuthKey::class,
// FeedBack
	https://restfulapi.net/
	https://restfulapi.net/http-status-codes/