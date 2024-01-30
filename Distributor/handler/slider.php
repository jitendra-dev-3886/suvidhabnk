<?php
    require_once('../../Db/config.php');
    // Send data
     $image2 = $_FILES['slider_img'];
     $img_name2 = $image2['name'];
     $img_tmp2 = $image2['tmp_name'];
     $filerror = $image2['error'];
     $status = $_POST['status'];

    $file_text = explode('.',$img_name2);
    $file_text_check = strtolower(end($file_text));
    //  echo $file_text_check;
    $valid_file_text = array('png','jpg','jpeg');
    if($filerror == 0){
        if(in_array($file_text_check,$valid_file_text)){
            $dest2 = "../dist/img/slider/" . $img_name2;
            move_uploaded_file($img_tmp2, $dest2);
            $sql = $con->query("INSERT INTO `slider`(`IMAGE`, `STATUS`) VALUES ('$img_name2','$status')");
        if($sql){
            echo'successfully  Inserted';
            
        }else{
    echo'Failed to Inserted';
    
    }
}else{
         echo'Not Valid Extension';
} 
    }  
    

?>
