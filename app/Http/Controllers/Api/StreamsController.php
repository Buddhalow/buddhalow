<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Author;
use App\SaleType;
use Illuminate\Http\Request;
use App\Importers\ElibBookSalesImporter;
use DB;
use App\ArtistStreamStat;

class StreamsController extends Controller
{
    public function import(Request $request) {
        $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'spotify';
     
        $files = scandir($dir);
        $result = [];
        for($i = 2; $i < count($files); $i++) {
            $file = $files[$i];
            if (($handle = fopen($dir . DIRECTORY_SEPARATOR . $file, "r")) !== FALSE) {
                $i = 0;
                while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $i++;
                    if ($i < 2) continue;
                    
                    $streams = $row[2];
                    $listeners = $row[1];
                    $followers = $row[3];
                    $date = $row[0];
                    $artist = 'drsounds';
                    $external_artist_id = 'spotify:artist:2FOROU2Fdxew72QmueWSUy';
                    $stream_stats = ArtistStreamStat::firstOrNew(array('external_id' => $external_artist_id  . ':statistics:' . (md5($date))));
                    $stream_stats->time = $date;
                    $stream_stats->streams = $streams;
                    $stream_stats->listeners = $listeners;
                    $stream_stats->artist_id = 'drsounds';
                    $stream_stats->external_artist_id = $external_artist_id;
                    $stream_stats->followers = $followers;
                    $stream_stats->save();
                    $result[] = $stream_stats;
                    
                }
            }
        }
        
        return response()->json(compact('result'), 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {     
        $start = $request->get('start', 'DATE_SUB(CURDATE(), INTERVAL 28 DAY)');
        $end = $request->get('end', 'DATE_ADD(CURDATE(), INTERVAL 1 DAY)');
        //$this->import($request);
        $sql = "SELECT streams, followers, listeners, time, service_id, data_provider_id, external_artist_id, external_id FROM artist_stream_stats WHERE time BETWEEN '$start' AND '$end'  ORDER BY time ASC";
     
        $streams = DB::select($sql, array($start, $end)); 
        return response()->json(compact('streams'), 200);
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
        $craving = craving::findOrFail($id);

        return $craving;
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
    
    public function upload(Request $request) {
        
        
    }
}
