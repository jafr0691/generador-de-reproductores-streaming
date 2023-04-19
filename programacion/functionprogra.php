<?php

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
    
    function subirimg($img,$var_img_dir){
	    $filename = "";
		if(!empty($img)){
      	    $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png', 'ico');
      		$file_parts = $img['name'];
    		$fileNameCmps = explode(".", $file_parts);
            $fileExtension = strtolower(end($fileNameCmps));
            if (in_array($fileExtension, $allowedfileExtensions)) {
				$temp = explode(".", $img["name"]);
				$newfilename = substr(rand(),0,4). '.' . end($temp);
				if (move_uploaded_file($img["tmp_name"], '../player/reproductores/'.$var_img_dir . $newfilename)){
					$filename = $newfilename;
				}
            }
    	}
    	return $var_img_dir.$filename;
	}