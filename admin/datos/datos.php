<?php
    include "conn.php";
    include('../admin/config/index.php');
    if($_SESSION['user_roles']=='admin' or $_SESSION['user_roles']=='vendedor'){
        $emty = "<div class='col-sm-12'>
            Crea tu primer reproductor 
            <a href='https://dashboard.mediapanel.app/panel-control/player.php'  data-toggle='tooltip' title='Crea tu primer reproductor' class='btn btn-sm btn-primary'> 
                <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-radio align-middle'><circle cx='12' cy='12' r='2'></circle><path d='M16.24 7.76a6 6 0 0 1 0 8.49m-8.48-.01a6 6 0 0 1 0-8.49m11.31-2.82a10 10 0 0 1 0 14.14m-14.14 0a10 10 0 0 1 0-14.14'></path>
                </svg> 
            </a>
        </div>"; 
    }else{
        $a = "<a class='text-muted'"; 
        if(!empty($perfil['web'])){
            $a .= "href='{$perfil['web']}'"; 
        }else{ 
            $a .= "href='#'"; 
        } 
            $a .= "target='_blank'><strong>";
                
        if(!empty($perfil['text_footer'])){ 
            $a .= $perfil['text_footer']; 
        }else{ 
            $a .= "Ingresar el texto del Footer"; 
        }
        $a .= "</strong></a>";

        $emty = "Contactarte con tu proveedor $a";
        
    } 
    $sql = "SELECT reproductores.* ";
    if($_SESSION['user_roles']=='admin'){
        $sql.=" FROM reproductores ";
    }else if($_SESSION['user_roles']=='vendedor'){
        $sql.=" FROM reproductores WHERE user_id=".$_SESSION['user_id'];
    }else if($_SESSION['user_roles']=='usuario'){
        $sql.=" FROM reproductores INNER JOIN relacionrepro ON relacionrepro.iduser={$_SESSION['user_id']} AND reproductores.ID=relacionrepro.idrepro";
    }
    
    $query=mysqli_query($conn, $sql);
    $totalData = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<style>
    .alert-success {
    color: #ffffff;
    background-color: #04AA6D;
    border-color: #ecf3e7;
    font-weight: bold;
}
.close {
    color: #fff;
    opacity: 1;
}
.alert-danger {
    color: #ffffff;
    background-color: #b30000;
    border-color: #ffbdc8;
    font-weight: bold;
}
.alert {
    border-radius: 7px;
}
.tooltip {
  position: relative;
  display: inline-block;
  opacity: 1 !important;
}

.tooltip .tooltiptext {
  visibility: hidden;
  font-size: 10px;
  height: auto;
  width: 260px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 7px;
  padding: 3px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 0;
  margin-left: -75px;
  opacity: 1 !important;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  font-size: 12px;
  position: absolute;
  top: 100%;
  left: 35%;
  margin-left: 50px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1 !important;
}
.topList button {
     top: -20px !important;
     border-radius: 7px !important;
}
.topList {
    margin-bottom: 0;
    background: transparent;
}
.alert {
    border-radius: 10px;
}
select.input-lg {
    height: 46px;
    line-height: 25px;
}
.input-lg {
    padding: 2px 8px;
    font-size: 19px;
    border-radius: 12px;
}
  </style>
<div class="row">
    <div class="span12">
        <div>
            <?php
                if(isset($_GET['action']) == 'delete'){
                    $id_delete = intval($_GET['id']);
                    $query = mysqli_query($conn, "SELECT * FROM reproductores WHERE id='$id_delete'");
                    if(mysqli_num_rows($query) == 0){
                    	echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> La emisora ya ha sido eliminada.</div>';
                    }else{
                    	$delete = mysqli_query($conn, "DELETE FROM reproductores WHERE id='$id_delete'");
                    	if($delete){
                    	    mysqli_query($conn, "DELETE FROM relacionrepro WHERE idrepro={$id_delete}");
                    		echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  Bien hecho, la emisora ha sido eliminada correctamente.</div>';
                    	}else{
                    		echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar la emisora.</div>';
                    	}
                    }
                }
            ?>
            <div class="panel panel-default">
                <div class="panel-body table-responsive">
                    <table id="lookup" class="table table-striped table-bordered table-hover">
                        <thead style="background-color: #eeeeee;color:#000; font-weight: bold"; align="center">
                            <tr>
                            <th>Nombre Emisora</th>
                            <th class="text-center"> Acciones </th>
                            <th class="text-center"> Codigo HTML </th>
                            <th class="text-center"> URL </th>
                            </tr>
                        </thead>
                        <tfoot style="background-color: #eeeeee;color:#000; font-weight: bold"; align="center">
                        </tfoot>
                        <tbody>
                            <?php 
                                foreach ($totalData as $reproductor) {
                                    echo '<tr><td>'.$reproductor["TituloEmisora"].'</td>';
                                    if($_SESSION['user_roles']=='usuario'){
                                    echo '<td><center>
                                         <a href="editweb.php?id='.$reproductor['ID'].'"  data-toggle="tooltip" title="Editar Reproductor" class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i> </a>
                    				     </center></td>';
                                    }else{
                    				echo '<td>
                	                        <div class="row">
                    	                        <div class="col-sm-6">
                                                    <a href="editweb.php?id='.$reproductor['ID'].'"  data-toggle="tooltip" title="Editar Reproductor" class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i> </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a href="admin.php?action=delete&id='.$reproductor['ID'].'"  data-toggle="tooltip" title="Eliminar Reproductor" class="btn btn-sm btn-danger"> <i class="fas fa-trash-alt"></i> </a>
                                                </div>
                                            </div>
                                        </td>';
                                        }
                                    echo '<td class="text-center"><center>
                                        
                                        <span class="btn btn-sm btn-info  	glyphicon glyphicon-eye-open" data-id="'.$reproductor['ID'].'" data-target="#modalcodigohtml" data-toggle="modal" id="btncodigoweb" title="Ver">
                                        </span>
                                        
                                        </center></td>
                                        <td><center>
                                         <a href="https://site.mediapanel.app/?idr='.base64_encode($reproductor['ID']).'"  data-toggle="tooltip" title="Web Basic" class="btn btn-sm btn-info  	glyphicon glyphicon-eye-open" target="_blank"></a>
                    				     </center></td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="modalcodigohtml" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Codigo Html</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid" id="htmldivweb">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<input type="hidden" id="user" value="<?php echo $_SESSION['user_id']; ?>">
<!--<script src="../admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->

<!--<script src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        var emty = `<?php echo $emty;?>`;
        user = document.getElementById('user').value;
        let touchEvent = 'ontouchstart' in window ? 'touchstart' : 'click';
        
        if (document.getElementById("btncodigoweb")) {
            for (var i = 0; i < document.querySelectorAll("#btncodigoweb").length; i++) {
                document.querySelectorAll("#btncodigoweb")[i].addEventListener(touchEvent, modalcodigoweb);
            }
        }
        
        function modalcodigoweb(e){
            let user = document.getElementById('user').value;
            var idweb= e.target.getAttribute('data-id');
            $.ajax({
            url: '../admin/datos/modalcodigowebhtml.php',
            type: 'post',
            data:{id:idweb,user},
            success: function(dato) {
                $('#htmldivweb').html(dato);
            }
        });
            
        }
        
        
        
		var dataTable = $('#lookup').DataTable({
		    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
        "language": {
            "sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     emty,
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
                "sLast":     "Último",
				"sNext":     "Seguiente",
				"sPrevious": "Anterior"
			},
            "sProcessing":"Procesando...",
        }

        });
		
	} );
</script>
