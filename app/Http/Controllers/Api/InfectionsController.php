<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Roaming;
use Illuminate\Http\Request;
use App\Infection;
use App\Treatment;

class InfectionsController extends Controller
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
        $infection = Infection::where(array('code' => $id))->first();
    
        $transactions = Treatment::where(array('infection_id' => $id))->orderBy('time', 'DESC')->get();
        return response()->json(compact('infection', 'transactions'));
    }
    
    public function destroy($id)
    {
        Saving::destroy($id);

    }
}