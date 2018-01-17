<?php

namespace App\Http\Controllers\Dashboard;

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

class BookSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('dashboard.booksales.index', []);
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
        return view('dashboard.booksales.index', []);
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
        
        return view('dashboard.booksales.index', []);
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
