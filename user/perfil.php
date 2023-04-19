<?php
    session_start();
    include "../admin/conn.php";
    $userid = $_SESSION['user_id'];

    $msj = "Error";
    $icon = "Error";
    if($_SESSION['user_roles']=="admin" or $_SESSION['user_roles']=="vendedor"){

        function subir($archi, $uploadFileDir,$name,$id){
            include "../admin/conn.php";
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'ico');
            $fileTmpPath = $archi['tmp_name'];
            $fileName = $archi['name'];
            $fileType = $archi['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            if (in_array($fileExtension, $allowedfileExtensions)) {
                if (!file_exists('../panel-control'.$uploadFileDir.$name)) {
                    mkdir('../panel-control'.$uploadFileDir.$name, 0777, true);
                    chmod('../panel-control'.$uploadFileDir.$name, 0777);
                }
                $newFileName = $name.'.'.$fileExtension;
                $dest_path = $uploadFileDir.$name.'/'.$newFileName;
                if(move_uploaded_file($fileTmpPath, '../panel-control'.$dest_path))
                {
                    if(mysqli_query($conn, "UPDATE perfil SET $name='{$dest_path}' WHERE id_user=$id")){
                        return true;
                    }else{
                        return false;
                    }
                }
                else
                {
                    return false;
                }
            }else{
                return false;
            }
        }
        
        if(isset($_FILES)){
            if(isset($_FILES['logo']) AND $_FILES['logo']['error']==0){
                    
                if(subir($_FILES['logo'], "/img/pefiles/{$userid}/","logo",$userid)){
                    $msj = "El logo fue subida al servidor";
                    $icon = "success";
                }else{
                    $msj = "ERROR: Al subir el Logo";
                    $icon = "error";
                }
                
            }else if(isset($_FILES['favicon']) AND $_FILES['favicon']['error']==0){
                    
                if(subir($_FILES['favicon'], "/img/pefiles/{$userid}/","favicon",$userid)){
                    $msj = "El Favicon fue subida al servidor";
                    $icon = "success";
                }else{
                    $msj = "ERROR: Al subir el Favicon";
                    $icon = "error";
                }
            
            }else{
                $msj = "ERROR: La imagen no es correcta";
                $icon = "error";
            }
        }
        
        if(isset($_POST['text_footer']) AND isset($_POST['web'])){
            if(!empty($_POST['text_footer']) AND !empty($_POST['web'])){
                if(mysqli_query($conn, "UPDATE perfil SET text_footer='{$_POST['text_footer']}', web='{$_POST['web']}' WHERE id_user=$userid")){
                    $msj = "Se Guardo el Texto del Footer y Url de la WEB";
                    $icon = "success";
                }else{
                    $msj = "ERROR: Al Guardar Texto del Footer y Url de la WEB";
                    $icon = "error";
                }
            }else{
                $msj = "ERROR: Los campos estan vacios";
                $icon = "error";
            }
        }
        if(isset($_POST['firma'])){
            if(!empty($_POST['firma'])){
                if(mysqli_query($conn, "UPDATE perfil SET firma='{$_POST['firma']}' WHERE id_user=$userid")){
                    $msj = "Se Guardo la firma del correo";
                    $icon = "success";
                }else{
                    $msj = "ERROR: La firma del correo";
                    $icon = "error";
                }
            }else{
                $msj = "ERROR: El campo esta vacio";
                $icon = "error";
            }
        }
        if(isset($_POST['servi'])){
            if(!empty($_POST['servi'])){
                $serv = json_encode($_POST['servi']);
                if(mysqli_query($conn, "UPDATE perfil SET servidores='{$serv}' WHERE id_user=$userid")){
                    $msj = "Se Guardaron los servidores";
                    $icon = "success";
                }else{
                    $msj = "ERROR: Al Guardar los servidores";
                    $icon = "error";
                }
            }else{
                $msj = "ERROR: El campos esta vacio";
                $icon = "error";
            }
        }
    }
    
     if(isset($_POST['red']) AND isset($_POST['db'])){
            if(!empty($_POST['red']) AND !empty($_POST['db'])){
                if(mysqli_query($conn, "UPDATE perfil SET {$_POST['db']}='{$_POST['red']}' WHERE id_user=$userid")){
                    $msj = "Se guardo la red social con éxito!";
                    $icon = "success";
                }else{
                    $msj = "ERROR: Al Guardar la red social";
                    $icon = "error";
                }
            }else{
                $msj = "ERROR: El campo esta vacio";
                $icon = "error";
            }
        }
    
    if(isset($_POST['pass']) AND isset($_POST['con_pass'])){
        
        if(!empty($_POST['pass']) AND !empty($_POST['con_pass'])){
        
            if(strcmp($_POST['pass'], $_POST['con_pass']) == 0){
                $pass = $_POST['pass'];
                $passhas = password_hash($pass, PASSWORD_DEFAULT);
                if(mysqli_query($conn, "UPDATE user SET password='{$passhas}' WHERE id=$userid")){
                    $msj = "Se Guardo Con exito el Password";
                    $icon = "success";
                }else{
                    $msj = "ERROR al cambiar el password";
                    $icon = "error";
                }
            }else{
                $msj = "ERROR password no coinciden";
                $icon = "error";
            }
        }else{
            $msj = "ERROR: Campos password estan vacios";
            $icon = "error";
        }
    }

    mysqli_close($conn);
    $dato = array('msj'=> $msj,'icon'=>$icon);
    exit(json_encode($dato));
    