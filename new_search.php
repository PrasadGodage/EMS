<?php

include('config1.php');

require 'authentication.php'; // admin authentication check 

// auth check
$user_id = $_SESSION['admin_id'];
$user_name = $_SESSION['name'];
$security_key = $_SESSION['security_key'];
if ($user_id == NULL || $security_key == NULL) {
  header('Location: index.php');
}

// check admin
$user_role = $_SESSION['user_role'];


if (isset($_GET['delete_task'])) {
  $action_id = $_GET['task_id'];

  $sql = "DELETE FROM task_info WHERE task_id = :id";
  $sent_po = "task-info.php";
  $obj_admin->delete_data_by_this_method($sql, $action_id, $sent_po);
}

if (isset($_POST['add_task_post'])) {
  $obj_admin->add_new_task($_POST);
}





?>

<html>
 <head>
  <title>Custom Search in jQuery Datatables using PHP Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

 </head>
 <body>
  <div class="container box">
   <h3 align="center">Search Bar For Dynamic Data</h3>
   <br />
   <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="col-12" style="display: flex; margin:10px 10px">

        <div class="form-group">
          <?php
                    $sql = "SELECT user_id, fullname FROM tbl_admin WHERE user_role = 2";
                    $info = $obj_admin->manage_all_info($sql);
                    ?>
                    <select class="form-control rounded-0" name="assign_to" id="empName" required>
                      <option value="">Select Employee...</option>
                      
                      <?php while ($row = $info->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option><?php echo $row['fullname']; ?></option>
                      <?php } ?>
                    </select>

                  </div>
                  <div class="form-group">
                  <?php
                    $q = "SELECT  `products` FROM `products` WHERE 1";
                    $info1 = $obj_admin->manage_all_info($q);
                    ?>

                    <select class="form-control rounded-0" name="select_product" id="prdName" required>
                      <option value="">Select Product...</option>
                      <?php while ($row1 = $info1->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row1['products']; ?>"><?php echo $row1['products']; ?></option>
                      <?php } ?>

                      

                    </select>
     </div>
    
    
     <div class="form-group">
       <input type="date" class="form-control" id="srcDate" required>
      </div>
    </div>
      <!-- <div class="form-group">
        <label for="">Select Dynamic</label>
      <input class="form_control" placeholder="Employee Name" id="live_search" type="text">

     </div> -->
     <div class="form-group" align="center">
      <button type="button" name="filter" id="filter" class="btn btn-info" onclick="searchRec()">Search</button>
     </div>
    </div>
    <div class="col-md-4"></div>
   </div>
   <div>
    <table class="table table-bordered table-striped">
     <thead>
      <tr>
      <th width="5%">Sr No</th>

       <th width="15%">Ticket No</th>
       <th width="15%">Task Title</th>
       <th width="15%">Assign To</th>
       <th width="15%">Start Date</th>
       <th width="15%">End Date</th>
       <th width="15%">Status</th>
      </tr>
     </thead>
     <tbody id="dataholder">

     </tbody>
    </table>
    <br />
    <br />
    <br />
   </div>
   
  </div>
  <script>
  function searchRec() {
    let empName = $('#empName').val();
    let prdName = $('#prdName').val();
    let srcDate = $('#srcDate').val();
    console.log(empName)

    
    $.ajax({
        
      url: "backendSearch.php",
      type: 'POST',
      data: {
        empName:empName,
        prdName:prdName,
        srcDate:srcDate,
      },
      success: function(data) {
           
          $('#dataholder').html(data);
       
        
      }
    })
  }
  </script>
 </body>
</html>



   