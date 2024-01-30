



 <!--Multi Not used Select -->
   <script src="assets/js/multiselect-dropdown.js"></script>
 <!--Multi Not used Select -->

   <script
      type="text/javascript"
      src="assets/js/jquery/jquery.min.js "
    ></script>
    <script
      type="text/javascript"
      src="assets/js/jquery-ui/jquery-ui.min.js "
    ></script>
  
  
 

    <!--not used-->

  <!--<link-->
  <!--    rel="stylesheet"-->
  <!--    href="assets/css/multiselect/cdnjs/multiselect.css"-->
  <!--    type="text/css"-->
  <!--    media="all"-->
  <!--  />-->
    
    
    
    <!--<script type="text/javascript" src="https://unpkg.com/jquery-ui-multiselect-widget@3.0.1/src/jquery.multiselect.js"></script>-->

    <!--not used-->



    
    
    
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
    
    <!-- MDB -->

    
 

    <script>
        
        function logout()
        {
            localStorage.clear();
            document.location.href="http://paydeer.in/crm/admin/authsign_in.php" ;
        }
        
    </script>
    <script type="text/javascript">

    $(document).ready(function(){
    
      var Token = localStorage.getItem("Token");

        $.ajax({
            type:'post',
            url:'./Backend/myauth.php',
            data: {  
                Token:Token, 
                pageid:1,
              },
             success: function(data){
                 
                var obj    =  JSON.parse(data);
                 
                 if(obj.status){
                     

                 }
                 else
                 {
                    Swal.fire(
                        'Sorry!',
                            'Login Again',
                                ''
                            );
               
                  document.location.href="http://paydeer.in/crm/admin/authsign_in.php" ;
                 }
                 
             }
                        
            
        });
    })
    
    
</script>

    
    </body>
    </html>
    
    
    