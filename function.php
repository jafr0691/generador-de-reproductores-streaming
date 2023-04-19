<?php
require './vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer(true);

function validaPassword($var1, $var2)
{
    if (strcmp($var1, $var2) !== 0) {
        return false;
    } else {
        return true;
    }
}

function validaIdToken($id, $token)
{
    global $ConsultaDB;

    $stmt = $ConsultaDB->prepare("SELECT activacion,username FROM user WHERE id = ? AND token = ? LIMIT 1");
    $stmt->bind_param("is", $id, $token);
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    if ($rows > 0) {
        $stmt->bind_result($activacion,$username);
        $stmt->fetch();

        if ($activacion == 1) {
            $msg = "La cuenta ya ha sido verificada anteriormente.";
        } else {
            if (activarUsuario($id)) {
                $msg = 'Cuenta activada.';
            } else {
                $msg = 'Error al Activar Cuenta';
            }
        }
    } else {
        $msg = "No existe el registro para activar.";
    }
    return $msg;
}

function activarUsuario($id)
{
    global $ConsultaDB;

    $stmt = $ConsultaDB->prepare("UPDATE user SET activacion=1 WHERE id = ?");
    $stmt->bind_param('i', $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function verificaTokenPass($email, $token)
{

    global $ConsultaDB;

    $stmt = $ConsultaDB->prepare("SELECT activacion FROM user WHERE email = ? AND token_password = ? AND password_request = 1 LIMIT 1");
    $stmt->bind_param('ss', $email, $token);
    $stmt->execute();
    $stmt->store_result();
    $num = $stmt->num_rows;

    if ($num > 0) {
        $stmt->bind_result($activacion);
        $stmt->fetch();
        if ($activacion == 1) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function cambiaPassword($password, $email, $token)
{

    global $ConsultaDB;

    $stmt = $ConsultaDB->prepare("UPDATE user SET password = ?, token_password='', password_request=0 WHERE email = ? AND token_password = ?");
    $stmt->bind_param('sss', $password, $email, $token);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function hashPassword($password)
{
    $hash = password_hash($password, PASSWORD_DEFAULT);
    return $hash;
}

function resultBlock($errors)
{
    if (count($errors) > 0) {
        echo "<div id='error' class='alert alert-danger' role='alert'>
			<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
}

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
        return true;
    } else {
        return false;
    }
}

function emailExiste($email)
{
    global $ConsultaDB;

    $stmt = $ConsultaDB->prepare("SELECT id FROM user WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $num = $stmt->num_rows;
    $stmt->close();

    if ($num > 0) {
        return true;
    } else {
        return false;
    }
}

function getValor($campo, $campoWhere, $valor, $tabla = "user")
{
    global $ConsultaDB;

    $stmt = $ConsultaDB->prepare("SELECT $campo FROM $tabla WHERE $campoWhere = ? LIMIT 1");
    $stmt->bind_param('s', $valor);
    $stmt->execute();
    $stmt->store_result();
    $num = $stmt->num_rows;

    if ($num > 0) {
        $stmt->bind_result($_campo);
        $stmt->fetch();
        return $_campo;
    } else {
        return null;
    }
}
function generateToken()
{
    $gen = md5(uniqid(mt_rand(), false));
    return $gen;
}
function generaTokenPass($email)
{
    global $ConsultaDB;

    $token = generateToken();

    $stmt = $ConsultaDB->prepare("UPDATE user SET token_password=?, password_request=1 WHERE email = ?");
    $stmt->bind_param('ss', $token, $email);
    $stmt->execute();
    $stmt->close();

    return $token;
}

function isActivo($correo)
{
    global $ConsultaDB;

    $stmt = $ConsultaDB->prepare("SELECT activacion FROM user WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $correo);
    $stmt->execute();
    $stmt->bind_result($activacion);
    $stmt->fetch();

    if ($activacion == 1) {
        return true;
    } else {
        return false;
    }
}



