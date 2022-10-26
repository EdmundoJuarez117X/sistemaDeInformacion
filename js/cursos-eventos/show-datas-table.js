$(document).on('click','#showData',function(e){
    $.ajax({    
      type: "GET",
      url: "./../../controllers/ajax/cursos-eventos/backend-cursos.php",             
      dataType: "html",                  
      success: function(data){                    
          $("#table-container").html(data); 
         
      }
  });
});