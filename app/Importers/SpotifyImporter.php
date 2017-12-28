<?php

namespace App\Importers;

use App\Importers\Importer;

use Excel;

class ElibBookSalesImporter implements SaleImporter {
    
    public function importFile($file) {
        $result = [];
        $reader = Excel::load($file);
        $rows = $reader->all();
        
        foreach($rows as $row) {
            $formats = explode(' : ', $row['format']);
            $format = trim($formats[0]);
            $saleTypeName = trim($formats[1]);
            $author = explode(', ', $row['forfattare']);
            $destination_row = array(
                'store' => array(
                    'name' => $row['aterforsaljare']    
                ),
                'time' => $row['bestallningsdatum'],
                'book' => array(
                    'isbn' => (string)$row['isbn']
                ),
                'author' => array(
                    'first_name' => $author[1],
                    'last_name' => $author[0]
                ),
                'book_type' => array(
                    'name' => $format,    
                    'slug' => $format    
                ),
                'sale_type' => array(
                    'name' => $saleTypeName,
                    'slug' => $saleTypeName
                ),
                'count' => $row['antal'],
                'currency' => 'SEK',
                'price' => $row['nettoersattning'],
                'store' => array(
                    'name' => $row['aterforsaljare'],
                    'slug' => $row['aterforsaljare']
                ),
                'external_order_id' => 'elib:' . $row['elib_order_id']
            );
            $result[] = $destination_row;
        }
    
        return $result;
    }
}