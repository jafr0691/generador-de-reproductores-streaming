<?php 
    header('Content-type: text/html; charset=utf-8');
session_start();
    if(isset($_POST['username']) and isset($_POST['user_password'])){
        include ('./player/reproductores/db.php');
        $correo = $_POST['username'];
    	$password = $_POST['user_password'];
    	$stmt = $ConsultaDB->prepare("SELECT password,id,roles,hast,acthash,activacion FROM user WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;
    
        if ($rows > 0) {
    
            $stmt->bind_result($passwd,$u_id,$u_roles,$u_hast,$acthash,$u_activacion);
            $stmt->fetch();
    
            $validaPassw = password_verify($password, $passwd);
    
            if ($validaPassw) {
                if($activacion==0){
                    exit(header("location: https://".$_SERVER['SERVER_NAME']."/index.php?error=El usuario No esta esta verificado por correo"));
                }else{
                    $_SESSION['username'] = $correo;
                    $_SESSION['user_id'] = $u_id;
                    $_SESSION['user_roles'] = $u_roles;
                    $_SESSION['hast'] = $u_hast;
                    $_SESSION['acthash'] = $acthash;
                    header("location: ./panel-control/index.php");
                }
                
            } else {
            	header("location: https://".$_SERVER['SERVER_NAME']."/index.php?error=El usuario o contraseña no existe");
            }
    
        } else {
        	header("location: https://".$_SERVER['SERVER_NAME']."/index.php?error=El usuario o contraseña no existe");
        }
        
    }

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
	<title>Panel Reproductores</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js?render=6LeorK4dAAAAACXM66CuQpJl3qcJbdbkn2YDOnDB"></script>
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
	    .mdc-text-field:not(.mdc-text-field--disabled) .mdc-text-field__icon--leading {
    color: rgb(0 0 0);
    background-color: #26a9e0;
}
.mdc-text-field__icon--leading {
    margin-left: 15px;
    margin-right: -16px;
    padding: 16px;
}
	</style>
</head>
<body>
	<div class="container pt-5">
	    <div class="inicio">
    	    <form action="./panel-control/index.php" method="post">
    	  	    <div class="row pt-2">
    	  	        <div class="col-md-12 mb-3">
        			    <label class="usuario mdc-text-field mdc-text-field--outlined col-md-12">
                            <span class="mdc-notched-outline">
                                <span class="mdc-notched-outline__leading"></span>
                                <span class="mdc-notched-outline__notch">
                                    <span class="mdc-floating-label" id="my-label-id">Usuario</span>
                                </span>
                                <span class="mdc-notched-outline__trailing"></span>
                            </span>
                            <input type="text" class="mdc-text-field__input" name="username" id="txtUsername" aria-labelledby="my-label-id" autocomplete="off" required>
                        </label>
        		    </div>
        		    <div class="col-md-12">
                        
                        <label class="password mdc-text-field mdc-text-field--outlined col-md-12">
                          <input type="password" class="mdc-text-field__input" name="password" id="txtPassword" aria-labelledby="my-label-id" autocomplete="off" required>
                          <i class="material-icons mdc-text-field__icon mdc-text-field__icon--leading" tabindex="0" role="button"><span id="show_password" onclick="mostrarPassword()" class="fa fa-eye-slash icon"></span></i>
                          <span class="mdc-notched-outline">
                            <span class="mdc-notched-outline__leading"></span>
                            <span class="mdc-notched-outline__notch">
                              <span class="mdc-floating-label">Contraseña</span>
                            </span>
                            <span class="mdc-notched-outline__trailing"></span>
                          </span>
                        </label>
        		    </div>
        		    <div class="col-md-12 text-right">
        		        <span  data-toggle="modal" data-target="#Modalrecuperar" style="color:#26a9e0;" class="btn">
        		            Olvidé mi contrase&#241;a
                        </span> 
        		    </div>
    		        <div class="col-md-12">
    		            <?php if(isset($_GET['error'])){ 
    		                echo "<div style='color: #ffffff;background-color: #ff444d;border-color: #121212;border: 1px solid #00000000;border-radius: 5px;padding-top: 15px;text-align: center;' role='alert'>
                                    <ul style='list-style: none;padding-left:0px;'>
                                        <li style='display:list-item;text-align:-webkit-match-parent;margin-bottom: 6px;'>
                                            ".$_GET['error']."
                                        </li>
                                    </ul>
                                </div>";}?>
    	  	            <br/>
    		        </div>
        		    <div class="col-md-12">
            	  	    <button class="btn col-md-12" style="background:#26a9e0;color:#fff;" type="submit">
            	    	    <span>Ingresar</span>
            	  	    </button>
        	  	    </div>
        	    </div>
    	    </form>
	    </div>
	</div>	
	
    	<div class="modal fade" id="Modalrecuperar" role="dialog">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-body">                      
						<div class="panel panel-info" >
							<div class="panel-heading text-center">
								<div class="panel-title text-center"><span style="font-size: 1.6rem;color:#26a9e0;">&#191;Olvidaste tu contrase&#241;a&#63;</span></div>
								<span style="font: 400 14px/20px Roboto,Helvetica Neue,sans-serif;">&#161;No te preocupes! Ingresa tu correo electr&#243;nico y te ayudaremos a recuperarla.</span>
							</div>     
							<div style="padding-top:30px" class="panel-body" >
								<div id="loginform" class="form-horizontal" role="form">
									<div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">@</span>
                                        </div>
                                        <input id="email" type="email" class="form-control" name="email" placeholder="Ingrese su correo electrónico" autocomplete="off" required>  
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        <button id="btn-loginrecupe" class="btn" style="background:#26a9e0;color:#fff;">
											<span id="txtbtnrec">Recuperar</span>
											<img style="display: none;" src="./panel-control/img/carga.gif" id="cargarecu" width="70px" height="25px">
										</button>
                                    </div>
								</div>
								<div id="errors"></div>
							</div>
						</div>  
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="Modalenviado" role="dialog">
    		<div class="modal-dialog modal-md">
    			<div class="modal-content">
    				<div class="modal-header">
    
    					<h4 class="modal-title" id="titlemsj"></h4>
    				</div>
    				<div class="modal-body text-center" id="imp1">
    				    <div class="row">
    				        <div class="col-md-12">
        					    <p id="mensaje">Revisa tu correo electr&#243;nico <strong id="Modalemail"></strong> para activar tu cuenta</p>
        					</div>
        					<div class="col-md-12">
        					    <button type="button" data-dismiss="modal" class="btn mr-5 col-md-12" style="background:#26a9e0; color:#fff;">Volver al inicio de Sessi&#243;n</button>
        					</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<!-- Required Material Web JavaScript library -->
<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
<!-- Instantiate single textfield component rendered in the document -->
<script>
  mdc.textField.MDCTextField.attachTo(document.querySelector('.usuario'));
  mdc.textField.MDCTextField.attachTo(document.querySelector('.password'));
</script>
	<script>
	    $('#formSuemisora').submit(function(event) {
            event.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('6LeorK4dAAAAACXM66CuQpJl3qcJbdbkn2YDOnDB', {action: 'registro'}).then(function(token) {
                    $('#formSuemisora').prepend('<input type="hidden" name="token" value="' + token + '">');
                    $('#formSuemisora').prepend('<input type="hidden" name="action" value="registro">');
                    $('#formSuemisora').unbind('submit').submit();
                });;
            });
      });
	</script>
	<script type="text/javascript">
    	var touchEvent = 'ontouchstart' in window ? 'touchstart' : 'click';
        function mostrarPassword(){
        		var cambio = document.getElementById("txtPassword");
        		if(cambio.type == "password"){
        			cambio.type = "text";
        			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        		}else{
        			cambio.type = "password";
        			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        		}
        	} 
        	
        	
        $("#btn-loginrecupe").on(touchEvent,function(){
			var email = $("#email").val();
			if (email!="") {
				$.ajax({
					url: "/recuperarpassword.php",
					type: 'post',
					data: {email:email},
					beforeSend: function(){
						$('#cargarecu').css('display','inline-block');
						$('#txtbtnrec').css('display','none');
					},
					success: function(dato) {
					    console.log(dato);
						if(dato == 1){

				         $('#Modalemail').text(email);
				         $('#Modalrecuperar').modal("hide");
				     	 $('#Modalenviado').modal("show");
				     	 $("#email").val("");
						    
						}else{
							$("#errors").html(dato);
							setTimeout(function(){$("#errors").empty();},10000);
						}
						$('#cargarecu').css('display','none');
						$('#txtbtnrec').css('display','block');
					}
				});
			}
		});
</script>
</body>
</html>