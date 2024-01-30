<?php

include("config.php");

if(isset($_POST["action"])){
  // Choose a function depends on value of $_POST["action"]
  if($_POST["action"] == "delete"){
    delete();
  }
}

function delete(){
  global $conn;

  $ID = $_POST["ID"];

 mysqli_query($conn, "DELETE FROM commission_package WHERE ID = $ID");
  echo "DATA DELETE SUCCESSFULLY";
}

