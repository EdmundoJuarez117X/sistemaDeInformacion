<?php
    session_start();
    if (empty($_SESSION["subMat"])) {
        header("location:../../../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../styles/css/eventos-cursos/eventos-cursos.css">
    <title>Document</title>
</head>
<body>
        <div class="actividad-cursos">
            <div class="text-actividad">
                <h1>Actividad de Cursos-Eventos</h1>
            </div>
            <div class="section-buttons">
                <button class="btn-actividad-curso" id="btn-mas-vendidos">Más vendidos</button>
                <button class="btn-actividad-curso" id="btn-mas-buscados">Más buscados</button>
            </div>
            <div class="contenedor-graficas">
                <canvas id="myChart" height="110"></canvas>
                <!--<canvas id="masBuscados" height="110"></canvas>-->
            </div>
        </div>

    <!-- Script de CHARTJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Script de PARA USAR JAVASCRIPT-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Script de visualizacion de gráfica 
    <script src="../../../js/cursos-eventos/admin/actions-admin.js"></script>-->

    <script>
        let myChart;
        $('#btn-mas-vendidos').click(function(){
            $.ajax({
                url: '../../../controllers/ajax/cursos-eventos/admin/grafica-reportes.php',
                type: 'POST'
            }).done(function(e){
                //alert(e);
                
                if(e.length > 0) {

                    var curso = [];
                    var total_accesos = [];
                    var data = JSON.parse(e);

                    for(var i = 0; i < data.length; i++) {

                        curso.push(data[i][0]);
                        total_accesos.push(data[i][1]);
                    }  
                }

                const ctx = document.getElementById('myChart');
                if (myChart) {
                    myChart.destroy();
                }
                myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: curso,
                        datasets: [{
                            label: 'Gráfica de reportes',
                            data: total_accesos,
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                stacked: true
                            }
                        }
                    }
                });
                
            });
        });

        $('#btn-mas-buscados').click(function(){
            $.ajax({
                url: '../../../controllers/ajax/cursos-eventos/admin/grafica-reportes.php',
                type: 'POST'
            }).done(function(e){
                //alert(e);
                
                if(e.length > 0) {

                    var curso = [];
                    var total_accesos = [];
                    var data = JSON.parse(e);

                    for(var i = 0; i < data.length; i++) {

                        curso.push(data[i][0]);
                        total_accesos.push(data[i][1]);
                    }  
                }

                const ctx = document.getElementById('myChart');
                if (myChart) {
                    myChart.destroy();
                }
                myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: curso,
                        datasets: [{
                            label: 'Gráfica de reportes',
                            data: total_accesos,
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        scales: {
                        x: {
                            beginAtZero: true
                        }
                        }
                    }
                });
                
            });
        });
    </script>

    <script>

        function MasVendidos() {
            $.ajax({
                url: '../../../controllers/ajax/cursos-eventos/admin/grafica-reportes.php',
                type: 'POST'
            }).done(function(e){
                //alert(e);
                
                if(e.length > 0) {
                    var curso = [];
                    var total_accesos = [];
                    var data = JSON.parse(e);

                    for(var i = 0; i < data.length; i++) {
                        curso.push(data[i][0]);
                        total_accesos.push(data[i][1]);
                    }
                    crearGrafico(curso, total_accesos, 'line', 'Cursos más vendidos', 'masVendidos');
                    document.getElementById('masBuscados').style.display = "none";
                    document.getElementById('masVendidos').style.display = "block";
                }
            });
        }

        function MasBuscados() {
            $.ajax({
                url: '../../../controllers/ajax/cursos-eventos/admin/grafica-reportes.php',
                type: 'POST'
            }).done(function(e){
                //alert(e);
                
                if(e.length > 0) {
                    var curso = [];
                    var total_accesos = [];
                    var data = JSON.parse(e);

                    for(var i = 0; i < data.length; i++) {
                        curso.push(data[i][0]);
                        total_accesos.push(data[i][1]);
                    }
                    crearGrafico(curso, total_accesos, 'line', 'Cursos más buscados', 'masBuscados');
                    document.getElementById('masVendidos').style.display = "none";
                    document.getElementById('masBuscados').style.display = "block";
                }
            });
        }
        //let myChart;
        function crearGrafico(curso, total_accesos, tipo, encabezado, id) {
            
            const ctx = document.getElementById(id);
            if (myChart) {
                myChart.destroy();
            }
            myChart = new Chart(ctx, {
                type: tipo,
                data: {
                    labels: curso,
                    datasets: [{
                        label: encabezado,
                        data: total_accesos,
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            stacked: true
                        }
                    }
                }
            });    
        }

    </script>

</body>
</html>