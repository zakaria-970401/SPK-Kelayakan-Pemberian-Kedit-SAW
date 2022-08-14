<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use DB;

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

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function ubahPassword(Request $request)
    {
        $validate = $request->password != $request->password_konfirm;
        if ($validate) {
            return response()->json([
                'status' => 'gagal',
            ]);
        } else if (strlen($request->password) < 6) {
            return response()->json([
                'status' => 'kurang',
            ]);
        } else {
            DB::table('users')->where('id', Auth::user()->id)->update([
                'password' => bcrypt($request->password),
                'updated_at' => date('Y-m-d H:i:s'),
                // 'updated_by' => Auth::user()->name,
            ]);
            Auth::logout();
            return response()->json([
                'status' => 'ok',
            ]);
            // return back();
        }
    }
}
