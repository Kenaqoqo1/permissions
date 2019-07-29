<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request as Request;
use App\Token;
use App\User;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
 {
   $this->validateLogin($request);
   //retrieveByCredentials
   if ($user = app('auth')->getProvider()->retrieveByCredentials($request->only('email', 'password'))) {
     $token = Token::create([
       'user_id' => $user->id
     ]);

     if ($token->sendCode()) {
       session([
         'token_id'=> $token->id,
         "user_id" => $user->id,
         "remember" => $request->get('remember')
       ]);

       return redirect("code");
     }

     $token->delete();// delete token because it can't be sent

     return redirect('/login')->withErrors([
       "Unable to send verification code"
     ]);
   }

   return \Redirect::to('login')
   ->withErrors([
     $this->username() => \Lang::get('auth.failed')
   ]);
 }

 public function verifyCode(Request $request){
   $user_id = session()->get('user_id');
   $token = Token::with('user')->where('user_id',$user_id)->where('used',0)->orderBy('id','DESC')->first();
   if($request->get('code') == $token->code){
     if($token->isTokenValid()){
       \Auth::login(User::find($user_id));
       $token->used = 1;
       $token->save();
       return \Redirect('home');
     }else{
       return \Redirect::to('code')
       ->withErrors([
         'code' => 'Expired Token!'
       ]);
     }
   }else{
     return \Redirect::to('code')
     ->withErrors([
       'code' => 'Invalid Token!'
     ]);
   }
 }
}
