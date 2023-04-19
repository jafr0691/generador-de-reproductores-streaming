<?php
    session_start();
    include "../admin/conn.php";
    $userid = $_SESSION['user_id'];
    $acction = TRUE;
    $msj = array();
    $style = "success";
    $per = mysqli_query($conn, "SELECT text_footer,web,logo,firma FROM perfil WHERE id_user='$userid'");
    $perfil = mysqli_fetch_assoc($per);
    
    require "./functionuser.php";
    
    if(!empty($_POST['user']) AND !empty($_POST['passw']) AND !empty($_POST['con_password']) AND !empty($_POST['hast']) AND !empty($_POST['email']) ){
        $hast = $_POST['hast'];
        $email = $_POST['email'];
        if(isEmail($email)){
            $acction = FALSE;
            $msj[] = "Email no valido";
            $style = "danger";
        }else if(emailExiste($email)){
            $acction = FALSE;
            $msj[] = "Email ya existe";
            $style = "danger";
        }
        
        if($acction){
        
            if(strcmp($_POST['passw'], $_POST['con_password']) == 0){
                $name = $_POST['user'];
                if($_SESSION['user_roles']=='admin'){
                    $rol = $_POST['rol'];
                    $genr = $_POST['reproduc'];
                }else{
                    $rol = 'usuario';
                    $genr = 0;
                }
                $pass = password_hash($_POST['passw'], PASSWORD_DEFAULT);
                $fecha = date("H:i:s d-m-Y");
                $ip = getIp();
                $sqluser = "INSERT INTO user ( username,email, password, roles, crear, activ, userid,hast, date, ip ) VALUES ( '$name','$email', '$pass', '$rol', $genr, 1, $userid, '$hast', '$fecha', '$ip' )";
                if (mysqli_query($conn, $sqluser)) {
                    $id_user = mysqli_insert_id($conn);
                    $token = generaTokenPass($id_user);
                    if($rol!="usuario"){
                        $sqluperfil = "INSERT INTO perfil ( id_user ) VALUES ( $id_user )";
                        mysqli_query($conn, $sqluperfil); 
                    }
                      
                    $msj[] = "El $rol $name se Guardo Exitosamente, Verificar en el correo $email";
                    $style = "success";
                    $url = 'https://'.$_SERVER["SERVER_NAME"].'/activar.php?id='.$id_user.'&token='.$token;
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
                    enviarEmail($email, $name, "Verificacion", $cuerpo);
                } else {
                  $acction = FALSE;
                  $msj[] = "No se logro Guardar el $rol $name ".mysqli_error($conn);
                  $style = "danger";
                }
    
            }else{
                $acction = FALSE;
                $msj[] = 'No Coinciden los Password';
                $style = "danger";
            }
        
            if(isset($_POST['to'])){
                $listrepro = $_POST['to'];
                if(isset($id_user)){
                    for($i=0; $i <= count($listrepro)-1; $i++){
                        $sql = "INSERT INTO relacionrepro (iduser,idrepro) VALUES ($id_user,{$listrepro[$i]})";
                        if (!mysqli_query($conn, $sql)) {
                          $acction = FALSE;
                          $msj[] = 'No se logro Guardar Los reproductores';
                          $style = "danger";
                        }
                    }
                }
                
            }
        
        }
    }else{
        $acction = false;
        $msj[] = 'Los campos estan vacios';
        $style = "danger";
    }
    mysqli_close($conn);
    $dato = array('acction'=> $acction, 'msj'=> resultBlock($msj,$style));
    exit(json_encode($dato));
