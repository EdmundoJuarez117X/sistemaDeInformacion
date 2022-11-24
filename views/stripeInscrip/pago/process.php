<?php
require_once('stripe-php-master/init.php');
\Stripe\Stripe::setApiKey('sk_test_51Ly3wRBjIjedb6hbaVxKhDaZZECfHTq9XPMUkO9nRG3a4cjayZGWYkEALpawNGelEOWgJ746l56c5NrstKCfGTHb008QGWKA29');

$token = $_POST['stripeToken'];
$total  = $_POST['total'];
$email  = $_POST['email'];

try {

	$customer = Stripe\Customer::create(array(
		'email' => $email,
		'source' => $token,
		));
	// Crear cargo de Stripe
$charge = \Stripe\Charge::create(
    array(
		'customer' => $customer->id,
        'amount' => $total*100,
        'currency' => "MXN", // Cambiar el tipo de moneda
		'description' =>'Pagos de Inscripcion/Reinscripción',
       
    )
);



if($charge->status=="succeeded"){
	echo "<script>alert('Pagado exitosamente! ');</script>";

	include "./../../../model/connection.php";
    $query_insert = mysqli_query($connection,"INSERT INTO `pago`(`monto`, `estatus_pago`, `f_creacion_pago`) 
	VALUES ('$total','$charge[status]', NOW())");
		//pago_cita(referencia_pago,transacción_saldo,descripcion,monto,moneda,status_pago,cliente,fecha)
    //VALUES ('$charge[id]','$charge[balance_transaction]','$charge[description]','$total','$charge[currency]','$charge[status]','$email',NOW())
	
}else{
	echo "<script>alert('Error al pagar!');</script>";
	Core::alert("Error al realizar el pago!");	
}
}catch(Exception $e){
	echo "<script>alert('".$e->getMessage()."');</script>";
}
// print_r($change);
?>