<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SemesterController extends Controller
{
    public function index(Request $request)
    {
        $semesters = Semester::where('user_id', $request->user()->id)
            ->with(['courses.materials'])
            ->orderBy('semester_number', 'desc')
            ->get();

        return response()->json($semesters);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'semester_number' => 'required|integer',
            'academic_year' => 'required|integer',
            'status' => 'nullable|in:active,completed,archived',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $semester = Semester::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'semester_number' => $request->semester_number,
            'academic_year' => $request->academic_year,
            'status' => $request->status ?? 'active',
        ]);

        return response()->json([
            'message' => 'Semester created successfully',
            'semester' => $semester
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $semester = Semester::where('user_id', $request->user()->id)
            ->with(['courses.materials'])
            ->findOrFail($id);

        return response()->json($semester);
    }

    public function update(Request $request, $id)
    {
        $semester = Semester::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'semester_number' => 'sometimes|integer',
            'academic_year' => 'sometimes|integer',
            'status' => 'sometimes|in:active,completed,archived',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $semester->update($request->all());

        return response()->json([
            'message' => 'Semester updated successfully',
            'semester' => $semester
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $semester = Semester::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $semester->delete();

        return response()->json([
            'message' => 'Semester deleted successfully'
        ]);
    }
}