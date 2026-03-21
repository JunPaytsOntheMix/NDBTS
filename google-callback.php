<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'model/Database.php'; 
require_once 'model/User.php'; 

$client = new Google_Client();
$client->setClientId('1010060076471-3drv39bou44hmvm2lur96bmjnuak7t7k.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/NDTBS/google-callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);
        $google_oauth = new Google_Service_Oauth2($client);
        $info = $google_oauth->userinfo->get();
        
        $dbClass = new Database(); 
        $userObj = new User($dbClass->getConnection()); 
        
        // 1. Log the Google user in the database
        $userObj->syncGoogleUser($info->email); 

        // 2. Set the session email
        $_SESSION['user_email'] = $info->email;
        
        // 3. CRITICAL: Assign the 'customer' role so they can enter dashboard.php
        $_SESSION['user_role'] = 'customer'; 
        
        header("Location: dashboard.php");
        exit();
    }
}
?>