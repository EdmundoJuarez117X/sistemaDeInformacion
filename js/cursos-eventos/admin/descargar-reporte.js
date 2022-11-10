function descargar_reporte() {
    var report_period = document.getElementById("report_period").value;
    // si cse ha seleccionado "Último mes"
    if(report_period == "op1") {
        window.open("../../archivos-pdf-php/reporte-cursos-pdf.php?pdo="+report_period, '_blank');
    }
    // si cse ha seleccionado "Últimos seis meses" 
    if(report_period == "op2") {
        window.open("../../archivos-pdf-php/reporte-cursos-pdf.php?pdo="+report_period, '_blank');   
    }
    // si cse ha seleccionado "Último año"
    if(report_period == "op3") {
        window.open("../../archivos-pdf-php/reporte-cursos-pdf.php?pdo="+report_period, '_blank');
    }
    // si cse ha seleccionado "Por fecha"
    if(report_period == "op4") {
        var date1 = document.getElementById("course_date_inicial").value;
        var date2 = document.getElementById("course_date_final").value;

        //console.log("../../archivos-pdf-php/reporte-cursos-pdf.php?fchaI="+date1+"&fchaF="+date2);
        window.open("../../archivos-pdf-php/reporte-cursos-pdf.php?pdo="+report_period+"&fchaI="+date1+"&fchaF="+date2, '_blank');        
    }
}