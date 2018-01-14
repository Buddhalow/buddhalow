<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookSaleLink extends Model
{ 
    public $table = 'book_sale_links';
    
    /**
     * Get the post that owns the comment.
     */
    public function book()
    {
        return $this->belongsTo('App\Book');
    }
    
    /**
     * Get the post that owns the comment.
     */
    public function store()
    {
        return $this->belongsTo('App\Store');
    }
    
    /**
     * Get the post that owns the comment.
     */
    public function saleType()
    {
        return $this->belongsTo('App\SaleType');
    }
    
    /**
     * Get the post that owns the comment.
     */
    public function bookType()
    {
        return $this->belongsTo('App\BookType');
    }
    public $fillable = ['book_id', 'store_id', 'isbn', 'sale_type_id', 'time', 'amount', 'external_order_id'];
}
