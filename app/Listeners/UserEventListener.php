<?php

namespace App\Listeners;

use App\Events\UserAcceptFriendEvent;
use App\Events\UserAddFriendEvent;
use App\Events\UserCreateEvent;
use App\Events\UserEventFollowing;
use App\Events\UserPostChatEvent;
use App\Events\UserPostFeedEvent;
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
        Mail::send('email.user_create', ['data' => $user], function ($message) use ($user) {
            $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $message->to($user['email'])
                ->subject('Verify your email address');
            Flash::success('Thanks for signing up! Please check your email.');
        });
        return Redirect::to('profile/message');

    }
    public function subscribe($events)
    {
        $events->listen(
            UserCreateEvent::class,
            static::class . '@onUserCreated'
        );
    }

}
