$(document).on('click', '#showData', function (e) {
  let nivelEdu = $('#select_nivelEdu').val();
  let periodoE = $('#select_periodoE').val();
  let modalidadE = $('#select_modalidadE').val();

  if (nivelEdu != "" && periodoE != "" && modalidadE != "") {
    if (nivelEdu == "Superior") {
      $.ajax({
        url: "./../../controllers/ajax/aspAdmision/backend-scriptAllInputsSup.php",
        type: "POST",
        data: {
          nivelEdu: nivelEdu,
          periodoE: periodoE,
          modalidadE: modalidadE
        },

        dataType: "html",
        success: function (data) {
          $("#table-container").html(data);
        }
      });

    } else {
      $.ajax({
        url: "./../../controllers/ajax/aspAdmision/backend-scriptAllInputs.php",
        type: "POST",
        data: {
          nivelEdu: nivelEdu,
          periodoE: periodoE,
          modalidadE: modalidadE
        },

        dataType: "html",
        success: function (data) {
          $("#table-container").html(data);
        }
      });
    }

  } else if(nivelEdu != "" && periodoE != ""){
    if (nivelEdu == "Superior") {
      $.ajax({
        url: "./../../controllers/ajax/aspAdmision/backend-scriptNPSup.php", //Nivel Educativo y Periodo Escolar Superior
        type: "POST",
        data: {
          nivelEdu: nivelEdu,
          periodoE: periodoE
        },

        dataType: "html",
        success: function (data) {
          $("#table-container").html(data);
        }
      });

    } else {
      $.ajax({
        url: "./../../controllers/ajax/aspAdmision/backend-scriptNP.php",//Nivel educativo y Periodo Escolar
        type: "POST",
        data: {
          nivelEdu: nivelEdu,
          periodoE: periodoE
        },

        dataType: "html",
        success: function (data) {
          $("#table-container").html(data);
        }
      });
    }

  } else if(nivelEdu != "" && modalidadE != ""){
    if (nivelEdu == "Superior") {
      $.ajax({
        url: "./../../controllers/ajax/aspAdmision/backend-scriptNMSup.php",
        type: "POST",
        data: {
          nivelEdu: nivelEdu,
          modalidadE: modalidadE
        },

        dataType: "html",
        success: function (data) {
          $("#table-container").html(data);
        }
      });

    } else {
      $.ajax({
        url: "./../../controllers/ajax/aspAdmision/backend-scriptNM.php",
        type: "POST",
        data: {
          nivelEdu: nivelEdu,
          modalidadE: modalidadE
        },

        dataType: "html",
        success: function (data) {
          $("#table-container").html(data);
        }
      });
    }

  }else if (nivelEdu != "") {
    if (nivelEdu == "Superior") {
      $.ajax({
        url: "./../../controllers/ajax/aspAdmision/backend-scriptSupOneInp.php",
        type: "POST",
        data: {
          nivelEdu: nivelEdu
        },
        dataType: "html",
        success: function (data) {
          $("#table-container").html(data);
        }
      });
    } else {
      $.ajax({
        url: "./../../controllers/ajax/aspAdmision/backend-script.php",
        type: "POST",
        data: {
          nivelEdu: nivelEdu
        },
        dataType: "html",
        success: function (data) {
          $("#table-container").html(data);
        }
      });
    }

  }else{
    $.ajax({
      url: "./../../controllers/ajax/aspAdmision/backend-scriptCV.php",
      type: "POST",
      data: {
        nivelEdu: nivelEdu
      },
      dataType: "html",
      success: function (data) {
        $("#table-container").html(data);
      }
    });
  }
});