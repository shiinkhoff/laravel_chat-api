<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{
    // List all conversations
    public function index()
    {
        return response()->json(Conversation::all(), 200);
    }

    // Show single conversation
    public function show($id)
    {
        $conversation = Conversation::find($id);
        if (!$conversation) {
            return response()->json(['error' => 'Conversation not found'], 404);
        }
        return response()->json($conversation, 200);
    }

    // Create new conversation
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user1_id' => 'required|exists:users,id',
            'user2_id' => 'required|exists:users,id|different:user1_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Cegah duplikasi
        $existing = Conversation::where(function ($q) use ($request) {
            $q->where('user1_id', $request->user1_id)
              ->where('user2_id', $request->user2_id);
        })->orWhere(function ($q) use ($request) {
            $q->where('user1_id', $request->user2_id)
              ->where('user2_id', $request->user1_id);
        })->first();

        if ($existing) {
            return response()->json(['error' => 'Conversation already exists'], 409);
        }

        $conversation = Conversation::create($request->only('user1_id', 'user2_id'));
        return response()->json($conversation, 201);
    }

    // Update conversation
    public function update(Request $request, $id)
    {
        $conversation = Conversation::find($id);
        if (!$conversation) {
            return response()->json(['error' => 'Conversation not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'user1_id' => 'required|exists:users,id',
            'user2_id' => 'required|exists:users,id|different:user1_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $conversation->update($request->only('user1_id', 'user2_id'));
        return response()->json($conversation, 200);
    }

    // Delete conversation
    public function destroy($id)
    {
        $conversation = Conversation::find($id);
        if (!$conversation) {
            return response()->json(['error' => 'Conversation not found'], 404);
        }

        $conversation->delete();
        return response()->json(['message' => 'Conversation deleted'], 200);
    }
}