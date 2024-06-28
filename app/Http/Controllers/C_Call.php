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
        $user = M_Relawan::where('id_users', $userid)->first();
        $status = $request->input('status');
        $user->setStatus($status);
        $user->save();

        event(new UserStatusChanged($user->id, $status));

        return response()->json(['status' => $status]);
    }

    public function getRandomVolunteer()
    {
        $volunteer = M_Relawan::where('status', 'online')->inRandomOrder()->first();

        if ($volunteer) {
            return response()->json($volunteer);
        } else {
            return response()->json(['message' => 'No volunteers are currently online.'], 404);
        }
    }

    public function handleSignal(Request $request)
    {
        $data = $request->validate([
            'to' => 'required|string',
            'type' => 'required|string',
            'sdp' => 'sometimes|string',
            'candidate' => 'sometimes|array', // Ensure you can handle array format correctly
        ]);

        $to = $data['to'];

        // Handle different types of signaling messages (offer, answer, ice-candidate)
        switch ($data['type']) {
            case 'offer':
            case 'answer':
                // Store SDP in your application as needed
                Log::info("Received {$data['type']} from {$to}: " . json_encode($data['sdp']));
                break;
            case 'ice-candidate':
                // Handle ICE candidate
                Log::info("Received ICE candidate from {$to}: " . json_encode($data['candidate']));
                break;
            default:
                Log::warning("Unknown signal type received from {$to}: " . $data['type']);
                break;
        }

        return response()->json(['message' => 'Signal received successfully']);
    }
}
