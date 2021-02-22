<?php
$fireBaseApiKey = 'AAAAOEbzKiA:APA91bGp-eVITkQPGTsh2DXhSQPLzVxEgSLXquRs6Oy-zvGSWAkWZtaaIv_ZbUXHzEY016iekD0gEx3RItFdRdPwVbKMXAGHQ0S63OhAM0oH1bA-sVP4VIfAvFCSfi3n5BPUnLQHeQGF';
$messageTitle = "Sample Notification";
$messageText = "Simple message from server";
$fireBaseDeviceId = 'Add device token here';
$registrationIds[] = "/topics/all";//$fireBaseDeviceId; // this should be in array form
$aMessage = array(
'body' => $messageText,
'title' => $messageTitle,
"content_available" => true,
"priority" => "high"
);
$aNotification = array(
'text' => $messageText,
'title' => $messageTitle,
"content_available" => true,
"priority" => "high"
);
$aFields = array(
'registration_ids' => $registrationIds,
'data' => $aMessage,
'notification' => $aNotification
);
$aHeaders = array(
'Authorization: key=' . $fireBaseApiKey,
'Content-Type: application/json'
);
$aUrl = "https://fcm.googleapis.com/fcm/send";
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, $aUrl );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $aHeaders );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $aFields ) );
$result = curl_exec($ch );
print_r($result);
curl_close( $ch );


