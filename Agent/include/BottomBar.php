<?php

// require_once('../../Db/config.php');

$sql=$con->query("SELECT * FROM `company_contact` WHERE `ID`='1'")->fetch_assoc();
$mobile=$sql['MOBILE'];
$email=$sql['EMAIL'];
?>

<!-- Comming Soon Modal -->
<div class="modal fade" id="exampleModalCenterC" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Comming Soon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2 class="text-center">Our Services is</h2>
        <h1 class="text-center">Comming Soon</h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- contact  Modal -->
<div class="modal fade" id="exampleModalCenterContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Contact Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2 class="text-center">Mobile : +91 <?php echo $mobile ?></h2>
        <h2 class="text-center">Email : <?php echo $email ?></h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/6328310c37898912e969fed1/1gdafv6qj';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

 <script>
     window.addEventListener("online", 
      ()=>  alert("Connected Now.")
    );
    
    window.addEventListener("offline", 
      ()=>  alert("No internet connection. Please check your internet connection ")
    );

 function check_session(){
     if(!navigator.onLine){
        //  alert("No internet connection. ")
        return false;
     }
     
     let check_user = "check_user";
     $.ajax({
         url:'Backend/Auth/validate',
         type:'post',
         data:{check_user},
              beforeSend:function(xhr){xhr.setRequestHeader('Token', localStorage.getItem('Token'));},
         success:function(data, status){
            //  console.log(data);
            if(data != ""){
             let rslt = JSON.parse(data);
             if(rslt.rscode == undefined){
              let rs_code = rslt.response_code; 
              let msg = rslt.msg; 
              if(rs_code == 1){
                clearInterval(checkRepeat);
                alert(msg);
                  location.replace("Login");
              }
            }
            else{
                alert(msg);
             }
            }
         },
         error:function(err){
             if(err.responseText != undefined){
                 let dt = JSON.parse(err.responseText);
                 alert(dt.message+" Login Again to continue");
             }
            clearInterval(checkRepeat);
          location.replace("Login");

            // alert("Internet connection required");
         }
     })
 }
 let checkRepeat =  setInterval(check_session ,  5000);

 </script>
 
 <?php
 
    $row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();

 ?>
 
 <footer class="main-footer">
    <strong>Copyright &copy; 2008-2022 <a href="<?php echo $row['DOMAIN'] ?>" target="_blank"><?php echo $row['NAME'] ?></a>.</strong>
    All rights reserved.
    <!--<div class="float-right d-none d-sm-inline-block">-->
    <!--  <b>Version</b> 3.2.0-rc-->
    <!--</div>-->
  </footer>