$(document).on('click','#btn-see-info',function(e){
    $.ajax({    
      type: "GET",
      url: "../../../controllers/ajax/cursos-eventos/backend-reportes.php",      
      dataType: "html",                  
      success: function(data){                    
          $("#report-courses-info").html(data); 
      }
    });
});