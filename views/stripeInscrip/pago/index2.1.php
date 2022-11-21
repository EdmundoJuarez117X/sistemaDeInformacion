<!DOCTYPE html>
<html>

<head>
  <title>Pago</title>
  <!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="./../../../styles/css/stripePayment/stripeForm.css">
  <meta charset="utf-8">
</head>

<body>

  <nav class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button> -->
        <a class="navbar-brand" href="#">Pagos en Linea </a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="./">Regresar</a></li>
        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Pago por Inscripción / Reinscripción </h1>
        <br>
        <form action="process.php" method="post" id="payment-form">

          
            <label for="exampleInputEmail1">Correo de tu cuenta escolar</label>
            <input type="email" required name="email" class="fields-middle second-middle" id="exampleInputEmail1"
              placeholder="Correo electrónico">
          
          <div class="form-group">
            <label for="exampleInputPassword1">Monto total</label>
            <?php
    const monto = 1000.00
      ?>
            <input style="display:grid;" type="number" value="<?php echo monto ?>" required name="totalX"
              class="form-control unselectable" id="exampleInputPasswordX" placeholder="$1,000" pattern="[0-9]+"
              title="Precio total a pagar" readonly="readonly">
            <span class="material-icons unselectable"
              style="display:grid; margin-left:-5px; margin-top: -30px; margin-bottom: 5px;">attach_money</span>
          </div>
          <div><input class="unselectable" type="number" value="<?php echo monto ?>" name="total"
              id="exampleInputPassword1" readonly="readonly" hidden></div>

          <label for="card-element">Tarjeta de crédito o debito</label>
          <div id="card-element">
            <!-- a Stripe Element will be inserted here. -->
          </div>
          <!-- Used to display form errors -->
          <div id="card-errors"></div>


          <input type="hidden" class="form-control" required name="paymethod_id" value="stripe">
          <br>
          <button class="btn btn-primary btn-block">Pagar</button>
        </form>

      </div>
    </div>

  </div>
  <script src="https://js.stripe.com/v3/"></script>
  <script type="text/javascript" src="charge.js"></script>
  </body>

</html>