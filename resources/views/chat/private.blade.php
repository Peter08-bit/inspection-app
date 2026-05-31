@extends('layouts.app')
@section('title', 'Chat avec ' . $user->name)
@section('page-title', 'Chat Privé 🔒')

@section('content')
<div class="flex gap-4 h-[calc(100vh-12rem)]">

    <!-- Liste utilisateurs -->
    <div class="w-64 bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm flex flex-col">
        <div class="px-4 py-3 border-b border-orange-100 dark:border-orange-900">
            <h3 class="font-semibold text-gray-800 dark:text-white text-sm">👥 Conversations</h3>
        </div>
        <div class="flex-1 overflow-y-auto p-3 space-y-2">
            @foreach($users as $u)
            <a href="{{ route('chat.private', $u) }}"
               class="flex items-center gap-3 p-2 rounded-xl transition {{ $u->id === $user->id ? 'bg-orange-100 dark:bg-orange-900/50' : 'hover:bg-orange-50 dark:hover:bg-orange-900/30' }}">
                <div class="w-8 h-8 rounded-full bg-orange-100 dark:bg-orange-900 flex items-center justify-center text-orange-600 dark:text-orange-400 font-bold text-xs">
                    {{ strtoupper(substr($u->name, 0, 2)) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $u->name }}</p>
                    <p class="text-xs text-orange-500">{{ ucfirst($u->role) }}</p>
                </div>
            </a>
            @endforeach
        </div>
        <div class="p-3 border-t border-orange-100 dark:border-orange-900">
            <a href="{{ route('chat.group') }}"
               class="flex items-center gap-2 p-2 rounded-xl bg-orange-500 text-white text-sm font-medium justify-center">
                💬 Chat Général
            </a>
        </div>
    </div>

    <!-- Zone Chat -->
    <div class="flex-1 bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm flex flex-col">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-orange-100 dark:border-orange-900 flex items-center gap-3">
            <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900 rounded-xl flex items-center justify-center text-orange-600 dark:text-orange-400 font-bold">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            <div>
                <h3 class="font-semibold text-gray-800 dark:text-white">{{ $user->name }}</h3>
                <p class="text-xs text-green-500">● En ligne</p>
            </div>
        </div>

        <!-- Messages -->
        <div id="messages-container" class="flex-1 overflow-y-auto p-4 space-y-3">
            @foreach($messages as $msg)
            <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-xs lg:max-w-md">
                    <div class="px-4 py-2 rounded-2xl {{ $msg->sender_id === auth()->id()
                        ? 'bg-orange-500 text-white rounded-tr-none'
                        : 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-tl-none' }}">
                        <p class="text-sm">{{ $msg->content }}</p>
                        <p class="text-xs opacity-70 mt-1 text-right">{{ $msg->created_at->format('H:i') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Input -->
        <div class="px-4 py-3 border-t border-orange-100 dark:border-orange-900">
            <div class="flex gap-3 items-center">
                <input type="text" id="message-input" placeholder="Écrire un message..."
                    class="flex-1 px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition text-sm">
                <button id="send-btn"
                    class="bg-orange-500 hover:bg-orange-600 text-white p-2.5 rounded-xl transition shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    const currentUserId = {{ auth()->id() }};
    const receiverId = {{ $user->id }};
    const sendUrl = "{{ route('chat.private.send', $user) }}";
    const csrfToken = "{{ csrf_token() }}";

    const container = document.getElementById('messages-container');
    container.scrollTop = container.scrollHeight;

    const pusher = new Pusher("{{ config('reverb.apps.0.key', env('REVERB_APP_KEY')) }}", {
        wsHost: "{{ config('reverb.servers.reverb.host', '127.0.0.1') }}",
        wsPort: {{ config('reverb.servers.reverb.port', 8080) }},
        forceTLS: false,
        disableStats: true,
        enabledTransports: ['ws'],
    });

    const channelName = 'private-chat.' + Math.min(currentUserId, receiverId) + '.' + Math.max(currentUserId, receiverId);
    const channel = pusher.subscribe(channelName);
    channel.bind('message.sent', function(data) {
        if (data.sender_id !== currentUserId) {
            appendMessage(data, false);
        }
    });

    document.getElementById('send-btn').addEventListener('click', sendMessage);
    document.getElementById('message-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') sendMessage();
    });

    function sendMessage() {
        const input = document.getElementById('message-input');
        const content = input.value.trim();
        if (!content) return;

        fetch(sendUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ content }),
        })
        .then(res => res.json())
        .then(data => {
            appendMessage(data, true);
            input.value = '';
        });
    }

    function appendMessage(data, isMine) {
        const div = document.createElement('div');
        div.className = `flex ${isMine ? 'justify-end' : 'justify-start'}`;
        div.innerHTML = `
            <div class="max-w-xs lg:max-w-md">
                <div class="px-4 py-2 rounded-2xl ${isMine ? 'bg-orange-500 text-white rounded-tr-none' : 'bg-gray-100 text-gray-800 rounded-tl-none'}">
                    <p class="text-sm">${data.content}</p>
                    <p class="text-xs opacity-70 mt-1 text-right">${data.created_at}</p>
                </div>
            </div>
        `;
        container.appendChild(div);
        container.scrollTop = container.scrollHeight;
    }
</script>
@endpush
@endsection
