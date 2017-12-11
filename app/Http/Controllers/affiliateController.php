<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Psr7\Request;
use Log;

class affiliateController extends Controller
{
	const BASEURL  = 'https://www.refersion.com/api/';

	/**
	 * create request parameter for creating new affiliate trigger
     * @param string $trigger = rfsnadid:{affiliateID}
     * @param string $type (SKU, COUPON, EMAIL)
     *
     */
    public function newAffiliateTrigger($trigger,$type)
    {
		$action = 'new_affiliate_trigger';

    	$request['json'] = [
		    'refersion_public_key' => env('REFERSION_PUBLIC_KEY'),
		    'refersion_secret_key' => env('REFERSION_SECRET_KEY'),
		    'type' => $type,
		];
		if($type == 'SKU'){
			// Set Affiliate Code and Trigger When creating trigger from SKU 
			$code = explode("rfsnadid:",$trigger)[1];
		    $request['json']['affiliate_code'] = $code;
		    $request['json']['trigger'] = $trigger;
		// }elseif($type == 'COUPON'){
			// Set Affiliate Code and Trigger When creating trigger from Coupon 
		    
		    // $request['affiliate_code'] = 
		    // $request['trigger'] = 
		// }elseif($type == 'EMAIL'){
			// Set Affiliate Code and Trigger When creating trigger from Email
		    
		    // $request['affiliate_code'] = 
		    // $request['trigger'] = 
		}
		$this->makeRequest("POST", $action, $request);
    }

	/**
	 * send Request to refersion 
     * @param string $method 
     * @param string $action - API Action to Create API URL
     * @param array  $parameter 
     *
     */
    public function makeRequest($method,$action,$parameter)
    {
    	$url = self::BASEURL.$action; // Create URL For API Call
    	$client = new Client();
		try {
			$response = $client->request($method, $url, $parameter, ['http_errors' => false]);
			$logDetails['level']    = "DEBUG";
			$logDetails['message']  = "SUCCESS : ".json_encode($response->getBody());
	    } catch (\Exception $e) {
			$logDetails['level']    = "ERROR";
			$logDetails['message']  = "EXCEPTION : ".$e->getMessage();
	    } finally{
			Log::log($logDetails['level'],$logDetails['message']);
	    }
    }

}
