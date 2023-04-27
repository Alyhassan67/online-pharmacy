<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|eamil',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Please validate error',$validator->errors());
        }
            $input = $request->all();
            $input['password']= Hash::make($input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken('abgwaa')->accessToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success,'User resistered successfully');


    }




    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->$email, 'password' => $request->$password]))
        {
            $user = Auth::user();
            $success['token'] = $user->createToken('abgwaa')->accessToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success,'User login successfully');
        }
        else{
            return $this->sendError('Please check your Auth', ['error'=>'unauthorised']);
        }
    }
}





