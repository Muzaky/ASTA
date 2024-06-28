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
use App\Events\UserStatusChanged;


class C_Call extends Controller
{
    public function toggleStatus(Request $request)
    {
        $userid = Auth::user()->id;
        $user = M_Relawan::where('id', $userid)->first();
        $status = $request->input('status');
        $user->status = $status;
        $user->save();

        event(new UserStatusChanged($user->id, $status));

        return response()->json(['status' => $status]);
    }
}
