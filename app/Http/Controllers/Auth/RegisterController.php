<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    /**
     * Hapus atau ganti construct lama dengan ini 
     * Jika masih error, hapus seluruh fungsi __construct ini.
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama_depan' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'nama_depan'     => $data['nama_depan'],
            'email'          => $data['email'],
            'password'       => Hash::make($data['password']),
            'role'           => 'user', 
            'tanggal_daftar' => Carbon::now(), // Pastikan pakai Carbon
        ]);
    }
}