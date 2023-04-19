<?php
    session_start();
    include "../admin/conn.php";
    $userid = $_SESSION['user_id'];
    if(isset($_SESSION['user_id'])){
    $id = $_POST['id'];
    $timezone_identifiers = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
    $n = 425;
    
    $pro = mysqli_query($conn, "SELECT * FROM programacion WHERE id_programa=$id");
    $verpro =mysqli_fetch_assoc($pro);
    
    $reproasig = "";
        if($_SESSION['user_roles'] == 'usuario'){
            $queryre = mysqli_query($conn, "SELECT idrepro FROM relacionrepro WHERE iduser = $userid");
            $repro=mysqli_fetch_all($queryre, MYSQLI_ASSOC);
            foreach($repro as $val){
                $rpro = mysqli_query($conn, "SELECT ID, TituloEmisora FROM relacionrepro WHERE idrepro={$val['idrepro']}");
                if($r = mysqli_fetch_assoc($rpro)){
                    if($verpro['id_repro']==$r['ID']){
                        $reproasig .= "<option value='{$r['ID']}' selected>{$r['TituloEmisora']}</option>";
                    }else{
                        $reproasig .= "<option value='{$r['ID']}'>{$r['TituloEmisora']}</option>";
                    }
                }
            }
    
        }else{

            $queryr = mysqli_query($conn, "SELECT * FROM reproductores WHERE user_id = $userid");
            $repro=mysqli_fetch_all($queryr, MYSQLI_ASSOC);

            foreach($repro as $val){
                $reproasig .= "entro";
                $rpro = mysqli_query($conn, "SELECT * FROM relacionrepro WHERE idrepro={$val['ID']} AND iduser!=$userid");
                if(!mysqli_fetch_assoc($rpro)){
                    if($verpro['id_repro']==$val['ID']){
                        $reproasig .= "<option value='{$val['ID']}' selected>{$val['TituloEmisora']}</option>";
                    }else{
                        $reproasig .= "<option value='{$val['ID']}'>{$val['TituloEmisora']}</option>";
                    }
                }
            }
        }


        
        $zonahoraria = "<option disabled selected>
                            Seleccione la zona horaria
                        </option>";

        for($i = 0; $i < $n; $i++) {
            if($verpro['zonahoraria']==$timezone_identifiers[$i]){
                $zonahoraria .= "<option value='" . $timezone_identifiers[$i] . 
                "' selected>" . $timezone_identifiers[$i] . "</option>";
            }else{
                $zonahoraria .= "<option value='" . $timezone_identifiers[$i] . 
                "'>" . $timezone_identifiers[$i] . "</option>";
            }
        }
        
        $arraydias = json_decode($verpro['dias']);
        
        $diasarray = array(0 => "Domingo",1 => "Lunes",2 => "Martes",3 => "Miercoles",4 => "Jueves",5 => "Viernes",6 => "Sabado");
        $i=20;
        $diasopt = "";
        foreach($diasarray as $key => $value){ 
            
            foreach($arraydias as $dias){ 
                if($key==$dias){
                    $diasopt .= "<option value='{$key}' selected>$value</option>";
                    $i = $key;
                }
            }
            if($i==20){
                $diasopt .= "<option value='{$key}' >$value</option>";
            }
            $i=20;
        } 
        
        
        
        

        
        $dato = array ('programa'=>$verpro['programa'],
            'locutor'=>$verpro['locutor'],
            'portada'=>$verpro['url_portada'],
            'inicio' => $verpro['inicio'],
            'final' => $verpro['final'],
            'zonahoraria' => $zonahoraria,
            'dias' => $diasopt,
            'reproasig' => $reproasig
        );

        exit(json_encode($dato));
        
    }