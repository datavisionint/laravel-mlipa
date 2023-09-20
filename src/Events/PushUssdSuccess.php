<?php

namespace DatavisionInt\Mlipa\Events;

use DatavisionInt\Mlipa\Contracts\MlipaWebhookEvent;
use DatavisionInt\Mlipa\MlipaWebhookEventData;
use DatavisionInt\Mlipa\Traits\HasMlipaWebhookEventData;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PushUssdSuccess  implements MlipaWebhookEvent
{

    use Dispatchable, InteractsWithSockets, SerializesModels, HasMlipaWebhookEventData;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public MlipaWebhookEventData $data
    )
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
