<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class productController extends Controller
{	/**
     * Accepts Data From request and validates product 
     * For valdiated product creates new affiliate Trigger
     * 
     */
    public function productCreatedByShopify()
    {
		$data = \Request::get('jsonData'); // sample Affiliate ID rfsnadid:01b5b9 for testing
		$dataArray = json_decode($data,1);
		// validates and process each product from notification
		foreach ($dataArray['variants'] as $key => $value) {
			if(strpos($value['sku'],'rfsnadid')){
				$affiliateController = new affiliateController();
				$affiliateController -> newAffiliateTrigger($value['sku'],'SKU');
			}else{
				$logDetails['level']   = 'WARNING';
				$logDetails['message'] = 'Product Created without Affiliate ID : Shopify Product ID : '.$value['product_id'].":".$value['sku'];
				Log::log($logDetails['level'],$logDetails['message']);
			}
		}
		http_response_code(200); 
    }
    //
}
