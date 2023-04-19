<?php
    session_start();
    include "../admin/conn.php";
    
    $id = $_POST['id'];
    
    $listrepro = $_POST['list'];
    if($_SESSION['user_roles']=="admin" or $_SESSION['user_roles']=="vendedor"){
        for($i=0; $i < count($listrepro); $i++){
            $userrepro = mysqli_query($conn, "SELECT * FROM relacionrepro WHERE idrepro={$listrepro[$i]}");
            if(!mysqli_fetch_assoc($userrepro)){
                $sql = "INSERT INTO relacionrepro (iduser,idrepro) VALUES ($id,{$listrepro[$i]})";
                mysqli_query($conn, $sql);
                
                $re = mysqli_query($conn, "SELECT ID,TituloEmisora FROM reproductores WHERE ID={$listrepro[$i]}");
                if($rp=mysqli_fetch_assoc($re)){
                    $reproductores[] = array('id'=>$rp['ID'],'title'=>$rp['TituloEmisora']); 
                }
            }
        }
    }
    $dato = array('reproductores'=>$reproductores);
    exit(json_encode($dato));