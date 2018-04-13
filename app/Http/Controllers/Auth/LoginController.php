<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {
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
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Authenticate user function.
     *
     * @return Response
     */
    protected function authenticated($request, $user) {

        if (auth()->check() && auth()->user()->status == 0) {
            auth()->logout();
            return redirect()->back()->with('error-message', 'Your account is deactivated by admin,please contact with administrator !');
        } else if (auth()->check() && auth()->user()->role_id == 1) {
            return redirect()->route('admin');
        }
    }

}
