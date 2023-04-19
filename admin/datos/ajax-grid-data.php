
<?php

 include "conn.php";

/* Database connection end */


// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$user = $_POST['user'];
$u = mysqli_query($conn, "SELECT roles FROM user WHERE id=".$user);
$rol = mysqli_fetch_assoc($u)['roles'];
$columns = array(
// datatable column index  => database column name
    0 => 'Tema',
    1 => 'Puerto',
    2 => 'CPuerto',
    3 => 'BPuerto',
    4 => 'TituloEmisora',
    5 => 'btn',
	6 => 'abtn'
);

// getting total number records without any search
$sql = "SELECT reproductores.* ";
if($rol=='admin'){
    $sql.=" FROM reproductores ";
}else if($rol=='vendedor'){
    $sql.=" FROM reproductores WHERE user_id=".$user;
}else if($rol=='usuario'){
    $sql.=" FROM reproductores INNER JOIN relacionrepro ON relacionrepro.iduser=$user AND reproductores.ID=relacionrepro.idrepro";
}

$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
// 	if there is a search parameter
	$sql = "SELECT ID, Tema, Puerto, CPuerto, TituloEmisora, btn, abtn ";
	$sql.=" FROM reproductores";
	if($rol=='admin'){
	    $sql.=" WHERE TituloEmisora LIKE '%".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	}else if($rol=='vendedor'){
	   $sql.=" WHERE user_id=$user and TituloEmisora LIKE '%".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter 
	}else if($rol=='usuario'){
	   $sql.=" reproductores INNER JOIN relacionrepro ON relacionrepro.iduser=$user and reproductores.TituloEmisora LIKE '%".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter 
	}
//     $sql.=" OR Puerto LIKE '%".$requestData['search']['value']."%' ";
//     $sql.=" OR CPuerto LIKE '%".$requestData['search']['value']."%' ";
//     $sql.=" OR BPuerto LIKE '%".$requestData['search']['value']."%' ";
//     $sql.=" OR TituloEmisora LIKE '%".$requestData['search']['value']."%' ";
//     $sql.=" OR btn LIKE '%".$requestData['search']['value']."%' ";
// 	$sql.=" OR abtn LIKE '%".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO"); // again run query with limit

} else {

	$sql = "SELECT reproductores.* ";
	$sql.=" FROM reproductores";
	if($rol=='admin'){
	    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	}else if($rol=='vendedor'){
	    $sql.=" WHERE user_id=".$user." ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	}else if($rol=='usuario'){
        $sql.=" reproductores INNER JOIN relacionrepro ON relacionrepro.iduser=$user AND reproductores.ID=relacionrepro.idrepro ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    }
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");

}
$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array();

    $nestedData[] = $row["TituloEmisora"];
	if($rol=='usuario'){
	    $nestedData[] = '<td><center>
                     <a href="editweb.php?id='.$row['ID'].'"  data-toggle="tooltip" title="Editar Reproductor" class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i> </a>
				     </center></td>';
	}else{
	    $nestedData[] = '<td>
	                        <div class="row">
    	                        <div class="col-sm-6">
                                    <a href="editweb.php?id='.$row['ID'].'"  data-toggle="tooltip" title="Editar Reproductor" class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i> </a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="admin.php?action=delete&id='.$row['ID'].'"  data-toggle="tooltip" title="Eliminar Reproductor" class="btn btn-sm btn-danger"> <i class="fas fa-trash-alt"></i> </a>
                                </div>
                            </div>
                        </td>';
	}

$nestedData[] = "<td class='text-center'><center><span class='btn btn-sm btn-info' id='htmlweb' data-id='{$row['ID']}' > <i class='fas fa-eye'></i>
                                        </span></center></td>";
$nestedData[] = '<td><center>
                     <a href="https://site.mediapanel.app/?idr='.base64_encode($row['ID']).'"  data-toggle="tooltip" title="Web Basic" class="btn btn-sm btn-info" target="_blank"> <i class="fas fa-eye"></i> </a>
				     </center></td>';

	$data[] = $nestedData;

}


$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
