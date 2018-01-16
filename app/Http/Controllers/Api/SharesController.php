<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Roaming;
use Illuminate\Http\Request;
use App\Share;
use App\ShareState;

class SharesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        
    }
    
    public function show(Request $request, $id) {
        
        $start = $request->query('start', 'NOW() - INTERVAL 28 DAY');
       
        $end = $request->query('end', 'NOW()');
        $share = Share::where(array('id' => $id))->first();
     
        $states = array();
        
        if ($share != null) {
            $states = ShareState::where(array('share_id' => $share->id))->whereBetween('time', array($start, $end))->get();
        }
        return response()->json(compact('share', 'states'));
    }
    
    public function destroy($id)
    {
        Saving::destroy($id);

    }
}