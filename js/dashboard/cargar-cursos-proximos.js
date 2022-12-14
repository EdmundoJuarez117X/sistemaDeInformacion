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
                    <a href="../cursos-eventos/users/comprar-curso.php?cso='${curso.id}'">
                        <div class="update">
                            <div class="profile-photo">
                                <img src="./../../img/cursos-eventos/notify.svg" alt="">
                            </div>
                            <div class="message">
                                <p><b>${curso.name}</b><br>Precio: <b>$${curso.cost}</b></p>
                                <small class="text-muted">Faltan: <b>${curso.dias} días</b></small>
                            </div>
                        </div>
                    </a>
                    `
                });
                $('#cursos-proximos').html(template);
            }
        });
    }

})