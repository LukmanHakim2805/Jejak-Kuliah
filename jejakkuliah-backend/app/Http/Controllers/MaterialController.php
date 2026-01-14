<?php
namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Course;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    public function store(Request $request, $semesterId, $courseId)
    {
        $semester = Semester::where('user_id', $request->user()->id)
            ->findOrFail($semesterId);

        $course = Course::where('semester_id', $semesterId)
            ->findOrFail($courseId);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|in:lecture,journal,video,book',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // max 10MB
            'url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $filePath = null;
        $fileType = null;
        $fileSize = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('materials', 'public');
            $fileType = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();
        }

        $material = Material::create([
            'course_id' => $courseId,
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'file_path' => $filePath,
            'file_type' => $fileType,
            'file_size' => $fileSize,
            'url' => $request->url,
        ]);

        return response()->json([
            'message' => 'Material created successfully',
            'material' => $material
        ], 201);
    }

    public function destroy(Request $request, $semesterId, $courseId, $id)
    {
        $semester = Semester::where('user_id', $request->user()->id)
            ->findOrFail($semesterId);

        $course = Course::where('semester_id', $semesterId)
            ->findOrFail($courseId);

        $material = Material::where('course_id', $courseId)
            ->findOrFail($id);

        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();

        return response()->json([
            'message' => 'Material deleted successfully'
        ]);
    }
}