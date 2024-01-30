<?php
session_start();
require_once('../Db/config.php');
require("include/Auth.php");
if(isset($_POST['value'])){
$colors = implode(',', $_POST['value']);
echo $colors;
}
$dbObj = new db();
$db = $dbObj->db();
if($db->query("INSERT INTO `menu_management`(`ID`, `MENU`, `DATE`) VALUES (`$ID`,`$MENU`,`$DATE`)")){
    echo "Success";
}

?>