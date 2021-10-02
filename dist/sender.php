<?php
// Include the bundled autoload from the Twilio PHP Helper Library
require './api/src/Twilio/autoload.php';
use Twilio\Rest\Client;
// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC39cb23728fe3017a29deb18fb7846dc6';
$auth_token = '8fe3c8cded6b962dd0b6856f14dc3401';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
// A Twilio number you own with SMS capabilities
$twilio_number = "+12169255214";
$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+9647706994420',
    array(
        'from' => $twilio_number,
        'body' => 'salam 3alaik'
    )
);