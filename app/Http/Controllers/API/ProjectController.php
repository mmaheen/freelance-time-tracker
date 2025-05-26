<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TimeLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function start(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|integer|exists:projects,id',
            // 'description' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        $time_logs = TimeLog::select('project_id')->get();

        foreach ($time_logs as $time_log) {
            if ($time_log->project_id == $request->project_id) {
                return response()->json([
                    'message' => 'Time log already started for this project',
                ], 400);
            }
        }
        
        $timeLog = \App\Models\TimeLog::create([
            'project_id' => $request->project_id,
            'start_time' => now(),
            'description' => $request->description ?? null,
        ]);
        return response()->json([
            'message' => 'Time log started successfully',
            'time_log' => $timeLog,
        ], 201);

    }
}
