<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Roaming;
use Illuminate\Http\Request;

class RoamingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $roamings = Roaming::with('aqtivities')->orderBy('time', 'DESC')->paginate(28);
        return response()->json(compact('roamings'), 200);
    }
    
    public function destroy($id)
    {
        Saving::destroy($id);

        return redirect('dashboard/savings')->with('flash_message', 'Saving deleted!');
    }
}