<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;



use App\Post;

class OrderShipped
{
    use SerializesModels;

    public $post;

    /**
     * Create a new event instance.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->order = $post;
    }
}
