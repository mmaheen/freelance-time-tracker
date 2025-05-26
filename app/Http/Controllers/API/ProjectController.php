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
        $all_time_logs = TimeLog::select('project_id')->get();

        foreach ($all_time_logs as $time_log) {
            if ($time_log->project_id == $request->project_id) {
                return response()->json([
                    'message' => 'Time log already started for this project',
                ], 400);
            }
        }

        $time_log = TimeLog::create([
            'project_id' => $request->project_id,
            'start_time' => now(),
            'description' => $request->description ?? null,
        ]);
        return response()->json([
            'message' => 'Time log started successfully',
            'time_log' => $time_log,
        ], 201);

    }

    public function stop(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|integer|exists:projects,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $time_log = TimeLog::where('project_id', $request->project_id)
            ->whereNull('end_time')
            ->first();

        if (!$time_log) {
            return response()->json([
                'message' => 'No active time log found for this project',
            ], 404);
        }

        $time_log->end_time = now();
        $time_log->hours = $time_log->end_time->diff($time_log->start_time); // Convert seconds to hours

        $time_log->save();

        return response()->json([
            'message' => 'Time log stopped successfully',
            'time_log' => $time_log,
        ], 200);
    }
}
