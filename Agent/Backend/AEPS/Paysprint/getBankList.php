<?php
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../Auth/userdata.php");
require("aeps_function.php");
$time = date("Y-m-d g:i:s A");
    
    $response  = array();

    $id = $_POST['id'];
                       $jsn_data = json_decode(getbank() , true);
                                                            
                        $banklist = $jsn_data['banklist'];
                        $bank_data = $banklist['data'];
                        foreach($bank_data as $bank){
                                                                            
                        array_push($response,array("id"=>$bank['id'],"bankname"=>$bank['bankName'],"iinno"=>$bank['iinno'],"activeflag"=>$bank['activeFlag']));
                        }
                        echo json_encode($response);
?>