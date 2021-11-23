<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PaymentNotification;

class Relaunch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parent:relaunch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Relaunch notification';

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
        $ntf = new PaymentNotification();
        $ntf->sendNotification("Rappel","Rappel de paiment","Payment");

        
    }
}
