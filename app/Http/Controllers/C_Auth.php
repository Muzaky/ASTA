<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Models\M_Kecamatan;
use App\Models\M_Relawan;
use App\Models\User;
use App\Models\M_Tunanetra;


class C_Auth extends Controller
{
    public function start()
    {
        return view('Auth.start');
    }
    public function login($id_roles)
    {
        $roles = $id_roles;
        return view('Auth.login', ['roles' => $roles]);
    }

    public function authlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $userx = Auth::user()->id;
            $x = Auth::user()->id_roles;
            
            if ($x == 3){
                $iduser = M_Tunanetra::where('id', $userx)->first();
                return view('User.main', ['iduser' => $iduser], ['id_roles' => $x]);
            }elseif ($x == 2){
                $iduser = M_Relawan::where('id', $userx)->first();
                return view('User.main', ['iduser' => $iduser], ['id_roles' => $x]);
            }
        }
    }
    public function register($id_roles)
    {

        $roles = $id_roles;
        $kecamatan = M_Kecamatan::orderBy('nama_kecamatan', 'asc')->get();

        return view('Auth.register', ['roles' => $roles], ['kecamatan' => $kecamatan]);
    }
    public function authregister(Request $request)
    {
    
        $roles = $request->id_roles;
        if ($roles == 2) {
            $request->validate([
                'nama_depan' => 'required',
                'nama_belakang' => 'required',
                'umur' => 'required',
                'jenis_kelamin' => 'required',
                'nik' => 'required|unique:tunanetra|min:16|max:16',
                'kecamatan' => 'required',
                'alamat' => 'required',
                'nama_wali' => 'required',
                'nomor_wali' => 'required',
                'no_hp' => 'required',
                'email' => 'required|email|unique:tunanetra',
                'password' => 'required',
                'id_roles' => 'required',
            ]);
            $user = User::create([
                'name' => $request->nama_depan . ' ' . $request->nama_belakang,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_roles' => $request->id_roles,
            ]);
            M_Tunanetra::create([
                'id_users' => $user->id,
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                'umur' => $request->umur,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nik' => $request->nik,
                'kecamatan' => $request->kecamatan,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'nama_wali' => $request->nama_wali,
                'nomor_wali' => $request->nomor_wali,
                'email' => $request->email,
            ]);
        } elseif ($roles == 3) {
            $request->validate([
                'nama_depan' => 'required',
                'nama_belakang' => 'required',
                'umur' => 'required',
                'jenis_kelamin' => 'required',
                'nik' => 'required|unique:tunanetra|min:16|max:16',
                'kecamatan' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'email' => 'required|email|unique:tunanetra',
                'password' => 'required',
                'id_roles' => 'required',
            ]);
            $user = User::create([
                'name' => $request->nama_depan . ' ' . $request->nama_belakang,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_roles' => $request->id_roles,
            ]);
            M_Relawan::create([
                'id_users' => $user->id,
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                'umur' => $request->umur,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nik' => $request->nik,
                'kecamatan' => $request->kecamatan,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
            ]);
        }

        return view('Auth.login', ['roles' => $roles]);
    }

    public function verifemail()
    {

        return view('Auth.verifemail');
    }
}
