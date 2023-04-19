<?php
    session_start();
    include "../admin/conn.php";
    $userid = $_SESSION['user_id'];
    $user_rol = $_SESSION['user_roles'];
    $id = $_POST['id'];
    
    if($user_rol=='vendedor' or $user_rol=='admin'){
        
        $sqluser = "DELETE FROM user WHERE id=$id";
        mysqli_query($conn, $sqluser);
        
        $sqlrepro = "DELETE FROM reproductores WHERE user_id=$id";
        mysqli_query($conn, $sqlrepro);
        
        $sqlrelacion = "DELETE FROM relacionrepro WHERE iduser=$id";
        mysqli_query($conn, $sqlrelacion);
        
        $sqlperfil= "DELETE FROM perfil WHERE id_user=$id";
        mysqli_query($conn, $sqlperfil);
        
        $sqluserid = "DELETE FROM user WHERE userid=$id";
        mysqli_query($conn, $sqluserid);
        
        mysqli_close($conn);
    }
    
    