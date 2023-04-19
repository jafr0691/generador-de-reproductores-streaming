  <?php
    include "../admin/conn.php";
    session_start();
    $uid = $_SESSION['user_id'];
    if($_SESSION['user_roles']=='admin'){
        $query = mysqli_query($conn, "SELECT *  FROM user");
        $listuser=mysqli_fetch_all($query, MYSQLI_ASSOC);
    }else if($_SESSION['user_roles']=='vendedor'){
        $query = mysqli_query($conn, "SELECT * FROM user WHERE userid=$uid");
        $listuser=mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
    $re = mysqli_query($conn, "SELECT ID,TituloEmisora FROM reproductores WHERE user_id=$uid");
    $repro=mysqli_fetch_all($re, MYSQLI_ASSOC);
    
    $regisuser = mysqli_query($conn, "SELECT id,username FROM user WHERE roles='vendedor' or roles = 'admin'");
    $listuserid =mysqli_fetch_all($regisuser, MYSQLI_ASSOC);
    
    
    
  ?>
    <div class="row">
        <div class="col-md-8">
            <h2>Usuarios</h2>
            <p>administrador de usuarios:</p>
        </div>  
        <div class="topList">
        <button data-target="#Modalr" data-toggle="modal" onClick="regist()">
                Registrar Usuarios
            </button>
        </div>
        <div class="col-md-4 text-right">
            
            
        </div>
    </div>
  <div class="table-responsive">
      <table id="tableuser" class="table table-bordered table-hover">
        <thead>
          <tr>
            <?php if($_SESSION['user_roles']=='admin' or $_SESSION['user_roles']=='vendedor'){?>
            <th class="text-center">Dueño</th>
            <?php } ?>
            <th class="text-center" onClick="tt(2)">Usuario</th>
            <th class="text-center">Privilegios</th>
            <th class="text-center">Radios</th>
            <th class="text-center">Estado</th>
            <?php if($_SESSION['user_roles']=='admin'){?>
            <th class="text-center">Licencia</th>
            <?php } ?>
            <th class="text-center">Asignados</th>
            <th class="text-center">Editar</th>
            <th class="text-center">Eliminar</th>
          </tr>
        </thead>
        <tbody>
            <?php
                foreach ($listuser as $use){
                    echo "<tr id='list'>";
                    if($_SESSION['user_roles']=='admin' or $_SESSION['user_roles']=='vendedor'){
                        $usli = mysqli_query($conn, "SELECT * FROM user WHERE id=".$use['userid']);
                        $usuariolist=mysqli_fetch_assoc($usli);
                    echo "<td style='text-transform:capitalize'>".$usuariolist['username']."</td>";
                    }
                    echo "<td style='text-transform:capitalize'>".$use['username']."</td>";
                    echo "<td class='text-center' style='text-transform:capitalize'>".$use['roles']."</td>";
                    if($use['roles']=='usuario'){
                        $countu = mysqli_query($conn, "SELECT COUNT(*) as nru FROM relacionrepro WHERE iduser={$use['id']}");
                        $cru = mysqli_fetch_assoc($countu);
                        echo "<td class='text-center'>".$cru['nru']."</td>";
                    }else{
                        $count = mysqli_query($conn, "SELECT COUNT(*) as nr FROM reproductores WHERE user_id={$use['id']}");
                        $cr = mysqli_fetch_assoc($count);
                        echo "<td class='text-center'>".$cr['nr']."</td>";
                    }
                    echo "<td class='text-center'>";
                        if ($use['activ']==1) {
                        echo "<div class='btn-success text-center'>
                                            ACTIVO
                                        </div>";
                            
                        } else if ($use['activ']==0) {
                        echo "<div class='btn-danger text-center'>
                                            SUSPENDIDO
                                        </div>";
                            
                        }
                    echo "</td>";
                    if($_SESSION['user_roles']=='admin'){
                    echo "<td class='text-center'>";
                        if ($use['acthash']==1) {
                        echo "<div class='btn-success text-center'>
                                            ACTIVA
                                        </div>";
                            
                        } else if ($use['acthash']==0) {
                        echo "<div class='btn-warning text-center'>
                                            SUSPENDIDA
                                        </div>";
                            
                        } else if ($use['acthash']==2) {
                        echo "<div class='btn-danger text-center'>
                                            INHABILITADA
                                        </div>";
                            
                        }
                    echo "</td>";
                    }
                    echo "<td class='text-center'>";
                        if($use['roles']=='usuario'){
                            echo "<div id='formlistrepro{$use['id']}' style='display:none'>
                            <select name='reproasig{$use['id']}' class='form-control mb-2' id='reproasig{$use['id']}' multiple>";
                                foreach($repro as $val){
                                    $userrepro = mysqli_query($conn, "SELECT * FROM relacionrepro WHERE idrepro={$val['ID']}");
                                    if(!mysqli_fetch_assoc($userrepro)){
                                        echo "<option value='{$val['ID']}' select>{$val['TituloEmisora']}</option>";
                                    }
                                }
                            echo "</select>";
                            echo "<button class='btn btn-success mr-5' style='margin-right:50px;' id='btnasigrep{$use['id']}' onClick='asigRepro({$use['id']})'>Guardar</button><button class='btn btn-danger' id='btnasigrepx{$use['id']}' onClick='cancelar({$use['id']})'>Cancelar</button></div>";
                            
                            echo "<select name='listrep{$use['id']}' class='form-control select-abajo' id='listrep{$use['id']}' onChange='agregar({$use['id']})'>";
                                    $lireuser = mysqli_query($conn, "SELECT rp.ID, rp.TituloEmisora FROM reproductores rp RIGHT JOIN relacionrepro rr ON rr.iduser={$use['id']} AND rp.ID=rr.idrepro");
                                    $lireuserid = mysqli_fetch_all($lireuser, MYSQLI_ASSOC);
                                    foreach($lireuserid as $val){
                                        if(!empty($val['ID']) or !empty($val['TituloEmisora'])){
                                            echo "<option value='{$val['ID']}' select>{$val['TituloEmisora']}</option>";
                                        }
                                    }
                                echo "<option></option>";
                                echo "<option value='agregar' class='btn btn-info'>Agregar mas</option>";
                            echo "</select>";
                        }else{
                            echo "<select class='form-control select-abajo'>";
                                    $lireuser = mysqli_query($conn, "SELECT ID, TituloEmisora FROM reproductores WHERE user_id={$use['id']}");
                                    $lireuserid = mysqli_fetch_all($lireuser, MYSQLI_ASSOC);
                                    foreach($lireuserid as $val){
                                        if(!empty($val['ID']) or !empty($val['TituloEmisora'])){
                                            echo "<option value='{$val['ID']}' select>{$val['TituloEmisora']}</option>";
                                        }
                                    }
                            echo "</select>";
                        }
                        
                    echo "</td>";
                    echo "<td class='text-center'><span class='glyphicon glyphicon-edit btn text-primary' onClick='editar({$use['id']})' data-target='#Modaleditar' data-toggle='modal'>
                                        </span></td>";
                    echo "<td class='text-center'><span class='text-danger btn delet glyphicon glyphicon-trash' data-id='".$use['id']."' data-name='".$use['username']."' data-target='#Modaldelet' data-toggle='modal' id='delet".$use['id']."' title='Eliminar'>
                                        </span></td></tr>";
                }
            ?>
        </tbody>
      </table>
  </div>
  <div class="modal fade" id="Modaldelet" role="dialog">
  <div class="modal-dialog modal-md">
   <div class="modal-content">
    <div class="modal-header">

     <h4 class="modal-title" id="titlemsjdelet"></h4>
   </div>
   <div class="modal-body text-center" id="imp1">
     <p id="mensajedelet"></p>
   </div>
   <div class="modal-footer">
     <button type="button" class="close mr-5" data-dismiss="modal">Cancelar</button>
     <div id="btnmodaldelet"></div>
   </div>
 </div>
</div>
</div>






	<div id="Modaleditar" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="panel-title">Editar Usuario</div>
						</div>
					</div>
					<form id="formeditar">
					    <input type="hidden" name="user_id" id="user_id">
						<div class="panel-body" >
							<div class="form-horizontal">
								<div class="form-group">
									<label for="useredi" class="col-md-3 control-label">Usuario:</label>
									<div class="col-md-9">
										<input type="text" class="form-control" id="useredi" name="useredi" placeholder="Usuario" onkeyUp="return Valletra(this);" required  autocomplete="off">
									</div>
								</div>
								<?php if($_SESSION['user_roles']=='admin' or $_SESSION['user_roles']=='vendedor'){ ?>
								<div class="form-group">
									<label for="emailedi" class="col-md-3 control-label">Correo:</label>
									<div class="col-md-9">
										<input type="email" class="form-control" id="emailedi" name="emailedi" placeholder="Correo" required  autocomplete="off">
									</div>
								</div>

								<?php } if($_SESSION['user_roles']=='vendedor') { ?>

									<input type="hidden" name="roledi" value="usuario">
									<input type="hidden" name="useridedi" value="<?php echo $uid; ?>">
									<input type="hidden" name="reproducedi" value="0">

								<?php }else if($_SESSION['user_roles']=='admin'){ ?>

									<div class="form-group">
										<label for="roledi" class="col-md-3 control-label">Rol:</label>
										<div class="col-md-9" style="display: flex;">
											<div style="width:150px;">
												<select name="roledi" class="form-control select-abajo" required="" id="roledi">
													<option value="admin">Administrador</option><option value="vendedor">Vendedor</option><option value="usuario">Usuario</option>
												</select>
											</div>
										</div>
									</div>

									<div class="form-group" id="reproedi" style="display:none">
										<label for="reproducedi" class="col-md-3 control-label">Generar reproductores</label>
										<div class="col-md-9">
											<input type="number" class="form-control" id="reproducedi" name="reproducedi" placeholder="Cantidad" value="0"  autocomplete="off">
										</div>
									</div>

								<?php } ?>
								
								<div class="form-group">
									<label for="suspender" class="col-md-3 control-label">Estado</label>
									<div class="col-md-3">
									    <label class="form-check-label" for="activo">Activo</label>
									    <input type="radio" class="form-check-input" id="activo" value="1" name="suspender" checked>
									</div>
									<div class="col-md-3">
									    <label class="form-check-label" for="suspender">Suspendido</label>
									    <input type="radio" class="form-check-input" id="suspender" value="0" name="suspender">
									</div>
								</div>
								<?php if($_SESSION['user_roles']=='admin'){ ?>
								<div class="form-group">
									<label for="suspenderli" class="col-md-3 control-label">Licencia</label>
									<div class="col-md-3">
									    <label class="form-check-label" for="activoli">Activa</label>
									    <input type="radio" class="form-check-input" id="activoli" value="1" name="suspenderli" checked>
									</div>
									<div class="col-md-3">
									    <label class="form-check-label" for="suspenderli">Suspendida</label>
									    <input type="radio" class="form-check-input" id="suspenderli" value="0" name="suspenderli">
									</div>
									<div class="col-md-3">
									    <label class="form-check-label" for="inhabilitadali">Inhabilitada</label>
									    <input type="radio" class="form-check-input" id="inhabilitadali" value="2" name="suspenderli">
									</div>
									
								</div>
							
								<?php } ?>
								<?php if($_SESSION['user_roles']=='vendedor'){ ?>
								<div class="form-group" style="display:none">
									<label for="suspenderli" class="col-md-3 control-label">Licencia</label>
									<div class="col-md-3">
									    <label class="form-check-label" for="activoli">Activa</label>
									    <input type="radio" class="form-check-input" id="activoli" value="1" name="suspenderli" checked>
									</div>
									<div class="col-md-3">
									    <label class="form-check-label" for="suspenderli">Suspendida</label>
									    <input type="radio" class="form-check-input" id="suspenderli" value="0" name="suspenderli">
									</div>
									<div class="col-md-3">
									    <label class="form-check-label" for="inhabilitadali">Inhabilitada</label>
									    <input type="radio" class="form-check-input" id="inhabilitadali" value="2" name="suspenderli">
									</div>
									
								</div>
							
								<?php } ?>
								<div class="form-group">
								    <div class="row">
								        <div class="col-md-12 text-center pb-4">
								            <button type="button" id="btn-passedi" class="btn btn-light"><i class="glyphicon glyphicon-lock"></i> Cambiar Contraseña</button>
								        </div>
								    </div>
								</div>
                                <div id="formpassedi" style="display:none">
    								<div class="form-group">
    									<label for="passwordedi" class="col-md-3 control-label">Contraseña</label>
    									<div class="col-md-9">
    										<input type="password" class="form-control" id="passredi" name="passwordedi" placeholder="Contraseña" required value="" autocomplete="new-password" autocomplete="off"/>
    									</div>
    								</div>
                                    <input type="hidden" name="ifpassedi" id="ifpassedi" value="false" />
    								<div class="form-group">
    									<label for="con_passwordedi" class="col-md-3 control-label">Confirmar Contraseña</label>
    									<div class="col-md-9">
    										<input type="password" class="form-control" id="con_passredi" name="con_passwordedi" placeholder="Confirmar Contraseña" required autocomplete="new-password" autocomplete="off"/>
    									</div>
    								</div>
    								<div class="form-group" id="input-hast-edi">
									<label for="con_password" class="col-md-3 control-label">Licencia</label>
    									<div class="col-md-7">
    										<input type="text" class="form-control" id="hast-edi" name="hast_edi" placeholder=" Generador de hast" required readonly>
    									</div>
    									<div>
    									    <button class="btn btn-info" type="button" id="btn-hast-edi">Generar</button>
    									</div>
    								</div>
                                </div>
                                

								<div class="form-group">
									<div class="col-md-12">
										<button type="button" id="btn-editar" class="btn btn-info col-md-12"><i class="icon-hand-right"></i>Editar</button>
									</div>
									<div class="col-md-12">
										<img style="margin-left:40%;display: none;" src="./img/carga.gif" id="cargaredi" width="100px" height="60px">
									</div>
								</div>
							</div>
							<div id="infoedi"></div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>






	<div id="Modalr" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="panel-title">Crear Usuario</div>
						</div>
					</div>
					<form id="formregistre">
						<div class="panel-body" >
							<div class="form-horizontal">
								<div class="form-group">
									<label for="user" class="col-md-3 control-label">Usuario:</label>
									<div class="col-md-9">
										<input type="text" class="form-control" id="user" name="user" placeholder="Usuario" onkeyUp="return Valletra(this);" required  autocomplete="off">
									</div>
								</div>
                                <div class="form-group">
									<label for="email" class="col-md-3 control-label">Correo:</label>
									<div class="col-md-9">
										<input type="email" class="form-control" id="email" name="email" placeholder="Correo" required  autocomplete="off">
									</div>
								</div>
								<?php if($_SESSION['user_roles']=='vendedor') { ?>

									<input type="hidden" name="rol" id="rol" value="usuario" />
									<input type="hidden" name="userid" id="userid" value="<?php echo $uid; ?>" />
									<input type="hidden" name="reproduc" id="reproduc" value="0" />

								<?php }else if($_SESSION['user_roles']=='admin'){ ?>

									<div class="form-group">
										<label for="rol" class="col-md-3 control-label">Rol:</label>
										<div class="col-md-9" style="display: flex;">
											<div style="width:150px;">
												<select name="rol" class="form-control select-abajo" required="" id="rol">
													<option value="admin">Administrador</option><option value="vendedor">Vendedor</option><option value="usuario">Usuario</option>
												</select>
											</div>
										</div>
									</div>

									<div class="form-group" id="asig" style="display:none">
										<label for="userid" class="col-md-3 control-label">Asignado</label>
										<div class="col-md-9">
											<select name="userid" class="form-control" required="" id="userid">
												<option value="0" select>Niguno</option>
												<?php foreach($listuserid as $val){
													echo "<option value='{$val['id']}' select>{$val['username']}</option>";
												}?>
											</select>
										</div>
									</div>
									<div class="form-group" id="repro" style="display:none">
										<label for="reproduc" class="col-md-3 control-label">Generar reproductores</label>
										<div class="col-md-9">
											<input type="number" class="form-control" id="reproduc" name="reproduc" placeholder="Cantidad" value="0"  autocomplete="off">
										</div>
									</div>

								<?php } ?>
								
								<div class="form-group" id="selectreproduc">
								    <div class="row">
								        <div class="col-md-12 text-center pb-4">
								            <label for="selectrepro" class="control-label">Selector de reproductor</label>
								        </div>
								    </div>
									<div class="col-xs-5 col-md-5 col-sm-5">
									    Reproductores
                                		<select name="from" id="selectrepro" class="form-control" size="8" multiple="multiple">
                                		</select>
                                	</div>
                                    
                                	<div class="col-xs-2 col-md-2 col-sm-2">
                                		<button type="button" id="selectrepro_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                		<button type="button" id="selectrepro_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                		<button type="button" id="selectrepro_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                		<button type="button" id="selectrepro_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                                	</div>
                                    
                                	<div class="col-xs-5 col-md-5 col-sm-5">Seleccionados
                                		<select name="to[]" id="selectrepro_to" class="form-control" size="8" multiple="multiple"></select>
                                	</div>
								</div>

								<div class="form-group">
									<label for="passw" class="col-md-3 control-label">Contraseña</label>
									<div class="col-md-9">
										<input type="password" class="form-control" id="pa" name="passw" placeholder="Contraseña" required  autocomplete="new-password" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label for="con_password" class="col-md-3 control-label">Confirmar Contraseña</label>
									<div class="col-md-9">
										<input type="password" class="form-control" id="con_passr" name="con_password" placeholder="Confirmar Contraseña" required autocomplete="new-password" autocomplete="off">
									</div>
								</div>
                                    <div class="form-group" id="hast-edi-input">
    									<label for="con_password" class="col-md-3 control-label">Licencia</label>
    									<div class="col-md-7">
    										<input type="text" class="form-control" id="hast" name="hast" placeholder=" Generador de hast" required readonly>
    									</div>
    									<div class="col-md-2" style="padding-left:0;">
    									    <button class="btn btn-info" type="button" id="btn-hast">Generar</button>
    									</div>
    								</div>
								<div class="form-group">
									<div class="col-md-12">
										<button type="submit" id="btn-regist" class="btn btn-info col-md-12"><i class="icon-hand-right"></i>Registrar</button>
									</div>
									<div class="col-md-12">
										<img style="margin-left:40%;display: none;" src="./img/carga.gif" id="cargar" width="100px" height="60px">
									</div>
								</div>
							</div>
							<div id="info"></div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>







<script src="./js/datatables.js"></script>
<script src="./js/multiselect.js"></script>
<script>
    // $('#selectreproedi').multiselect();
    $('#selectrepro').multiselect({search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
        },
        fireSearch: function(value) {
            return value.length > 3;
        },        
        right: '#selectrepro_to',
        rightSelected: '#selectrepro_rightSelected',
        leftSelected: '#selectrepro_leftSelected',
        rightAll: '#selectrepro_rightAll',
        leftAll: '#selectrepro_leftAll',
        moveToRight: function(Multiselect, $options, event, silent, skipStack) {
            var button = $(event.currentTarget).attr('id');
 
            if (button == 'selectrepro_rightSelected') {
                var $left_options = Multiselect.$left.find('> option:selected');
                Multiselect.$right.eq(0).append($left_options);
 
                if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                    Multiselect.$right.eq(0).find('> option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.$right.eq(0));
                }
            } else if (button == 'selectrepro_rightAll') {
                var $left_options = Multiselect.$left.children(':visible');
                Multiselect.$right.eq(0).append($left_options);
 
                if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                    Multiselect.$right.eq(0).find('> option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.$right.eq(0));
                }
            } 
        },
 
        moveToLeft: function(Multiselect, $options, event, silent, skipStack) {
            var button = $(event.currentTarget).attr('id');
 
            if (button == 'selectrepro_leftSelected') {
                var $right_options = Multiselect.$right.eq(0).find('> option:selected');
                Multiselect.$left.append($right_options);
 
                if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                    Multiselect.$left.find('> option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.$left);
                }
            } else if (button == 'selectrepro_leftAll') {
                var $right_options = Multiselect.$right.eq(0).children(':visible');
                Multiselect.$left.append($right_options);
 
                if ( typeof Multiselect.callbacks.sort == 'function' && !silent ) {
                    Multiselect.$left.find('> option').sort(Multiselect.callbacks.sort).appendTo(Multiselect.$left);
                }
            } 
        }
    });
    
    function rolactiv(rol,d){
        if(rol== "superadmin"){
            $('#repro'+d).css('display', 'none');
            $('#input-hast-'+d).css('display', 'block');
            $('#selectreproduc'+d).css('display', 'none');
        }else if(rol == "vendedor"){
            $('#repro'+d).css('display', 'block');
            $('#input-hast-'+d).css('display', 'block');
            $('#selectreproduc'+d).css('display', 'none');
        }else if(rol == "usuario"){
            $('#repro'+d).css('display', 'none');
            $('#input-hast-'+d).css('display', 'none');
            $('#selectreproduc'+d).css('display', 'block');
        }else{
            $('#repro'+d).css('display', 'none');
            $('#selectreproduc'+d).css('display', 'none');
        }
    }
    
    function regist(){
		$.ajax({
            url: '../user/registasigrepro.php',
            type: 'post',
            success: function(dato) {

                var edi = JSON.parse(dato);
                var r = $('#rol').val();
                rolactiv(r,'');
                var repro = edi.selectrepro;
                if(repro!=null){
                    $("#selectrepro option").remove();
                    repro.forEach(function(repro, index) {
                        $('#selectrepro').append($("<option>", {
                            value: repro.id,
                            text: repro.title
                          }));
                    });
                }

            }
        });
    }
    
    $('#btn-hast').on('click',()=>{
        
        var user = $('#user').val();
        var pa = $('#pa').val();
        var con_pa = $('#con_passr').val();
        $.ajax({
            url: '../user/hast.php',
            type: 'post',
            data: {user,pa,con_pa},
            success: function(dato) {
                var hast = JSON.parse(dato);
                $('#hast').val(hast.hast);
            }
        });
    });
    
    $('#btn-hast-edi').on('click',()=>{
        var user = $('#useredi').val();
        var pa = $('#passredi').val();
        var con_pa = $('#con_passredi').val();
        $.ajax({
            url: '../user/hast.php',
            type: 'post',
            data: {user,pa,con_pa},
            success: function(dato) {
                var hast = JSON.parse(dato);
                $('#hast-edi').val(hast.hast);
            }
        });
    });
    
    $('#btn-regist').click((e)=>{
        e.preventDefault();
        var form = $('#formregistre').serialize();
        $.ajax({
            url: '../user/insertuser.php',
            type: 'post',
            data: form,
            beforeSend: function() {
                $('#cargareditar').css('display','block');
            },
            success: function(dato) {
                var d = JSON.parse(dato);
                if(d.acction){
                    $('#info').html(d.msj);
                    setTimeout(function() {
                        location.reload();
                    }, 10000);
                    $('#hast').val('');
                }else{
                    $('#info').html(d.msj);
                }
                setTimeout(function() {
                    $("#info").empty();
                }, 10000);
                $('#cargareditar').css('display','none');
            }
        });
    });
    
    function Solo_letra(variable){
        return variable.replace(' ', '_');
    }
    function Valletra(Control){
        Control.value=Solo_letra(Control.value);
    }
    
    $('#roledi').change(()=>{
		if($('#roledi').val()=='vendedor' || $('#roledi').val()=='superadmin'){
	        $('#selectreproduc').css('display','none');
	    }else{
	        $('#selectreproduc').css('display','block');
	    }
    });
 
    $('#btn-passedi').click(()=>{
        if($('#btn-passedi').text()=='Ocultar Formulario'){
            $('#ifpassedi').val(false);
            $('#formpassedi').css('display','none');
            $('#btn-passedi').html('<i class="glyphicon glyphicon-lock"></i> Cambiar Contraseña');
        }else{
            $('#ifpassedi').val(true);
            $('#formpassedi').css('display','block');
            $('#btn-passedi').text('Ocultar Formulario');
        }
    });
    
    function editar(id) {
        $.ajax({
            url: '../user/veredi.php',
            type: 'post',
            data: {
                id: id,
            },
            success: function(dato) {

    		    $('#user_id').val(id);
                var edi = JSON.parse(dato);
                $('#useredi').val(edi.name);
                $('#hast-edi').val(edi.hast);
                if(document.getElementById("emailedi")){
                    $('#emailedi').val(edi.email);
                }
                if(edi.rolif){
                    $("#roledi option:selected").removeAttr("selected");
                    $("#roledi option[value='"+edi.rol+"']").attr("selected", true);
                }else{
                    $('#roledi').val(edi.rol);
                }
                rolactiv(edi.rol,'edi');
                $('#reproducedi').val(edi.genrepro);

                if(edi.suspender==1){
                    $('#activo').attr('checked','true');
                }else{
                    $('#suspender').attr('checked','true');
                }
                if(edi.suspenderli==1){
                    $('#activoli').attr('checked','true');
                }else{
                    $('#suspenderli').attr('checked','true');
                }

               
            }
        });
    }
    
    $('#btn-editar').click((e)=>{
        e.preventDefault();
        var form = $('#formeditar').serialize();
        $.ajax({
            url: '../user/updateuser.php',
            type: 'post',
            data: form,
            beforeSend: function() {
                $('#cargaredi').css('display','block');
            },
            success: function(dato) {
                console.log(dato);
                var d = JSON.parse(dato);
                if(d.acction){
                    $('#infoedi').html(d.msj);
                    setTimeout(function() {
                        location.reload();
                    }, 10000);
                    
                }else{
                    $('#infoedi').html(d.msj);
                }
                setTimeout(function() {
                    $("#infoedi").empty();
                }, 10000);
                $('#cargaredi').css('display','none');
            }
        });
    });
    
    $('#tableuser').DataTable({
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Usuarios",
                "zeroRecords": "No se encontraron resultados",
                "info": "Usuarios de _START_ al _END_ de un total de _TOTAL_ recibidos",
                "infoEmpty": "Usuarios de 0 al 0 de un total de 0 recibidos",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing":"Procesando...",
            },
            // searching: false,

        });
        for (var i = 0; i <= document.querySelectorAll('#list').length - 1; i++) {
        document.querySelectorAll(".delet")[i].addEventListener("click", msjdelet);
    }

    function msjdelet(e) {
        var nombre = e.target.getAttribute('data-name');
        var id = e.target.getAttribute('data-id');
        document.getElementById('titlemsjdelet').innerHTML = '<strong>' + nombre + '</strong>';
        document.getElementById('mensajedelet').innerHTML = 'Desea eliminar al Usuarios <strong>' + nombre + '</strong>?';
        document.getElementById('btnmodaldelet').innerHTML = '<button class="btn btn-default rounded" style="position: absolute; left:30px; bottom: 10px;" id="btndelet" data-dismiss="modal" data-id="' + id + '">Eliminar <span class="text-danger glyphicon glyphicon-trash"></span></button>';
        document.getElementById('btndelet').addEventListener("click", delet);
    }

    function delet() {
        var id = document.getElementById('btndelet').getAttribute('data-id');
        $.ajax({
            url: '../user/deletuser.php',
            type: 'post',
            data: {id: id,},
            success: function(dato) {
                document.getElementById('delet' + id).parentElement.parentElement.remove();
            }
        });
    }


    $("#rol").change(()=>{
        var rol = $("#rol").val();
        rolactiv(rol,'');
    });

    $("#roledi").change(()=>{
        var rol = $("#roledi").val();
        rolactiv(rol,'edi');
    });


    function agregar(id){
        if($('#listrep'+id).val()=='agregar'){
            $('#listrep'+id).css('display','none');
            $('#formlistrepro'+id).css('display','block');
        }
    }

    function asigRepro(id){
        var listagregarrepro = $('#reproasig'+id).val();
        $.ajax({
            url: '../user/tablereproasig.php',
            type: 'post',
            data: {id: id,list:listagregarrepro},
            success: function(dato) {
                var r = JSON.parse(dato);
                var repro = r.reproductores;
                console.log(repro);
                if(repro!=null){
                    repro.forEach(function(repro, index) {
                        $('#listrep'+id).prepend($("<option>", {
                            value: repro.id,
                            text: repro.title
                          }));
                    });
                }
                cancelar(id);
            }
        });
        
    }

    function cancelar(id){
        $('#listrep'+id).css('display','block');
        $('#listrep'+id).get(0).selectedIndex = 0;
        $('#formlistrepro'+id).css('display','none');
    }
</script>