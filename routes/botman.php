<?php
use App\Http\Controllers\BotManController;
use App\Http\Conversations\SubscribeConversation;
use BotMan\BotMan\BotMan;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;

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

$botman->fallback(function(BotMan $bot) {
    $bot->reply('Hey!');
    $bot->typesAndWaits(1);
    $bot->reply('I see those words of yours, but I have no idea what they mean. 🤔');
    $bot->typesAndWaits(1);
    $bot->reply('Christoph said I need to focus on telling you about his book development for now. Maybe later he will train me to understand your messages as well. I hope so ☺️');

    $bot->typesAndWaits(1);

    $question = ButtonTemplate::create('Here is how I can help you:')->addButtons([
        ElementButton::create('💌 Edit subscription')->type('postback')->payload('subscribe'),
        ElementButton::create('👉 Christoph\'s Blog')->url('https://christoph-rumpel.com/')
    ]);

    $bot->reply($question);

});