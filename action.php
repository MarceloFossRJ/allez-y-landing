<?php

	$result = json_decode( mailchimp_subscriber_status($_POST['email'], 'subscribed'));
	// print_r( $result );
	if( $result->status == 400 ){
		foreach( $result->errors as $error ) {
			echo '<p>Error: ' . $error->message . '</p>';
		}
	} elseif( $result->status == 'subscribed' ){
		echo 'Thank you, ' . $result->merge_fields->FNAME . '. You have subscribed successfully';
	}


function mailchimp_subscriber_status( $email, $status){
	$data = array(
		'apikey'        => $api_key,
    'email_address' => $email,
		'status'        => $status
	);

  $config = parse_ini_file('config.ini');
  $apiKey = $config['apiKey'];
  $listID = $config['listID'];

  $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
  $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . md5(strtolower($data['email_address']));

	$mch_api = curl_init(); // initialize cURL connection

  curl_setopt($mch_api, CURLOPT_URL, $url);
	curl_setopt($mch_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$api_key )));
	curl_setopt($mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
	curl_setopt($mch_api, CURLOPT_RETURNTRANSFER, true); // return the API response
	curl_setopt($mch_api, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
	curl_setopt($mch_api, CURLOPT_TIMEOUT, 10);
	curl_setopt($mch_api, CURLOPT_POST, true);
	curl_setopt($mch_api, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($mch_api, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json

	$result = curl_exec($mch_api);
  curl_close($mch_api);
	return $result;
}

?>
