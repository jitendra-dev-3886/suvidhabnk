<?php  include('./header.php');  ?>

<?php  include('./sidebar.php');  ?>


            <!-- Page-header start -->
            <div class="page-header">
              <div class="page-block">
                <div class="row align-items-center">
                  <div class="col-md-8">
                    <div class="page-header-title">
                      <h5 class="m-b-10">Dashboard</h5>
                      <p class="m-b-0">Welcome to Material Able</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <ul class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="index.html"> <i class="fa fa-home"></i> </a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="#!">Dashboard</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- Page-header end -->
            <div class="pcoded-inner-content">
              <!-- Main-body start -->
              <div class="main-body">
                <div class="page-wrapper">
                  <!-- Page-body start -->

                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        
                        <!---<div class="page-header">-->
                        <!--    <div class="page-block">-->
                        <!--        <div class="row align-items-center">-->
                        <!--            <div class="col-md-8">-->
                        <!--                <div class="page-header-title">-->
                        <!--                    <h5 class="m-b-10">Basic Form Inputs</h5>-->
                        <!--                    <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="col-md-4">-->
                        <!--                <ul class="breadcrumb">-->
                        <!--                    <li class="breadcrumb-item">-->
                        <!--                        <a href="index.html"> <i class="fa fa-home"></i> </a>-->
                        <!--                    </li>-->
                        <!--                    <li class="breadcrumb-item"><a href="#!">Form Components</a>-->
                        <!--                    </li>-->
                        <!--                    <li class="breadcrumb-item"><a href="#!">Basic Form Inputs</a>-->
                        <!--                    </li>-->
                        <!--                </ul>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">

                                    <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Basic Form Inputs card start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Basic Form Inputs</h5>
                                                        <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
                                                    </div>
                                                    <div class="card-block">
                                                      <form id="Lead_Form" name="Lead_Form">
                                                      
                                                      <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control" name="leaddata" id="leaddata" placeholder="Lead Manager">
                                                    </div>
                                                    
                                                        <div class="input-group mb-3 col-md-6">
                                                         
                                                          <select class="custom-select" id="status" name="status">
                                                            <option selected>Select</option>
                                                            <option value="Active">Active</option>
                                                            <option value="Deactive">Deactive</option>
                                                          </select>
                                                        </div>
                                                        </div>
                                                      
                                                         <div class="text-center">
                                                              <input type="hidden" name="type" value="1">
                                                              <button type="button" id="submitLead" class="btn btn-info">Submit</button>
                                                         </div>
                                                      
                                                      </form>



                                                    </div>
                                                </div>
                                                <!-- Basic Form Inputs card end -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->
                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>

                  <!-- Page-body end -->
                </div>
                <div id="styleSelector"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
   
<!--cutom script for ajax-->
  
    
<?php    include('./footer.php');   ?>

    <script>
            
        $(document).ready(function(){
           $('#submitLead').click(function(){
               var user = 'user';
            //   alert("hey");
              $.ajax({
                type:"POST",
                url:'Backend/submitLeadmanager.php',
                data:$("#Lead_Form").serialize(),
            success: function(data){
                alert(data);            }
        });

           }) 
        });
    </script>
    
    
    
    <!--cutom script for ajax-->
   
     
     
     
     
     
  </body>
  

  
  
  
  
</html>
