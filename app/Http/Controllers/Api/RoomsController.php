<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Room;
use App\Cleaning;
use Illuminate\Http\Request;
use App\RoomSnapshot;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        
        $_rooms = Room::all();
        $rooms = array();
        foreach($_rooms as $room) {
            $harmony_balance = 0;
            $now = new \DateTime();
            $last_updated = $room->last_updated;
            if ($last_updated == NULL) {
                $last_updated = new \DateTime();
            } else {
                $last_updated = new \DateTime($room->last_updated);
            }
            $deterioration = ($now->diff($last_updated)->d * $room->deterioration_speed) + ($now->diff($last_updated)->h * ($room->deterioration_speed / 23));
            $room->balance -= $deterioration;
            if ($now->diff($last_updated)->d > 0) {
                $room_snapshot = new RoomSnapshot();
                $room_snapshot->time = new \DateTime();
                $room_snapshot->balance = $room->balance;
                $room_snapshot->room_id = $room->slug;
                $room_snapshot->save();
            }
            $cleaning = Cleaning::where("room_id", $room->slug)->where('redeemed', false)->first();
            
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