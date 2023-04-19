<?php
    session_start();
    include "../admin/conn.php";
    $userid = $_SESSION['user_id'];
    
    $re = mysqli_query($conn, "SELECT ID,TituloEmisora FROM reproductores WHERE user_id=$userid");
    $repro=mysqli_fetch_all($re, MYSQLI_ASSOC);

    foreach($repro as $val){
        $userrepro = mysqli_query($conn, "SELECT * FROM relacionrepro WHERE idrepro={$val['ID']}");
        if(!mysqli_fetch_assoc($userrepro)){
            $reproductores[] = array('id'=>$val['ID'],'title'=>$val['TituloEmisora']);
        }
    }

    
    $dato = array ('selectrepro'=>$reproductores);
    
    exit(json_encode($dato));
    
