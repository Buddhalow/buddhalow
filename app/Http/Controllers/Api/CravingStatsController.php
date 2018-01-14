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
        $start_date = $request->get('start_date', 'NOW() - INTERVAL 28 DAY');
        $end_date = $request->query('end_date', 'NOW()');
        $allowed_groups = ['date', 'time_of_day', 'food_id', 'action_id', 'status', 'month', 'date', 'week', 'weekday', 'hour'];
        $select = array();
        foreach($groups as $group) {
            if (in_array($request->query('group_by'), $allowed_groups)) {
               
                $group_by[] = '`' . $group . '`';
                if ($group == 'date') {
                    $select[] = "DATE_FORMAT(time, '%Y-%m-%d') AS `date`";
                }
                if ($group == 'month') {
                    $select[] = "DATE_FORMAT(time, '%Y-%m') AS `month`";
                }
                if ($group == 'status') {
                    $select[] = "FIRST(status_id) AS status";
                }
                if ($group == 'day_of_week') {
                    $select[] = "DAYOFWEEK(time) AS `day_of_week`";
                }
                if ($group == 'weekday') {
                    $select[] = "WEEKDAY(time) AS `weekday`";
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
            }
        }
        $sql = "SELECT count(*) AS qty, " . implode(',',$select) . " FROM cravings WHERE time BETWEEN $start_date AND $end_date GROUP BY " . implode(',', $group_by) . "";
    
        $result = DB::select($sql); 
        
        return response()->json(compact('result'), 200);
    }
    
    public function destroy($id)
    {
        Saving::destroy($id);

        return redirect('dashboard/savings')->with('flash_message', 'Saving deleted!');
    }
}