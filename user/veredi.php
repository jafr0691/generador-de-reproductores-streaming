<?php
    session_start();
    include "../admin/conn.php";
    $userid = $_SESSION['user_id'];
    $id = $_POST['id'];
    
    $user = mysqli_query($conn, "SELECT * FROM user WHERE id=$id");
    $veruser =mysqli_fetch_assoc($user);
    
    // $re = mysqli_query($conn, "SELECT ID,TituloEmisora FROM reproductores WHERE user_id=$userid");
    // $repro=mysqli_fetch_all($re, MYSQLI_ASSOC);

    // foreach($repro as $val){
    //     $userrepro = mysqli_query($conn, "SELECT * FROM relacionrepro WHERE idrepro={$val['ID']}");
    //     if(!mysqli_fetch_assoc($userrepro)){
    //         $reproductores[] = array('id'=>$val['ID'],'title'=>$val['TituloEmisora']);
    //     }
    // }
    

    // $lireuser = mysqli_query($conn, "SELECT reproductores.ID,reproductores.TituloEmisora FROM reproductores INNER JOIN relacionrepro ON relacionrepro.iduser={$id} AND reproductores.ID=relacionrepro.idrepro");
    // $lireuserid = mysqli_fetch_all($lireuser, MYSQLI_ASSOC);
    // foreach($lireuserid as $val){
    //     $reproductores_to[] = array('id'=>$val['ID'],'title'=>$val['TituloEmisora']);
    // }
     mysqli_close($conn);
    if($_SESSION['user_roles']=="admin"){
        
        $dato = array ('name'=>$veruser['username'],
        'rol'=>$veruser['roles'],
        'genrepro'=>$veruser['crear'],
        'suspender'=>$veruser['activ'],
        'suspenderli'=>$veruser['acthash'],
        'rolif'=>TRUE,
        'hast'=>$veruser['hast'],
        'email'=>$veruser['email']);
        // ,
        // 'selecreproif'=>TRUE,
        // 'selectrepro'=>array($reproductores),
        // 'selectrepro_to'=>array($reproductores_to));
        
        exit(json_encode($dato));
        
    }else if($_SESSION['user_roles']=="vendedor"){
        
        $dato = array ('name'=>$veruser['username'],'hast'=>$veruser['hast'],'rol'=>$veruser['roles'],'genrepro'=>$veruser['crear'],'suspender'=>$veruser['activ'],'suspenderli'=>$veruser['acthash'],'rolif'=>FALSE,
        'email'=>$veruser['email']);
        // ,'selecreproif'=>TRUE,'selectrepro'=>$reproductores,'selectrepro_to'=>$reproductores_to);
        
        exit(json_encode($dato));
        
    }
