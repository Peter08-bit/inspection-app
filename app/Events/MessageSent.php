<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Message $message)
    {
        $this->message->load('sender');
    }

    public function broadcastOn(): array
    {
        if ($this->message->type === 'group') {
            return [new Channel('group-chat')];
        }

        return [
            new PrivateChannel('chat.' . min($this->message->sender_id, $this->message->receiver_id) . '.' . max($this->message->sender_id, $this->message->receiver_id)),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'id'         => $this->message->id,
            'content'    => $this->message->content,
            'type'       => $this->message->type,
            'sender_id'  => $this->message->sender_id,
            'sender'     => [
                'id'   => $this->message->sender->id,
                'name' => $this->message->sender->name,
            ],
            'created_at' => $this->message->created_at->format('H:i'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'message.sent';
    }
}