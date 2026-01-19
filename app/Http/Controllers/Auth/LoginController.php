<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Default redirect jika fungsi authenticated tidak terpenuhi
     */
    protected $redirectTo = '/home';

    /**
     * Konstruktor: Mengatur middleware
     */

    /**
     * Logika Redirect Setelah Login Berhasil (Custom)
     */
    protected function authenticated(Request $request, $user)
    {
        // Jika yang login adalah admin, arahkan ke dashboard admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Jika user biasa, arahkan ke home
        return redirect('/home');
    }

    /**
     * Pastikan logout mengarah ke landing page
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
