<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Craving;
class ModelController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function upload(Request $request)
    {
        if ($request->file('cravings')->isValid()) {
            $str_json = file_get_contents($request->cravings->path());
            $data = json_decode($str_json, TRUE);
         
            foreach($data['results'] as $_craving) {
                $craving = new Craving;
                if (array_key_exists('statusCode', $_craving))
                    $craving->status = $_craving['statusCode'];
                if (array_key_exists('food', $_craving))
                    $craving->food_id = $_craving['food'];
                    if (array_key_exists('action', $_craving))
                        $craving->action_id = $_craving['action'];
           //     $craving->created_at = $_craving['createdAt'];
             //   $craving->updated_at = $_craving['updatedAt'];
                if (array_key_exists('time', $_craving))
                    $craving->time = strftime('%Y-%m-%d %H:%M:%S', strtotime($_craving['time']['iso'])); 
                
                $craving->save();
            }
        }
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }
    public function index(Request $request) {
        $cravings = Craving::all();
        return view('cravings_index', ['cravings' => $cravings]);
    }
}