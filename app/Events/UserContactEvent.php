<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserContactEvent extends Event
{
    use SerializesModels;
    public $contact_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($contact_id)
    {
        $this->contact_id = $contact_id;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
