<?php
session_start();
require_once ('../../Db/config.php');
require ("../include/Auth.php");

$id = $_SESSION['UsId'];

if(isset($_POST['pageid']) && $_POST['pageid'] == 6){
    
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];
    $type = $_POST['type'];

 $i = 1;
 
  
    if($type == "MAIN"){
        $filterquery = "AND WALLET='MAIN'";
    }
    else{
        $filterquery = "AND WALLET='AEPS'";
    }

  $sql = "SELECT * FROM report WHERE USER_ID = '$id' $filterquery AND TRANS_DATE BETWEEN '{$fromdate}' AND '{$todate}'";
  
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$userdata = "";



  $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                     <th>Sr. No</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Member ID</th>
                        <th>Service Type</th>
                        <th>Ref Id</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Balance</th>
                  </tr>
                  </thead>
                  <tbody>';

             while ($row = mysqli_fetch_assoc($result))
    {
        if(strtolower($row['FUND_TYPE']) == "debit"){
            $fnd = "<td>0</td><td>{$row['AMOUNT']}</td>";
        }
        else if(strtolower($row['FUND_TYPE']) == "credit"){
            $fnd = "<td>{$row['AMOUNT']}</td><td>0</td>";
        }
        else{
            $fnd = "<td>0</td><td>0</td>";
        }
        $userdata .= "<tr>
                    <td>" . $i++ . "</td>
                    <td>{$row['TRANS_DATE']}</td>
                    <td>{$row['TRANS_TIME']}</td>
                    <td>{$row['USER_ID']}</td>
                    <td>{$row['TRANS_TYPE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    $fnd
                    <td>".number_format((float)$row['AFTER_AMOUNT'], 2, '.', '')."</td>
                   
                 </tr>";
    }
    $userdata .= " </tfoot>
                  
                </table>";
                
    

    echo $userdata;
}


if (isset($_POST['pageid']) && $_POST['pageid'] == 4){
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

    $i = 1;
    
    $type = $_POST['type'];
    
    if($type == "MAIN"){
        $filterquery = "AND WALLET='MAIN'";
    }
    else{
        $filterquery = "AND WALLET='AEPS'";
    }
    
    $sql = "SELECT * FROM report WHERE USER_ID = '$id' $filterquery AND TRANS_DATE between '$fromdate' and '$todate' ORDER BY ID DESC";
// echo "SELECT * FROM report WHERE USER_ID = '$id' $filterquery ORDER BY ID DESC LIMIT {$offset},{$limit_per_page}";

    $result = mysqli_query($con, $sql);
    $userdata = "";

    $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                     <th>Sr. No</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Member ID</th>
                        <th>Service Type</th>
                        <th>Ref Id</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Balance</th>
                  </tr>
                  </thead>
                  <tbody>';

             while ($row = mysqli_fetch_assoc($result))
    {
        if(strtolower($row['FUND_TYPE']) == "debit"){
            $fnd = "<td>0</td><td>{$row['AMOUNT']}</td>";
        }
        else if(strtolower($row['FUND_TYPE']) == "credit"){
            $fnd = "<td>{$row['AMOUNT']}</td><td>0</td>";
        }
        else{
            $fnd = "<td>0</td><td>0</td>";
        }
        $userdata .= "<tr>
                    <td>" . $i++ . "</td>
                    <td>{$row['TRANS_DATE']}</td>
                    <td>{$row['TRANS_TIME']}</td>
                    <td>{$row['USER_ID']}</td>
                    <td>{$row['TRANS_TYPE']}</td>
                    <td>{$row['REFERENCE_ID']}</td>
                    $fnd
                    <td>".number_format((float)$row['AFTER_AMOUNT'], 2, '.', '')."</td>
                   
                 </tr>";
    }
    $userdata .= " </tfoot>
                  
                </table>";

//     $userdata .= '

// <br />
// <div style="float:right;" align="center">
//   <ul class="pagination">
// ';

//     $sql_total = "SELECT * FROM report WHERE USER_ID = '$id' $filterquery";
//     $records = mysqli_query($con, $sql_total) or die("Query Unsuccessful.");
//     $total_record = mysqli_num_rows($records);
//     $total_links = ceil($total_record / $limit_per_page);
//     $previous_link = '';
//     $next_link = '';
//     $page_link = '';

//     //echo $total_links;
//     if ($total_links > 4)
//     {
//         if ($page < 5)
//         {
//             for ($count = 1;$count <= 5;$count++)
//             {
//                 $page_array[] = $count;
//             }
//             $page_array[] = '...';
//             $page_array[] = $total_links;
//         }
//         else
//         {
//             $end_limit = $total_links - 5;
//             if ($page > $end_limit)
//             {
//                 $page_array[] = 1;
//                 $page_array[] = '...';
//                 for ($count = $end_limit;$count <= $total_links;$count++)
//                 {
//                     $page_array[] = $count;
//                 }
//             }
//             else
//             {
//                 $page_array[] = 1;
//                 $page_array[] = '...';
//                 for ($count = $page - 1;$count <= $page + 1;$count++)
//                 {
//                     $page_array[] = $count;
//                 }
//                 $page_array[] = '...';
//                 $page_array[] = $total_links;
//             }
//         }
//     }
//     else
//     {
//         for ($count = 1;$count <= $total_links;$count++)
//         {
//             $page_array[] = $count;
//         }
//     }

//     for ($count = 0;$count < count($page_array);$count++)
//     {
//         if ($page == $page_array[$count])
//         {
//             $page_link .= '
//     <li class="page-item active">
//       <a class="page-link" href="#">' . $page_array[$count] . ' <span class="sr-only">(current)</span></a>
//     </li>
//     ';

//             $previous_id = $page_array[$count] - 1;
//             if ($previous_id > 0)
//             {
//                 $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '">Previous</a></li>';
//             }
//             else
//             {
//                 $previous_link = '
//       <li class="page-item disabled">
//         <a class="page-link" href="#">Previous</a>
//       </li>
//       ';
//             }
//             $next_id = $page_array[$count] + 1;
//             if ($next_id >= $total_links)
//             {
//                 $next_link = '
//       <li class="page-item disabled">
//         <a class="page-link" href="#">Next</a>
//       </li>
//         ';
//             }
//             else
//             {
//                 $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $next_id . '">Next</a></li>';
//             }
//         }
//         else
//         {
//             if ($page_array[$count] == '...')
//             {
//                 $page_link .= '
//       <li class="page-item disabled">
//           <a class="page-link" href="#">...</a>
//       </li>
//       ';
//             }
//             else
//             {
//                 $page_link .= '
//       <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>
//       ';
//             }
//         }
//     }

//     $userdata .= $previous_link . $page_link . $next_link;

//     $userdata .= '</div>';

    echo $userdata;

}





if (isset($_POST['pageid']) && $_POST['pageid'] == 14){
    $fromdate = $_POST['formdate'];
    $todate = $_POST['todate'];

    $i = 1;
    
    $sql1 = "SELECT * FROM wallet_exchange WHERE USER_ID = '$id' AND date(DATE) between '$fromdate' and '$todate' ORDER BY ID DESC";
// echo "SELECT * FROM report WHERE USER_ID = '$id' $filterquery ORDER BY ID DESC LIMIT {$offset},{$limit_per_page}";

    $result = mysqli_query($con, $sql1);
    $userdata = "";

    $userdata .= '<table id="example1" class="table table-bordered table-striped">
        
                  <thead>
                  <tr>
                     <th>Sr. No</th>
                        <th>WALLET TYPE</th>
                        <th>AMOUNT</th>
                        <th>MAIN_BAL BEFORE</th>
                        <th>MAIN BALANCE AFTER</th>
                        <th>AEPS BALANCE BEFORE</th>
                        <th>AEPS BALANCE AFTER</th>
                        <th>STATUS</th>
                        <th>DATE</th>
                  </tr>
                  </thead>
                  <tbody>';

             while ($row = mysqli_fetch_assoc($result))
    {
        
        $userdata .= "<tr>
                    <td>" . $i++ . "</td>
                    <td>{$row['WALLET_TYPE']}</td>
                    <td>{$row['AMOUNT']}</td>
                    <td>{$row['MAIN_BAL_BEFORE']}</td>
                    <td>{$row['MAIN_BAL_AFTER']}</td>
                    <td>{$row['AEPS_BAL_BEFORE']}</td>
                    <td>{$row['AEPS_BAL_AFTER']}</td>
                    <td>{$row['STATUS']}</td>
                    <td>{$row['DATE']}</td>
                 </tr>";
    }
    $userdata .= " </tfoot>
                  
                </table>";

//     $userdata .= '

// <br />
// <div style="float:right;" align="center">
//   <ul class="pagination">
// ';

//     $sql_total = "SELECT * FROM report WHERE USER_ID = '$id' $filterquery";
//     $records = mysqli_query($con, $sql_total) or die("Query Unsuccessful.");
//     $total_record = mysqli_num_rows($records);
//     $total_links = ceil($total_record / $limit_per_page);
//     $previous_link = '';
//     $next_link = '';
//     $page_link = '';

//     //echo $total_links;
//     if ($total_links > 4)
//     {
//         if ($page < 5)
//         {
//             for ($count = 1;$count <= 5;$count++)
//             {
//                 $page_array[] = $count;
//             }
//             $page_array[] = '...';
//             $page_array[] = $total_links;
//         }
//         else
//         {
//             $end_limit = $total_links - 5;
//             if ($page > $end_limit)
//             {
//                 $page_array[] = 1;
//                 $page_array[] = '...';
//                 for ($count = $end_limit;$count <= $total_links;$count++)
//                 {
//                     $page_array[] = $count;
//                 }
//             }
//             else
//             {
//                 $page_array[] = 1;
//                 $page_array[] = '...';
//                 for ($count = $page - 1;$count <= $page + 1;$count++)
//                 {
//                     $page_array[] = $count;
//                 }
//                 $page_array[] = '...';
//                 $page_array[] = $total_links;
//             }
//         }
//     }
//     else
//     {
//         for ($count = 1;$count <= $total_links;$count++)
//         {
//             $page_array[] = $count;
//         }
//     }

//     for ($count = 0;$count < count($page_array);$count++)
//     {
//         if ($page == $page_array[$count])
//         {
//             $page_link .= '
//     <li class="page-item active">
//       <a class="page-link" href="#">' . $page_array[$count] . ' <span class="sr-only">(current)</span></a>
//     </li>
//     ';

//             $previous_id = $page_array[$count] - 1;
//             if ($previous_id > 0)
//             {
//                 $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '">Previous</a></li>';
//             }
//             else
//             {
//                 $previous_link = '
//       <li class="page-item disabled">
//         <a class="page-link" href="#">Previous</a>
//       </li>
//       ';
//             }
//             $next_id = $page_array[$count] + 1;
//             if ($next_id >= $total_links)
//             {
//                 $next_link = '
//       <li class="page-item disabled">
//         <a class="page-link" href="#">Next</a>
//       </li>
//         ';
//             }
//             else
//             {
//                 $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $next_id . '">Next</a></li>';
//             }
//         }
//         else
//         {
//             if ($page_array[$count] == '...')
//             {
//                 $page_link .= '
//       <li class="page-item disabled">
//           <a class="page-link" href="#">...</a>
//       </li>
//       ';
//             }
//             else
//             {
//                 $page_link .= '
//       <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>
//       ';
//             }
//         }
//     }

//     $userdata .= $previous_link . $page_link . $next_link;

//     $userdata .= '</div>';

    echo $userdata;

}

