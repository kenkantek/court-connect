<?php

namespace App\Listeners;

use App\Events\UserAcceptFriendEvent;
use App\Events\UserAddFriendEvent;
use App\Events\UserBookingEvent;
use App\Events\UserCreateEvent;
use App\Events\UserEventFollowing;
use App\Events\UserPostChatEvent;
use App\Events\UserPostFeedEvent;
use App\Models\Booking;
use Illuminate\Support\Facades\Redirect;
use App\Feed;
use App\User;
use Caffeinated\Flash\Facades\Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserEventListener
{


    public function onUserCreated($event)
    {
        $user = $event->user->toArray();
        Mail::send('home.users.emails.user_create', ['data' => $user], function ($message) use ($user) {
            $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $message->to($user['email'])
                ->subject('Verify your email address');
        });
    }

    public function onUserBooking($event)
    {
        $booking_id = $event->booking_id;
        $booking = Booking::with('court','court.club','court.surface')->where(['bookings.id'=>$booking_id,'bookings.player_id'=>$event->user_id])->first();
        $data['booking'] = $booking;
        Mail::send('home.bookings.print_confirmation',$data, function($message) use ($booking)
        {
            $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $message->to($booking['billing_info']['email'])->subject('Court Connect: Order');
        });
    }

    public function subscribe($events)
    {
        $events->listen(
            UserCreateEvent::class,
            static::class . '@onUserCreated'
        );
        $events->listen(
            UserBookingEvent::class,
            static::class . '@onUserBooking'
        );
    }

}
