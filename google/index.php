<?php
ini_set('display_errors','on');
echo 'google api 1';
use Google\Auth\OAuth2;
require_once 'vendor/autoload.php';

/*
putenv('GOOGLE_APPLICATION_CREDENTIALS=./pc-api-6342731106437956238-927-5d5e8e8c218f.json');

$client = new Google\Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google\Service\Plus::PLUS_ME);

// returns a Guzzle HTTP Client
$httpClient = $client->authorize();

// make an HTTP request
$response = $httpClient->get('https://www.googleapis.com/plus/v1/people/me');
echo 'result:';
print_r($response); 
*/
function getGoogleJWT($scopes, $jsonKey) {
    $jsonKey = json_decode(file_get_contents($jsonKey), true);
    $config = [
        'audience' => 'https://oauth2.googleapis.com/token',
        'issuer' => $jsonKey['client_email'],
        'scope' => $scopes,
        'signingAlgorithm' => 'RS256',
        'signingKey' => $jsonKey['private_key'],
        'sub' => NULL,
        'tokenCredentialUri' => 'https://oauth2.googleapis.com/token'
    ];
	//print_r($config);
    $auth = new OAuth2($config);
    return $auth->toJWT();
}

$scopes = ['https://www.googleapis.com/auth/drive.readonly'];
echo '<br><br>';
echo getGoogleJWT($scopes, 'pc-api-6342731106437956238-927-5d5e8e8c218f.json');

function getAccessToken($jwt) {
    $params = ['grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer', 'assertion' => $jwt];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://oauth2.googleapis.com/token');
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

$jwt = 'JWT';
echo '<br><br>';
echo getAccessToken($jwt);