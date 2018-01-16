<?php

namespace App\Importers;

use App\Importers\Importer;

use Maatwebsite\Excel\Facades\Excel;
      
class ElibBookSalesImporter implements Importer {
    
    public function importFile($file) {
        $result = [];
        $mimeType = mime_content_type($file);
        try {
            $reader = Excel::load($file);
            $rows = $reader->all();
            if (get_class($rows) === 'Maatwebsite\Excel\Collections\RowCollection') {
                $rows = ($rows->all());
                if (count($rows) < 1) return [];   
            } 
            foreach($rows as $_row) {
                $row = $_row->all();
                $saleTypeName = 'stream';
                $format = '';
                if (array_key_exists('format', $row)) {
                    $formats = explode(' : ', $row['format']);
                    if (count($formats) > 1) {
                        $format = trim($formats[0]);
                        $saleTypeName = trim($formats[1]);
                    }
                }
                if (array_key_exists('booktype', $row)) {
                    $format = $row['booktype'];
                }
                if (!array_key_exists('bestallningsdatum', $row)) {
                    continue;
                }
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
                        'first_name' => count($author) > 1 ? $author[1] : '',
                        'last_name' => $author[0]
                    ),
                    'book_type' => array(
                        'name' => $format,    
                        'slug' => str_slug($format, '')
                    ),
                    'sale_type' => array(
                        'name' => $saleTypeName,
                        'slug' => str_slug($saleTypeName. '')
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
        } catch (Exception $e) {
            var_dump($e);
        }
    
        return $result;
    }
}