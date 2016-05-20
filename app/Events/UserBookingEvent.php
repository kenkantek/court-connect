<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserBookingEvent extends Event
{
    use SerializesModels;
    public $user_id;
    public $booking_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id,$booking_id)
    {
        $this->user_id = $user_id;
        $this->booking_id = $booking_id;
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
