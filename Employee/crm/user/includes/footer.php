   <script
      type="text/javascript"
      src="assets/js/jquery/jquery.min.js "
    ></script>
    <script
      type="text/javascript"
      src="assets/js/jquery-ui/jquery-ui.min.js "
    ></script>
    <script
      type="text/javascript"
      src="assets/js/popper.js/popper.min.js"
    ></script>
    <script
      type="text/javascript"
      src="assets/js/bootstrap/js/bootstrap.min.js "
    ></script>
    <!-- waves js -->
    <script src="assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script
      type="text/javascript"
      src="assets/js/jquery-slimscroll/jquery.slimscroll.js"
    ></script>

    <!-- slimscroll js -->
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js "></script>


    <!-- menu js -->
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/vertical/vertical-layout.min.js "></script>
    <script type="text/javascript" src="assets/js/script.js "></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    
$(document).ready(function(){
      var Token = localStorage.getItem("Token");

        $.ajax({
            type:'post',
            url:'./Backend/myauth.php',
            data: {  
                Token:Token,   
                pageid:1
              },
             success: function(data){
                var obj =JSON.parse(data); 
                 var stat = obj.status;

             if(stat)
                 {
                     
                   document.getElementById("usrname").innerHTML = obj.name;
                }
                 else
                 {
                    Swal.fire(
                        'Sorry!',
                            'Login Again',
                                ''
                                );
                     document.location.href="http://paydeer.in/crm/user/authsign_in.php" ;
                 }
             }
            });
        })
    
    
    
    
    
    
    function logout()
    {
       localStorage.clear();
     }
    
    
    </script>

    
    </body>
    </html>
