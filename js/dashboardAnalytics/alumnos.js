$(function () {
  // Alumnos
  showUserInfo();//Alumno
  showTotal();//Alumno
  showDocInfo();//Docente
  showTotalDoc();//Docente
  showPFInfo();//Padre de Familia
  showTotalPF();//Padre de Familia
  function showUserInfo() {
    $.ajax({
      url: "./../../controllers/ajax/dashAnalytics/alumno/datosAlumno.php",
      type: "POST",


      dataType: "html",
      success: function (data) {
        $("#alumnosChart").html(data);
      }
    });
  }
  function showTotal() {
    $.ajax({
      url: "./../../controllers/ajax/dashAnalytics/alumno/cantidadAlumno.php",
      type: "POST",


      dataType: "html",
      success: function (data) {
        $("#alumnosCantidad").html(data);
      }
    });
  }

  // Docentes
  function showDocInfo() {
    $.ajax({
      url: "./../../controllers/ajax/dashAnalytics/docente/datosDocente.php",
      type: "POST",


      dataType: "html",
      success: function (data) {
        $("#docentesChart").html(data);
      }
    });
  }
  function showTotalDoc() {
    $.ajax({
      url: "./../../controllers/ajax/dashAnalytics/docente/cantidadDocente.php",
      type: "POST",


      dataType: "html",
      success: function (data) {
        $("#docentesCantidad").html(data);
      }
    });
  }

  //Padres de Fam
  function showPFInfo(){
    $.ajax({
        url: "./../../controllers/ajax/dashAnalytics/padreDeFam/datosPadreDeFam.php",
        type: "POST",
       

        dataType: "html",
        success: function (data) {
          $("#padresDeFamChart").html(data);
        }
      });
}
function showTotalPF(){
    $.ajax({
        url: "./../../controllers/ajax/dashAnalytics/padreDeFam/cantidadPadreDeFam.php",
        type: "POST",
        

        dataType: "html",
        success: function (data) {
          $("#padresDeFamCantidad").html(data);
        }
      });
}

});