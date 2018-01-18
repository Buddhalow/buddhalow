<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Roaming;
use Illuminate\Http\Request;
use App\Threat;

class MeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = $user = Auth::user();
        if ($user) return $user;
        return response()->json(['error' => 'Not authenticated'], 403);
    }
    
    public function store(Request $request) {
        $data = json_decode($request->body);
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return response()->json(['status' => 'ok']);
        }
    }
    public function destroy($id)
    {
        Auth::logout();
        return response()->json(['logged' => 'out']);

    }
}