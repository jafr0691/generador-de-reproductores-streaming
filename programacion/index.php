  <?php
    include "../admin/conn.php";
    session_start();
    $uid = $_SESSION['user_id'];

    $query = mysqli_query($conn, "SELECT * FROM programacion WHERE id_user=$uid");
    $listprogramacion=mysqli_fetch_all($query, MYSQLI_ASSOC);
    
    if($_SESSION['user_roles'] == 'usuario'){
        $queryre = mysqli_query($conn, "SELECT idrepro FROM relacionrepro WHERE iduser = $uid");
        $repro=mysqli_fetch_all($queryre, MYSQLI_ASSOC);

    }else{
        $queryr = mysqli_query($conn, "SELECT ID, TituloEmisora FROM reproductores WHERE user_id = $uid");
        $repro=mysqli_fetch_all($queryr, MYSQLI_ASSOC);
    }
    
    $timezone_identifiers = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
    $n = 425;

  ?>
    <div class="row">
        <div class="col-md-8">
            <h2>Programacion</h2>
            <p>administrador de Programacion:</p>
        </div>  
        <div class="topList">
        <button data-target="#crearprograma" data-toggle="modal">
                Registrar Programacion
            </button>
        </div>
        <div class="col-md-4 text-right">
            
            
        </div>
    </div>
  <div class="table-responsive">
      <table id="tablepro" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center">Programa</th>
            <th class="text-center">Locutor</th>
            <th class="text-center">Editar</th>
            <th class="text-center">Eliminar</th>
          </tr>
        </thead>
        <tbody>
            <?php
                foreach ($listprogramacion as $pro){
                    echo "<tr id='list'>";

                    echo "<td style='text-center' style='text-transform:capitalize'>".$pro['programa']."</td>";
                    echo "<td class='text-center' style='text-transform:capitalize'>".$pro['locutor']."</td>";
                    echo "<td class='text-center'><span class='glyphicon glyphicon-edit btn text-primary' onClick='editar({$pro['id_programa']})' data-target='#programaeditar' data-toggle='modal'>
                                        </span></td>";
                    echo "<td class='text-center'><span class='text-danger btn delet glyphicon glyphicon-trash' data-id='".$pro['id_programa']."' data-name='".$pro['programa']."' data-target='#Modaldelet' data-toggle='modal' id='delet".$pro['id_programa']."' title='Eliminar'>
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






	<div id="programaeditar" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="panel-title">Editar Programa</div>
						</div>
					</div>
					<form id="formeditar">
					    <input type="hidden" name="id_pro" id="id_pro">
						<div class="panel-body" >
							<div class="form-horizontal">
								<div class="form-group">
									<label for="proedi" class="col-md-3 control-label">Programacion:</label>
									<div class="col-md-9">
										<input type="text" class="form-control" id="proedi" name="proedi" placeholder="Programacion" required  autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label for="locutoredi" class="col-md-3 control-label">Locutor:</label>
									<div class="col-md-9">
										<input type="text" class="form-control" id="locutoredi" name="locutoredi" placeholder="Locutor" required  autocomplete="off">
									</div>
								</div>
								<div class="form-group">
								    <label for="portadaedi" class="col-md-3 control-label" style="margin-right: 16px;">Portada</label>
								    <div class="col-md-1"></div>
                        		    <div class="input-group col-md-8">
                    		            <span class="input-group-addon" id="vista-img-portadaedi">
                    		                <i class="fa fa-image"></i>
                    		            </span>
                    		            <input type="text" class="form-control col-xs-12" name="portadaedi" id="portadaedi" ng-model="imgportadaedi" placeholder="Link Img del programa" style="padding:20px;" autocomplete="off">
                        		        <span class="input-group-addon btn" id="fileportadaedi">
                                            <i class="align-middle" data-feather="folder"></i>
                                            <input accept=".jpg,.png,.jpeg,.gif" class="hidden" type="file" ng-model="fileportadaedi" name="fileportadaedi" id="input-subir-img-portadaedi">
                                        </span>
                    		        </div>
                    		    </div>
                    		    <div class="form-group">
                                    <label for="diasedi" class="col-md-3 control-label">Dias:</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="diasedi[]" id="diasedi" multiple="multiple">
    
                                        </select>
                                        
                                    </div>
                                </div>
                    		    <div class="form-group">
									<label for="inicioedi" class="col-md-4 control-label">Hora del programa:</label>
									<div class="col-md-4">
										Desde: <input type="time" class="form-control" id="inicioedi" name="inicioedi" placeholder="Hora inicio" required  autocomplete="off">
									</div>
									<div class="col-md-4">
										Hasta: <input type="time" class="form-control" id="finaledi" name="finaledi" placeholder="Hora final" required  autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label for="reproasigedi" class="col-md-4 control-label">Asignar Reproductor:</label>
									<div class="col-md-4">
        								<select name='reproasigedi' class='form-control' id='reproasigedi'>

                                        </select>
                                    </div>
								</div>
								<div class="form-group">
									<label for="des" class="col-md-3 control-label">Zona horaria:</label>
									<div class="col-md-9">
										<select class="form-control" id="zonahorariaedi" name="zonahorariaedi"required>
										    
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<button type="button" id="btn-editar" class="btn btn-info col-md-12"><i class="icon-hand-right"></i>Editar</button>
									</div>
									<div class="col-md-12">
										<img style="margin-left:40%;display: none;" src="../programacion/img/carga.gif" id="cargaredi" width="100px" height="60px">
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


	<div id="crearprograma" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="panel-title">Crear Programa</div>
						</div>
					</div>
					<form id="formregistre" enctype="multipart/form-data" method="POST">
						<div class="panel-body" >
							<div class="form-horizontal">
								<div class="form-group">
									<label for="pro" class="col-md-3 control-label">Programacion:</label>
									<div class="col-md-9">
										<input type="text" class="form-control" id="pro" name="pro" placeholder="Programacion" required  autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label for="locutor" class="col-md-3 control-label">Locutor:</label>
									<div class="col-md-9">
										<input type="text" class="form-control" id="locutor" name="locutor" placeholder="Locutor" required  autocomplete="off">
									</div>
								</div>
								<div class="form-group">
								    <label for="portada" class="col-md-3 control-label" style="margin-right: 16px;">Portada</label>
								    <div class="col-md-1"></div>
                        		    <div class="input-group col-md-8">
                    		            <span class="input-group-addon" id="vista-img-portada">
                    		                <i class="fa fa-image"></i>
                    		            </span>
                    		            <input type="text" class="form-control col-xs-12" name="portada" id="portada" ng-model="imgportada" placeholder="Link Img del programa" style="padding:20px;" autocomplete="off">
                        		        <span class="input-group-addon btn" id="fileportada">
                                            <i class="align-middle" data-feather="folder"></i>
                                            <input accept=".jpg,.png,.jpeg,.gif" class="hidden" type="file" ng-model="fileportada" name="fileportada" id="input-subir-img-portada">
                                        </span>
                    		        </div>
                    		    </div>
                                <div class="form-group">
                                    <label for="dias" class="col-md-3 control-label">Dias:</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="dias[]" id="dias" multiple="multiple">
     
                                            <option value='0'>Domingo</option>
                                            <option value='1'>Lunes</option>
                                            <option value='2'>Martes</option>
                                            <option value='3'>Miercoles</option>
                                            <option value='4'>Jueves</option>
                                            <option value='5'>Viernes</option>
                                            <option value='6'>Sabado</option>
    
                                        </select>
                                        
                                    </div>
                                </div>
                    		    <div class="form-group">
									<label for="des" class="col-md-4 control-label">Hora del programa:</label>
									<div class="col-md-4">
										Desde: <input type="time" class="form-control" id="inicio" name="inicio" placeholder="Hora inicio" required  autocomplete="off">
									</div>
									<div class="col-md-4">
										Hasta: <input type="time" class="form-control" id="final" name="final" placeholder="Hora final" required  autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<label for="reproasig" class="col-md-4 control-label">Asignar Reproductor:</label>
									<div class="col-md-4">
        								<select name='reproasig' class='form-control' id='reproasig'>
                                            <?php
                                                if($_SESSION['user_roles'] == 'usuario'){
                                                    
                                                    foreach($repro as $val){
                                                        $rpro = mysqli_query($conn, "SELECT ID, TituloEmisora FROM relacionrepro WHERE idrepro={$val['idrepro']}");
                                                        if($r = mysqli_fetch_assoc($rpro)){
                                                            echo "<option value='{$r['ID']}'>{$r['TituloEmisora']}</option>";
                                                        }
                                                    }
                                                    
                                                }else{
                                                    foreach($repro as $val){
                                                        $rpro = mysqli_query($conn, "SELECT * FROM relacionrepro WHERE idrepro={$val['ID']} AND iduser!=$uid");
                                                        if(!mysqli_fetch_assoc($rpro)){
                                                            echo "<option value='{$val['ID']}'>{$val['TituloEmisora']}</option>";
                                                        }
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
								</div>
								<div class="form-group">
									<label for="des" class="col-md-3 control-label">Zona horaria:</label>
									<div class="col-md-9">
										<select class="form-control" id="zonahoraria" name="zonahoraria"required>
										    <option disabled selected>
                                                Seleccione la zona horaria
                                            </option>
										    <?php
										        for($i = 0; $i < $n; $i++) {
                                                    echo "<option value='" . $timezone_identifiers[$i] . 
                                                        "'>" . $timezone_identifiers[$i] . "</option>";
                                                }
                                            ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<button type="submit" id="btn-regist" class="btn btn-info col-md-12"><i class="icon-hand-right"></i>Registrar</button>
									</div>
									<div class="col-md-12">
										<img style="margin-left:40%;display: none;" src="../programacion/img/carga.gif" id="cargar" width="100px" height="60px">
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
<script src="../player/js/angular.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function previewImage(img) {
        var reader = new FileReader();
        reader.readAsDataURL(document.getElementById("input-subir-img-"+img).files[0]);
        reader.onload = function(e) {
            $("#vista-img-"+img).html("<img src='"+e.target.result+"' width='50' height='26'>");
        };
        
    }
    $('#dias').select2({
        tags: "true",
        placeholder: "Seleccionar Dias",
        allowClear: true
    });
    $('#diasedi').select2({
        tags: "true",
        placeholder: "Seleccionar Dias",
        allowClear: true
    });

    const inputTexto = (img,tag) =>{
        const r = /^https/i;
        if(r.test(img)){
            $.get(img)
            .done(function(e) { 
                $("#vista-img-"+tag).html("<img src='"+img+"' width='50' height='26'>");
        
            }).fail(function(ee) { 
                $("#vista-img-"+tag).html("<i class='fa fa-image'></i>");
        
            })
        }
    }
    
    $("#fileportada").click(()=>{
       document.getElementById("input-subir-img-portada").click();
    })

    $("#input-subir-img-portada").change(function () {
	    $("#imgportada").val($(this).val());
	    previewImage("portada");
	})
	$("#portada").keyup(()=>{
	    let img = $("#portada").val();
	    inputTexto(img,"portada");
	});
	
	
	$("#fileportadaedi").click(()=>{
       document.getElementById("input-subir-img-portadaedi").click();
    })

    $("#input-subir-img-portadaedi").change(function () {
	    $("#portadaedi").val($(this).val());
	    previewImage("portadaedi");
	})
	$("#portadaedi").keyup(()=>{
	    let img = $("#portadaedi").val();
	    inputTexto(img,"portadaedi");
	});
    
    $('#btn-regist').click((e)=>{
        e.preventDefault();
        var form = document.getElementById("formregistre");
        var formData = new FormData(form);
        $.ajax({
            url: '../programacion/crearprograma.php',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#cargar').css('display','block');
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
                $('#cargar').css('display','none');
            }
        });
    });
    
    
    function editar(id) {
        $.ajax({
            url: '../programacion/veredi.php',
            type: 'post',
            data: {
                id: id,
            },
            success: function(dato) {
                const r = /^https/i;
    		    $('#id_pro').val(id);
                var edi = JSON.parse(dato);
                console.log(edi);
                $('#proedi').val(edi.programa);
                $('#locutoredi').val(edi.locutor);
                if(edi.portada!=""){
                    if(r.test(edi.portada)){
                        $("#vista-img-portadaedi").html("<img src='"+edi.portada+"' width='50' height='33'>");
                    }else{
                        $("#vista-img-portadaedi").html("<img src='../player/reproductores/"+edi.portada+"' width='50' height='33'>");
                    }
                    $('#portadaedi').val(edi.portada);
                }else{
                    $("#vista-img-portadaedi").html("<i class='fa fa-image'></i>");
                    $('#portadaedi').val('');
                }
                $('#inicioedi').val(edi.inicio);
                $('#finaledi').val(edi.final);
                $('#reproasigedi').html(edi.reproasig);
                $('#zonahorariaedi').html(edi.zonahoraria);
                $('#diasedi').html(edi.dias);
            }
        });
    }
    
    $('#btn-editar').click((e)=>{
        e.preventDefault();
        var form = document.getElementById("formeditar");
        var formData = new FormData(form);
        $.ajax({
            url: '../programacion/updateprogra.php',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#cargaredi').css('display','block');
            },
            success: function(dato) {
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
                "lengthMenu": "Mostrar _MENU_ Programacion",
                "zeroRecords": "No se encontraron resultados",
                "info": "Programas de _START_ al _END_ de un total de _TOTAL_ recibidos",
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
        document.getElementById('mensajedelet').innerHTML = 'Desea eliminar al Porgrama <strong>' + nombre + '</strong>?';
        document.getElementById('btnmodaldelet').innerHTML = '<button class="btn btn-default rounded" style="position: absolute; left:30px; bottom: 10px;" id="btndelet" data-dismiss="modal" data-id="' + id + '">Eliminar <span class="text-danger glyphicon glyphicon-trash"></span></button>';
        document.getElementById('btndelet').addEventListener("click", delet);
    }

    function delet() {
        var id = document.getElementById('btndelet').getAttribute('data-id');
        $.ajax({
            url: '../programacion/deletpro.php',
            type: 'post',
            data: {id: id,},
            success: function(dato) {
                document.getElementById('delet' + id).parentElement.parentElement.remove();
            }
        });
    }

</script>