<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Roaming;
use Illuminate\Http\Request;
use App\Entity;
use App\EntityState;

class EntitiesController extends Controller
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
        $entity = Entity::where(array('slug' => $id))->first();
        $start = $request->query('start', 'NOW() - INTERVAL 28 DAY');
       
        $end = $request->query('end', 'NOW()');
        $states = EntityState::where(array('entity_id' => $entity->slug))->whereBetween('time', array($start, $end))->get();
        return response()->json(compact('entity', 'states'));
    }
    
    public function destroy($id)
    {
        Saving::destroy($id);

    }
}