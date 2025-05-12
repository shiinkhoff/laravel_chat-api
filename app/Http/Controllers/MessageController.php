<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    // Menampilkan semua pesan dalam percakapan
    public function index()
    {
        $messages = Messages::all();

        return response()->json($messages, 200);
    }

    // Menampilkan pesan berdasarkan ID
    public function show($id)
    {
        $message = Messages::find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        return response()->json($message, 200);
    }

    // Membuat pesan baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conversation_id' => 'required|exists:conversations,id',
            'sender_id' => 'required|exists:users,id',
            'message' => 'nullable|string',
            'image_url' => 'nullable|url',
            'is_read' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $message = Messages::create([
            'conversation_id' => $request->conversation_id,
            'sender_id' => $request->sender_id,
            'message' => $request->message,
            'image_url' => $request->image_url,
            'is_read' => $request->is_read,
        ]);

        return response()->json($message, 201);
    }

    // Mengupdate pesan
    public function update(Request $request, $id)
    {
        $message = Messages::find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'message' => 'nullable|string',
            'image_url' => 'nullable|url',
            'is_read' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $message->update([
            'message' => $request->message ?? $message->message,
            'image_url' => $request->image_url ?? $message->image_url,
            'is_read' => $request->has('is_read') ? $request->is_read : $message->is_read,
        ]);

        return response()->json($message, 200);
    }

    // Menghapus pesan
    public function destroy($id)
    {
        $message = Messages::find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $message->delete();
        return response()->json(['message' => 'Message deleted successfully'], 200);
    }
}
