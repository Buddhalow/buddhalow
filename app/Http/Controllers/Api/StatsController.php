<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Roaming;
use Illuminate\Http\Request;

class StatsController extends Controller
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
        $table = $request->query('table');
        if (!in_array($table, ['book_sales'])) {
            return;
        }
        $allowed_groups = ['date', 'time_of_day', 'food', 'reason', 'action', 'status', 'month', 'date', 'week', 'weekday', 'hour'];
        $select = array($table. '.id AS id');
        $joins = array();
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
                if ($group == 'store') {
                    $select[] = "store_id AS store";
                    $joins[] = "INNER JOIN stores ON store.slug = $table.store_id";
                }
                if ($group == 'sale_type') {
                    $select[] = "sale_type_id AS sale_type";
                    $joins[] = "INNER JOIN sale_types ON sale_types.slug = $table.sale_type_id";
                }
            }
        }
        $sql = "SELECT count(*) AS qty, " . implode(',',$select) . "  FROM " . $table ." ". implode(' ',$joins) . " WHERE time BETWEEN '$start_date' AND '$end_date' GROUP BY " . implode(',', $group_by) . "";
        $result = DB::select($sql); 
        
        return response()->json(compact('result'), 200);
    }
    
    public function destroy($id)
    {
        Saving::destroy($id);

        return redirect('dashboard/savings')->with('flash_message', 'Saving deleted!');
    }
}