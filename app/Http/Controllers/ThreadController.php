<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThreadController extends Controller
{
    // Menampilkan semua thread
    public function index()
    {
        $threads = Thread::all();

        if ($threads->isEmpty()) {
            return response()->json(['error' => 'No threads found'], 404);
        }

        return response()->json($threads, 200);
    }

    // Menampilkan thread berdasarkan ID
    public function show($id)
    {
        $thread = Thread::find($id);

        if (!$thread) {
            return response()->json(['error' => 'Thread not found'], 404);
        }

        return response()->json($thread, 200);
    }

    // Membuat thread baru
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Membuat thread baru
        $thread = Thread::create([
            'user_id' => $request->user_id,
            'content' => $request->content,
        ]);

        return response()->json($thread, 201);
    }

    // Mengupdate thread
    public function update(Request $request, $id)
    {
        $thread = Thread::find($id);

        if (!$thread) {
            return response()->json(['error' => 'Thread not found'], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update thread
        $thread->update([
            'content' => $request->content,
        ]);

        return response()->json($thread, 200);
    }

    // Menghapus thread
    public function destroy($id)
    {
        $thread = Thread::find($id);

        if (!$thread) {
            return response()->json(['error' => 'Thread not found'], 404);
        }

        $thread->delete();
        return response()->json(['message' => 'Thread deleted successfully'], 200);
    }
}