<?php
session_start();
$email = $_POST['email'];
$status = 'subscribed';

if (!empty($email)) {
  $data = array(
    'apikey'        => $apikey,
    'email_address' => $email,
    'status'        => $status
  );

  try {
    $config = parse_ini_file('../config.ini');
    $apiKey = $config['apiKey']
    $listID = $config['listID']
  }
  catch (HttpException $ex) {
    echo __FILE__ . ':' . __LINE__ . PHP_EOL;
    echo $ex;
    exit;
  }

  $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
  $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . md5(strtolower($data['email_address']))

  $mch_api = curl_init(); // initialize cURL connection

  curl_setopt($mch_api, CURLOPT_URL, $url);
  curl_setopt($mch_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$apiKey )));
  curl_setopt($mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
  curl_setopt($mch_api, CURLOPT_RETURNTRANSFER, true); // return the API response
  curl_setopt($mch_api, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
  curl_setopt($mch_api, CURLOPT_TIMEOUT, 10);
  curl_setopt($mch_api, CURLOPT_POST, true);
  curl_setopt($mch_api, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($mch_api, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json

  try {
    $result = curl_exec($mch_api) or die(curl_error($mch_api));
  }
  catch (HttpException $ex) {
    echo __FILE__ . ':' . __LINE__ . PHP_EOL;
    echo $ex;
    exit;
  }

  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  if ($httpCode == 200) {
    $_SESSION['msg'] = '<p style="color: #34A853">You have successfully subscribed to CodexWorld.</p>';
  }
  else {
    switch ($httpCode) {
      case 214:
        $msg = 'You are already subscribed.';
        break;
      default:
        $msg = 'Some problem occurred, please try again.';
        break;
      }
    $_SESSION['msg'] = '<p style="color: #EA4335">'.$msg.'</p>';
  }

  curl_close($mch_api);
}
// redirect to homepage
//
header('location:index.php');
?>
