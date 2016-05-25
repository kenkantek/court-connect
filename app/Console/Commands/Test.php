<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a test.';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire(){
        Mail::raw('Text to e-mail', function ($message) {
            $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
            $message->to("luongconghieu93@gmail.com")
                ->subject('Test send email');
        });
    }

}
