<?php

namespace App\DataProviders;

abstract class DataProvider {
    /**
     * Import sale data for book
     * @param {String} isbn The ISBN number of the book to import
     **/
    public abstract function importSaleDataForBook($isbn);
    
    /**
     * Import availability data for book
     * */
    public abstract function importAvailabilityDataForBook($isbn);
}