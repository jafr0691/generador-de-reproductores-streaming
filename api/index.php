<?php
include "../admin/conn.php";
    $msj = "success";
    $id_user = mysqli_query($conn, "SELECT id,roles from user WHERE hast='{$_POST['hast']}' ");
    $user_id = mysqli_fetch_assoc($id_user);
    
    if(empty($user_id["id"])){
        $msj = "Error: HASH no valido";
    }
    if($user_id["roles"]=="admin"){
        $id_user_u = mysqli_query($conn, "SELECT id from user WHERE username='{$_POST['username']}' ");
        $user_id_u = mysqli_fetch_assoc($id_user_u);
    }else{
        $id_user_u = mysqli_query($conn, "SELECT id from user WHERE username='{$_POST['username']}' and userid='{$user_id['id']}' ");
        $user_id_u = mysqli_fetch_assoc($id_user_u);
    }
    

    if(!isset($user_id_u["id"])){
        $msj = "Error: No tiene acceso a la licencia";
    }

    if($_POST['op']=='reactivar'){
        $if = 1;
        $m = "Activar";
    }else if($_POST['op']=='suspender'){
        $if = 0;
        $m = "Suspender";
    }else if($_POST['op']=='terminar'){
        $if = 3;
        $m = "Eliminar";
    }
    
    if(!mysqli_query($conn, "UPDATE user SET acthash=$if WHERE id='{$user_id_u['id']}'")){
        $msj = "Error: No se logro $m la lincencia";
    }

    exit($msj);

