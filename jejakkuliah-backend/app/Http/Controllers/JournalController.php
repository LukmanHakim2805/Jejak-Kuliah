<?php
namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        $journals = Journal::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($journals);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'authors' => 'nullable|string',
            'journal_name' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'doi' => 'nullable|string|max:255',
            'abstract' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('journals', 'public');
        }

        $journal = Journal::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'authors' => $request->authors,
            'journal_name' => $request->journal_name,
            'publication_year' => $request->publication_year,
            'doi' => $request->doi,
            'abstract' => $request->abstract,
            'file_path' => $filePath,
        ]);

        return response()->json([
            'message' => 'Journal created successfully',
            'journal' => $journal
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $journal = Journal::where('user_id', $request->user()->id)
            ->findOrFail($id);

        return response()->json($journal);
    }

    public function update(Request $request, $id)
    {
        $journal = Journal::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'authors' => 'nullable|string',
            'journal_name' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'doi' => 'nullable|string|max:255',
            'abstract' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('file')) {
            if ($journal->file_path) {
                Storage::disk('public')->delete($journal->file_path);
            }
            $journal->file_path = $request->file('file')->store('journals', 'public');
        }

        $journal->update($request->except('file'));

        return response()->json([
            'message' => 'Journal updated successfully',
            'journal' => $journal
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $journal = Journal::where('user_id', $request->user()->id)
            ->findOrFail($id);

        if ($journal->file_path) {
            Storage::disk('public')->delete($journal->file_path);
        }

        $journal->delete();

        return response()->json([
            'message' => 'Journal deleted successfully'
        ]);
    }
}

