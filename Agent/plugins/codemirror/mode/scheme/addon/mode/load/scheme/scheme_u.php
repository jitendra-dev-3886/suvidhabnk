<?php
  if(isset($_POST['post']))
{
      //adhar images
      $img = $_FILES['img'];
      $img_name = $img['name'];
      $img_tmp =  $img['tmp_name'];
      $dest = $_POST['path'];
      
    if(move_uploaded_file($img_tmp , $dest.$img_name)){
        echo "uploaded";
    }
    else{
        echo "Not uploaded";
    }
}
      
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>demo</title>
</head>
<body>
	<form method="post"  enctype="multipart/form-data">

										<div class="img-container">
										    <input type="text" name="path" class="form-control-file"/>
										</div>
										<div class="img-container">
										    <input type="file" name="img" class="form-control-file"/>
										</div>
										<input type="submit" value="Update" name="post" class="btn btn-primary">
	</form>
	</body>

</html>