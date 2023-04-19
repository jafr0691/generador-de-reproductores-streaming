<?php
    include "conn.php";
    include('config/index.php');
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
                            <?php if($_SESSION['user_roles']=='admin' or $_SESSION['user_roles']=='vendedor'){?>
                            <th>Dueño</th>
                            <?php } ?>
                            <th>Nombre Emisora</th>
                            <th>Versión</th>
                            <th>Puerto SSl</th>
                            <th>Puerto Comun</th>
                            <th class="text-center"> Acciones </th>
                            <th class="text-center"> Reproductor </th>
                            </tr>
                        </thead>
                        <tfoot style="background-color: #eeeeee;color:#000; font-weight: bold"; align="center">
                            
                        </tfoot>
                        <tbody>
                        </tbody>
                    </table>
                </div>
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
		var dataTable = $('#lookup').DataTable( {

		 "language":	{

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
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		},

			"processing": true,
			"serverSide": true,
			"ajax":{
				url :"../admin/ajax-grid-data.php", // json datasource
				type: "post",  // method  , by default get
				data: {user:user},
				error: function(){  // error handling
					$(".lookup-error").html("");
					$("#lookup").append('');
					$("#lookup_processing").css("display","none");

				}
			}
		} );
	} );
</script>
