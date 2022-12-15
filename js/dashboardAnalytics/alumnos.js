$(function(){

    showUserInfo();
    showTotal();
    function showUserInfo(){
        $.ajax({
            url: "./../../controllers/ajax/dashAnalytics/alumno/datosAlumno.php",
            type: "POST",
           
    
            dataType: "html",
            success: function (data) {
              $("#alumnosChart").html(data);
            }
          });
    }
    function showTotal(){
        $.ajax({
            url: "./../../controllers/ajax/dashAnalytics/alumno/cantidadAlumno.php",
            type: "GET",
            
    
            dataType: "html",
            success: function (data) {
              $("#alumnosCantidad").html(data);
            }
          });
    }
    
});