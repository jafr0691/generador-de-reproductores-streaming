<?php 
	require './player/reproductores/db.php';
	require './function.php';
	session_start();
	
	if(empty($_GET['email'])){
		header('Location: index.php');
	}
	
	if(empty($_GET['token'])){
		header('Location: index.php');
	}
	
	$email = $ConsultaDB->real_escape_string($_GET['email']);
	$token = $ConsultaDB->real_escape_string($_GET['token']);
?>
<!DOCTYPE html>
<html leng="es">
<head>
	<meta charset="UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="">

	<link href="radio.png" rel="shortcut icon" title="Panel Reproductores" type="image/x-icon" />
	<title>Cambiar Password</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style>
	    body{
	        background:#f9f9f9;
	    }
	    .inicio{
	        background:;
	        max-width: 540px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            left: 50%;
            transform: translateX(-50%);
            position: relative;
            min-height: 0 !important;
            margin: 0;
            box-shadow: 0 2px 1px -1px rgba(0,0,0,.2),0 1px 1px 0 rgba(0,0,0,.14),0 1px 3px 0 rgba(0,0,0,.12);
            transition: box-shadow 280ms cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 4px;
            color: #3a3a3a;
            font-family: Roboto,Helvetica Neue,sans-serif;
            background:#fff;
	    }
	    
	</style>
</head>
	<div class="modal fade" id="Modalverificar" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">

					<h4 class="modal-title" id="titlemsj"></h4>
				</div>
				<div class="modal-body text-center" id="imp1">
					<strong><p id="mensaje">No se pudo verificar los Datos:</p></strong>
				</div>
				<div class="modal-footer">
					<a href="./index.php"><button type="button" class="btn btn-default">Volver al inicio de Sessi&#243;n</button></a>
				</div>
			</div>
		</div>
	</div>
	
<?php
	
	if(!verificaTokenPass($email, $token))
	{
		echo "<script>$('#Modalverificar').modal('show');</script>";
		exit();
	} 
?>

	<body>
		
    <div class="container pt-5">
	    <div class="inicio">
	        <input type="hidden" id="email" name="email" value ="<?php echo $email; ?>" />
			<input type="hidden" id="token" name="token" value ="<?php echo $token; ?>" />
			
	  	    <div class="row pt-2">
	  	        <div class="col-md-12 mb-3">
	  	            <span style="font-size: 1.6rem;color:#ff5722;">Ingresa tu nueva contraseña</span>
	  	        </div>
	  	        <div class="col-md-12 mb-3">
                    <label class="pass mdc-text-field mdc-text-field--outlined col-md-12">
                      <input type="password" class="mdc-text-field__input" name="password" id="password" aria-labelledby="my-label-id" autocomplete="off" required>
                      <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading" tabindex="0" role="button"><span id="show_password1" onclick="mostrarPassword('password','icon1')" class="fa fa-eye-slash icon1"></span></i>
                      <span class="mdc-notched-outline">
                        <span class="mdc-notched-outline__leading"></span>
                        <span class="mdc-notched-outline__notch">
                          <span class="mdc-floating-label">Nueva Contraseña</span>
                        </span>
                        <span class="mdc-notched-outline__trailing"></span>
                      </span>
                    </label>
    		    </div>
    		</div>
    		    <div class="row text-center mb-3">
    		        <div class="col-md-6 text-right">
    		            <span id="progretext" lass="text-danger"></span>
    		        </div>
    		        <div class="col-md-6">
        		        <div class="progress">
                            <div class="progress-bar bg-danger progress-bar-animated" id="progreclav"></div>
                        </div>
                    </div>
    		    </div>
    		    <div class="row">
    		    <div class="col-md-12 mb-3">
                    <label class="con_pass mdc-text-field mdc-text-field--outlined col-md-12">
                      <input type="password" class="mdc-text-field__input" name="con_password" id="con_password" aria-labelledby="my-label-id" autocomplete="off" required>
                      <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading" tabindex="0" role="button"><span id="show_password2" onclick="mostrarPassword('con_password','icon2')" class="fa fa-eye-slash icon2"></span></i>
                      <span class="mdc-notched-outline">
                        <span class="mdc-notched-outline__leading"></span>
                        <span class="mdc-notched-outline__notch">
                          <span class="mdc-floating-label">Repetir Contraseña</span>
                        </span>
                        <span class="mdc-notched-outline__trailing"></span>
                      </span>
                    </label>
    		    </div>
    	  	    <div class="col-md-12 text-right mb-4">
                    <a href="./index.php"><button type="button" class="btn btn-default">Cancelar</button></a>
                    <button id="btn-login" class="btn" style="background:#ff5722;color:#fff;">
						<span id="txtbtnrec">Confirmar</span>
						<img style="display: none;" src="./panel-control/img/carga.gif" id="cargar" width="80px" height="25px">
					</button>
                </div>
    	  	    <div class="col-md-12" id="errors"></div>
    	    </div>
	    </div>
	</div>	
		
		
		
		
		
		
		
		<div class="modal fade" id="Modalmodificar" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">

					<h4 class="modal-title" id="titlemsj"></h4>
				</div>
				<div class="modal-body text-center" id="imp1">
					<strong><p id="mensaje">Contrase&ntilde;a Modificada:</p></strong>
				</div>
				<div class="modal-footer">
				    <a href="./index.php"><button type="button" class="btn btn-default">Volver al inicio de Sessi&#243;n</button></a>
				</div>
			</div>
		</div>
	</div>
	<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
<!-- Instantiate single textfield component rendered in the document -->
    <script>
        mdc.textField.MDCTextField.attachTo(document.querySelector('.pass'));
        mdc.textField.MDCTextField.attachTo(document.querySelector('.con_pass'));
    </script>
	<script type="text/javascript">

    		function move() {
                var elem = document.getElementById("myBar");   
                var width = 1;
                var id = setInterval(frame, 10);
                function frame() {
                    if (width >= 100) {
                      clearInterval(id);
                    } else {
                      width++; 
                      elem.style.width = width + '%'; 
                    }
                }
            }

    		function mostrarPassword(txtPassword,icon){
        		var cambio = document.getElementById(txtPassword);
        		if(cambio.type == "password"){
        			cambio.type = "text";
        			$('.'+icon).removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        		}else{
        			cambio.type = "password";
        			$('.'+icon).removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        		}
        	} 
        	
        	const progrecambio = (text,porc,tc,bgc)=>{
        	    $("#progretext").text(text);
        	    $("#progreclav").css("width",porc);
        	    $("#progretext").attr("class",tc);
                $("#progreclav").attr("class","progress-bar "+bgc+" progress-bar-animated");
        	}
        	
        	const progreclave = ()=>{
        	    let aceptable = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{0,}$/;
        	    let aceptable2 = /^(?=.*[A-Za-z])(?=.*[@$!%*#?&+-./^)(_=}{;:,\|/])[A-Za-z@$!%*#?&+-./^)(_=}{;:,\|/]{0,}$/;
        	    let aceptable3 = /^(?=.*\d)(?=.*[@$!%*#?&+-./^)(_=}{;:,\|/])[\d@$!%*#?&+-./^)(_=}{;:,\|/]{0,}$/;
        	    let seguro = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&+-./^)(_=}{;:,\|/]{0,}$/;
        	    let clav=  $('#password').val();
        	    if(clav.length>0){
        	        progrecambio("Debil","33%","text-danger","bg-danger");
        	   }
        	   if(aceptable.test(clav) || aceptable2.test(clav) || aceptable3.test(clav) || clav.length >= 8){
    	           progrecambio("Aceptable","66%","text-warning","bg-warning");
    	       }
    	       if(seguro.test(clav)){
    	           progrecambio("Muy Seguro","100%","text-success","bg-success");
    	       }
    	       if(clav.length==0){
        	       progrecambio("","0%","text-danger","bg-danger");
        	   }
        	}
        	
        	$('#password').keyup(()=>{
                progreclave();
        	});
        	
		
    		$("#btn-login").click(function(){
    			var  email = $('#email').val();
    			var  token = $('#token').val();
    			var  pass = $('#password').val();
    			var  con_pass = $('#con_password').val();
    			
    			if(email!="" && pass!="" && con_pass!="" && token!=""){
    				$.ajax({
    					url: "guarda_pass.php",
    					type: 'post',
    					data: {email:email,password:pass,con_password:con_pass,token:token},
    					beforeSend: function(){
    						$('#cargar').css('display','inline-block');
    						$('#txtbtnrec').css('display','none');
    					},
    					success: function(dato) {
    						if(dato==true){
    							$('#Modalmodificar').modal("show");
    						}else{
    							$("#errors").html(dato);
    							setTimeout(function(){$("#errors").empty();},10000);
    						}
    						$('#cargar').css('display','none');
    						$('#txtbtnrec').css('display','block');
    					}
    				});
    			}else{
    				alert("No deje ningun campo vacio");
    			}
    		});
    		setTimeout(function(){
                progreclave();
            },1000);
    	
	</script>
	</body>
</html>