$(function () {
    // console.log("JQuery is working...")
    $('#search').keyup(function(){
        let search = $('#search').val();
        $.ajax({
            url: './../../controllers/ajax/aspAlSearch/aspAlSearch.php',
            type: 'POST',
            data: {search},
            dataType: "html",
            success: function(response){
                $('#container').html(response);
            }
        })
    })
});
// $(function () {
//     // console.log("JQuery is working...")
//     $('#search').keyup(function(){
//         let search = $('#search').val();
//         $.ajax({
//             url: './../../controllers/ajax/aspAlSearch/aspAlSearch.php',
//             type: 'POST',
//             data: {search},
//             success: function(response){
//                  let aspirantes= JSON.parse((response));
//                  let template = '';
//                 //  console.log(aspirantes)
//                  aspirantes.forEach(aspirante => {
//                     template += `<li>
//                     ${aspirante.nombre_aspirante}
//                     ${aspirante.apellido_maternoAspirante}
//                     ${aspirante.apellido_paternoAspirante}
//                     ${aspirante.edad_Aspirante}
//                     ${aspirante.fecha_nacimientoAspirante}
//                     ${aspirante.nombre_escuela}
//                     ${aspirante.nombre_nivelEducativo}
//                     ${aspirante.nombre_facultad}
//                     ${aspirante.nombre_esp}
//                     ${aspirante.nombre_carrera}
//                     </li>`
//                 });
//                 $('#container').html(template);
//             }
//         })
//     })
// });