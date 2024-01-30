 <?php
 
    $row = $con->query("SELECT * FROM `websetting`")->fetch_assoc();

 ?>
 
 <footer class="main-footer">
    <strong>Copyright &copy; 2008-2022 <a href="<?php echo $row['DOMAIN'] ?>"><?php echo $row['NAME'] ?></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 2.0
    </div>
  </footer>