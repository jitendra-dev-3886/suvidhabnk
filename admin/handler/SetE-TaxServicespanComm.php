<?php
session_start();
require_once('../../Db/config.php');
        $coupn_prc = strip_tags($_POST['coupon_price']);
        $coupn_prc2 = strip_tags($_POST['coupon_price2']);
        $tds = strip_tags($_POST['tds']);
        $gst = strip_tags($_POST['gst']);
	    $rt_comm =strip_tags($_POST['ds_comm']);
        $dt_comm = strip_tags($_POST['ms_comm']);

if($_POST['set_pan']==1){
        //   $query = "INSERT INTO `pan_coupon`(`USER_ID`, `COUPON_PRICE`, `RT_COMM`, `DT_COMM`, `GST`, `TDS`) VALUES ('All','$coupn_prc','$rt_comm','$dt_comm','$gst','$tds')";  

         $query="UPDATE `pan_charge` SET `E_PAN`='$coupn_prc', `P_PAN`='$coupn_prc2',`DS_COM`='$rt_comm',`MS_COM`='$dt_comm' WHERE ID='1'";

        if(mysqli_query($con, $query))  {
            echo 1;
        }else{
            echo 0;
        }
	    exit();
	}
	
	
	
	if(isset($_POST["pageid"]) && $_POST["pageid"] == 1){
	    
	    $cahrge = strip_tags($_POST['charge']);
        $tds = strip_tags($_POST['tds']);
        $gst = strip_tags($_POST['gst']);
	    $rt_comm =strip_tags($_POST['rt_comm']);
        $dt_comm = strip_tags($_POST['dt_comm']);
        
        $query="UPDATE `insurance_coupon` SET `USER_ID`='',`CHARGE`='$cahrge',`RT_COMM`='$rt_comm',`DT_COMM`='$dt_comm',`GST`='$gst',`TDS`='$tds' WHERE ID='1'";
        
        if(mysqli_query($con, $query)){
            echo 1;
        }else{
            echo 0;
        }
	    
	}
	
	
	
	?>