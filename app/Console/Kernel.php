<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Craving;
use App\Food;
use Parse\ParseQuery;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        // Get all cravings
        $craving_query = new ParseQuery("Craving");
        $results = $craving_query->limit(1000000)->find();
        foreach($results as $_craving) {
          
           $craving = Craving::firstOrNew(array('parse_id' => (string)$_craving->getObjectId()));
           $craving->status = $_craving->get('statusCode');

           $craving->reason_id = $_craving->get('reason');
           $craving->time = $_craving->get('time');
           $craving->food_id = $_craving->get('food');
           $craving->action_id = $_craving->get('action');
           $craving->toothbrush = $_craving->get('toothbrush');
           var_dump($craving);
           $craving->save();
          
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
