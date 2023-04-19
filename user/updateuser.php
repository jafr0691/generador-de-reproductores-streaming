<?php
    session_start();
    include "../admin/conn.php";
    $userid = $_SESSION['user_id'];
    $id = $_POST['user_id'];
    $name = $_POST['useredi'];
    $activ = $_POST['suspender'];
    $acthash = $_POST['suspenderli'];
    $hast = $_POST['hast_edi'];
    $acction = TRUE;
    $msj = array();
    $style = "success";
    require "./functionuser.php";
    
    if(!empty($id) or !empty($name) or !empty($activ) or !empty($acthash) ){
        
        if($_SESSION['user_roles']=="admin"){
            $rol = $_POST['roledi'];
            if(!mysqli_query($conn, "UPDATE user SET roles='$rol' WHERE id=$id")){
                $acction = FALSE;
                $msj[] = "ERROR al editar el rol del usuario";
                $style = "danger";
            }
            
            if($rol=="vendedor"){
                $genr = $_POST['reproducedi'];
                if(!mysqli_query($conn, "UPDATE user SET crear=$genr  WHERE id=$id")){
                    $acction = FALSE;
                    $msj[] = "ERROR al editar Cantidad de reproductores";
                    $style = "danger";
                }
            }
        }

        if($_SESSION['user_roles']=="admin" or $_SESSION['user_roles']=="vendedor"){
            if(!empty($_POST['emailedi'])){
                $email = $_POST['emailedi'];
                if(isEmail($email)){
                    $acction = FALSE;
                    $msj[] = "Email no valido";
                    $style = "danger";
                }else if(!emailExiste($email)){
                    $per = mysqli_query($conn, "SELECT web,logo,firma FROM perfil WHERE id_user='$userid'");
                    $perfil = mysqli_fetch_assoc($per);
                    $token = generaTokenPass($id);
                    $url = 'https://'.$_SERVER["SERVER_NAME"].'/activar.php?id='.$id.'&token='.$token;
                    $cuerpo = '<center><div style="width:600px"><table cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td align="center" valign="top">
                                    <a href="'.$perfil['web'].'" target="_blank">
                                        <img alt="" src="https://'.$_SERVER['SERVER_NAME'].'/panel-control'.$perfil['logo'].'" style="max-width:300px;padding-bottom:0px;vertical-align:bottom;display:inline!important;border-radius:0%" width="280" align="middle">
                                    </a>
                                    <br><br><br>
                                </td>
                            </tr>
                                <tr>
                                    <td style="font-size:26px;line-height:25px;font-family:Helvetica,Arial,sans-serif;color:#26a9e0" align="center">
                                        <span>Hola, <strong style="text-transform: capitalize;"> '.$name.'</strong></span><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:16px;line-height:25px;font-family:Helvetica,Arial,sans-serif;color:#444444;font-weight: bold;">
                                        <br> &#161;Gracias por registrar una cuenta en <strong>:</strong><br><strong><a href="'.$perfil['web'].'" style="cursor: pointer!important;text-decoration: none;" target="_blank"><strong>'.$perfil['text_footer'].'</strong></a></strong> !<br>
                                                Antes de que empecemos, tenemos que confirmar que eres realmente t&#250;.<br>
                                                Haz clic en el siguiente enlace para verificar tu correo electr&#243;nico:
                                        <br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:16px;line-height:25px;font-family:Helvetica,Arial,sans-serif;color:#444444;font-weight: bold;text-align: center;">
                                        <a href="'.$url.'" style="font-size:12px;font-family:Helvetica,Arial,sans-serif;font-weight:normal;color:#ffffff;text-decoration:none;background-color: #26a9e0;border-top: 7px solid #26a9e0;border-bottom: 7px solid #26a9e0;border-left: 20px solid #26a9e0;border-right: 20px solid #26a9e0;border-radius:25px;display:inline-block;cursor: pointer!important;" target="_blank">
                                            <span style="color:#ffffff;font-size:18px;font-weight:bold;font-family:Arial,Helvetica,sans-serif;text-decoration:none;line-height:30px;width:100%;display:inline-block;vertical-align:middle">Verificar Ahora</span>
                                        </a>
                                        <br><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:16px;line-height:25px;font-family:Helvetica,Arial,sans-serif;color:#444444!important;font-weight: bold;">
                                        Si tiene problemas, intente copiar y pegar la siguiente URL en su navegador:<br>
                                        '.$url.'<br><br>
                                    </td>
                                </tr>
                                <tr>
                                <td>
                                    '.$perfil['firma'].'
                                </td>
                            </tr>
                        </tbody>
                    </table></div></center>
                        <style>
.im {
    color: #444444 !important;
}
</style>';
                    if(mysqli_query($conn, "UPDATE user SET email='{$email}' WHERE id={$id}")){
                        enviarEmail($email, $name, "Verificacion", $cuerpo);
                        $msj[] = "El $rol $name se Guardo Exitosamente, Verificar en el correo $email";
                    }else{
                        $acction = FALSE;
                        $msj[] = "ERROR al editar el Correo";
                        $style = "danger";
                    }
                }
            }
            
            
            if($_POST['ifpassedi']=='true'){
                if(!empty($_POST['passwordedi']) AND !empty($_POST['con_passwordedi'])){
                    
                    if(strcmp($_POST['passwordedi'], $_POST['con_passwordedi']) == 0){
                        $pass = $_POST['passwordedi'];
                        $passhas = password_hash($pass, PASSWORD_DEFAULT);
                        if(!mysqli_query($conn, "UPDATE user SET hast='{$hast}',password='{$passhas}' WHERE id=$id")){
                            $acction = FALSE;
                            $msj[] = "ERROR al cambiar el password";
                            $style = "danger";
                        }
                    }else{
                        $acction = FALSE;
                        $msj[] = "ERROR password no coinciden";
                        $style = "danger";
                    }
                }else{
                    $acction = FALSE;
                    $msj[] = "ERROR: password estan vacios";
                    $style = "danger";
                }
            }
        }
        if(mysqli_query($conn, "UPDATE user SET username='{$name}',activ={$activ},acthash={$acthash} WHERE id={$id}")){
            $msj[] = "Exito al editar nombre y estado";
        }else{
            $acction = FALSE;
            $msj[] = "ERROR al editar nombre y estado";
            $style = "danger";
        }
        $ree = mysqli_query($conn, "SELECT roles FROM user WHERE id={$id}");
        $reprol = mysqli_fetch_assoc($ree);
        
        
        // if($reprol['roles']=="usuario"){
        //     if(is_array($_POST['toedi'])){
                
        //         $lis = mysqli_query($conn, "SELECT * FROM relacionrepro WHERE iduser={$id}");
        //         $list = mysqli_fetch_all($lis, MYSQLI_ASSOC);
                
        //         foreach($list as $val){
                    
        //             $sql = "DELETE FROM relacionrepro WHERE id={$val['id']}";
        //             mysqli_query($conn, $sql);
                    
        //         }
                
        //         $listrepro = $_POST['toedi'];
        //         for($i=0; $i < count($listrepro); $i++){
        //             $sql = "INSERT INTO relacionrepro (iduser,idrepro) VALUES ($id,{$listrepro[$i]})";
        //             if(!mysqli_query($conn, $sql)){
        //                 $acction = FALSE;
        //                 $msj[] = "ERROR al guardar reproductor con id {$listrepro[$i]}";
        //                 $style = "danger";
        //             }
        //         }
        //     }
            
        // }
    }else{
        $acction = FALSE;
        $msj[] = "ERROR: los campos estan vacios";
        $style = "danger";
    }

    mysqli_close($conn);
    $dato = array('acction'=> $acction, 'msj'=> resultBlock($msj,$style));
    exit(json_encode($dato));
    