<?php

namespace App\Importers;

      
interface Importer {
    public function importFile($file);
}