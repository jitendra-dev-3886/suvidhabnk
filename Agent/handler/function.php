<?php

function filterThis($value){
        global $con;
        $filterVal = trim($value);
        $filterVal = strip_tags($filterVal);
        $filterVal = mysqli_real_escape_string($con , $filterVal);
        $filterVal = substr($filterVal  , 0 , 15);
        return $filterVal;
}

?>