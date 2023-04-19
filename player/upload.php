<?php
	session_start();

	$sesion_caverna_user=$_SESSION['username'];

  	if(!empty($sesion_caverna_user)){

  			/*ACTION UPLOAD*/
  			if(!empty($_FILES['images']['name'][0])){
		  		$file_parts = $_FILES['images']['name'][0];
				$file_ext = '.'.pathinfo($file_parts,PATHINFO_EXTENSION);
				if ($_FILES["images"]["error"][0] > 0){ //Si hay error en la imagen
					$AlertaModificados= 'error';
				}else{ //sino
					try{
						$var_img_dir = './reproductores/img/portadas/'; //obtenemos el directorio actual con el cual se está trabajando
						$temp = explode(".", $_FILES["images"]["name"][0]);
						$newfilename = substr(rand(),0,4). '.' . end($temp);
						if($file_ext=='.php')
							return;
						if (move_uploaded_file($_FILES["images"]["tmp_name"][0], $var_img_dir . $newfilename)){
							$subida = true; //admitimos que la subida fue correcta
						}
					}catch(Error $e){
						echo $e->getMessage();
					}
				}

				if($subida){
					$AlertaModificados='<div class="alert alert-success AlertasPanel"> Logo subido correctamente con la url: <br/> <b>./img/portadas/'.$newfilename.'</b></div>';
				}else{
					$AlertaModificados='<div class="alert alert-danger AlertasPanel"> Hubo un error al subir el logo.</div>';
				}
			}


  		?>

  		<!DOCTYPE html>
		<html>
		<head>
			<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
				<style type="text/css">
				html,body{
					background-color: transparent;
				}
				 input[type="submit"]{
					width: 100%;
					text-transform: uppercase;
					font-size: 12px;
					color:#FFFFFF;
					background-color: #333333;
					float: right;
					clear: right;
					border:0px;
					padding:5px 5px;
					cursor: pointer;
				}

				/***************  EXTRAS  ***************/
				.fileUpload {
				    position: relative;
				    overflow: hidden;
				    margin: 15px 0px 0px 10px;
				}
				.fileUpload input.upload {
				    position: absolute;
				    top: 0;
				    right: 0;
				    margin: 0;
				    padding: 0;
				    font-size: 20px;
				    cursor: pointer;
				    opacity: 0;
				    filter: alpha(opacity=0);
				}
				.input-group-addon{
					border: 0px;
				    background: transparent;
				    padding: 0px;
				}
				.uploadFile{
					margin:15px 0px 0px 0px;
					border-radius: 5px !important;
				}
				.guardar{
					margin-top: 15px;
				}
			</style>
		</head>
		<body>
			<!--bloque-->
			<form action="" method="POST" enctype="multipart/form-data">
				<?php echo $AlertaModificados; ?>
				<div class="col-xs-12">
					<div class="bloque_form ">
						<div class="input-group">
							<input placeholder="Seleccionar archivo..." class="form-control uploadFile" disabled="disabled" />
						  <span class="input-group-addon" id="basic-addon2">
						  	<div class="fileUpload btn btn-primary">
							    <span>ASIGNAR IMAGEN</span>
							    <input type="file" class="upload uploadBtn" name="images[]">
							</div>
						  </span>
						</div>
						<input type="submit" class="btn btn-success guardar" value="SUBIR">
					</div>
				</div>
			</form>
			<!--/bloque-->
			<script src="js/jquery-1.11.3.min.js"></script>
			<script type="text/javascript">
				$(".uploadBtn").change(function () {
				    $(".uploadFile").val($(this).val());
				});
			</script>

		</body>
		</html>
  		<?php
  	}
?>