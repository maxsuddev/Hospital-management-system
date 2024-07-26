<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $role = $user->getRoleNames()->first();
        Log::info('User authenticated with role: ' . $role);
        if ($role === 'admin') {
            Log::info('Redirecting to category.index');
            return redirect()->route('category.index');
        } else {
            Log::info('Redirecting to cash_box.index');
            return redirect()->route('cash_box.index');
        }
    }
}
