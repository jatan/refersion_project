<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class shopifyVerifyWebhook
{
    /**
     * Handle an incoming request for notification verification from shopify
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::useFiles(storage_path().'/logs/shopify.log');
        $hmac_header =  $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];

        // Retrieve the request's body and parse it as JSON
        $data = file_get_contents('php://input');

        if(! $this -> verify_webhook($data, $hmac_header)){
            // when Not verified, Log related details
            Log::emergency('Notification from un-verified Source : '.$_SERVER);
        }
        Log::debug('Webhook Verified!!');
        // Adds Passed Data in request
        $request->attributes->add(['jsonData' => $data]); 
        return $next($request);
    }

    /**
     *Compare the computed HMAC digest based on the shared secret and the request contents
     *
     *to the reported HMAC in the headers
     */
    public function verify_webhook($data, $hmac_header)
    {
      $calculated_hmac = base64_encode(hash_hmac('sha256', $data, env('SHOPIFY_APP_SECRET'), true));
      return hash_equals($hmac_header, $calculated_hmac);
    }
}
