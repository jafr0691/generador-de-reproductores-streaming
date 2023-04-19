<?php
    session_start();
    include "../admin/conn.php";
    $userid = $_SESSION['user_id'];
    $acction = TRUE;
    $msj = array();
    $style = "success";
    
    require "./functionprogra.php";

    if(!empty($_POST['pro']) AND !empty($_POST['locutor']) AND !empty($_POST['inicio']) AND !empty($_POST['final']) AND !empty($_POST['reproasig']) AND !empty($_POST['zonahoraria']) AND !empty($_POST['dias']) AND ( !empty($_POST['portada']) OR !empty($_FILES['fileportada']['name'])) ){
        if(preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $_POST['inicio']) AND preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $_POST['final'])){
            date_default_timezone_set($_POST['zonahoraria']);
            $pro = $_POST['pro'];
            $locutor = $_POST['locutor'];
            $inicio = $_POST['inicio'];
            $final = $_POST['final'];
            $zonahoraria = $_POST['zonahoraria'];
            $idrepro = $_POST['reproasig'];
            $dias = json_encode($_POST['dias']);
            
            if(filter_var($_POST['portada'], FILTER_VALIDATE_URL)){
    		    $portada  = addslashes(htmlentities(strip_tags($_POST['portada'])));
    
            }else{
      		    $img = $_FILES['fileportada'];
      		    $var_img_dir = '/img/programacion/portadas/';
      		    $portada  = addslashes(htmlentities(strip_tags(subirimg($img,$var_img_dir), ENT_QUOTES)));
    		}
    
    
                $sqlpro = "INSERT INTO programacion ( id_user, id_repro, programa, locutor, url_portada, inicio, final, zonahoraria, dias ) VALUES ( $userid, $idrepro, '$pro', '$locutor', '$portada', '$inicio', '$final', '$zonahoraria', '$dias' )";
                if (mysqli_query($conn, $sqlpro)) {
                      
                    $msj[] = "Programa: $pro, Locutor: $locutor se Guardo Exitosamente";
                    $style = "success";
    
                } else {
                    
                  $acction = FALSE;
                  $msj[] = "ERROR: No se logro Guardar el programa ".mysqli_error($conn);
                  $style = "danger";
                  
                }

        }else{
                
            $acction = FALSE;
            $msj[] = 'ERROR: en las horas';
            $style = "danger";
            
        }
        
    }else{
        
        $acction = false;
        $msj[] = 'ERROR: Los campos estan vacios';
        $style = "danger";
        
    }
    
    mysqli_close($conn);
    $dato = array('acction'=> $acction, 'msj'=> resultBlock($msj,$style));
    exit(json_encode($dato));