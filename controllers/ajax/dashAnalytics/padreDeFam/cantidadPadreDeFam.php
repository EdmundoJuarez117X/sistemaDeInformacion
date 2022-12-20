<?php
include("../../../../model/connection.php");

$db = $connection;
$sn = 0;

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
            $sn++;
        }
    } else {


    }

}

echo ($sn);
// echo "<script>
// const ctx = document.getElementById('myChart');

// new Chart(ctx, {
//     type: 'doughnut',
//     data: {
//         labels: ['Masculino','Femenino','Otro','Pref. No Decir'],
//         datasets: [{
//             label: ['Total'],
//             data: [".$masculino.",".$femenino.",".$otro.",".$prefieroNoDecir."],
//             backgroundColor: [
//                 '#47ABE2',
//                 '#ff7782',
//                 '#16C368',
//                 '#ffbb55',
//             ],
//             borderWidth: 0
//         }]
//     },
//     options: {
//         responsive: true,
//         plugins: {
//             legend: {
//               display: false
//             }
//           },        
//             // scales: {
//             //     y: {
//             //         beginAtZero: true
//             //     }
//             // }
//         }
//     });
// </script>";
?>