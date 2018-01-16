<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Roaming;
use Illuminate\Http\Request;
use App\Threat;

class ThreatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return Threat::orderBy('time', 'DESC')->paginate(28);
    }
    
    public function destroy($id)
    {
        Saving::destroy($id);

    }
}