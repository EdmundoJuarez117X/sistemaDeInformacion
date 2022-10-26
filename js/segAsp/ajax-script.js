$(document).on('click','#showData',function(e){
    $.ajax({    
      type: "GET",
      url: "./../../controllers/ajax/segAsp/backend-script.php",             
      dataType: "html",                  
      success: function(data){                    
          $("#table-container").html(data); 
         
      }
  });
});