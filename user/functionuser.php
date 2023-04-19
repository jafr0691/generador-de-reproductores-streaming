<?php 
    require '../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    $mail = new PHPMailer(true);
    function enviarEmail($email, $nombre, $asunto, $cuerpo)
    {
        global $mail;
    
        $mail->CharSet = "UTF-8";
        $mail->isSMTP();
        $mail->Host     = "mail.mediapanel.app"; //Modificar
        // $mail->Host     = "mail.suemisora.com.ar"; //Modificar
        $mail->SMTPAuth = true;
        // $mail->Port     = 465; //Modificar
        $mail->Port     = 587; //Modificar
    
        $mail->Username = "no-reply@mediapanel.app"; //Modificar
        $mail->Password = "(nk9wvG#eaEmrQ"; //Modificar
    
        $mail->setFrom("no-reply@mediapanel.app", "Admin"); //Modificar
        $mail->addAddress($email, $nombre);
    
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpo;
        $mail->IsHTML(true);
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    
    }
    function isEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
            
        }
    }
    
    function emailExiste($email)
    {
        global $conn;
        $dbemail = mysqli_query($conn, "SELECT COUNT(*) as num FROM user WHERE email ='$email'");
        $contemail = mysqli_fetch_assoc($dbemail);
    
        if ($contemail['num']>0) {
            return true;
        } else {
            return false;
        }
    }
    
    function generateToken()
    {
        $gen = md5(uniqid(mt_rand(), false));
        return $gen;
    }
    
    function generaTokenPass($id)
    {
        global $conn;
        $token = generateToken();
        mysqli_query($conn, "UPDATE user SET token='$token', activacion=0 WHERE id=$id");
        return $token;
    }
    
    function resultBlock($msgs,$style)
    {
    	$list="";
        if (count($msgs) > 0) {
            $list .= "<div id='error' class='alert alert-".$style."' role='alert'>
    			<ul>";
            foreach ($msgs as $error) {
                $list .= "<li>" . $error . "</li>";
            }
            $list .= "</ul>";
            $list .= "</div>";
            return $list;
        }
    }
    
    function getIp()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    
        return $ip;
    }