<?php

namespace Store\Store\Services;
/**
 * Class EmailVerificationService
 *
 * @package store\store\Services
 *
 * @author Jaber Rasul
 */

// To use the EmailVerificationService class, first, make sure you have set up your environment variables correctly, particularly the `API_EmailVerificationService` key which should contain your Hunter.io API key.
// Then, you can instantiate the class and call the `verifyEmail` method passing the email address you want to verify. Here's an example:
// ```php
// use Store\Store\Services\EmailVerificationService;
// // Instantiate the service
// $emailVerificationService = new EmailVerificationService();
// // Email address to verify
// $email = 'example@example.com';
// // Verify the email address
// if ($emailVerificationService->verifyEmail($email)) {
//     echo "The email address $email is valid.";
// } else {
//     echo "The email address $email is invalid.";
// }

class EmailVerificationService
{
    public $apiKey;

    public function __construct()
    {
        $this->apiKey = env("API_EmailVerificationService");
        
    }

    /**
     * Check if there is an active internet connection.
     *
     * @return bool Returns true if the internet is connected, false otherwise.
     */
    public function isInternetConnected(): bool
    {
        $connected = @fsockopen("www.google.com", 80); 
        if ($connected) {
            fclose($connected);
            return true;
        }
        return false;
    }

    /**
     * Verify the validity of an email address.
     *
     * @param string|null $email The email address to verify.
     * 
     * @return bool Returns true if the email is valid, false otherwise.
     */
    public function verifyEmail($email = null): bool
    {
        if (!is_null($email)) {
            $api = $this->apiKey;
            $url = "https://api.hunter.io/v2/email-verifier?email=$email&api_key=$api";
            $response = file_get_contents($url);
            $response = json_decode($response);
            if($response->data->status == "invalid"){
                return false;
            }else if($response->data->status == "valid"){
                return true;
            }
        }else{
            return false;
        }
        return false;
        
    }
}
