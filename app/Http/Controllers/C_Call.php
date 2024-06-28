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
        return response()->json($volunteer);
    }

    public function handleSignal(Request $request)
    {
        // Validate incoming request data
        $data = $request->validate([
            'to' => 'required|string',  // Ensure 'to' is required and a string
            'type' => 'required|string',
            'sdp' => 'sometimes|string',
            'candidate' => 'sometimes|array',
        ]);

        $to = $data['to'];

        // Handle different types of signaling messages (offer, answer, ice-candidate)
        switch ($data['type']) {
            case 'offer':
            case 'answer':
                // Log SDP message
                Log::info("Received {$data['type']} from {$to}: " . json_encode($data['sdp']));
                break;
            case 'ice-candidate':
                // Log ICE candidate
                Log::info("Received ICE candidate from {$to}: " . json_encode($data['candidate']));
                break;
            default:
                Log::warning("Unknown signal type received from {$to}: " . $data['type']);
                break;
        }

        // Respond with a success message
        return response()->json(['message' => 'Signal received successfully']);
    }
}
