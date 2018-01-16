<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Author;
use App\SaleType;
use Illuminate\Http\Request;
use App\Importers\ElibBookSalesImporter;
use DB;

class StreamsController extends Controller
{
    private function import(Request $request) {
        $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'spotify';
     
        $files = scandir($dir);
        
        for($i = 2; $i < count($files); $i++) {
            if (($handle = fopen($file, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);
                    $row++;
                    for ($c=0; $c < $num; $c++) {
                        $number_of_streams = $c[2];
                        $date = $data[0];
                        $artist = 'drsounds';
                        $external_artist_id = 'spotify:artist:2FOROU2Fdxew72QmueWSUy';
                        $stream_stats = ArtistStreamStats::firstOrNew(array('external_id' => $external_artist_id  . ':statistics:' . (md5($date))));
                        $stream_stats->streams = $data[1];
                        $stream_stats->listeners = $data[0];
                        $stream_stats->followers = $data[2];
                        $stream_stats->save();
                    }
                }
            }
        }
        
        return response()->json($rows, 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {     
        $start = $request->get('start', 'NOW() - INTERVAL 28 DAY');
        $end = $request->get('end', 'NOW() + INTERVAL 1 DAY');
        //$this->import($request);
        $sql = "SELECT sum(count) AS total, DATE_PART(time, '%Y-%m-%d') AS `date` FROM streams WHERE book_sales.time BETWEEN ($start AND $end) GROUP BY `date` ASC";

        $sales = DB::select($sql, array($start, $end)); 
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
