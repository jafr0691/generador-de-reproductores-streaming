<?php
    session_start();
    include "../admin/conn.php";
    $userid = $_SESSION['user_id'];
    $id = $_POST['id_pro'];
    $acction = TRUE;
    $msj = array();
    $style = "success";
    require "./functionprogra.php";
    
    if(!empty($_POST['proedi']) AND !empty($_POST['locutoredi']) AND !empty($_POST['inicioedi']) AND !empty($_POST['reproasigedi']) AND !empty($_POST['finaledi']) AND !empty($_POST['zonahorariaedi']) AND !empty($_POST['diasedi']) AND ( !empty($_POST['portadaedi']) OR !empty($_FILES['fileportadaedi']['name'])) ){
        if(preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $_POST['inicioedi']) AND preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $_POST['finaledi'])){
                $pro = mysqli_query($conn, "SELECT url_portada FROM programacion WHERE id_programa=$id");
                date_default_timezone_set($_POST['zonahorariaedi']);
                $verpro =mysqli_fetch_assoc($pro);
                $pro = $_POST['proedi'];
                $locutor = $_POST['locutoredi'];
                $inicio = $_POST['inicioedi'];
                $final = $_POST['finaledi'];
                $idrepro = $_POST['reproasigedi'];
                $dias = json_encode($_POST['diasedi']);
                $zonahoraria = $_POST['zonahorariaedi'];
                
                if(filter_var($_POST['portadaedi'], FILTER_VALIDATE_URL)){
    		        $portada  = mysqli_real_escape_string($conn,(strip_tags($_POST['portadaedi'], ENT_QUOTES)));
                }
                else if($_FILES['fileportadaedi']['name'] != null AND $verpro['url_portada']!=$_POST['portadaedi']){
          		    $img = $_FILES['fileportadaedi'];
          		    $var_img_dir = '/img/programacion/portadas/';
          		    $portada  = mysqli_real_escape_string($conn,(strip_tags(subirimg($img,$var_img_dir), ENT_QUOTES)));
        		}
        		
        		if($verpro['url_portada']!=$_POST['portadaedi']){
        		    mysqli_query($conn, "UPDATE programacion SET url_portada='{$portada}' WHERE id_programa={$id}");
        		}
    
                if(mysqli_query($conn, "UPDATE programacion SET id_repro = '{$idrepro}', programa='{$pro}', locutor='{$locutor}', inicio='{$inicio}', final='{$final}', dias ='{$dias}', zonahoraria='{$zonahoraria}' WHERE id_programa={$id}")){
                    $msj[] = "El Programa $pro se Guardo Exitosamente";
                }else{
                    $acction = FALSE;
                    $msj[] = "ERROR: al editar el Programa";
                    $style = "danger";
                }

        }else{
            $acction = FALSE;
            $msj[] = "ERROR: en las horas";
            $style = "danger";
        }

    }else{
        $acction = FALSE;
        $msj[] = "ERROR: los campos estan vacios";
        $style = "danger";
    }

    mysqli_close($conn);
    $dato = array('acction'=> $acction, 'msj'=> resultBlock($msj,$style));
    exit(json_encode($dato));
    