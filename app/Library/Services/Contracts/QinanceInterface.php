<?php
// app/Library/Services/Contracts/CustomServiceInterface.php
namespace App\Library\Services\Contracts;
  
/**
 * Qinance Interface
 **/
Interface QinanceInterface
{
    /**
     * Get account by ID
     * */
    public function getLedgerById($id);
    
    /**
     * Get transactions
     * @param {String} $id The account ID
     * @param {String} $offset Offset in search result
     * @param {String} $limit limit
     * @returns {Array} Account history
     **/
    public function getEntriesInLedgerById($id, $offset=0, $limit = 28);
    
    /**
     * Add transaction
     **/
    public function addVoucher($transaction);
}