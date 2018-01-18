<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Roaming;
use Illuminate\Http\Request;

class CravingStatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $group_by = array();
        
        $groups = explode(',', $request->query('group_by'));
        $start_date = $request->query('start', 'NOW() - INTERVAL 28 DAY');

        $end_date = $request->query('end', 'NOW()');
        $allowed_groups = ['date', 'time_of_day', 'food', 'reason', 'action', 'status', 'month', 'date', 'week', 'weekday', 'hour'];
        $select = array();
        foreach($groups as $group) {
            if (in_array($group, $allowed_groups)) {
               
                $group_by[] = '`' . $group . '`';
                if ($group == 'date') {
                    $select[] = "DATE_FORMAT(time, '%Y-%m-%d') AS `date`";
                }
                if ($group == 'month') {
                    $select[] = "DATE_FORMAT(time, '%Y-%m') AS `month`";
                }
                if ($group == 'status') {
                    $select[] = "MIN(status) AS status";
                }
                if ($group == 'day_of_week') {
                    $select[] = "DAYOFWEEK(time) AS `day_of_week`";
                }
                if ($group == 'weekday') {
                    $select[] = "DAYNAME(time) AS `weekday`";
                }
                if ($group == 'week') {
                    $select[] = "WEEKOFYEAR(time) AS `week`";
                }
                if ($group == 'hour') {
                    $select[] = "MIN(HOUR(time)) AS `hour`"; 
                }
                if ($group == 'day_of_month') {
                    $select[] = "MIN(DAYOFMONTH(time)) AS day_of_month";
                }
                if ($group == 'food') {
                    $select[] = "food_id AS food";
                }
                if ($group == 'reason') {
                    $select[] = "reason_id AS reason";
                }
                if ($group == 'action') {
                    $select[] = "action_id AS action";
                }
            }
        }
        $sql = "SELECT count(*) FROM cravings WHERE status BETWEEN 200 AND 299 AND food_id <> 'vegetables' AND DAY(time) = DAY(db_date) ";
        $unhealthy = DB::select("SELECT ($sql) AS qty, db_date AS date FROM time_dimension WHERE db_date BETWEEN '$start_date' AND '$end_date'"); 
        $sql = "SELECT count(*) FROM cravings WHERE status BETWEEN 200 AND 299 AND food_id = 'vegetables' AND DAY(time) = DAY(db_date) ";
        
        $healthy = DB::select("SELECT ($sql) AS qty, db_date AS date FROM time_dimension WHERE db_date BETWEEN '$start_date' AND '$end_date'");
        return response()->json(compact('healthy', 'unhealthy'), 200);
    }
    
    public function destroy($id)
    {
        Saving::destroy($id);

        return redirect('dashboard/savings')->with('flash_message', 'Saving deleted!');
    }
}