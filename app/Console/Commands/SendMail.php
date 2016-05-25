<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     *
     * @return mixed
     */
    public function handle()
    {
        $date_current = Carbon::now();
        $bookings_today = Booking::orWhere(function($q) use ($date_current) {
            $q->where('date', $date_current->format('Y/m/d'))
                ->where(function($query) use ($date_current) {
                    $query->orWhere('hour', '>=', $date_current->hour)
                        ->orWhere('hour', '>=', $date_current->hour);
                });
        })
            ->orWhere('date', $date_current->subDays(5)->format('Y/m/d'))
            ->get();

        foreach($bookings_today as $booking){
            $data['booking'] = $booking;
            Mail::send('home.bookings.print_confirmation',$data, function($message) use ($booking)
            {
                $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
                $message->to($booking['billing_info']['email'])->subject('Court Connect: Order#'.$booking['id']);
            });
        }
        \Log::info("Begin schedule send mail: ". \Carbon\Carbon::now());
    }
}
