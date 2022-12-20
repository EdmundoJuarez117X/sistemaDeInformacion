<?php

require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51Ly3wRBjIjedb6hbaVxKhDaZZECfHTq9XPMUkO9nRG3a4cjayZGWYkEALpawNGelEOWgJ746l56c5NrstKCfGTHb008QGWKA29');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/sistemaDeInformacion/views/stripeInscrip/public/';

// $person = $_SESSION["subMat"];
$successPayment = false;

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    'price' => 'price_1LyLTDBjIjedb6hbLiRTSGUs',
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $successPayment = true,
  'success_url' => $YOUR_DOMAIN . 'success.php',
  'cancel_url' => $YOUR_DOMAIN . 'cancel.php',
]);

include('./../../../model/connection.php');
if($successPayment == true){
      $f_creacion = date("Y-m-d H:i:s");
      $sql = $connection->query("INSERT INTO `pago`(`monto`, `estatus_pago`, `f_creacion_pago`)
      VALUES('1000','Exitoso','$f_creacion')");
}
header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);

