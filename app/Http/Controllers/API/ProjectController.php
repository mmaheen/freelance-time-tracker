<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function store(Request $request){
        // return response()->json(
        //     $request
        // );
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'string|max:1000',
            'client_id' => 'required|integer|exists:clients,id',
            'status' => 'required|in:active,inactive',
            'deadline' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'client_id' => $request->client_id,
            'status' => $request->status,
            'deadline' => $request->deadline,
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Project created successfully',
            'data' => $project,
        ], 201);
    }
}
