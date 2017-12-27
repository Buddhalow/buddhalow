<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookSale extends Model
{ 
    public $table = 'book_sales';
    
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
    public $fillable = ['book_id', 'store_id'];
}
