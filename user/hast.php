<?php 
$user = $_POST['user'];
$pa = $_POST['pa'];
$con_pa = $_POST['con_pa'];
$data = array('hast'=> '');
if(!empty($user) AND !empty($pa) AND !empty($con_pa)){
    if(strcmp($pa, $con_pa) == 0){
        $generado = hash(md5, $user.$pa);
        $data = array('hast'=> $generado);
    }
}
exit(json_encode($data));