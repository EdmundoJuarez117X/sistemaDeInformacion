<?php
include("../../../../model/connection.php");

$db = $connection;
$sn = 0;
// session_start();

// $sqlAl = $connection->query("SELECT `genero_Alumno` 
//      FROM `alumno`");
// if ($resultAl = $sqlAl->fetch_object()) {
//     //Obtenemos el genero de cada alumno
//     $genero_Alumno = $resultAl->genero_Alumno;
//Creamos un contador de generos para cada uno
$masculino = 0;
$femenino = 0;
$otro = 0;
$prefieroNoDecir = 0;



// }

function fetch_data()
{
    global $db;
    
    

    $query = "SELECT `genero_padreDeFam` 
     FROM `padreDeFamilia`";

    $exec = mysqli_query($db, $query);
    if (mysqli_num_rows($exec) > 0) {
        $row = mysqli_fetch_all($exec, MYSQLI_ASSOC);
        return $row;

    } else {
        return $row = [];
    }
}
$fetchData = fetch_data();
show_data($fetchData);

function show_data($fetchData)
{
    global $masculino;
    global $femenino;
    global $otro;
    global $prefieroNoDecir;
    global $sn;
    if (count($fetchData) > 0) {
        $sn = 0;
        foreach ($fetchData as $data) {
            if ($data['genero_padreDeFam'] == "Masculino") {
                $masculino ++;
            } else if ($data['genero_padreDeFam'] == "Femenino") {
                $femenino ++;
            } else if ($data['genero_padreDeFam'] == "Otro") {
                $otro ++;
            } else if ($data['genero_padreDeFam'] == "Prefiero No Decir") {
                $prefieroNoDecir++;
            }

            $sn++;
        }
    } else {


    }

}


echo "<script>
const ctx3 = document.getElementById('myChartPadreDeFam');

new Chart(ctx3, {
    type: 'doughnut',
    data: {
        labels: ['Masculino','Femenino','Otro','Pref. No Decir'],
        datasets: [{
            label: ['Total'],
            data: [".$masculino.",".$femenino.",".$otro.",".$prefieroNoDecir."],
            backgroundColor: [
                '#47ABE2',
                '#ff7782',
                '#16C368',
                '#ffbb55',
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
              display: false
            }
          },        
            // scales: {
            //     y: {
            //         beginAtZero: true
            //     }
            // }
        }
    });
</script>";
?>