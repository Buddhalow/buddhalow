<?php
namespace App\Library\Services;

use App\Library\Services\Contracts\QinanceInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

/**
 * Qinance 
 * */
class Qinance implements QinanceInterface {
    public function __construct($config) {
        $this->api_key = $config['api_key'];
        $this->api_url = $config['api_url'];
        
    }
    private function request($method, $url, $data = array()) {
   
        $client = new Client(array('base_uri' => $this->api_url));
        $headers = array(
            'Authorization' => 'OAuth ' . $this->api_key,
            'Content-Type'=> 'application/json'
        );
        if ($method === 'GET') {
            $response = $client->get( $url, [
                'verify' => false,
                'headers' => $headers
            ]);
        } else if ($method === 'POST') {
            $response = $client->post( $url, [
                'body' => json_encode($data),
                'headers' => $headers
            ]);
        } else if ($method == 'PUT') {
            $response = $client->post( $url, [
                'body' => json_encode($data),
                'headers' => $headers
            ]);
        } else {
            throw new \Exception('Invalid HTTP method ' . $method);
        }
        $status_code = $response->getStatusCode();
        if ($status_code < 200 || $status_code > 299) {
            throw new Exception($status_code);
        }
        $body = $response->getBody();
        $data = json_decode($body);
        return $data;
    }
    
    /**
     * Get account by ID
     * */
    public function getLedgers() {
        return $this->request('GET', '/api.php?resource=accounts');
    }
    
    /**
     * Get account by ID
     * */
    public function getLedgerById($id) {
        $resource_id = '/api.php?resource=accounts&resource_id=' . $id;
  
        return $this->request('GET', $resource_id);
    }
    
    /**
     * Get transactions
     * @param {String} $id The account ID
     * @param {String} $offset Offset in search result
     * @param {String} $limit limit
     * @returns {Array} Account history
     **/
    public function getEntriesInLedgerById($id, $offset=0, $limit = 28) {
        return $this->request('GET', '/api.php?resource=transactions&resource_id=' . $id . '&sub_resource=entryitems');
    }
    
    /**
     * Add transaction
     **/
    public function addVoucher($transaction) {
        return $this->request('POST', '/api.php?resource=transactions', $transaction);
    }
}