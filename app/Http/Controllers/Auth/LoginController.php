<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;
use Carbon\Carbon;
use Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // public function showLoginForm()
    // {
    //   return view('auth.login');
    // }

    public function login(Request $request)
    {
      # Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:4'
      ]);
       
      $findUser = User::where('email',$request->email)->first();
      # Attempt to log the user in
      if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
        # if successful, then redirect to their intended location
        $findUser->lastLogin = Carbon::now()->timezone('Asia/Kolkata')->format('Y-m-d H:i A');
        $findUser->update();
       // return redirect()->intended(route('dashboard'));
        return [
          'name'        => $findUser->name,
          'contactno'   => $findUser->contactNo,
          'roleid'      => $findUser->roleId,
          'success'     => true,
          'message'     => 'User Login Successfull',
          'token'       =>$findUser-> createToken('MyApp')->plainTextToken,
          'guard'       => 'web'
        ];
      }
      # if unsuccessful, then redirect back to the login with the form data
      //return redirect()->intended(route('login'))->with('message','Authentication failure please try again!');
      else{
        return [
          'success' => false,
          'message' => 'User Login Unsuccessfull',
          'token'   => '',
        ];
      }
    }

    public function logout()
    {

      $guard = Auth::getDefaultDriver();
      $user = Auth::guard($guard)->user();
      $user->tokens()->delete();
      return [
        'message' => $guard.'Token deleted'
      ];   

       
    }
}