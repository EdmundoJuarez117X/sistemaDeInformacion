$(function(){

    showUserInfo();
    
    function showUserInfo(){
        $.ajax({
            url: "./../../controllers/ajax/dashAnalytics/DatosPadreDeFam.php",
            type: "POST",
            // data: {
            //   nivelEdu: nivelEdu,
            //   periodoE: periodoE,
            //   modalidadE: modalidadE
            // },
    
            dataType: "html",
            success: function (data) {
              $("#comProfileForm").html(data);
            }
          });
    }
    
    });