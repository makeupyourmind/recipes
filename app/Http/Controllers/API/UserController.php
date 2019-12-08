<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;
use App\User;

class UserController extends BaseController
{
    public function singUp(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required',
            'name' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        return $this->sendResponse("", 'Successfully registred');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required|string|email'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            Session::put('user', $user);
            return $this->sendResponse("", 'User authorized successfully.');
        }

        return $this->sendError('Authorization failed.', '', 400);
    }

    public function logout(){
        Session::forget('user');
        return $this->sendResponse("", 'ok');
    }
}
