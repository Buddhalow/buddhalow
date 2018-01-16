<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Roaming;
use Illuminate\Http\Request;
use App\Infection;

class InfectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $entity = Infection::where(array('slug' => $id))->first();
        $infection = $request->query('start', 'NOW() - INTERVAL 28 DAY');
       
        $end = $request->query('end', 'NOW()');
        $transactions = Treatment::where(array('code' => $entity->slug))->whereBetween('time', array($start, $end))->get();
        return response()->json(compact('infection', 'transactions'));
    }
    
    public function destroy($id)
    {
        Saving::destroy($id);

    }
}