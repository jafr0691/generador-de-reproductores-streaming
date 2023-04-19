<?php
include "../../admin/conn.php";
    $msj = "success";
    $id_user = mysqli_query($conn, "SELECT id,acthash,roles from user WHERE hast='{$_POST['hast']}' ");
    $user_id = mysqli_fetch_assoc($id_user);
    
    if(empty($user_id["id"])){
        exit("Error: HASH no valido");
    }
    
    if($user_id["acthash"]==1){
        if($user_id["roles"]=="admin"){
            $id_user_u = mysqli_query($conn, "SELECT id from user WHERE username='{$_POST['username']}' ");
            $user_id_u = mysqli_fetch_assoc($id_user_u);
        }else{
            $id_user_u = mysqli_query($conn, "SELECT id from user WHERE username='{$_POST['username']}' and userid='{$user_id['id']}' ");
            $user_id_u = mysqli_fetch_assoc($id_user_u);
        }
    }else if($user_id["acthash"]==0){
        exit("Error: Licencia Suspendida");
        
    }else if($user_id["acthash"]==3){
        exit("Error: Licencia Eliminada");
    }

    if(!isset($user_id_u["id"])){
        exit("Error: No tiene acceso al usuario");
    }

    if($_POST['op']=='suspender' or $_POST['op']=='reactivar'){
        if($_POST['op']=='reactivar'){
            $if = 1;
        }else if($_POST['op']=='suspender'){
            $if = 0;
        }
        
        if(!mysqli_query($conn, "UPDATE user SET activ=$if WHERE id='{$user_id_u['id']}'")){
            exit("Error: No se logro suspender al usuario");
        }

        exit($msj);
    }else if($_POST['op']=='terminar'){
        
        $sqluser = "DELETE FROM user WHERE id={$user_id_u['id']}";
        mysqli_query($conn, $sqluser);
        
        $sqlrepro = "DELETE FROM reproductores WHERE user_id={$user_id_u['id']}";
        mysqli_query($conn, $sqlrepro);
        
        $sqlrelacion = "DELETE FROM relacionrepro WHERE iduser={$user_id_u['id']}";
        mysqli_query($conn, $sqlrelacion);
        
        $sqluserid = "DELETE FROM user WHERE userid={$user_id_u['id']}";
        mysqli_query($conn, $sqluserid);
        
        mysqli_close($conn);
        exit("Usuario eliminado");
    }
