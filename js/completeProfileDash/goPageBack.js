$(document).ready(function () {
    $('#back').on('click', function () {
        let timerInterval
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Vuelve cuando estes listo :)',
            html: 'Se actualizará en <b></b>.',
            timer: 1369,
            timerProgressBar: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                location.href = "./../dashboard/inicio.php";
            }
        });
    });

});