<?php

namespace App\Http\Controllers\Api;
  
use App\Http\Controllers\Controller;
use App\Library\Services\Contracts\QinanceInterface;
use Illuminate\Http\Request;
class LedgersController extends Controller
{
    public function __construct(QinanceInterface $qinance) {
        $this->qinance = $qinance;
    }
    public function index(Request $request)
    {
        
        return response()->json($this->qinance->getLedgers());
    }
    
    public function show(Request $request, $id)
    {
        $result = $this->qinance->getLedgerById($id);
        $result->transactions = $this->qinance->getEntriesInLedgerById($id); 
        return response()->json($result);
    }
}