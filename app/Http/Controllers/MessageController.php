<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function groupChat()
    {
        $currentUser = Auth::user();
        $conversation = Conversation::where('type', 'group')->first();
        if (!$conversation) {
            $conversation = Conversation::create(['name' => 'Chat Général', 'type' => 'group']);
        }
        if (!$conversation->users->contains($currentUser->id)) {
            $conversation->users()->attach($currentUser->id);
        }
        $messages = $conversation->messages()->with('sender')->latest()->take(50)->get()->reverse();
        $users = User::where('id', '!=', $currentUser->id)->get();
        return view('chat.group', compact('conversation', 'messages', 'users'));
    }

    public function privateChat(User $user)
    {
        $currentUser = Auth::user();
        $conversation = Conversation::where('type', 'private')
            ->whereHas('users', fn($q) => $q->where('user_id', $currentUser->id))
            ->whereHas('users', fn($q) => $q->where('user_id', $user->id))
            ->first();
        if (!$conversation) {
            $conversation = Conversation::create(['type' => 'private']);
            $conversation->users()->attach([$currentUser->id, $user->id]);
        }
        $messages = $conversation->messages()->with('sender')->latest()->take(50)->get()->reverse();
        $conversation->users()->updateExistingPivot($currentUser->id, ['last_read_at' => now()]);
        $users = User::where('id', '!=', $currentUser->id)->get();
        return view('chat.private', compact('conversation', 'messages', 'user', 'users'));
    }

    public function sendGroup(Request $request)
    {
        $request->validate(['content' => 'required|string|max:1000']);
        $conversation = Conversation::where('type', 'group')->first();
        $message = Message::create([
            'sender_id'       => Auth::id(),
            'conversation_id' => $conversation->id,
            'type'            => 'group',
            'content'         => $request->content,
        ]);
        broadcast(new MessageSent($message))->toOthers();
        return response()->json([
            'id'         => $message->id,
            'content'    => $message->content,
            'sender_id'  => $message->sender_id,
            'created_at' => $message->created_at->format('H:i'),
        ]);
    }

    public function sendPrivate(Request $request, User $user)
    {
        $request->validate(['content' => 'required|string|max:1000']);
        $currentUser = Auth::user();
        $conversation = Conversation::where('type', 'private')
            ->whereHas('users', fn($q) => $q->where('user_id', $currentUser->id))
            ->whereHas('users', fn($q) => $q->where('user_id', $user->id))
            ->first();
        if (!$conversation) {
            $conversation = Conversation::create(['type' => 'private']);
            $conversation->users()->attach([$currentUser->id, $user->id]);
        }
        $message = Message::create([
            'sender_id'       => $currentUser->id,
            'receiver_id'     => $user->id,
            'conversation_id' => $conversation->id,
            'type'            => 'private',
            'content'         => $request->content,
        ]);
        broadcast(new MessageSent($message))->toOthers();
        return response()->json([
            'id'         => $message->id,
            'content'    => $message->content,
            'sender_id'  => $message->sender_id,
            'created_at' => $message->created_at->format('H:i'),
        ]);
    }

    public function unreadCount()
    {
        $count = Message::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();
        return response()->json(['count' => $count]);
    }

    public function usersStatus()
    {
        $currentUser = Auth::user();
        $users = User::where('id', '!=', $currentUser->id)->get()->map(function ($user) use ($currentUser) {
            $unread = Message::where('sender_id', $user->id)
                ->where('receiver_id', $currentUser->id)
                ->where('is_read', false)
                ->count();

            return [
                'id'       => $user->id,
                'name'     => $user->name,
                'initials' => strtoupper(substr($user->name, 0, 2)),
                'online'   => $user->updated_at->gt(now()->subMinutes(5)),
                'unread'   => $unread,
                'role'     => $user->role,
            ];
        });

        $totalUnread = Message::where('receiver_id', $currentUser->id)
            ->where('is_read', false)
            ->count();

        return response()->json([
            'users'        => $users,
            'total_unread' => $totalUnread,
        ]);
    }

    // ✅ NOUVELLE MÉTHODE 1 — Récupérer messages privés pour le drawer
    public function getPrivateMessages(User $user)
    {
        $currentUser = Auth::user();

        $conversation = Conversation::where('type', 'private')
            ->whereHas('users', fn($q) => $q->where('user_id', $currentUser->id))
            ->whereHas('users', fn($q) => $q->where('user_id', $user->id))
            ->first();

        if (!$conversation) {
            return response()->json(['messages' => []]);
        }

        $messages = $conversation->messages()
            ->with('sender')
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values()
            ->map(fn($msg) => [
                'id'          => $msg->id,
                'content'     => $msg->content,
                'sender_id'   => $msg->sender_id,
                'sender_name' => $msg->sender->name ?? '',
                'created_at'  => $msg->created_at->format('H:i'),
            ]);

        return response()->json(['messages' => $messages]);
    }

    // ✅ NOUVELLE MÉTHODE 2 — Récupérer messages groupe pour le drawer
    public function getGroupMessages()
    {
        $currentUser = Auth::user();

        $conversation = Conversation::where('type', 'group')->first();

        if (!$conversation) {
            return response()->json(['messages' => []]);
        }

        // Ajouter l'utilisateur au groupe s'il n'y est pas
        if (!$conversation->users->contains($currentUser->id)) {
            $conversation->users()->attach($currentUser->id);
        }

        $messages = $conversation->messages()
            ->with('sender')
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values()
            ->map(fn($msg) => [
                'id'          => $msg->id,
                'content'     => $msg->content,
                'sender_id'   => $msg->sender_id,
                'sender_name' => $msg->sender->name ?? '',
                'created_at'  => $msg->created_at->format('H:i'),
            ]);

        return response()->json(['messages' => $messages]);
    }

    // ✅ NOUVELLE MÉTHODE 3 — Marquer les messages comme lus
    public function markAsRead(User $user)
    {
        Message::where('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}