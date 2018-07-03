<?php

namespace App\Console\Commands;

use App\User;
use BotMan\Drivers\Facebook\FacebookDriver;
use Illuminate\Console\Command;

class SendOutNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send newsletter to all subscribers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $botman = app('botman');

        $users = User::where('subscribed', true)->get();

        $users->each(function ($user) use ($botman){
            try {
                $botman->say('Hey ' .$user->first_name.' ...', $user->fb_id, FacebookDriver::class);
            } catch (\Exception $e) {
                $this->info('FAIL sending message to '.$user->fb_id);
                $this->info($e->getCode().': '.$e->getMessage());
            }
        });

        $this->info('Success.');
    }
}
