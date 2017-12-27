<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BookSale;
use App\Store;
use App\Author;
use App\Book;
use App\BookType;
use Illuminate\Http\Request;
use App\Importers\ElibSaleImporter;

class BookSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
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
        $file = File::input('file');
        $elibSaleImporter = new ElibSaleImporter();
        $rows = $elibSaleImporter->importFile($file);
        foreach($rows as $row ) {
            $book_sale = new BookSale;
            $store = Store::firstOrNew($row['store']);
            $book = Book::firstOrNew($row['book']);
            $format = BookType::firstOrNew($row['format']);
            $book_sale->store = $store;
        }
        
    }
}
