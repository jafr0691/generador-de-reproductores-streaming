<?php
    session_start();
    include "../admin/conn.php";
    $userid = $_SESSION['user_id'];
    $user_rol = $_SESSION['user_roles'];
    $id = $_POST['id'];
    
    if($user_rol=='vendedor' or $user_rol=='admin'){
        
        $sqluser = "DELETE FROM programacion WHERE id_programa=$id";
        mysqli_query($conn, $sqluser);
        
        mysqli_close($conn);
    }
    