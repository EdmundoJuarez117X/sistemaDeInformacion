$(document).ready(function () {
    $('#register').on('click', function () {
        $("#register").attr("disabled", "disabled");
        var nombre_persona = $('#nombre_persona').val();
        var apellido_paterno = $('#apellido_paterno').val();
        var apellido_materno = $('#apellido_materno').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var mstadm = $('#mstadm').val();
        if (nombre_persona != "" && apellido_paterno != "" && apellido_materno != "" && email != "" && password != "" && mstadm != "") {
            if (mstadm == "master") {
                $.ajax({
                    url: "./../../controllers/controller_signupMst.php",
                    type: "POST",
                    data: {
                        type: 1,
                        nombre_persona: nombre_persona,
                        apellido_paterno: apellido_paterno,
                        apellido_materno: apellido_materno,
                        email: email,
                        password: password,
                        mstadm: mstadm
                    },
                    cache: false,
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {
                            // $("#register").removeAttr("disabled");
                            
                            //Sweet alert and locate to complete profile view
                            let timerInterval
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Completa tu perfil!',
                                    html: 'Se actualizará en <b></b>.',
                                    timer: 1369,
                                    timerProgressBar: true,
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
                                        location.href = "./../../views/register/completeProfile.php";
                                    }
                                });
                        }
                        else if (dataResult.statusCode == 201) {
                            //Sweet alert and locate to index
                            let timerInterval
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Correo ya registrado o estructura no valida!',
                                    html: 'Se actualizará en <b></b>.',
                                    timer: 1369,
                                    timerProgressBar: true,
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
                                        location.href = "index.php";
                                    }
                                });

                        }

                    }
                });
            } else {
                if (mstadm == "administrador") {
                    $.ajax({
                        url: "./../../controllers/controller_signupAdm.php",
                        type: "POST",
                        data: {
                            type: 1,
                            nombre_persona: nombre_persona,
                            apellido_paterno: apellido_paterno,
                            apellido_materno: apellido_materno,
                            email: email,
                            password: password,
                            mstadm: mstadm
                        },
                        cache: false,
                        success: function (dataResult) {
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                //Sweet alert and locate to complete profile view
                                let timerInterval
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Completa tu perfil!',
                                    html: 'Se actualizará en <b></b>.',
                                    timer: 1369,
                                    timerProgressBar: true,
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
                                        location.href = "./../../views/register/completeProfile.php";
                                    }
                                });


                            }
                            else if (dataResult.statusCode == 201) {
                                let timerInterval
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Correo ya registrado o estructura no valida!',
                                    html: 'Se actualizará en <b></b>.',
                                    timer: 1369,
                                    timerProgressBar: true,
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
                                        location.href = "index.php";
                                    }
                                });

                            }

                        }
                    });
                }
            }
        }
        else {
            //Sweet alert
            let timerInterval
            Swal.fire({
                icon: 'error',
                title: 'Porfavor llena todos los campos!',
                html: 'Se actualizará en <b></b>.',
                timer: 1369,
                timerProgressBar: true,
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
                    location.href = "index.php";
                }
            })


        }
    });

});