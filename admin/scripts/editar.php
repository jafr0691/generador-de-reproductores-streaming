<?php
	if (isset($_SESSION['username']));
	include "conn.php";
	include "head.php";
?>


    <style>
		.mat-drawer-container {
		    background-color: #fafafa;
		    color: rgba(0, 0, 0, 0.87);
		}
		.mat-card:not([class*='mat-elevation-z']) {
		    box-shadow: 0px 2px 1px -1px rgba(0, 0, 0, 0.2), 0px 1px 1px 0px rgba(0, 0, 0, 0.14), 0px 1px 3px 0px rgba(0, 0, 0, 0.12);
		}
		.mat-card {
		    transition: box-shadow 280ms cubic-bezier(.4,0,.2,1);
		    display: block;
		    position: relative;
		    padding: 16px;
		    border-radius: 4px;
		}
	</style>
    <div class="row">
        <div class="span12">
            <div class="content" style="padding: 0px;">
	            <?php
					$id  = intval($_GET['id']);
					$sql = mysqli_query($conn, "SELECT * FROM reproductores WHERE id='$id'");
					if (mysqli_num_rows($sql) == 0) {
					    header("Location: index.php");
					} else {
					    $row = mysqli_fetch_assoc($sql);
					}
				?>

	            <blockquote>
	            Actualizar reproductor de <?php echo $row['TituloEmisora']; ?>
	            </blockquote>
                <form name="form1" id="form1" style="padding-left: 0px;" action="../admin/update-edit.php" method="POST" >
                 	<div class="col-md-6 col-sm-12">
                        <h4>Configuración:</h4>
						<div class="control-group">
							<label class="control-label" for="basicinput">ID</label>
							<div class="controls">
								<input type="text" name="id" id="id" value="<?php echo $row['ID']; ?>" placeholder="Tidak perlu di isi" class="input-group col-xs-12" style="padding:17px;" readonly>
							</div>
						</div>

                        <div class="control-group">
							<label class="control-label" for="basicinput">TituloEmisora <span id="charNum3"></span></label>
							<div class="controls">
								<input maxlength="30" name="TituloEmisora" id="TituloEmisora" value="<?php echo $row['TituloEmisora']; ?>" class="input-group col-xs-12" type="text" style="padding:17px;" autocomplete="off" onkeyup="mayus(this);countChars3(this);" required="required"/>
							</div>
						</div>

                        <div class="control-group">
							<label class="control-label" for="basicinput">Logo</label>
							<div class="controls">
								<input type="text" name="Logo" id="Logo" value="<?php echo $row['Logo']; ?>" placeholder="" class="input-group col-xs-12" style="padding:17px;" autocomplete="off">
							</div>
						</div>

                        <div class="control-group">
							<label class="control-label" for="basicinput">Banner</label>
							<div class="controls">
								<input type="text" name="Cover2" id="Cover2" value="<?php echo $row['Cover2']; ?>" placeholder="" class="input-group col-xs-12" style="padding:17px;" autocomplete="off">
							</div>
						</div>
						<label class="control-label" for="basicinput">Puertos</label>
						<div class="col-md-6 col-sm-12 input-group input-group-sm">
							<span class="input-group-addon" for="basicinput" style="height:auto;">Puerto SSL</span>
							<input name="Puerto" id="Puerto" value="<?php echo $row['Puerto']; ?>" type="text" class="controls" style="width: 90px;height: 20px;padding: 22px;margin: 0px;" required />
							<span class="input-group-addon" for="basicinput">Puerto Com&uacute;n</span>
							<input name="CPuerto" id="CPuerto" value="<?php echo $row['CPuerto']; ?>" type="text" class="controls" style="width: 90px;height: 20px;padding: 22px;margin: 0px;" required />
							<span class="input-group-addon">Barra</span>
							<input name="BPuerto" id="BPuerto" value="<?php echo $row['BPuerto']; ?>" type="text" class="controls" style="width: 90px;height: 20px;padding: 22px;margin: 0px;" required />
						</div>

						<div class="control-group">
							<label class="control-label" for="basicinput">Servidor</label>
							<div class="controls">
								<input name="Servidor" id="Servidor" value="<?php echo $row['Servidor']; ?>" class="input-group col-xs-12" type="text" style="padding:17px;" required />
							</div>
						</div>

						<div class="col-xs-6 form-group MB10">
                        	<?php
								$opciones = array(
								    'uno' => 'Tema 1',
								    'dos' => 'Tema 2',
								);
								$seleccionado = $row['Tema'];
							?>
							<label class="control-label" for="basicinput">Tema</label>
							<div class="controls">
								<select name="Tema" id="form1" class="input-group col-xs-12" onChange="mostrar(this.value);">
		                            <?php foreach ($opciones as $key => $opcion) {
									    if ($key == $seleccionado) {
									        echo ' <option value="' . $key . '"  selected>' . $opcion . '</option>';
									    } else {
									        echo ' <option value="' . $key . '" >' . $opcion . '</option>';
									    }
									}?>
								</select>
							</div>
						</div>
						<div class="col-xs-6 form-group MB10">
                            <?php
								$opciones = array(
								    'true'  => 'Activado',
								    'false' => 'Desactivado',
								);
								$seleccionado = $row['Autoplay'];
							?>
							<label class="control-label" for="basicinput">Autoplay</label>
							<div class="controls">
								<select name="Autoplay" id="form1" class="input-group col-xs-12" >
									<?php foreach ($opciones as $key => $opcion) {
									    if ($key == $seleccionado) {
									        echo ' <option value="' . $key . '"  selected>' . $opcion . '</option>';
									    } else {
									        echo ' <option value="' . $key . '" >' . $opcion . '</option>';
									    }
									}?>
								</select>
          					</div>
						</div>
						<div id="uno" class="col-xs-6 form-group MB10">
                            <?php
								$opciones = array(
								    'true'  => 'Vertical',
								    'false' => 'Horizontal',
								);
								$seleccionado = $row['vertical'];
							?>
							<label class="control-label" for="basicinput">Posición</label>
							<div class="controls">
								<select name="vertical" id="form1" class="input-group col-xs-12" >
									<?php foreach ($opciones as $key => $opcion) {
									    if ($key == $seleccionado) {
									        echo ' <option value="' . $key . '"  selected>' . $opcion . '</option>';
									    } else {
									        echo ' <option value="' . $key . '" >' . $opcion . '</option>';
									    }
									}?>
								</select>
      						</div>
						</div>
          				<label class="control-label" for="basicinput">Color de texto pantalla</label>
						<div id="colorpicker" class="col-xs-12 col-md-4 input-group input-group-sm">
  							<span class="input-group-addon" for="basicinput" style="height:auto; display:none"></span>
							<input style="color:#<?php echo $row['Color']; ?>;height: 35px;padding: 1px;margin-bottom: auto;display:none" type="hidden" name="Color" id="colore" value="#<?php echo $row['Color']; ?>" />
							<input type="text" style="width:120px;" class="form-control" ng-model="color" name="color" id="colore3" type="hidden" class="campo-color" />
							<span class="input-group-addon desplegable"><i style="background-color: rgb(255,255,255);"></i></span>
							<span class="input-group-addon" style=" display:none"><span id="borrar" class="fa fa-refresh" style="cursor: pointer;"></span></span>
						</div>
                    </div>
					<div class="col-md-6 col-sm-12 laterales" style="padding:-25px;">
						<h4>Redes Sociales:</h4>
						<div class="col-xs-12 vista-previa SinPadding" >
				            <div class="control-group">
	                        	<?php
									$opciones = array(
									    'red'        => 'Color Red',
									    'pink'       => 'Color Pink',
									    'purple'     => 'Color Purple',
									    'deeppurple' => 'Color DeepPurple',
									    'indigo'     => 'Color Indigo',
									    'blue'       => 'Color Blue',
									    'lightblue'  => 'Color LightBlue',
									    'cyan'       => 'Color Cyan',
									    'teal'       => 'Color Teal',
									    'green'      => 'Color Green',
									    'lightgreen' => 'Color LightGreen',
									    'lime'       => 'Color Lime',
									    'yellow'     => 'Color Yellow',
									    'amber'      => 'Color Amber',
									    'orange'     => 'Color Orange',
									    'deeporange' => 'Color DeepOrange',
									    'brown'      => 'Color Brown',
									    'grey'       => 'Color Grey',
									    'bluegrey'   => 'Color BlueGrey',
									    'darkblue'   => 'Color DarkBlue',
									    'black'      => 'Color Black',
									);
									$seleccionado = $row['abtn'];
								?>
								<label class="control-label" for="basicinput">Color Botones</label>
								<div class="controls">
									<select name="abtn" id="form1" class="input-group col-xs-12" >
	                                    <?php foreach ($opciones as $key => $opcion) {
											if ($key == $seleccionado) {
											    echo ' <option class="' . $key . '" value="' . $key . '"  selected>' . $opcion . '</option>';
											} else {
											    echo ' <option class="' . $key . '" value="' . $key . '" >' . $opcion . '</option>';
											}
										}?>
									</select>
								</div>
							</div>
							<div class="control-group">
	                            <?php
									$opciones = array(
									    'red'        => 'Color Red',
									    'pink'       => 'Color Pink',
									    'purple'     => 'Color Purple',
									    'deeppurple' => 'Color DeepPurple',
									    'indigo'     => 'Color Indigo',
									    'blue'       => 'Color Blue',
									    'lightblue'  => 'Color LightBlue',
									    'cyan'       => 'Color Cyan',
									    'teal'       => 'Color Teal',
									    'green'      => 'Color Green',
									    'lightgreen' => 'Color LightGreen',
									    'lime'       => 'Color Lime',
									    'yellow'     => 'Color Yellow',
									    'amber'      => 'Color Amber',
									    'orange'     => 'Color Orange',
									    'deeporange' => 'Color DeepOrange',
									    'brown'      => 'Color Brown',
									    'grey'       => 'Color Grey',
									    'bluegrey'   => 'Color BlueGrey',
									    'darkblue'   => 'Color DarkBlue',
									    'black'      => 'Color Black',
									);
									$seleccionado = $row['btn'];
								?>
								<label class="control-label" for="basicinput">Color Fondo</label>
								<div class="controls">
									<select name="btn" id="form1" class="input-group col-xs-12" >
	                                    <?php foreach ($opciones as $key => $opcion) {
										    if ($key == $seleccionado) {
										        echo ' <option class="' . $key . '" value="' . $key . '"  selected>' . $opcion . '</option>';
										    } else {
										        echo ' <option class="' . $key . '" value="' . $key . '" >' . $opcion . '</option>';
										    }
										}?>
	          						</select>
								</div>
							</div>
			                <div class="control-group">
								<label class="control-label" for="basicinput">Facebook</label>
								<div class="controls">
									<input type="text" name="Facebook" id="Facebook" value="<?php echo $row['Facebook']; ?>" placeholder="" class="input-group col-xs-12" style="padding:17px;" autocomplete="off">
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label" for="basicinput">Messenger</label>
								<div class="controls">
									<input type="text" name="Messenger" id="Messenger" value="<?php echo $row['Messenger']; ?>" placeholder="" class="input-group col-xs-12" style="padding:17px;" autocomplete="off">
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label" for="basicinput">Tiwitter</label>
								<div class="controls">
									<input type="text" name="Twitter" id="Twitter" value="<?php echo $row['Twitter']; ?>" placeholder="" class="input-group col-xs-12" style="padding:17px;" autocomplete="off">
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label" for="basicinput">Instagram</label>
								<div class="controls">
									<input type="text" name="Instagram" id="Instagram" value="<?php echo $row['Instagram']; ?>" placeholder="" class="input-group col-xs-12" style="padding:17px;" autocomplete="off">
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label" for="basicinput">Youtube</label>
								<div class="controls">
									<input type="text" name="Youtube" id="Youtube" value="<?php echo $row['Youtube']; ?>" placeholder="" class="input-group col-xs-12" style="padding:17px;" autocomplete="off">
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label" for="basicinput">WhatsApp</label>
								<div class="controls">
									<input type="text" name="Whatsapp" id="Whatsapp" value="<?php echo $row['Whatsapp']; ?>" placeholder="" class="input-group col-xs-12" style="padding:17px;" autocomplete="off">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="basicinput">Ventana</label>
								<div class="controls">
									<input type="text" name="ventana" id="ventana" value="<?php echo $row['ventana']; ?>" placeholder="" class="input-group col-xs-12" style="padding:17px;" autocomplete="off">
								</div>
							</div>
						</div>
	      			</div>
      				<div class="col-sm-12 laterales MB10">
						<h4>Texto que reemplazara la metadata cuando no se encuentre</h4>
						<div class="col-xs-12 " >
							<!--REPRODUCTOR-->
                            <div class="control-group">
								<label class="control-label" for="basicinput">Artista: <span id="charNum"></span>
								</label>
								<div class="controls">
									<input type="text" maxlength="20" name="Artista" id="Artista" value="<?php echo $row['Artista']; ?>" placeholder="" class="input-group col-xs-12" style="padding:17px;" onkeyup="countChars(this);" />
								</div>
							</div>
                            <div class="control-group">
								<label class="control-label" for="basicinput">Canción: <span id="charNum2"></span>
								</label>
								<div class="controls">
									<input type="text" maxlength="50" name="Cancion" id="Cancion" value="<?php echo $row['Cancion']; ?>" placeholder="" class="input-group col-xs-12" style="padding:17px;" autocomplete="off" onkeyup="countChars2(this);" />
								</div>
							</div>
							<br>
							<div class="col-xs-12 form-gr oup MB10">
								<center>
									<div class="controls">
										<input type="submit" name="update" id="update" value="Actualizar" class="btn btn-success pull-left" style=" width:79%; padding:10px;">
                                   		<a href="index.php" class="btn btn-sm btn-danger pull-right" style="width:20%; margin-bottom:0px;margin-top:0px;padding:10px; border-radius: 5px;" >Cancelar</a>
									</div>
								</center>
                    		</div>
	                	</div>
	                </div>
				</form>
	      	</div>
	    </div>
	</div>


        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <script>
function mostrar(id) {
    if (id == "uno") {
        $("#uno").show();
        $("#dos").hide();
    }

    if (id == "dos") {
        $("#uno").hide();
        $("#dos").show();
    }
}
function countChars(obj){
    var maxLength = 20;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);

    if(charRemain == 0){
        document.getElementById("charNum").innerHTML = '<span style="color: green;">Has llegado al límite de '+maxLength+' caracteres</span>';
    }else{
        document.getElementById("charNum").innerHTML = charRemain+' caracteres restantes';
    }
}

function countChars2(obj){
    var maxLength = 50;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);

    if(charRemain == 0){
        document.getElementById("charNum2").innerHTML = '<span style="color: green;">Has llegado al límite de '+maxLength+' caracteres</span>';
    }else{
        document.getElementById("charNum2").innerHTML = charRemain+' caracteres restantes';
    }
}
function countChars3(obj){
    var maxLength = 30;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);

    if(charRemain == 0){
        document.getElementById("charNum3").innerHTML = '<span style="color: green;">Has llegado al límite de '+maxLength+' caracteres</span>';
    }else{
        document.getElementById("charNum3").innerHTML = charRemain+' caracteres restantes';
    }
}


$('#colorpicker').colorpicker();

		        $('#colorpicker').on("change",function(){
		        	 $('#colorpicker input').attr('value',$('#colorpicker').colorpicker('getValue','ffffff'));
		        });



function mayus(e) {
    e.value = e.value.toUpperCase();
}

</script>
