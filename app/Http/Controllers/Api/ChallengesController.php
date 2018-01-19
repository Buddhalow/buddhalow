<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Challenge;
use App\ChallengeState;
use Illuminate\Http\Request;

class ChallengesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $challenges = Challenge::orderBy('name', 'ASC')->paginate(25);

        return $challenges;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $challenge = craving::create($request->all());

        return response()->json($challenge, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $challenge = Challenge::findOrFail(array('slug' => $id))->first();
        
        $sql = "SELECT coalesce(max(progress), 0) FROM challenge_states WHERE DATE(challenge_states.time) = db_date OR DATE(challenge_states.time) < CAST('{$challenge->end}' AS DATETIME) AND challenge_id = '{$challenge->id}'";
        
        $sql = "SELECT ($sql) AS progress, db_date AS date FROM time_dimension WHERE db_date BETWEEN CAST('{$challenge->start}' AS DATETIME) AND CAST('{$challenge->end}' AS DATETIME)";
       // die($sql);
        $dates = DB::select($sql);
       
        $challenge['dates'] = $dates;
        
        return $challenge;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $craving = craving::findOrFail($id);
        $craving->update($request->all());

        return response()->json($craving, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        craving::destroy($id);

        return response()->json(null, 204);
    }
}
