<div class="info-buy-course-selected">
    <h1><?= $curso['nombre_curso']?></h1>
    <p class="p-descripcion-compra-curso"><strong>Descripción: </strong><?= $curso['descripcion_curso']?></p>
    <div class="left--section">
        <p><strong>Inicia: </strong><br><?= $curso['fecha_inicio_curso']?></p>
    </div>
    <div class="right--section">
        <p><strong>Finaliza: </strong><br><?= $curso['fecha_fin_curso']?></p>
    </div>
    <div class="left--section">
        <p><strong>Accesos totales: </strong><br><?= $curso['total_participantes']?></p>
    </div>
    <div class="right--section">
        <p><strong>Accesos disponibles: </strong><br>
            <?=($curso['total_participantes'])-($curso['participantes_registrados'])?>
        </p>
    </div>
    <div class="left--section">
        <p><strong>Costo unitario: </strong><br>$<?= $curso['costo_unitario']?></p>
    </div>
    <div class="right--section">
        <p><strong>Exclusivo para: </strong><br><?= $curso['rol_dirigido']?>s</p>
    </div>
    <div class="left--section">
        <p><strong>Requisitos: </strong><br><?= $curso['requisitos_curso']?></p>
    </div>
    <div class="right--section">
        <p><strong>Responsables: </strong><br><?= $curso['responsables_curso']?></p>
    </div>
</div>
<div class="info-buy-course-selected">
    <div class="container-for-pago">
        <h2>Ingresa tus datos</h2>
        <p><strong>Todos los campos son obligatorios</strong>, si el curso no tiene accesos o ingresa 
            una cantidad mayor a los accesos disponibles, no podrá realizar su compra.</p>
        <form action="../../../controllers/ajax/cursos-eventos/users/charge.php" method="post" id="payment-form">
            <div class="form-row">
                <div>
                    <input type="text" name="id_curso" value="<?= $id ?>" readonly style="display:none">
                    <input type="text" name="nombre_curso" value="<?= $curso['nombre_curso'] ?>" readonly style="display:none">
                    <input type="text" name="costo" value="<?= $curso['costo_unitario'] ?>" readonly style="display:none">
                    <input type="text" name="first_name" placeholder="Nombre" required>
                </div>
                <div>
                    <input type="text" name="last_name" placeholder="Apellido" required>
                </div>
                <div>
                    <input type="email" name="email" placeholder="Correo" required>
                </div>
                <div>
                    <?php $acceso = ($curso['total_participantes'])-($curso['participantes_registrados']); ?>
                    <input type="number" name="boletos" placeholder="<?= $acceso ?> accesos disponibles" min="1" max="<?= $acceso ?>" required>
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
        </form>
    </div>  
</div>