<?php

    include('../../../model/connection.php');
    $db = $connection;

    $query = 'SELECT cursos.id_curso, cursos.nombre_curso, cursos.descripcion_curso, cursos.portada_curso, cursos.costo_unitario FROM cursos';
    $datas = $db->query($query);
    if($datas->num_rows > 0) {
        while($curso = $datas->fetch_assoc()) {
?>

            <a href="info-curso.php?cso=<?= $curso['id_curso'] ?>">
                <div class="courses">
                    <div class="profile-photo">
                        <img src="data:image/jpeg;base64,<?= base64_encode($curso["portada_curso"]) ?>" alt="">
                    </div>
                    <div class="message">
                        <p><b><?= $curso['nombre_curso'] ?></b><br> <?= $curso['descripcion_curso'] ?> </p>
                        <small class="text-muted"><strong> $ <?= $curso['costo_unitario'] ?> </strong></small>
                    </div>
                </div>
            </a>

<?php
        }
    }

?>