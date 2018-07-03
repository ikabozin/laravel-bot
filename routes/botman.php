<?php
use App\Http\Controllers\BotManController;
use App\Http\Conversations\SubscribeConversation;
use BotMan\BotMan\BotMan;

$botman = resolve('botman');

$botman->hears('Hi', function (BotMan $bot) {
    $bot->reply('Hello!');
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->hears('It just works', function(BotMan $bot) {
    $bot->reply('Yep 🤘');
});

$botman->hears('GET_STARTED|subscribe', function (BotMan $bot) {
    $userFromStartButton = $bot->getMessage()->getText() === 'GET_STARTED' ? true : false;
    $bot->startConversation(new SubscribeConversation($userFromStartButton));
});