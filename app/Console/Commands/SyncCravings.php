<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Craving;
use App\Food;
use Parse\ParseQuery;

class SyncCravings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cravity:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync cravings with cravity';

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
        //
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
           $craving->save();
          
        }
    }
}
