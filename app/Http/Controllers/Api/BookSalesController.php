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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $sql = "SELECT sum(count) AS total, DATE(time) AS `date` FROM book_sales WHERE (book_sales.time BETWEEN ? AND ?) GROUP BY `date`";
        
        $sales = DB::select($sql, array($request->get('start'), $request->get('end'))); 
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
        try {
            $file = $request->file('file');
            $elibSaleImporter = new ElibBookSalesImporter();
            $rows = $elibSaleImporter->importFile($file);
       
         
            foreach($rows as $row ) {
                $book_sale = BookSale::firstOrNew(array('external_order_id' => $row['external_order_id']));
                $store = Store::firstOrNew($row['store']);
                $store->save();
                $book = Book::firstOrNew($row['book']);
                $book->save();
                $bookType = BookType::firstOrNew($row['book_type']);
                $bookType->save();
                
                $saleType = SaleType::firstOrNew($row['sale_type']);
                $saleType->save();
                $book_sale->store()->associate($store);
                $book_sale->book()->associate($book);
                $book_sale->sale_type_id = $saleType->slug;
                $book_sale->time = $row['time'];
                $book_sale->amount = $row['price'];
                $book_sale->currency = $row['currency'];
                $book_sale->save();
            }
            return response()->json($rows, 200);
        } catch (Exception $e) {
            var_dump($e);
        }
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
