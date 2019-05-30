<?php

namespace yii2lab\notify\domain\repositories\rest;

use Yii;

/**
 * This is just an example.
 */
class FireBaseSend
{
    var $api_key;
    // constructor
    function __construct() {
        $this->api_key= Yii::$app->params['FIRE_BASE_PROJECT_NAME'];
    }
    public function getApiKey()
    {
        return $this->api_key;
    }
    // sending push message to single user by gcm registration id
    public function send($to, $message) {
        $fields = array(
            'to' => $to,
            'notification' => $message,
        );
        return $this->sendPushNotification($fields);
    }
    // Sending message to a topic by topic id
    public function sendToTopic($to, $message) {
        $fields = array(
            'to' => '/topics/' . $to,
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }
    // sending push message to multiple users by gcm registration ids
    public function sendMultiple($registration_ids, $message) {
        $fields = array(
            'to' => json_encode($registration_ids),
            'data' => $message,
        );
        return $this->sendPushNotification($fields);
    }
    // function makes curl request to gcm servers
    private function sendPushNotification($fields) {
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            'Authorization: key=' . $this->api_key,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, $url );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        // Execute post
		$info = curl_getinfo($ch);

        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        return $result;
    }
}