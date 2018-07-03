<?php
use App\Http\Controllers\BotManController;
use BotMan\BotMan\BotMan;

$botman = resolve('botman');

$botman->hears('Hi', function (BotMan $bot) {
    $bot->reply('Hello!');
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->hears('It just works', function(BotMan $bot) {
    $bot->reply('Yep 🤘');
});

$botman->hears('GET_STARTED', function (BotMan $bot) {
    $bot->reply('Welcome!');
});