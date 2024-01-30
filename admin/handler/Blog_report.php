<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
    
    if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
        
$i = 1;

 $fromdate = $_POST['formdate'];
  $todate = $_POST['todate'];

  $sql = "
SELECT * FROM blog WHERE date(DATE) BETWEEN '$fromdate' AND '$todate' ORDER BY ID DESC
";

$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";

  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>CATEGORIES</th>
                    <th>IMAGE</th>
                    <th>TITLE</th>
                    <th>WRITTEN_BY</th>
                    <th>RICH_TEXT</th>
                    <th>WEBSITE_NAME</th>
                    <th>DATE</th>
                    <th>ACTION</th>
                    
                   </tr>
                  </thead>
                  <tbody>';

              while($row = mysqli_fetch_assoc($result)){
                  
            $imgpath = "assets/Blog/".$row['IMAGE'];
                    
                $userdata .= "<tr>
                    <td>".$i++."</td>
                     <td>{$row['CATEGORIES']}</td>
                    <td><img class='notifyimg' src='$imgpath'></td>
                     <td>{$row['TITLE']}</td>
                    <td> {$row['WRITTEN_BY']}</td>
                    <td>{$row['WEBSITE_NAME']}</td>
                    <td> {$row['RICH_TEXT']}</td>
                    <td> {$row['DATE']}</td>
                   <td><a href='Edit_Blog.php?id={$row['ID']}' class='btn btn-sm btn-warning edit-btn'>Edit</a> &nbsp; <br> <br> <button type='button' class='btn btn-sm btn-danger delete-btn' data-id='{$row['ID']}'>Delete</button></td>
                   
                    </tr>";
              }
    $userdata .= " </tfoot>
                  
                </table>";
                
    echo $userdata;
}

if(isset($_POST['categories'])){
       $categories=$_POST['categories'];
 //logo images 
      $blog_image = $_FILES['image']; //input name
      $img_name = $blog_image['name'];
      $img_tmp = $blog_image['tmp_name'];
      $dest = "../assets/Blog/".$img_name;
      $title=$_POST['title'];
      $written=$_POST['writtenby'];
      $website_name=$_POST['website_name'];
      $richtext=$_POST['richtext'];

  
        $insert="INSERT INTO `blog`(`CATEGORIES`, `IMAGE`, `TITLE`, `WRITTEN_BY`, `RICH_TEXT`,`WEBSITE_NAME`) VALUES ('$categories','$img_name','$title','$written','$richtext','$website_name')";
        $run=mysqli_query($con,$insert);
        if($run){
             move_uploaded_file($img_tmp,$dest);
            echo 1;
        }else{
            echo 0;
        }
    }
    
    // update code
  if(isset($_POST['id']) && $_POST['id'] == 9){
      $team_image = $_FILES['image']; //input name
      $img_name = $team_image['name'];
      $img_tmp = $team_image['tmp_name'];
      $dest = "../assets/Blog/".$img_name;

$uid=$_POST['updateid'];
$update_categories=$_POST['category'];
// $update_image=$_POST['image'];
$update_title=$_POST['title'];
$update_written=$_POST['writtenby'];
$update_richtext=$_POST['richtext'];


if(!empty($img_name)){
   $con->query("UPDATE `blog` SET  IMAGE = '$img_name' WHERE ID = '$uid'" );
   move_uploaded_file($img_tmp, $dest);
}

$sql ="UPDATE `blog` SET `CATEGORIES`='$update_categories' , `TITLE`='$update_title',`WRITTEN_BY`='$update_written',`RICH_TEXT`='$update_richtext' WHERE ID='$uid'";
$run = mysqli_query($con,$sql);


if($run){
    echo 1;
}else{
    echo 0;
}

}
?>