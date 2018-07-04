<?php

namespace Tests\BotMan;

use Tests\TestCase;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;

class SubscribeConversationTest extends TestCase
{
    /**
     * @test
     */
    public function it_welcomes_user_at_start()
    {
        $this->bot->receives('GET_STARTED')
            ->assertReply('Hey and welcome! 👋')
            ->assertReply('I help Christoph to spread some news about his book development. 📘');
    }

    /**
     * @test
     **/
    public function it_subscribes_a_user()
    {
        $this->bot->receives('subscribe')
            ->assertReply('I help Christoph to spread some news about his book development. 📘')
            ->assertReply('If you like, I can keep you updated about it here on Facebook Messenger. (1-2 times a month)')
            ->assertReply("In order to work I will store your name and Facebook ID. Please make sure to read the short and easy to read privacy policy for more information(1-2min): \nhttps://christoph-rumpel.com/policy-newsletterchatbot")
            ->assertQuestion('Are you in?')
            ->receives('yes')
            ->assertReply('Woohoo, great to have you on board! 🎉')
            ->assertReply('I will message you when there is something new to tell ✌️')
            ->assertReply("Christoph also likes to blog a lot. Make sure to check out his site for more chatbot stuff: \n ✨ https://christoph-rumpel.com/ ✨ ")
            ->assertReply('See you! 👋');
    }

    /**
     * @test
     **/
    public function it_unsubscribes_a_user()
    {
        $this->bot->receives('subscribe')
            ->assertReply('I help Christoph to spread some news about his book development. 📘')
            ->assertReply("If you like, I can keep you updated about it here on Facebook Messenger. (1-2 times a month)")
            ->assertReply("In order to work I will store your name and Facebook ID. Please make sure to read the short and easy to read privacy policy for more information(1-2min): \nhttps://christoph-rumpel.com/policy-newsletterchatbot")
            ->assertQuestion('Are you in?')
            ->receives('no')
            ->assertReply('Ok no problem. If you change your mind, just type "subscribe" or use the menu.')
            ->assertReply("Christoph also likes to blog a lot. Make sure to check out his site for more chatbot stuff: \n ✨ https://christoph-rumpel.com/ ✨ ")
            ->assertReply('See you! 👋');
    }
}
