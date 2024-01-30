<html>
    <head>
        <title>Finalizing</title>
    </head>
    <body>
        <h1 style="text-align:center;">Processing, Please Wait..</h1>
        <h3 style="text-align:center;">Close the page if automatically doesn't close in 10 Seconds.</h3>
    </body>
</html>


<?php
    
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    
    // echo $json;
    
    // echo "Processing, Please wait..."
?>