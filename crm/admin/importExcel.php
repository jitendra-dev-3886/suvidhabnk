<?php  
        include('./includes/config.php');
        include('./includes/header.php');
        include('./includes/sidebar.php');
?>
        
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
                                    <h5>Dear Admin You Can Create Lead</h5>
                                    <span
                                      >Add 
                                      <code>Lead</code>
=                                    >
                                  </div>
                                  <div class="card-block">
                                    <h4 class="sub-title">Upload  Excel File </h4>


                               <form enctype="multipart/form-data">
                                      <div class="form-group row">
                                        <div class="col-sm-6">
                                          <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                         
                                              
                                            </div>
                                            <select class="custom-select" name="type_user"  id="type_user">
                                            <?php  
                                             
                                             $res=$con->query("SELECT * FROM user WHERE TYPE='Lead Manager' ORDER BY ID DESC");
                                                 while($row = $res->fetch_assoc()){
                                    
                                               
                                              ?>
                                               <option  value="<?php echo $row['ID'] ?>"><?php echo $row['FULL_NAME']; ?> </option>
                                           
                                           
                                            <?php  
                                                
                                            }
                                              ?>
                                              
                                           
                                            </select>
                                          </div>
                                        </div>

                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <input
                                              type="file"
                                              class="form-control-file"
                                              id="uploadfile"
                                              name="uploadfile"
                                            
                                            />
                                          </div>
                                        </div>
                                        </div>
                                        <div class="text-center">
                                            
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
                      <div id="styleSelector"></div>
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
<?php include('./includes/footer.php');  ?>

<script>
  $(document).ready(function () {
    $('#submitLead').click(function () {


        var types = $('#type_user').val();

        // console.log(type);

            
      var fd = new FormData();
        var files = $('#uploadfile')[0].files;
        

        // Check file selected or not
        if(files.length > 0 ){
          fd.append('uploadfile',files[0]);
          fd.append('type',types);

    $.ajax({
        type: "POST",
        url: "Backend/uploadExcel.php",
        data: fd, 
        contentType:false ,
        processData: false,
            success: function (data) {
                // alert(data);

                if(data == 1)
                {
                    Swal.fire(
                      'Good job!',
                      'Lead Inserted Sucessfully!',
                      'success'
                    )

                }
                else
                {
                    
                  Swal.fire(
                  'Sorry',
                  'Lead Not',
                  'Inserted'
                )

                }
          },
      });
   
        }
   
   
    
    
        
        })
  });
</script>


