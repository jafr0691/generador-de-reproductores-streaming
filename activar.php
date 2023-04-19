<?php
	
	require './player/reproductores/db.php';
	require './function.php';
	
	if(isset($_GET["id"]) AND isset($_GET['token']))
	{
		
		$idUsuario = $_GET['id'];
		$token = $_GET['token'];
		
		$mensaje = validaIdToken($idUsuario, $token);	
	}
?>

<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <link href="radio.png" rel="shortcut icon" title="Panel Reproductores" type="image/x-icon" />
		<title>Activar registro</title>
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
	<body>
	    <div class="container pt-5">
    	    <div class="inicio">
    	  	    <div class="row pt-2">
    	  	        <div class="col-md-12 mb-3 text-center">
    	  	            <span style="font-size: 1.6rem;color:#26a9e0;"><?php echo $mensaje; ?></span>
        		    </div>
        		    <div class="col-md-12">
            	  	    <button type="button" class="btn mr-5 col-md-12" onClick="Finalizar();" style="background:#26a9e0; color:#fff;">Volver al inicio de sesión</button>
        	  	    </div>
        	    </div>
    	    </div>
    	</div>	
	    
		<script>
		    function Finalizar() {        
                window.location=location.origin;
            }
		</script>
	</body>
</html>		
