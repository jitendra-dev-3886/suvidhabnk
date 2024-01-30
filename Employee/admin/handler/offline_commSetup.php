<?php
session_start();
require_once('../../Db/config.php');
	    
	    $cahrge = strip_tags($_POST['coupon_price']);
	    $service = strip_tags($_POST['service']);
        $tds = strip_tags($_POST['tds']);
        $gst = strip_tags($_POST['gst']);
	    $rt_comm =strip_tags($_POST['rt_comm']);
        $dt_comm = strip_tags($_POST['dt_comm']);
        
        if($service == "Pancard"){
            
        $query="UPDATE `pan_coupon` SET `COUPON_PRICE`='$cahrge',`RT_COMM`='$rt_comm',`DT_COMM`='$dt_comm',`GST`='$gst',`TDS`='$tds' WHERE ID='1'";
        }else{
        
        $query="UPDATE `etax_commission` SET `CHARGE`='$cahrge',`RT_COMM`='$rt_comm',`DT_COMM`='$dt_comm',`GST`='$gst',`TDS`='$tds' WHERE `SERVICE`='$service'";
        
        }
        if(mysqli_query($con, $query)){
            echo 1;
        }else{
            echo 0;
        }
	
	
	
	?>