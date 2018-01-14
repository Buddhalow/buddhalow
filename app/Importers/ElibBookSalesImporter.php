<?php

namespace App\Importers;

use App\Importers\Importer;

use Excel;

class ElibBookSalesImporter implements SaleImporter {
    
    public function importFile($file) {
        $result = [];
        $mimeType = mime_content_type($file);
        if ($mimeTye == 'text/csv') {
            $reader = Excel::load($file);
            $rows = $reader->all();
            foreach($rows as $row) {
                $formats = explode(' : ', $row['format']);
                $format = trim($formats[0]);
                $saleTypeName = trim($formats[1]);
                $author = explode(', ', $row['Author']);
                $destination_row = array(
                    'store' => array(
                        'name' => $row['aterforsaljare']    
                    ),
                    'time' => $row['date_ordered'],
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
                    'count' => $row['quantity'],
                    'currency' => $row['currency'],
                    'price' => $row['net_price'],
                    'store' => array(
                        'name' => $row['retailer'],
                        'slug' => $row['retailer']
                    ),
                    'external_order_id' => 'elib:' . $row['elib_order_id']
                );
                $result[] = $destination_row;
            }
           
            
        }
        if ($mimeType == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
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
        }
        return $result;
    }
}