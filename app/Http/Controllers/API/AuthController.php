<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Cookie;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        { 
            $auth = Auth::user(); 
            $token =  $auth->createToken('LaravelSanctumAuth')->plainTextToken;
            return array('success' => true, 'token' => $token);
            
        } else{
            return array('success' => false, 'msg' => ['Invalid Credentials']);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return array('success' => true);

    }
}
