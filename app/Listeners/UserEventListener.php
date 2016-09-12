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
use Exception;

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
        $user_id = $event->user_id;
        if($event->admin_book)
            $check_booking = Booking::where(['id'=>$booking_id])->first();
        else
            $check_booking = Booking::where(['id'=>$booking_id, 'player_id' => Auth::user()->id])->first();
        $booking = Booking::join('courts', 'courts.id', '=', 'bookings.court_id')
            ->join('clubs', 'clubs.id', '=', 'courts.club_id');

        if(!$event->admin_book)
            $booking = $booking->where('player_id', Auth::user()->id);

        $booking = $booking->where('bookings.token_booking', $check_booking->token_booking)
            ->orderBy('created_at', 'desc')
            ->groupBy('token_booking')
            ->selectRaw('bookings.*, group_concat(DISTINCT courts.name SEPARATOR \', \') as court_name, clubs.id as club_id, 
            clubs.image as club_image, clubs.name as club_name, clubs.address as club_address')
            ->first();

        //$booking = Booking::with('court','court.club','court.surface')->where(['bookings.id'=>$booking_id,'bookings.player_id'=>$event->user_id])->first();
        $data['booking'] = $booking;
        try {
            Mail::send('home.bookings.send_mail', $data, function ($message) use ($booking) {
                $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
                $message->to($booking['billing_info']['email'])->subject('Court Connect: Order#' . $booking['id']);
                $message->cc(env('MAIL_CC1'));
                $message->cc(env('MAIL_CC2'));
            });
        }catch(Exception $e){}
    }

    public function onContactEvent($event)
    {
        $contact_id = $event->contact_id;
        $contact = Contact::where('id',$contact_id)->first();
        
        Mail::send('home.users.emails.contact', ['contact' => $contact], function ($message) use ($contact) {
            $message->subject('Message Contact from Court Connect');
            $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $message->to(env('MAIL_CC1'));
            $message->cc(env('MAIL_CC2'));
            $message->bcc(env('MAIL_test'));
            //$message->cc('support@court-connect.com');
            //$message->cc(env('raykap@yahoo.com'));
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
