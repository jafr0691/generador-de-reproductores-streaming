
<?php

 include "conn.php";

/* Database connection end */


// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;


$columns = array(
// datatable column index  => database column name
	0 => 'ID',
    1 => 'Tema',
    2 => 'Puerto',
    3 => 'CPuerto',
    4 => 'BPuerto',
    5 => 'TituloEmisora',
    6 => 'btn',
	7 => 'abtn'
);

// getting total number records without any search
$sql = "SELECT ID, Tema, Puerto, CPuerto, BPuerto, TituloEmisora, btn, abtn ";
$sql.=" FROM reproductores";
$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT ID, Tema, Puerto, CPuerto, TituloEmisora, btn, abtn ";
	$sql.=" FROM reproductores";
	$sql.=" WHERE Tema LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR Puerto LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR CPuerto LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR BPuerto LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR TituloEmisora LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR btn LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR abtn LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO"); // again run query with limit

} else {

	$sql = "SELECT ID, Tema, Puerto, CPuerto, BPuerto, TituloEmisora, btn, abtn ";
	$sql.=" FROM reproductores";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");

}
$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array();

	$nestedData[] = $row["ID"];
    $nestedData[] = $row["Tema"];
    $nestedData[] = $row["TituloEmisora"];
    $nestedData[] = $row["Puerto"];
    $nestedData[] = $row["CPuerto"];
    $nestedData[] = $row["BPuerto"];
    $nestedData[] = $row["btn"];
	$nestedData[] = $row["abtn"];
    $nestedData[] = '<td><center>
                     <a href="editar.php?id='.$row['ID'].'"  data-toggle="tooltip" title="Editar Reproductor" class="btn btn-sm btn-info"> <i class="fas fa-edit"></i> </a>
                     <a href="admin.php?action=delete&id='.$row['ID'].'"  data-toggle="tooltip" title="Eliminar Reproductor" class="btn btn-sm btn-danger"> <i class="fas fa-trash-alt"></i> </a>
				     </center></td>';

$nestedData[] = '<td><center>
                     <a href="https://suemisora.com.ar/admin/Apps//?idr='.base64_encode($row['ID']).'"  data-toggle="tooltip" title="Player Facebook" class="btn btn-sm btn-info" target="_blank"> 1 </a>
				     </center></td>';
				     $nestedData[] = '<td><center>
                     <a href="https://suemisora.com.ar/player/reproductores/?idr='.base64_encode($row['ID']).'"  data-toggle="tooltip" title="Player HTML5" class="btn btn-sm btn-info" target="_blank"> 2 </a>
                     <a href="https://suemisora.com.ar/admin/Barras//?idr='.base64_encode($row['ID']).'"  data-toggle="tooltip" title="Barras HTML5" class="btn btn-sm btn-info" target="_blank"> 3 </a>
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
