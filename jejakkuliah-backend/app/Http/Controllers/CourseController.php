<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index(Request $request, $semesterId)
    {
        $semester = Semester::where('user_id', $request->user()->id)
            ->findOrFail($semesterId);

        $courses = Course::where('semester_id', $semesterId)
            ->with('materials')
            ->get();

        return response()->json($courses);
    }

    public function store(Request $request, $semesterId)
    {
        $semester = Semester::where('user_id', $request->user()->id)
            ->findOrFail($semesterId);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'credits' => 'nullable|integer',
            'lecturer' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $course = Course::create([
            'semester_id' => $semesterId,
            'name' => $request->name,
            'code' => $request->code,
            'credits' => $request->credits,
            'lecturer' => $request->lecturer,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Course created successfully',
            'course' => $course
        ], 201);
    }

    public function show(Request $request, $semesterId, $id)
    {
        $semester = Semester::where('user_id', $request->user()->id)
            ->findOrFail($semesterId);

        $course = Course::where('semester_id', $semesterId)
            ->with('materials')
            ->findOrFail($id);

        return response()->json($course);
    }

    public function update(Request $request, $semesterId, $id)
    {
        $semester = Semester::where('user_id', $request->user()->id)
            ->findOrFail($semesterId);

        $course = Course::where('semester_id', $semesterId)
            ->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'code' => 'nullable|string|max:50',
            'credits' => 'nullable|integer',
            'lecturer' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $course->update($request->all());

        return response()->json([
            'message' => 'Course updated successfully',
            'course' => $course
        ]);
    }

    public function destroy(Request $request, $semesterId, $id)
    {
        $semester = Semester::where('user_id', $request->user()->id)
            ->findOrFail($semesterId);

        $course = Course::where('semester_id', $semesterId)
            ->findOrFail($id);

        $course->delete();

        return response()->json([
            'message' => 'Course deleted successfully'
        ]);
    }
}