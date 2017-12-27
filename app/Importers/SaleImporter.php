<?php

namespace App\Importers;

/**
 * Interface for sale importers
 **/
interface SaleImporter {
    /**
     * Import file
     **/
    public function importFile($file);
}