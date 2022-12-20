$(function () {
    // console.log("JQuery is working...")
    //btnAsig
    $('#btnAsig').on('click', function () {
    // $('#search').keyup(function(){
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
