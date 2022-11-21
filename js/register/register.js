$(document).ready(function() {
	$('#register').on('click', function() {
		$("#register").attr("disabled", "disabled");
		var nombre_persona = $('#nombre_persona').val();
		var apellido_paterno = $('#apellido_paterno').val();
		var apellido_materno = $('#apellido_materno').val();
		var email = $('#email').val();
		var password = $('#password').val();
		var aspdoc = $('#aspdoc').val();
		if(nombre_persona!="" && apellido_paterno!="" && apellido_materno!="" && email!="" && password!="" && aspdoc!=""){
            if(aspdoc=="aspirante"){
                $.ajax({
                    url: "./controllers/controller_signupAsp.php",
                    type: "POST",
                    data: {
                        type: 1,
                        nombre_persona: nombre_persona,
                        apellido_paterno: apellido_paterno,
                        apellido_materno: apellido_materno,
                        email: email,
                        password: password,
                        aspdoc: aspdoc
                    },
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            // $("#register").removeAttr("disabled");
                            // $('#register_form').find('input:text').val('');
                            // $("#success").show();
                            // $('#success').html('Registro Exitoso !'); 
                            location.href = "./views/register/completeProfile.php";		
                        }
                        else if(dataResult.statusCode==201){
                           alert("Correo ya registrado o estructura no valida");
                           location.href = "index.php";	
                        }
                        
                    }
                });
            }else{
                if(aspdoc == "padredefamilia"){
                    $.ajax({
                        url: "./controllers/controller_signupPF.php",
                        type: "POST",
                        data: {
                            type: 1,
                            nombre_persona: nombre_persona,
                            apellido_paterno: apellido_paterno,
                            apellido_materno: apellido_materno,
                            email: email,
                            password: password,
                            aspdoc: aspdoc
                        },
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                location.href = "./views/register/completeProfile.php";		
                            }
                            else if(dataResult.statusCode==201){
                                alert("Correo ya registrado o estructura no valida");
                                location.href = "index.php";	
                            }
                            
                        }
                    });
                }
            }
		}
		else{
			alert('Por favor llena todos los campos !');
		}
	});
	
});