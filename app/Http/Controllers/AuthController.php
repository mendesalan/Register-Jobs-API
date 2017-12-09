<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
// use App\Http\Requests\AuthenticateRequest;
use Validator;
use Hash;

class AuthController extends Controller
{
	public function authenticate( Request $request) {
		  // Get only email and password from request
		  $credentials = $request->only('email', 'password');

	      $validator = Validator::make($credentials, [
	          'password' => 'required',
	          'email' => 'required'
	      ]);

	      if( $validator->fails() ) {
          	return response()->json([
            	  'message'   => 'E-mail or login invalid, please try again!',
              	  'errors'        => $validator->errors()->all()
          	], 422);
      	  }		  

		  // Get user by email
		  $company = Company::where('email', $credentials['email'])->first();

		  // Validate Company
		  if(!$company) {
		    return response()->json([
		      'error' => 'Invalid credentials'
		    ], 401);
		  }

		  // Validate Password
		  if (!Hash::check($credentials['password'], $company->password)) {
		      return response()->json([
		        'error' => 'Invalid credentials '
		      ], 401);
		  }

		  // Generate Token
		  $token = JWTAuth::fromUser($company);		  

		  // Get expiration time
		  $objectToken = JWTAuth::setToken($token);
		  $expiration = JWTAuth::decode($objectToken->getToken())->get('exp');

		  return response()->json([
		    'access_token' => $token,
		    'token_type' => 'bearer',
		    'expires_in' => $expiration
		    // 'expires_in' => JWTAuth::decode()->get('exp')
		  ]);
    }    

}
