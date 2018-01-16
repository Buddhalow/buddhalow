<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BookSale;
use App\Store;
use App\Author;
use App\Book;
use App\BookType;
use App\SaleType;
use Illuminate\Http\Request;
use App\Importers\ElibBookSalesImporter;
use DB;

class BookSalesController extends Controller
{
    private function import(Request $request) {
        $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'elib';
     
        $files = scandir($dir);
        
        $elibSaleImporter = new ElibBookSalesImporter();
        foreach($files as $file) {
            $file_path = $dir . DIRECTORY_SEPARATOR . $file;
            $rows = $elibSaleImporter->importFile($file_path);
           
            foreach($rows as $row ) {
                try {
                    $book_sale = BookSale::firstOrNew(array('external_order_id' => $row['external_order_id']));
                    $store = Store::firstOrNew(array('slug' => $row['store']['slug']));
                    $store->save();
                    $book = Book::firstOrNew(array('isbn' => $row['book']['isbn']));
                    $book->save();
                    $bookType = BookType::firstOrNew(array('slug' => $row['book_type']));
                    $bookType->save();
                    
                    $saleType = SaleType::firstOrNew(array('slug' =>  $row['sale_type']));
                    $saleType->save();
                    $book_sale->store_id = $store->slug;
                    $book_sale->book_id = $book->isbn;
                    $book_sale->sale_type_id = $saleType->slug;
                    $book_sale->time = $row['time'];
                    $book_sale->amount = $row['price'];
                    $book_sale->currency = $row['currency'];
                    $book_sale->save();
                } catch (Exception $e) {
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
        $sql = "SELECT sum(count) AS total, DATE_PART(time, '%Y-%m-%d') AS `date` FROM book_sales WHERE book_sales.time BETWEEN ($start AND $end) GROUP BY `date` ASC";

        $sales = DB::select($sql, array($start, $end)); 
        return response()->json(compact('sales'), 200);
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
