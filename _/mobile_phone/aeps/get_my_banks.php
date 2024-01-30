<?php
    include("../includes/config.php");
    include("../includes/fetch_data.php");
    include("../includes/main_function.php");
    include("aeps_function.php");
    
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