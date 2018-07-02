<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use App\Conversations\ExampleConversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle(Request $request)
    {
        Log::debug(json_encode($request->all()));

        $botman = app('botman');

        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
    }
}
