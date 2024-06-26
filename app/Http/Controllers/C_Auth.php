<?php 

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\MRegistrasi;


class C_Auth extends Controller
{
    public function start()
    {
        return view('Auth.start');
    }
    public function login($id_roles)
    {
        $roles = $id_roles;
        return view('Auth.login',['roles' => $roles]);
    }
    public function register($id_roles)
    {

        $roles = $id_roles;

        return view('Auth.register',['roles' => $roles]);

    }
}

?>