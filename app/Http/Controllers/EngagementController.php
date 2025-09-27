<?php

namespace App\Http\Controllers;

use App\Models\EngagementModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EngagementController extends Controller
{
    public function save_engagement(Request $request)
    {
        if (Auth::check()) {
            $data = $request->json()->all();

            $event = $data['event'] ?? null;
            $fileId = $data['fileId'] ?? null;
            $sessionTime = $data['sessionTime'] ?? null;
            $totalTime = $data['totalTime'] ?? null;
            $timestamp = $data['timestamp'] ?? null;
            $type = $data['type'] ?? null;
            $token = $data['_token'] ?? null;

            $engagement = new EngagementModel();
            $engagement->file_id = $fileId;
            $engagement->total_time = $totalTime;
            $engagement->user_id =  Auth::user()->id;
            $engagement->created_at = now();
            $engagement->save();
        }
    }
}
