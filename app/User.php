<?php

namespace App;

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
        'name', 'email', 'password',
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

    public static function createFromIncomingMessage(\BotMan\Drivers\Facebook\Extensions\User $user)
    {
        User::updateOrCreate(['fb_id' => $user->getId()], [
            'fb_id' => $user->getId(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'name' => $user->getUsername(),
            //'profile_pic' => $user->getProfilePic(),
            //'locale' => $user->getLocale(),
            //'gender' => $user->getGender(),
        ]);
    }
}
