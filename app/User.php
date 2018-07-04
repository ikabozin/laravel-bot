<?php

namespace App;

use BotMan\BotMan\Interfaces\UserInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'name', 'email', 'password',
        'fb_id',
        'first_name',
        'last_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function createFromIncomingMessage(UserInterface $user)
    {
        User::updateOrCreate(['fb_id' => $user->getId()], [
            'fb_id' => $user->getId(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            //'profile_pic' => $user->getProfilePic(),
            //'locale' => $user->getLocale(),
            //'gender' => $user->getGender(),
        ]);
    }

    /**
     * Subscribe user to newsletter
     *
     * @param string $facebookId
     */
    public static function subscribe(string $facebookId)
    {
        $user = User::where('fb_id', $facebookId)
            ->first();

        if ($user) {
            $user->subscribed = true;
            $user->save();
        }
    }

    /**
     * Unsubscribe user from newsletter
     *
     * @param string $facebookId
     */
    public static function unsubscribe(string $facebookId)
    {
        $user = User::where('fb_id', $facebookId)
            ->first();

        if ($user) {
            $user->subscribed = false;
            $user->save();
        }
    }
}
