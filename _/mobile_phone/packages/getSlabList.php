<?php
include("../includes/config.php");
$id = $_POST['package_id'];
$response  = array();
if(isset($_POST['fetch_slab'])){
    
     $pack_query2 = $con->query("SELECT * FROM `slab_commission` where STATUS='ACTIVE' AND COMM_PACK_ID='$id' order by ID desc");
     while($row = $pack_query2->fetch_assoc()){
        $id =  $row['ID'];
        $min_amount = $row['MIN_AMOUNT'];
        $max_amount = $row['MAX_AMOUNT'];
        $tds = $row['TDS'];

        $gst =  $row['GST'];
        $type = $row['TYPE'];
        $amount_type = $row['AMOUNT_TYPE'];
        $amount = $row['AMOUNT'];
        
        $status =  $row['STATUS'];
        $charge = $row['CHARGE'];
        $ms_com = $row['MS_COM'];
        $ds_com  =$row['DS_COM'];
        
        array_push($response,array("id"=>$id, "min_amount"=>$min_amount,"max_amount"=>$max_amount,"tds"=>$tds,"gst"=>$gst,"type"=>$type,"amount_type"=>$amount_type,"amount"=>$amount,"status"=>$status,"charge"=>$charge,"ms_com"=>$ms_com,"ds_com"=>$ds_com));
     }
     echo json_encode($response);
}



?>