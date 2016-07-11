<?php

namespace App\Listeners;

use App\Events\UserBookingEvent;
use App\Events\UserContactEvent;
use App\Events\UserCreateEvent;
use App\Models\Booking;
use App\Models\Setting\Contact;
use Illuminate\Support\Facades\Redirect;
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
            $message->cc(env('MAIL_CC1'));
            $message->cc(env('MAIL_CC2'));
        });
    }

    public function onUserBooking($event)
    {
        $booking_id = $event->booking_id;
        $booking = Booking::with('court','court.club','court.surface')->where(['bookings.id'=>$booking_id])->first();
        //$booking = Booking::with('court','court.club','court.surface')->where(['bookings.id'=>$booking_id,'bookings.player_id'=>$event->user_id])->first();
        $data['booking'] = $booking;
        Mail::send('home.bookings.print_confirmation',$data, function($message) use ($booking)
        {
            $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $message->to($booking['billing_info']['email'])->subject('Court Connect: Order#'.$booking['id']);
            $message->cc(env('MAIL_CC1'));
            $message->cc(env('MAIL_CC2'));
        });
    }

    public function onContactEvent($event)
    {
        $contact_id = $event->contact_id;
        $contact = Contact::where('id',$contact_id)->first();
        $text = 'Name: '.$contact->name."\n";
        $text .= 'Email: '.$contact->email."\n";
        $text .= 'Phone: '.$contact->phone."\n";
        $text .= 'Message: '.$contact->messages."\n";
        Mail::queue([],[], function($message) use($text)
        {
            $message->subject('Message Contact form Court-Connect');
            $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $message->to(env('MAIL_CC1'));
            $message->setBody($text);
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
        $events->listen(
            UserContactEvent::class,
            static::class . '@onContactEvent'
        );
    }

}
