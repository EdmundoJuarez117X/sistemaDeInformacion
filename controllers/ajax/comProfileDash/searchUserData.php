<?php
include("./../../../model/connection.php");

session_start();


//Buscamos en las sesiones que tengan datos dependiendo si es aspirante, alumno, pf, etc.
if (isset($_SESSION["id_aspirante"])) { //Caso de aspirante
    $id_aspirante = $_SESSION["id_aspirante"]; //Obtenemos el id de las sesioness
    //Consultamos la direccion del alumno
    $sqlAspDir = $connection->query("SELECT `id_direccionAspirante`, `calleAspirante`, `numeroCalleAspirante`, `coloniaAspirante`, `estadoAspirante`, `ciudadAspirante`, `codPostalAspirante`, `f_creacion_DirAspirante`, `f_modificacion_DirAspirante`, `id_aspirante` 
    FROM `direccionAspirante` 
    WHERE id_aspirante = '$id_aspirante'");
    if ($resultAspDir = $sqlAspDir->fetch_object()) {
        //Guardamos los datos obtenidos
        $id_direccionAspirante = $resultAspDir->id_direccionAspirante;
        $calleAspirante = $resultAspDir->calleAspirante;
        $numeroCalleAspirante = $resultAspDir->numeroCalleAspirante;
        $coloniaAspirante = $resultAspDir->coloniaAspirante;
        $estadoAspirante = $resultAspDir->estadoAspirante;
        $ciudadAspirante = $resultAspDir->ciudadAspirante;
        $codPostalAspirante = $resultAspDir->codPostalAspirante;
        //Consultamos si tiene segundo nombre
        $sqlAspSegNom = $connection->query("SELECT `segundo_nombreAspirante`, `fecha_nacimientoAspirante`, `genero_Aspirante`, `numero_tel_Aspirante` FROM `aspirante` 
        WHERE id_aspirante = '$id_aspirante'");
        if ($resultAspSegNom = $sqlAspSegNom->fetch_object()) {
            $segundo_nombreAspirante = $resultAspSegNom->segundo_nombreAspirante;
            $fecha_nacimientoAspirante = $resultAspSegNom->fecha_nacimientoAspirante;
            $genero_Aspirante = $resultAspSegNom->genero_Aspirante;
            $numero_tel_Aspirante = $resultAspSegNom->numero_tel_Aspirante;
            if ($fecha_nacimientoAspirante != "0000-00-00") { //Corroboramos que la fecha de nacimiento sea valida
                //Creamos una sesion para actualizar los datos
                $_SESSION["updateUser"] = "activate";
                //Mostramos formulario con los datos que ya tiene para realizar actualización
                echo '<form method="post" action="completeProfileDash.php" class="sign-up-form">
            <h2 class="title">Completa tu Perfil</h2>
           
            <div class="input-field">
                <i class="material-icons-sharp">person</i>
                <input type="text" placeholder="Segundo Nombre (Opcional)" name="seg_nombre_persona"
                    autocomplete="off" value="' . $segundo_nombreAspirante . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">signpost</i>
                <input type="text" placeholder="Calle" name="callePersona" required autocomplete="off" value="' . $calleAspirante . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">signpost</i>
                <input type="text" placeholder="Número" name="numeroCallePersona" required autocomplete="off" value="' . $numeroCalleAspirante . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Colonia" name="coloniaPersona" required autocomplete="off" value="' . $coloniaAspirante . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Estado" name="estadoPersona" required autocomplete="off" value="' . $estadoAspirante . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Ciudad" name="ciudadPersona" required autocomplete="off" value="' . $ciudadAspirante . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Código Postal" name="codPostalPersona" required autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==5) return false;" value="' . $codPostalAspirante . '">
            </div>
            <div>
                <label>Escoger de nuevo la Fecha de Nacimiento</label><br>
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">person</i>
                <input type="date" id="datePickerId"  name="fecha_nacimiento" required 
                min="1922-01-01" autocomplete="off">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">person</i>
                <select class="input-field" name="genero" required>
                    <option value="' . $genero_Aspirante . '">' . $genero_Aspirante . '</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                    <option value="Prefiero No Decir">Prefiero No Decir</option>
                </select>
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">phone_iphone</i>
                <input type="number" placeholder="Número de teléfono móvil" name="numero_telefonico" required
                    autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==10) return false;" value="' . $numero_tel_Aspirante . '">
            </div>
            <input type="submit" name="btn_completarPerfil" value="Finalizar" class="btn solid">
            <button id="back" class="btnBack">Regresar</button>
        </form>
        <script>
    datePickerId.max = new Date().toISOString().split("T")[0];
</script>
<!-- Regreso de página -->
    <script src="./../../js/completeProfileDash/goPageBack.js">
    </script>';
            }


        } else { //Mostramos datos sin segundo nombre (Casos muy raros / Revisar seguridad si eso sucede)

        }

    } else { //Mostramos formulario vacío para el llenado de la información
        echo '<form method="post" action="completeProfileDash.php" class="sign-up-form">
        <h2 class="title">Completa tu Perfil</h2>
        
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <input type="text" placeholder="Segundo Nombre (Opcional)" name="seg_nombre_persona"
                autocomplete="off">
        </div>
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
            <input type="text" placeholder="Código Postal" name="codPostalPersona" required
                autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==5) return false;">
        </div>
        <div>
            <label>Fecha de Nacimiento</label>
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <input type="date" id="datePickerId" name="fecha_nacimiento" required value="2000-01-01"
                min="1922-01-01" autocomplete="off">
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <select class="input-field" name="genero" required>
                <option value="">Selecciona tu Género</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
                <option value="Prefiero No Decir">Prefiero No Decir</option>
            </select>
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">phone_iphone</i>
            <input type="number" placeholder="Número de teléfono móvil" name="numero_telefonico" required
                autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==10) return false;">
        </div>
        <input type="submit" name="btn_completarPerfil" value="Finalizar" class="btn solid">
        <button id="back" class="btnBack">Regresar</button>
    </form>
    <script>
    datePickerId.max = new Date().toISOString().split("T")[0];
</script>
<!-- Regreso de página -->
    <script src="./../../js/completeProfileDash/goPageBack.js">
    </script>';
    }

} else if (isset($_SESSION["id_padreDeFamilia"])) { //Caso de padre de familia
    $id_padreDeFamilia = $_SESSION["id_padreDeFamilia"]; //Obtenemos id del padre de fam de las sesiones
    //Consultamos la direccion del padre de familia
    $sqlPFDir = $connection->query("SELECT `id_direccionPadreDeFamilia`, `callePadreDeFam`, `numeroCallePadreDeFam`, `coloniaPadreDeFam`, `estadoPadreDeFam`, `ciudadPadreDeFam`, `codPostalPadreDeFam`, `f_creacion_DirPadreDeFam`, `f_modificacion_DirPadreDeFam`, `id_padreDeFamilia` 
    FROM `direccionPadreDeFamilia` 
    WHERE `id_padreDeFamilia`='$id_padreDeFamilia';");
    if ($resultPFDir = $sqlPFDir->fetch_object()) {
        //Guardamos los datos obtenidos
        $id_direccionPadreDeFamilia = $resultPFDir->id_direccionPadreDeFamilia;
        $callePadreDeFam = $resultPFDir->callePadreDeFam;
        $numeroCallePadreDeFam = $resultPFDir->numeroCallePadreDeFam;
        $coloniaPadreDeFam = $resultPFDir->coloniaPadreDeFam;
        $estadoPadreDeFam = $resultPFDir->estadoPadreDeFam;
        $ciudadPadreDeFam = $resultPFDir->ciudadPadreDeFam;
        $codPostalPadreDeFam = $resultPFDir->codPostalPadreDeFam;
        //Consultamos si tiene segundo nombre
        $sqlPFSegNom = $connection->query("SELECT `segundo_nombrepadreDeFam`, `fecha_nacimientopadreDeFam`, `genero_padreDeFam`, `numero_tel_padreDeFam` FROM `padreDeFamilia` 
        WHERE id_padreDeFamilia = '$id_padreDeFamilia'");
        if ($resultPFSegNom = $sqlPFSegNom->fetch_object()) {
            $segundo_nombrepadreDeFam = $resultPFSegNom->segundo_nombrepadreDeFam;
            $fecha_nacimientopadreDeFam = $resultPFSegNom->fecha_nacimientopadreDeFam;
            $genero_padreDeFam = $resultPFSegNom->genero_padreDeFam;
            $numero_tel_padreDeFam = $resultPFSegNom->numero_tel_padreDeFam;
            if ($fecha_nacimientopadreDeFam != "0000-00-00") { //Corroboramos que la fecha de nacimiento sea valida
                //Creamos una sesion para actualizar los datos
                $_SESSION["updateUser"] = "activate";
                //Mostramos formulario con los datos que ya tiene para realizar actualización
                echo '<form method="post" action="completeProfileDash.php" class="sign-up-form">
            <h2 class="title">Completa tu Perfil</h2>
           
            <div class="input-field">
                <i class="material-icons-sharp">person</i>
                <input type="text" placeholder="Segundo Nombre (Opcional)" name="seg_nombre_persona"
                    autocomplete="off" value="' . $segundo_nombrepadreDeFam . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">signpost</i>
                <input type="text" placeholder="Calle" name="callePersona" required autocomplete="off" value="' . $callePadreDeFam . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">signpost</i>
                <input type="text" placeholder="Número" name="numeroCallePersona" required autocomplete="off" value="' . $numeroCallePadreDeFam . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Colonia" name="coloniaPersona" required autocomplete="off" value="' . $coloniaPadreDeFam . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Estado" name="estadoPersona" required autocomplete="off" value="' . $estadoPadreDeFam . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Ciudad" name="ciudadPersona" required autocomplete="off" value="' . $ciudadPadreDeFam . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Código Postal" name="codPostalPersona" required autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==5) return false;" value="' . $codPostalPadreDeFam . '">
            </div>
            <div>
                <label>Escoger de nuevo la Fecha de Nacimiento</label><br>
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">person</i>
                <input type="date" id="datePickerId"  name="fecha_nacimiento" required 
                min="1922-01-01" autocomplete="off">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">person</i>
                <select class="input-field" name="genero" required>
                    <option value="' . $genero_padreDeFam . '">' . $genero_padreDeFam . '</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                    <option value="Prefiero No Decir">Prefiero No Decir</option>
                </select>
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">phone_iphone</i>
                <input type="number" placeholder="Número de teléfono móvil" name="numero_telefonico" required
                    autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==10) return false;" value="' . $numero_tel_padreDeFam . '">
            </div>
            <input type="submit" name="btn_completarPerfil" value="Finalizar" class="btn solid">
            <button id="back" class="btnBack">Regresar</button>
        </form>
        <script>
    datePickerId.max = new Date().toISOString().split("T")[0];
</script>
<!-- Regreso de página -->
    <script src="./../../js/completeProfileDash/goPageBack.js">
    </script>';
            }


        } else { //Mostramos datos sin segundo nombre (Casos muy raros / Revisar seguridad si eso sucede)

        }

    } else { //Mostramos formulario vacío para el llenado de la informacion
        echo '<form method="post" action="completeProfileDash.php" class="sign-up-form">
        <h2 class="title">Completa tu Perfil</h2>
        
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <input type="text" placeholder="Segundo Nombre (Opcional)" name="seg_nombre_persona"
                autocomplete="off">
        </div>
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
            <input type="text" placeholder="Código Postal" name="codPostalPersona" required
                autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==5) return false;">
        </div>
        <div>
            <label>Fecha de Nacimiento</label>
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <input type="date" id="datePickerId" name="fecha_nacimiento" required value="2000-01-01"
                min="1922-01-01" autocomplete="off">
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <select class="input-field" name="genero" required>
                <option value="">Selecciona tu Género</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
                <option value="Prefiero No Decir">Prefiero No Decir</option>
            </select>
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">phone_iphone</i>
            <input type="number" placeholder="Número de teléfono móvil" name="numero_telefonico" required
                autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==10) return false;">
        </div>
        <input type="submit" name="btn_completarPerfil" value="Finalizar" class="btn solid">
        <button id="back" class="btnBack">Regresar</button>
    </form>
    <script>
    datePickerId.max = new Date().toISOString().split("T")[0];
</script>
<!-- Regreso de página -->
    <script src="./../../js/completeProfileDash/goPageBack.js">
    </script>';
    }

} else if (isset($_SESSION["id_alumno"])) { //Caso de alumno
    $id_alumno = $_SESSION["id_alumno"]; //Obtenemos id del alumno (De las sesiones)
    //Consultamos la direccion del alumno
    $sqlAlDir = $connection->query("SELECT `id_direccionAlumno`, `calleAlumno`, `numeroCalleAlumno`, `coloniaAlumno`, `estadoAlumno`, `ciudadAlumno`, `codPostalAlumno`, `f_creacion_DirAlumno`, `f_modificacion_DirAlumno`, `id_alumno` 
    FROM `direccionAlumno`
    WHERE `id_alumno`='$id_alumno';");
    if ($resultAlDir = $sqlAlDir->fetch_object()) {
        //Guardamos los datos obtenidos
        $id_direccionAlumno = $resultAlDir->id_direccionAlumno;
        $calleAlumno = $resultAlDir->calleAlumno;
        $numeroCalleAlumno = $resultAlDir->numeroCalleAlumno;
        $coloniaAlumno = $resultAlDir->coloniaAlumno;
        $estadoAlumno = $resultAlDir->estadoAlumno;
        $ciudadAlumno = $resultAlDir->ciudadAlumno;
        $codPostalAlumno = $resultAlDir->codPostalAlumno;
        //Consultamos si tiene segundo nombre y obtenemos más datos como fecha de nacimiento y genero
        $sqlAlSegNom = $connection->query("SELECT `segundo_nombreAlumno`, `fecha_nacimientoAlumno`, `genero_Alumno`, `numero_tel_Alumno` 
        FROM `alumno` 
        WHERE id_alumno = '$id_alumno'");
        if ($resultAlSegNom = $sqlAlSegNom->fetch_object()) {
            $segundo_nombreAlumno = $resultAlSegNom->segundo_nombreAlumno;
            $fecha_nacimientoAlumno = $resultAlSegNom->fecha_nacimientoAlumno;
            $genero_Alumno = $resultAlSegNom->genero_Alumno;
            $numero_tel_Alumno = $resultAlSegNom->numero_tel_Alumno;
            if ($fecha_nacimientoAlumno != "0000-00-00") { //Corroboramos que la fecha de nacimiento sea valida
                //Creamos una sesion para actualizar los datos
                $_SESSION["updateUser"] = "activate";
                //Mostramos formulario con los datos que ya tiene para realizar actualización
                echo '<form method="post" action="completeProfileDash.php" class="sign-up-form">
            <h2 class="title">Completa tu Perfil</h2>
           
            <div class="input-field">
                <i class="material-icons-sharp">person</i>
                <input type="text" placeholder="Segundo Nombre (Opcional)" name="seg_nombre_persona"
                    autocomplete="off" value="' . $segundo_nombreAlumno . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">signpost</i>
                <input type="text" placeholder="Calle" name="callePersona" required autocomplete="off" value="' . $calleAlumno . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">signpost</i>
                <input type="text" placeholder="Número" name="numeroCallePersona" required autocomplete="off" value="' . $numeroCalleAlumno . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Colonia" name="coloniaPersona" required autocomplete="off" value="' . $coloniaAlumno . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Estado" name="estadoPersona" required autocomplete="off" value="' . $estadoAlumno . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Ciudad" name="ciudadPersona" required autocomplete="off" value="' . $ciudadAlumno . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Código Postal" name="codPostalPersona" required autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==5) return false;" value="' . $codPostalAlumno . '">
            </div>
            <div>
                <label>Escoger de nuevo la Fecha de Nacimiento</label><br>
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">person</i>
                <input type="date" id="datePickerId"  name="fecha_nacimiento" required 
                min="1922-01-01" autocomplete="off">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">person</i>
                <select class="input-field" name="genero" required>
                    <option value="' . $genero_Alumno . '">' . $genero_Alumno . '</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                    <option value="Prefiero No Decir">Prefiero No Decir</option>
                </select>
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">phone_iphone</i>
                <input type="number" placeholder="Número de teléfono móvil" name="numero_telefonico" required
                    autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==10) return false;" value="' . $numero_tel_Alumno . '">
            </div>
            <input type="submit" name="btn_completarPerfil" value="Finalizar" class="btn solid">
            <button id="back" class="btnBack">Regresar</button>
        </form>
        <script>
    datePickerId.max = new Date().toISOString().split("T")[0];
</script>
<!-- Regreso de página -->
    <script src="./../../js/completeProfileDash/goPageBack.js">
    </script>'; //En la parte inferior se tiene el script de regreso a la pagina del dashboard
            }


        } else { //Mostramos datos sin segundo nombre, fecha de nacimiento, género y numero de tel (Casos muy raros / Revisar seguridad si eso sucede)

        }
    } else { //Mostramos formulario vacío para el llenado de la información
        echo '<form method="post" action="completeProfileDash.php" class="sign-up-form">
        <h2 class="title">Completa tu Perfil</h2>
        
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <input type="text" placeholder="Segundo Nombre (Opcional)" name="seg_nombre_persona"
                autocomplete="off">
        </div>
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
            <input type="text" placeholder="Código Postal" name="codPostalPersona" required
                autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==5) return false;">
        </div>
        <div>
            <label>Fecha de Nacimiento</label>
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <input type="date" id="datePickerId" name="fecha_nacimiento" required value="2000-01-01"
                min="1922-01-01" autocomplete="off">
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <select class="input-field" name="genero" required>
                <option value="">Selecciona tu Género</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
                <option value="Prefiero No Decir">Prefiero No Decir</option>
            </select>
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">phone_iphone</i>
            <input type="number" placeholder="Número de teléfono móvil" name="numero_telefonico" required
                autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==10) return false;">
        </div>
        <input type="submit" name="btn_completarPerfil" value="Finalizar" class="btn solid">
        <button id="back" class="btnBack">Regresar</button>
    </form>
    <script>
    datePickerId.max = new Date().toISOString().split("T")[0];
</script>
<!-- Regreso de página -->
    <script src="./../../js/completeProfileDash/goPageBack.js">
    </script>';
    }

} else if (isset($_SESSION["id_docente"])) { //Caso de docente
    $id_docente = $_SESSION["id_docente"]; //Obtenemos id del docente (De las sesiones)
    //Consultamos la direccion del docente
    $sqlDocDir = $connection->query("SELECT `id_direccionDocente`, `calleDocente`, `numeroCalleDocente`, `coloniaDocente`, `estadoDocente`, `ciudadDocente`, `codPostalDocente`, `f_creacion_DirDocente`, `f_modificacion_DirDocente`, `id_docente` 
    FROM `direccionDocente` 
    WHERE `id_docente` = '$id_docente'");
    if ($resultDocDir = $sqlDocDir->fetch_object()) {
        //Guardamos los datos obtenidos
        $id_direccionDocente = $resultDocDir->id_direccionDocente;
        $calleDocente = $resultDocDir->calleDocente;
        $numeroCalleDocente = $resultDocDir->numeroCalleDocente;
        $coloniaDocente = $resultDocDir->coloniaDocente;
        $estadoDocente = $resultDocDir->estadoDocente;
        $ciudadDocente = $resultDocDir->ciudadDocente;
        $codPostalDocente = $resultDocDir->codPostalDocente;
        //Consultamos si tiene segundo nombre y obtenemos más datos como fecha de nacimiento y genero
        $sqlDocSegNom = $connection->query("SELECT `segundo_nombreDocente`, `fecha_nacimientoDocente`, `genero_Docente`, `numero_tel_Docente` 
        FROM `docente` 
        WHERE id_docente = '$id_docente'");
        if ($resultDocSegNom = $sqlDocSegNom->fetch_object()) {
            $segundo_nombreDocente = $resultDocSegNom->segundo_nombreDocente;
            $fecha_nacimientoDocente = $resultDocSegNom->fecha_nacimientoDocente;
            $genero_Docente = $resultDocSegNom->genero_Docente;
            $numero_tel_Docente = $resultDocSegNom->numero_tel_Docente;
            if ($fecha_nacimientoDocente != "0000-00-00") { //Corroboramos que la fecha de nacimiento sea valida
                //Creamos una sesion para actualizar los datos
                $_SESSION["updateUser"] = "activate";
                //Mostramos formulario con los datos que ya tiene para realizar actualización
                echo '<form method="post" action="completeProfileDash.php" class="sign-up-form">
            <h2 class="title">Completa tu Perfil</h2>
           
            <div class="input-field">
                <i class="material-icons-sharp">person</i>
                <input type="text" placeholder="Segundo Nombre (Opcional)" name="seg_nombre_persona"
                    autocomplete="off" value="' . $segundo_nombreDocente . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">signpost</i>
                <input type="text" placeholder="Calle" name="callePersona" required autocomplete="off" value="' . $calleDocente . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">signpost</i>
                <input type="text" placeholder="Número" name="numeroCallePersona" required autocomplete="off" value="' . $numeroCalleDocente . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Colonia" name="coloniaPersona" required autocomplete="off" value="' . $coloniaDocente . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Estado" name="estadoPersona" required autocomplete="off" value="' . $estadoDocente . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Ciudad" name="ciudadPersona" required autocomplete="off" value="' . $ciudadDocente . '">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">location_city</i>
                <input type="text" placeholder="Código Postal" name="codPostalPersona" required autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==5) return false;" value="' . $codPostalDocente . '">
            </div>
            <div>
                <label>Escoger de nuevo la Fecha de Nacimiento</label><br>
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">person</i>
                <input type="date" id="datePickerId"  name="fecha_nacimiento" required 
                min="1922-01-01" autocomplete="off">
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">person</i>
                <select class="input-field" name="genero" required>
                    <option value="' . $genero_Docente . '">' . $genero_Docente . '</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                    <option value="Prefiero No Decir">Prefiero No Decir</option>
                </select>
            </div>
            <div class="input-field">
                <i class="material-icons-sharp">phone_iphone</i>
                <input type="number" placeholder="Número de teléfono móvil" name="numero_telefonico" required
                    autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==10) return false;" value="' . $numero_tel_Docente . '">
            </div>
            <input type="submit" name="btn_completarPerfil" value="Finalizar" class="btn solid">
            <button id="back" class="btnBack">Regresar</button>
        </form>
        <script>
    datePickerId.max = new Date().toISOString().split("T")[0];
</script>
<!-- Regreso de página -->
    <script src="./../../js/completeProfileDash/goPageBack.js">
    </script>'; //En la parte inferior se tiene el script de regreso a la pagina del dashboard
            }

        } else { //Mostramos datos sin segundo nombre, fecha de nacimiento, género y numero de tel (Casos muy raros / Revisar seguridad si eso sucede)

        }
    } else { //Mostramos formulario vacío para el llenado de la información
        echo '<form method="post" action="completeProfileDash.php" class="sign-up-form">
        <h2 class="title">Completa tu Perfil</h2>
        
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <input type="text" placeholder="Segundo Nombre (Opcional)" name="seg_nombre_persona"
                autocomplete="off">
        </div>
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
            <input type="text" placeholder="Código Postal" name="codPostalPersona" required
                autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==5) return false;">
        </div>
        <div>
            <label>Fecha de Nacimiento</label>
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <input type="date" id="datePickerId" name="fecha_nacimiento" required value="2000-01-01"
                min="1922-01-01" autocomplete="off">
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <select class="input-field" name="genero" required>
                <option value="">Selecciona tu Género</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
                <option value="Prefiero No Decir">Prefiero No Decir</option>
            </select>
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">phone_iphone</i>
            <input type="number" placeholder="Número de teléfono móvil" name="numero_telefonico" required
                autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==10) return false;">
        </div>
        <input type="submit" name="btn_completarPerfil" value="Finalizar" class="btn solid">
        <button id="back" class="btnBack">Regresar</button>
    </form>
    <script>
    datePickerId.max = new Date().toISOString().split("T")[0];
</script>
<!-- Regreso de página -->
    <script src="./../../js/completeProfileDash/goPageBack.js">
    </script>';

    }

} else if (isset($_SESSION["id_administrador"])) { //Caso de administrador
    $id_administrador = $_SESSION["id_administrador"]; //Obtenemos id del admin (De las sesiones)
    //Consultamos la direccion del admin
    $sqlAdmDir = $connection->query("SELECT `id_direccionAdmin`, `calleAdmin`, `numeroCalleAdmin`, `coloniaAdmin`, `estadoAdmin`, `ciudadAdmin`, `codPostalAdmin`, `f_creacion_DirAdmin`, `f_modificacion_DirAdmin`, `id_administrador` 
    FROM `direccionAdministrador`
    WHERE `id_administrador` = '$id_administrador'");
    if ($resultAdmDir = $sqlAdmDir->fetch_object()) {
         //Guardamos los datos obtenidos
         $id_direccionAdmin = $resultAdmDir->id_direccionAdmin;
         $calleAdmin = $resultAdmDir->calleAdmin;
         $numeroCalleAdmin = $resultAdmDir->numeroCalleAdmin;
         $coloniaAdmin = $resultAdmDir->coloniaAdmin;
         $estadoAdmin = $resultAdmDir->estadoAdmin;
         $ciudadAdmin = $resultAdmDir->ciudadAdmin;
         $codPostalAdmin = $resultAdmDir->codPostalAdmin;
         //Consultamos si tiene segundo nombre y obtenemos más datos como fecha de nacimiento y genero
         $sqlAdmSegNom = $connection->query("SELECT `segundo_nombreAdmin`, `fecha_nacimientoAdmin`, `genero_Admin`, `numero_tel_Admin` 
         FROM `administrador` 
         WHERE id_administrador = '$id_administrador'");
         if ($resultAdmSegNom = $sqlAdmSegNom->fetch_object()) {
             $segundo_nombreAdmin = $resultAdmSegNom->segundo_nombreAdmin;
             $fecha_nacimientoAdmin = $resultAdmSegNom->fecha_nacimientoAdmin;
             $genero_Admin = $resultAdmSegNom->genero_Admin;
             $numero_tel_Admin = $resultAdmSegNom->numero_tel_Admin;
             if ($fecha_nacimientoAdmin != "0000-00-00") { //Corroboramos que la fecha de nacimiento sea valida
                 //Creamos una sesion para actualizar los datos
                 $_SESSION["updateUser"] = "activate";
                 //Mostramos formulario con los datos que ya tiene para realizar actualización
                 echo '<form method="post" action="completeProfileDash.php" class="sign-up-form">
             <h2 class="title">Completa tu Perfil</h2>
            
             <div class="input-field">
                 <i class="material-icons-sharp">person</i>
                 <input type="text" placeholder="Segundo Nombre (Opcional)" name="seg_nombre_persona"
                     autocomplete="off" value="' . $segundo_nombreAdmin . '">
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">signpost</i>
                 <input type="text" placeholder="Calle" name="callePersona" required autocomplete="off" value="' . $calleAdmin . '">
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">signpost</i>
                 <input type="text" placeholder="Número" name="numeroCallePersona" required autocomplete="off" value="' . $numeroCalleAdmin . '">
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">location_city</i>
                 <input type="text" placeholder="Colonia" name="coloniaPersona" required autocomplete="off" value="' . $coloniaAdmin . '">
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">location_city</i>
                 <input type="text" placeholder="Estado" name="estadoPersona" required autocomplete="off" value="' . $estadoAdmin . '">
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">location_city</i>
                 <input type="text" placeholder="Ciudad" name="ciudadPersona" required autocomplete="off" value="' . $ciudadAdmin . '">
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">location_city</i>
                 <input type="text" placeholder="Código Postal" name="codPostalPersona" required autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==5) return false;" value="' . $codPostalAdmin . '">
             </div>
             <div>
                 <label>Escoger de nuevo la Fecha de Nacimiento</label><br>
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">person</i>
                 <input type="date" id="datePickerId"  name="fecha_nacimiento" required 
                 min="1922-01-01" autocomplete="off">
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">person</i>
                 <select class="input-field" name="genero" required>
                     <option value="' . $genero_Admin . '">' . $genero_Admin . '</option>
                     <option value="Masculino">Masculino</option>
                     <option value="Femenino">Femenino</option>
                     <option value="Otro">Otro</option>
                     <option value="Prefiero No Decir">Prefiero No Decir</option>
                 </select>
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">phone_iphone</i>
                 <input type="number" placeholder="Número de teléfono móvil" name="numero_telefonico" required
                     autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==10) return false;" value="' . $numero_tel_Admin . '">
             </div>
             <input type="submit" name="btn_completarPerfil" value="Finalizar" class="btn solid">
             <button id="back" class="btnBack">Regresar</button>
         </form>
         <script>
     datePickerId.max = new Date().toISOString().split("T")[0];
 </script>
 <!-- Regreso de página -->
     <script src="./../../js/completeProfileDash/goPageBack.js">
     </script>'; //En la parte inferior se tiene el script de regreso a la pagina del dashboard
             }
 
         } else { //Mostramos datos sin segundo nombre, fecha de nacimiento, género y numero de tel (Casos muy raros / Revisar seguridad si eso sucede)
 
         }
    } else { //Mostramos formulario vacío para el llenado de la información
        echo '<form method="post" action="completeProfileDash.php" class="sign-up-form">
        <h2 class="title">Completa tu Perfil</h2>
        
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <input type="text" placeholder="Segundo Nombre (Opcional)" name="seg_nombre_persona"
                autocomplete="off">
        </div>
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
            <input type="text" placeholder="Código Postal" name="codPostalPersona" required
                autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==5) return false;">
        </div>
        <div>
            <label>Fecha de Nacimiento</label>
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <input type="date" id="datePickerId" name="fecha_nacimiento" required value="2000-01-01"
                min="1922-01-01" autocomplete="off">
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <select class="input-field" name="genero" required>
                <option value="">Selecciona tu Género</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
                <option value="Prefiero No Decir">Prefiero No Decir</option>
            </select>
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">phone_iphone</i>
            <input type="number" placeholder="Número de teléfono móvil" name="numero_telefonico" required
                autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==10) return false;">
        </div>
        <input type="submit" name="btn_completarPerfil" value="Finalizar" class="btn solid">
        <button id="back" class="btnBack">Regresar</button>
    </form>
    <script>
    datePickerId.max = new Date().toISOString().split("T")[0];
</script>
<!-- Regreso de página -->
    <script src="./../../js/completeProfileDash/goPageBack.js">
    </script>';
    }

} else if (isset($_SESSION["id_master"])) { //Caso de Master
    $id_master = $_SESSION["id_master"]; //Obtenemos id del master (De las sesiones)
    //Consultamos la direccion del master
    $sqlMstDir = $connection->query("SELECT `id_direccionMaster`, `calleMaster`, `numeroCalleMaster`, `coloniaMaster`, `estadoMaster`, `ciudadMaster`, `codPostalMaster`, `f_creacion_DirMaster`, `f_modificacion_DirMaster`, `id_master`
    FROM `direccionMaster` 
    WHERE `id_master`='$id_master'");
    if($resultMstDir = $sqlMstDir->fetch_object()){
         //Guardamos los datos obtenidos
         $id_direccionMaster = $resultMstDir->id_direccionMaster;
         $calleMaster = $resultMstDir->calleMaster;
         $numeroCalleMaster = $resultMstDir->numeroCalleMaster;
         $coloniaMaster = $resultMstDir->coloniaMaster;
         $estadoMaster = $resultMstDir->estadoMaster;
         $ciudadMaster = $resultMstDir->ciudadMaster;
         $codPostalMaster = $resultMstDir->codPostalMaster;
         //Consultamos si tiene segundo nombre y obtenemos más datos como fecha de nacimiento y genero
         $sqlMstSegNom = $connection->query("SELECT `segundo_nombreMaster`, `fecha_nacimientoMaster`, `genero_Master`, `numero_tel_Master` 
         FROM `master` 
         WHERE id_master = '$id_master'");
         if ($resultMstSegNom = $sqlMstSegNom->fetch_object()) {
             $segundo_nombreMaster = $resultMstSegNom->segundo_nombreMaster;
             $fecha_nacimientoMaster = $resultMstSegNom->fecha_nacimientoMaster;
             $genero_Master = $resultMstSegNom->genero_Master;
             $numero_tel_Master = $resultMstSegNom->numero_tel_Master;
             if ($fecha_nacimientoMaster != "0000-00-00") { //Corroboramos que la fecha de nacimiento sea valida
                 //Creamos una sesion para actualizar los datos
                 $_SESSION["updateUser"] = "activate";
                 //Mostramos formulario con los datos que ya tiene para realizar actualización
                 echo '<form method="post" action="completeProfileDash.php" class="sign-up-form">
             <h2 class="title">Completa tu Perfil</h2>
            
             <div class="input-field">
                 <i class="material-icons-sharp">person</i>
                 <input type="text" placeholder="Segundo Nombre (Opcional)" name="seg_nombre_persona"
                     autocomplete="off" value="' . $segundo_nombreMaster . '">
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">signpost</i>
                 <input type="text" placeholder="Calle" name="callePersona" required autocomplete="off" value="' . $calleMaster . '">
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">signpost</i>
                 <input type="text" placeholder="Número" name="numeroCallePersona" required autocomplete="off" value="' . $numeroCalleMaster . '">
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">location_city</i>
                 <input type="text" placeholder="Colonia" name="coloniaPersona" required autocomplete="off" value="' . $coloniaMaster . '">
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">location_city</i>
                 <input type="text" placeholder="Estado" name="estadoPersona" required autocomplete="off" value="' . $estadoMaster . '">
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">location_city</i>
                 <input type="text" placeholder="Ciudad" name="ciudadPersona" required autocomplete="off" value="' . $ciudadMaster . '">
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">location_city</i>
                 <input type="text" placeholder="Código Postal" name="codPostalPersona" required autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==5) return false;" value="' . $codPostalMaster . '">
             </div>
             <div>
                 <label>Escoger de nuevo la Fecha de Nacimiento</label><br>
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">person</i>
                 <input type="date" id="datePickerId"  name="fecha_nacimiento" required 
                 min="1922-01-01" autocomplete="off">
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">person</i>
                 <select class="input-field" name="genero" required>
                     <option value="' . $genero_Master . '">' . $genero_Master . '</option>
                     <option value="Masculino">Masculino</option>
                     <option value="Femenino">Femenino</option>
                     <option value="Otro">Otro</option>
                     <option value="Prefiero No Decir">Prefiero No Decir</option>
                 </select>
             </div>
             <div class="input-field">
                 <i class="material-icons-sharp">phone_iphone</i>
                 <input type="number" placeholder="Número de teléfono móvil" name="numero_telefonico" required
                     autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==10) return false;" value="' . $numero_tel_Master . '">
             </div>
             <input type="submit" name="btn_completarPerfil" value="Finalizar" class="btn solid">
             <button id="back" class="btnBack">Regresar</button>
         </form>
         <script>
     datePickerId.max = new Date().toISOString().split("T")[0];
 </script>
 <!-- Regreso de página -->
     <script src="./../../js/completeProfileDash/goPageBack.js">
     </script>'; //En la parte inferior se tiene el script de regreso a la pagina del dashboard
             }
 
         } else { //Mostramos datos sin segundo nombre, fecha de nacimiento, género y numero de tel (Casos muy raros / Revisar seguridad si eso sucede)
            
         }
    }else { //Mostramos formulario vacío para el llenado de la información
        echo '<form method="post" action="completeProfileDash.php" class="sign-up-form">
        <h2 class="title">Completa tu Perfil</h2>
        
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <input type="text" placeholder="Segundo Nombre (Opcional)" name="seg_nombre_persona"
                autocomplete="off">
        </div>
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
            <input type="text" placeholder="Código Postal" name="codPostalPersona" required
                autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==5) return false;">
        </div>
        <div>
            <label>Fecha de Nacimiento</label>
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <input type="date" id="datePickerId" name="fecha_nacimiento" required value="2000-01-01"
                min="1922-01-01" autocomplete="off">
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">person</i>
            <select class="input-field" name="genero" required>
                <option value="">Selecciona tu Género</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
                <option value="Prefiero No Decir">Prefiero No Decir</option>
            </select>
        </div>
        <div class="input-field">
            <i class="material-icons-sharp">phone_iphone</i>
            <input type="number" placeholder="Número de teléfono móvil" name="numero_telefonico" required
                autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\'); this.value = this.value.replace(/(\..*)\./g, \'$1\');" onKeyPress="if(this.value.length==10) return false;">
        </div>
        <input type="submit" name="btn_completarPerfil" value="Finalizar" class="btn solid">
        <button id="back" class="btnBack">Regresar</button>
    </form>
    <script>
    datePickerId.max = new Date().toISOString().split("T")[0];
</script>
<!-- Regreso de página -->
    <script src="./../../js/completeProfileDash/goPageBack.js">
    </script>';
    }

}

?>