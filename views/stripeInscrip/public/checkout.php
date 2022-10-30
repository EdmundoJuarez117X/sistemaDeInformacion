<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagos SISESCOLAR</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
  <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
  <section>
    <div class="product">
      <img src="payment.png" alt="Payment image" />
      <div class="description">
        <h3>Pago de Inscripción y Reinscripción</h3>
        <h5>$1,000.00</h5>
      </div>
    </div>
    <form action="create-checkout-session.php" method="POST">
      <button type="submit" id="checkout-button">Pagar</button>
    </form>
  </section>
</body>

</html>