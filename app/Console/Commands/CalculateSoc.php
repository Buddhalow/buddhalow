<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Craving;
use App\Food;
use Parse\ParseQuery;
use App\SocState;
use App\Room;

class CalculateSoc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kasam:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syn KASAM state';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function calcluateSOC($now) {
        $soc->time = $now;
        
        $maximum_entropy = 7400;
        // Calculate cleaning
        $soc->entropy = 0;
        
        $rooms = array();
        foreach($_rooms as $room) {
            $harmony_balance = 0;
            $last_updated = $room->last_updated;
            if ($last_updated == NULL) {
                $last_updated = new \DateTime();
            } else {
                $last_updated = new \DateTime($room->last_updated);
            }
            $deterioration = ($now->diff($last_updated)->d * $room->deterioration_speed) + ($now->diff($last_updated)->h * ($room->deterioration_speed / 23));
            $room->balance -= $deterioration;
            
            $soc->yin += $room->balance * 0.9;
            
            $soc->entropy += ($now->diff($last_updated)->d * $room->deterioration_speed / 5) * $maximum_entropy;
            
            if ($now->diff($last_updated)->d > 0) {
                $room_snapshot = new RoomSnapshot();
                $room_snapshot->time = new \DateTime();
                $room_snapshot->balance = $room->balance;
                $room_snapshot->room_id = $room->slug;
                $room_snapshot->save();
            }
            
            $cleaning = Cleaning::where("room_id", $room->slug)->where('redeemed', false)->first();
            
            $soc->entropy -= (1-($now->diff($last_updated)->d / $room->deterioration_speed )) * $maximum_entropy;
            
            if ($cleaning != NULL) {
                $time = new \DateTime($cleaning->time);
                $relation = $time->diff(new \DateTime());
                $cleaning->redeemed = true;
                $cleaning->save();
                $room->balance += $cleaning->harmony;
            }
            
            $room->last_updated = new \DateTime();
            $room->save();
            
            $rooms[] = $room;
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $soc = new SocState;
        
        
        // Calculate number 
    }
}
