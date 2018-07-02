<?php
use App\Http\Controllers\BotManController;
use Illuminate\Support\Facades\Log;

Log::debug('botman');

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->hears('It just works', function($bot) {
    $bot->reply('Yep 🤘');
});