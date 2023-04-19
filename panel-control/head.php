<?php
    session_start();

    if(isset($_POST['username'])){
    	
    	include ('../db.php');
    	define("RECAPTCHA_V3_SECRET_KEY", '6LdvooUcAAAAAIRfig6uW4kBQey3c8G9P0hcohsy');
    
        $token = $_POST['token'];
        $action = $_POST['action'];
         
        // call curl to POST request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $arrResponse = json_decode($response, true);
         
        // verificar la respuesta
        if($arrResponse["success"] !== '1' && $arrResponse["action"] !== $action && $arrResponse["score"] <= 0.5){
            header("location: https://".$_SERVER['SERVER_NAME']."/index.php?error=No es un Humano");
        }
    
    	$correo = $ConsultaDB->real_escape_string($_POST['username']);
    	$password = $ConsultaDB->real_escape_string($_POST['password']);
    	$stmt = $ConsultaDB->prepare("SELECT password,id,roles,hast,acthash,activacion FROM user WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;
    
        if ($rows > 0) {
    
            $stmt->bind_result($passwd,$u_id,$u_roles,$u_hast,$acthash,$activacion);
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
                }
            } else {
            	exit(header("location: https://".$_SERVER['SERVER_NAME']."/index.php?error=El usuario o contraseña no existe"));
            }
    
        } else {
        	exit(header("location: https://".$_SERVER['SERVER_NAME']."/index.php?error=El usuario o contraseña no existe"));
        }
    }

        if(!isset($_SESSION['username'])){
        	exit(header("location: https://".$_SERVER['SERVER_NAME']."/index.php?error=Session cerrada"));
        }

        include "../admin/conn.php";
        $userid = $_SESSION['user_id'];
        if($_SESSION['user_roles']=='usuario'){
            $use = mysqli_query($conn, "SELECT userid FROM user WHERE id='$userid'");
            $idu = mysqli_fetch_assoc($use);
            $idus = $idu['userid'];
        }else{
            $idus = $userid;
        }
        $per = mysqli_query($conn, "SELECT * FROM perfil WHERE id_user='$idus'");
        $perfil = mysqli_fetch_assoc($per);
 ?>
 
 <style>
     .transform {
  -webkit-transition: all 2s ease;  
  -moz-transition: all 2s ease;  
  -o-transition: all 2s ease;  
  -ms-transition: all 2s ease;  
  transition: all 2s ease;
}
.transform-active {
  background-color: #45CEE0;
  height: 200px;
}
 </style>
<script>
//     $("#button").click(function() {
//   $('.transform').toggleClass('transform-active');
// });
</script>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="">

	<link <?php if(!empty($perfil['favicon'])){ echo "href='.{$perfil['favicon']}'"; }else{ echo "href='./img/ingre_img.jpg'";} ?> rel="shortcut icon" title="<?php echo $perfil['text_footer']; ?>" type="image/x-icon" />

	<title><?php echo $perfil['text_footer']; ?></title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css"/>
	<link href="../player/css/bootstrap-colorpicker.min.css" type="text/css" rel="stylesheet">
	<link href="../player/css/fa/css/font-awesome.min.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" href="./css/bootstrap-tagsinput.css"/>
    <link rel="stylesheet" href="./css/richtext.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script
		  src="https://code.jquery.com/jquery-3.6.0.js"
		  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
		  crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="../admin/scripts/jscolor.js"></script>
	<script type="text/javascript" src="./js/jquery.richtext.js"></script>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
          <img <?php if(!empty($perfil['logo'])){ echo "src='.{$perfil['logo']}'"; }else{ echo "src='./img/ingre_img.jpg'";} ?> width="220px" height="auto">
        </a>
        <hr>

				<ul class="sidebar-nav">
					<li class="sidebar-header" style="font-size: 12px">
					Tablero
					</li>
                    <li class="sidebar-item" id="perfilactiv">
						<a class="sidebar-link" href="perfil.php">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Perfil</span>
            </a>
					</li>
					<li class="sidebar-item" id="panelactiv">
						<a class="sidebar-link" href="admin.php">
              <i class="align-middle" data-feather="list"></i> <span class="align-middle">Reproductor</span>
            </a>
					</li>
					</li>
					<li class="sidebar-item" id="prograactiv">
						<a class="sidebar-link" href="programacion.php">
              <i class="align-middle" data-feather="list"></i> <span class="align-middle">Programacion</span>
            </a>
					</li>

					<?php if($_SESSION['user_roles']=='vendedor' OR $_SESSION['user_roles']=='admin'){ ?>

					<li class="sidebar-header" style="font-size: 12px">
						Radio
					</li>

					<li class="sidebar-item" id="genereproactiv">
						<a class="sidebar-link" href="player.php">
              <i class="align-middle" data-feather="radio"></i> <span class="align-middle">Generar Reproductor</span>
            </a>
					</li>
					<?php }  ?>
					<li class="sidebar-item" id="whtmlactiv">
						<a class="sidebar-link" href="whtml.php">
              <i class="align-middle" data-feather="eye"></i> <span class="align-middle">Web Basic</span>
            </a>
					</li>
                    <?php
                    if($_SESSION['user_roles']=='admin' or $_SESSION['user_roles']=='vendedor'){?>

					<li class="sidebar-header" style="font-size: 12px">
						Usuarios
					</li>

					<li class="sidebar-item" id="useractiv">
						<a class="sidebar-link" href="user.php">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">User</span>
            </a>
					</li>
					 <?php } ?>
					  <?php
                    if($_SESSION['user_roles']=='admin' or $_SESSION['user_roles']=='vendedor'){?>
					 <li class="sidebar-item" id="rnotesactiv">
						<a class="sidebar-link" href="rnotes.php">
              <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Notas de Versión</span>
            </a>
					</li>
					<?php } ?>
					  <?php
                    if($_SESSION['user_roles']=='usuario'){?>
					 <li class="sidebar-item" id="notesactiv">
						<a class="sidebar-link" href="notes.php">
              <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Notas de Versión</span>
            </a>
					</li>
					<?php } ?>
					<li class="sidebar-item" id="useractiv">
						<a class="sidebar-link" href="log.php">
              <i class="align-middle" data-feather="x-circle"></i> <span class="align-middle">Cerrar Sesión</span>
            </a>
					</li>
                   
				</ul>
			<?php include ('version.php');	?>
			</div>
			
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align" style="float: right;">
						<li class="nav-item dropdown" id="button">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link nav-link-general dropdown-toggle d-none d-sm-inline-block transform" data-toggle="dropdown">
							    <div class="rounded-circle icon-user-general"><i class="fas fa-user-circle"></i></div>
                <span class="text-dark"><?php echo $_SESSION['username']; ?></span>
              </a>
							<div class="dropdown-menu dropdown-menu2 dropdown-menu-end">
								<a class="dropdown-item" href="perfil.php"><i class="align-middle me-1" data-feather="user"></i> Perfil</a>
								<a class="dropdown-item" href="log.php">Cerrar sesión</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>