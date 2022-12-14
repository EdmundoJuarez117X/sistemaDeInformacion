<div class="info-curso-compra-container">
    <h1><?= $curso['nombre_curso']?></h1>
    <p><strong>Descripción: </strong><?= $curso['descripcion_curso']?></p>
    <div class="middle-section-informaction">
        <p><strong>Inicia:</strong><br> <?= $curso['fecha_inicio_curso']?> </p>
    </div>
    <div class="middle-section-informaction">
        <p><strong>Finaliza:</strong><br><?= $curso['fecha_fin_curso']?></p>
    </div>
    <div class="middle-section-informaction">
        <p><strong>Lugares totales:</strong><br><?= $curso['total_participantes']?></p>
    </div>
    <div class="middle-section-informaction">
        <p><strong>Lugares disponibles:</strong><br><?=($curso['total_participantes'])-($curso['participantes_registrados'])?></p>
    </div>
    <div class="middle-section-informaction">
        <p><strong>Costo unitario:</strong><br>$<?= $curso['costo_unitario']?></p>
    </div>
    <div class="middle-section-informaction">
        <p><strong>Exclusivo para:</strong><br><?= $curso['rol_dirigido']?>s</p>
    </div>
    <div class="middle-section-informaction">
        <p><strong>Requisitos:</strong><br><?= $curso['requisitos_curso']?></p>
    </div>
    <div class="middle-section-informaction">
        <p><strong>Responsables:</strong><br><?= $curso['responsables_curso']?></p>
    </div>
</div>
<div class="info-curso-compra-container">
    <div class="container-for-pago">
        <div class="logotipo-stripe">
            <a href="https://stripe.com/mx" target="_blank">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Stripe_Logo%2C_revised_2016.svg/2560px-Stripe_Logo%2C_revised_2016.svg.png">
            </a>
        </div>
        <p><strong>Todos los campos son obligatorios</strong>, si el curso no tiene accesos o ingresa 
        una cantidad mayor a los accesos disponibles, no podrá realizar su compra.</p>
        <form action="../../../controllers/ajax/cursos-eventos/users/charge.php" method="post" id="payment-form">
            <div class="form-row">
                <div>
                    <input type="text" name="id_curso" value="<?= $curso['id_curso'] ?>" readonly style="display:none;">
                    <input type="text" name="nombre_curso" value="<?= $curso['nombre_curso'] ?>" readonly style="display:none;">
                    <input type="text" name="costo" value="<?= $curso['costo_unitario'] ?>" readonly style="display:none;">
                    <input type="text" name="nombre_cliente" value="<?= $nombre_user ?>" required>
                </div>
                <div>
                    <input type="text" name="apellido_cliente" value="<?= $apellido_user ?>" required>
                </div>
                <div>
                    <input type="email" name="email" value="<?= $correo ?>" required>
                </div>
                <div>
                    <?php $acceso = ($curso['total_participantes'])-($curso['participantes_registrados']); ?>
                    <input type="number" name="boletos" placeholder="<?= $acceso ?> lugares disponibles" min="1" max="<?= $acceso ?>" required>
                </div>
                <div>
                    <label for="card-element">
                        Targeta de credito y debito
                    </label>
                    <div id="card-element" class="form-control"></div>
                                            
                    <div id="card-errors" role="alert"></div>
                </div>
            </div>
            <button>Pagar</button>
            <p class="link-stripe">Todas las tranferencias son realizadas por <a href="https://stripe.com/mx" target="_blank">Stripe</a></p>
        </form>
    </div>  
</div>