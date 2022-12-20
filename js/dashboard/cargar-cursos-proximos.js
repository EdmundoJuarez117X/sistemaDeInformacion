$(function() {

    cursosProximos();

    function cursosProximos() {
        $.ajax({
            type: 'GET',
            url: '../../controllers/ajax/cursos-eventos/dashboard/cursos-proximos.php',
            success: function(response) {
                let cursos = JSON.parse(response);
                let template = '';

                cursos.forEach(curso => {
                    template += `
                        <div class="update">
                            <div class="profile-photo">
                                <img src="../../img/cursos-eventos/notify.svg" alt="">
                            </div>
                            <div class="message">
                                <p><b><a href="../cursos-eventos/users/comprar-curso.php?cso='${curso.id}'" style="color:blue;">${curso.name}</a></b><br>
                                Precio: <b>$${curso.cost}</b></p>
                                <small class="text-muted">Faltan: <b>${curso.dias} días</b></small>
                            </div>
                        </div>
                    `
                });
                $('#cursos-proximos').html(template);
            }
        });
    }

})