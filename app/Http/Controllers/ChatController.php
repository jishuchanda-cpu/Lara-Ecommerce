<?php

namespace App\Http\Controllers;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function conversations(): JsonResponse
    {
        $conversations = Auth::user()->chatConversations()
            ->withCount('messages')
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()->json($conversations);
    }

    public function createConversation(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'system_prompt' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $conversation = Auth::user()->chatConversations()->create([
            'title' => $request->title ?? 'New Chat',
            'system_prompt' => $request->system_prompt ?? 'You are a helpful AI assistant.',
        ]);

        return response()->json($conversation, 201);
    }

    public function messages(ChatConversation $conversation): JsonResponse
    {
        if ($conversation->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messages = $conversation->messages()->get();
        return response()->json($messages);
    }

    public function sendMessage(Request $request, ChatConversation $conversation): JsonResponse
    {
        if ($conversation->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:4000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $userMessage = $conversation->messages()->create([
            'role' => 'user',
            'content' => $request->message,
        ]);

        $conversation->touch();

        $aiResponse = $this->getAIResponse($conversation);

        if ($aiResponse) {
            $assistantMessage = $conversation->messages()->create([
                'role' => 'assistant',
                'content' => $aiResponse,
                'metadata' => ['model' => 'gpt-3.5-turbo'],
            ]);

            return response()->json([
                'user_message' => $userMessage,
                'assistant_message' => $assistantMessage,
            ]);
        }

        return response()->json(['error' => 'Failed to get AI response'], 500);
    }

    private function getAIResponse(ChatConversation $conversation): ?string
    {
        $messages = $conversation->messages()
            ->orderBy('created_at')
            ->get(['role', 'content'])
            ->toArray();

        $apiKey = config('services.openai.api_key');
        if (!$apiKey) {
            return "I'm sorry, but I'm not configured to respond at the moment. Please set up your OpenAI API key in your .env file.";
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post(config('services.openai.api_url') . '/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => $messages,
                'max_tokens' => 1000,
                'temperature' => 0.7,
            ]);

            if ($response->status() === 200) {
                $data = $response->json();
                return $data['choices'][0]['message']['content'] ?? "I received a response but couldn't parse it properly.";
            }

            if ($response->status() === 401) {
                return "There's an issue with the OpenAI API key. Please check your configuration.";
            }

            if ($response->status() === 429) {
                return "I'm receiving too many requests right now. Please wait a moment and try again.";
            }

            return "I'm having trouble processing your request right now. Please try again later.";
        } catch (\Exception $e) {
            return "I'm experiencing technical difficulties. Please try again later.";
        }
    }

    public function deleteConversation(ChatConversation $conversation): JsonResponse
    {
        if ($conversation->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $conversation->delete();
        return response()->json(null, 204);
    }

    public function updateConversationTitle(Request $request, ChatConversation $conversation): JsonResponse
    {
        if ($conversation->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $conversation->update(['title' => $request->title]);
        return response()->json($conversation);
    }
}
