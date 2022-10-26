<?php
// session_start();
// if (empty($_SESSION["id_persona"])) {
//     header("location:index.php");
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <!-- CSS only -->
    <link rel="stylesheet" href="../../styles/css/comProfile.css">
    <title>Acceso al Sistema Escolar</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Formulario de registro -->
                <form method="post" action="completeProfile.php" class="sign-up-form">
                    <h2 class="title">Completa tu Perfil</h2>
                    <?php
                    // Conexión a la base de datos
                    include "../../model/connection.php";
                    // Controlador para acceder al login
                    include "../../controllers/controller_completeProfile.php";
                    ?>
                    
                    <div class="input-field">
                        <i class="material-icons-sharp">signpost</i>
                        <input type="text" placeholder="Calle" name="callePersona" required autocomplete="off">
                    </div>
                    <div class="input-field">
                        <i class="material-icons-sharp">signpost</i>
                        <input type="text" placeholder="Número" name="numeroCallePersona" required autocomplete="off">
                    </div>
                    <div class="input-field">
                        <i class="material-icons-sharp">location_city</i>
                        <input type="text" placeholder="Colonia" name="coloniaPersona" required autocomplete="off">
                    </div>
                    <div class="input-field">
                        <i class="material-icons-sharp">location_city</i>
                        <input type="text" placeholder="Estado" name="estadoPersona" required autocomplete="off">
                    </div>
                    <div class="input-field">
                        <i class="material-icons-sharp">location_city</i>
                        <input type="text" placeholder="Ciudad" name="ciudadPersona" required autocomplete="off">
                    </div>
                    <div class="input-field">
                        <i class="material-icons-sharp">location_city</i>
                        <input type="text" placeholder="Código Postal" name="codPostalPersona" required autocomplete="off">
                    </div>
                    <div>
                        <label >Fecha de Nacimiento</label>
                    </div>
                    <div class="input-field">
                        <i class="material-icons-sharp">person</i>
                        <input type="date"  id="datePickerId" name="fecha_nacimiento" required value="2000-01-01" min="1922-01-01" autocomplete="off">
                    </div>
                    <div class="input-field">
                        <i class="material-icons-sharp">person</i>
                        <select class="input-field"name="genero" required>
                            <option value="">Selecciona tu Género</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <i class="material-icons-sharp">person</i>
                        <select class="input-field"name="rol" required>
                            <option value="">¿Aspirante o Padre de Familia?</option>
                            <option value="5">Aspirante</option>
                            <option value="4">Padre de Familia</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <i class="material-icons-sharp">phone_iphone</i>
                        <input type="number" placeholder="Número de teléfono móvil" name="numero_telefonico" required autocomplete="off">
                    </div>
                    <input type="submit" name="btn_completarPerfil" value="Finalizar" class="btn solid">
                </form>

            </div>
        </div>
    </div>
    <script>
        datePickerId.max = new Date().toISOString().split("T")[0];
    </script>
</body>

</html>