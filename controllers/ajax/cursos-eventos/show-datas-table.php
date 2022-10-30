<?php

    include('../../../model/connection.php');
    $db = $connection;

    $query = 'SELECT * FROM CURSOS';
    $datas = $db->query($query);
    if($datas->num_rows > 0) {
        while($fila = $datas->fetch_assoc()) {
?>

        <tr>
            <td><a class='a-curso-info' href='info-curso.php?ver="<?= $fila['id_curso'] ?>"'> <?= $fila['nombre_curso'] ?> </a></td>
            <td> <?= $fila['total_participantes'] ?> </td>
            <td><a target="__blank" href="../../archivos-pdf-php/usuarios-registrados-pdf.php"> <?= $fila['participantes_registrados'] ?> </a></td>
            <td> <?= $fila['costo_unitario'] ?> </td>
            <td> <?= $fila['estatus_curso'] ?> </td>
            <td><a class='a-span-edit' href='actualizar-curso.php'><span class='material-icons-sharp'>edit</span></a></td>
            <td><button class='btn-visible-course'><span class='material-icons-sharp'>visibility</span></button></td>
        </tr>

<?php
        }
    }

?>