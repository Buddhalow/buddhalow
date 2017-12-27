<?php

namespace App\Importers;

use App\Importers\Importer;

class ElibSaleImporter extends SaleImporter {
    
    public function importFile($file) {
        $rows = array();
        Excel::load($file, function ($reader) {
            foreach($reader as $row) {
                $row = $row->toObject();
                $author = explode(', ', $row['Författare']);
                $destination_row = array(
                    'store' => array(
                        'name' => $row['Återförsäljare']    
                    ),
                    'time' => $row['Beställningsdatum'],
                    'book' => array(
                        'isbn' => $row['ISBN']
                    ),
                    'author' => array(
                        'first_name' => $author[1],
                        'last_name' => $author['2']
                    ),
                    'book_format' => array(
                        'name' => $row['Format']    
                    ),
                    'count' => $row['Antal'],
                    'currency' => 'SEK',
                    'price' => $row['Nettoersättning'],
                    'store' => array(
                        'name' => $row['Återförsäljare']    
                    ),
                    'external_order_id' => 'elib:' . $row['Återförsäljarens orderid']
                );
                $rows[] = $destination_row;
            }
        });
        return $rows;
    }
}