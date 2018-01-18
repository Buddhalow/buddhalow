<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Roaming;
use Illuminate\Http\Request;
use App\Threat;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        die(var_dump(Auth::user()));
    }
    
    public function store(Request $request) {
        $data = json_decode($request->getContent());
        $user = User::whereEmail($request->username)->first();
        $password = Hash::check($data->password, $user->password);     

        if (!$password) {
            return response()->json(['error' => 'Invalid password'], 403);
        }

        if (!$user->confirmed) {
          //  return response()->json(['error' => 'User not confirmed'], 403);
        }

        Auth::login($user);
        return response()->json(Auth::user());
    }
    public function destroy($id)
    {
        Auth::logout();
        return response()->json(['logged' => 'out']);

    }
}