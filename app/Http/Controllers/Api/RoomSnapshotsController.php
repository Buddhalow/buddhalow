<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Room;
use App\Cleaning;
use Illuminate\Http\Request;
use App\RoomSnapshot;
use DB;
class RoomSnapshotsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, $id)
    {
        
        $group_by = array();
        $groups = explode(',', $request->query('group_by'));
        
        $start_date = $request->query('start', 'NOW() - INTERVAL 28 DAY');
        
        $_rooms = Room::all();
        $rooms = [];
        $end_date = $request->query('end', 'NOW()');
        $allowed_groups = ['date', 'time_of_day', 'food', 'reason', 'action', 'status', 'month', 'date', 'week', 'weekday', 'hour'];
        $select = array();
        
        foreach($_rooms as $room) {
       
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
            $sql = "SELECT sum(balance) AS balance, " . implode(',',$select) . " FROM room_snapshots WHERE time BETWEEN '$start_date' AND '$end_date' GROUP BY " . implode(',', $group_by) . "  ORDER BY time ASC ";
            
            $snapshots = DB::select($sql); 
            $room->snapshots = $snapshots;
            $rooms[] = $room;
        }
        
        
        return response()->json(compact('rooms'), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.savings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Saving::create($requestData);

        return redirect('dashboard/savings')->with('flash_message', 'Saving added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $saving = Saving::findOrFail($id);

        return view('dashboard.savings.show', compact('saving'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $saving = Saving::findOrFail($id);

        return view('dashboard.savings.edit', compact('saving'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $saving = Saving::findOrFail($id);
        $saving->update($requestData);

        return redirect('dashboard/savings')->with('flash_message', 'Saving updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Saving::destroy($id);

        return redirect('dashboard/savings')->with('flash_message', 'Saving deleted!');
    }
}