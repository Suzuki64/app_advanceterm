<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRemindMail;
use App\Models\Reserve;
use Carbon\Carbon;


class RemindMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remindmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SendRemindMail';

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
     * @return int
     */
    public function handle()
    {
        $reserves = Reserve::where('date','=',new Carbon('today'));
        
        if($reserves->exists()){

            $data = $reserves->with(['user','shop'])->get();
            foreach($data as $datum){
                Mail::to($datum->user->email)->send(new SendRemindMail($datum));
            }
            return;
        }
    }
}
