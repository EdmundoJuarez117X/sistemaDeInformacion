function mostrar_datos() {
    //obtenemos el id del elemento dentro del select option
    var report_period = document.getElementById("report_period").value;
    //iniciamos el envío de de datos
    if(report_period == "op1" || report_period == "op2" || report_period == "op3") {
        $.ajax({    
            type: "GET",
            url: "../../../controllers/ajax/cursos-eventos/backend-reportes.php",      
            dataType: "html",                  
            success: function(data){                    
                $("#report-courses-info").html(data); 
            }
        });
    } else if(report_period == "op4") {
        $.ajax({    
            type: "GET",
            url: "../../../controllers/ajax/cursos-eventos/mostrar-inputs-filtrado-fecha.php",      
            dataType: "html",                  
            success: function(data){                    
                $("#show-inputs-data-filter").html(data); 
            }
        });
    } 
}