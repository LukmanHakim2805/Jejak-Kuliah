<?php
namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $videos = Video::where('user_id', $request->user()->id)
            ->with('course')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($videos);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
            'platform' => 'nullable|in:youtube,vimeo,local',
            'duration' => 'nullable|integer',
            'thumbnail' => 'nullable|url',
            'course_id' => 'nullable|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $video = Video::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'platform' => $request->platform ?? 'youtube',
            'duration' => $request->duration,
            'thumbnail' => $request->thumbnail,
            'course_id' => $request->course_id,
        ]);

        return response()->json([
            'message' => 'Video created successfully',
            'video' => $video
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $video = Video::where('user_id', $request->user()->id)
            ->with('course')
            ->findOrFail($id);

        return response()->json($video);
    }

    public function update(Request $request, $id)
    {
        $video = Video::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'url' => 'sometimes|url',
            'platform' => 'nullable|in:youtube,vimeo,local',
            'duration' => 'nullable|integer',
            'thumbnail' => 'nullable|url',
            'course_id' => 'nullable|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $video->update($request->all());

        return response()->json([
            'message' => 'Video updated successfully',
            'video' => $video
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $video = Video::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $video->delete();

        return response()->json([
            'message' => 'Video deleted successfully'
        ]);
    }
}