<?php

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    echo $_POST['age'];
    
    
    
    $dir='images';
    mkdir($dir);	
		// adhaarfront 2 upload
$image2 = $_FILES['adharf'];
$adharf = $image2['name'];
$img_tmp2 = $image2['tmp_name'];
$dest2 = "$dir/". $adharf;
move_uploaded_file($img_tmp2, $dest2);

?>