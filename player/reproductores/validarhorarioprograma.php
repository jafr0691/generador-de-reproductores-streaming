<?php

$servername = "localhost";
$username = "ppsltots_crm";
$password = 'e!cOezk#A5eS';


try {
  $conn = new PDO("mysql:host=$servername;dbname=ppsltots_crm", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  
}

$IDR = base64_decode(addslashes(htmlentities(strip_tags($_GET['idr']))));

$progra = $conn->prepare("SELECT * FROM programacion WHERE id_repro=? ");
$progra->execute([$IDR]);
$programas = $progra->fetchAll(PDO::FETCH_ASSOC);


$prograif = false;



    foreach($programas as $program){ 
        foreach(json_decode($program['dias']) as $dias){
            date_default_timezone_set($program['zonahoraria']);
            if($dias == date("w")){
                $from = strtotime($program['inicio']);
                $d = strtotime(Date("H:i"));
                $to = strtotime($program['final']);
                if($d >= $from && $d <= $to){
                    $locutor = $program['locutor'];
                    $programa = $program['programa'];
                    $url_portada = $program['url_portada'];
                    $prograif = true;
                }
            }
        }
    }


$data = array('prograif' => $prograif, 'locutor' => $locutor, 'programa' => $programa, 'url_portada' => $url_portada, 'dia' => date("w"), 'hora' => date("H:i"),'id' => $IDR, 'repro' =>$programas);

exit(json_encode($data));
