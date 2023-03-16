<?php

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


$page_name = "Task_Info";
include("include/sidebar.php");
// include('ems_header.php');


?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog add-category-modal">

    <!-- Modal content-->
    <div class="modal-content rounded-0">
      <div class="modal-header rounded-0">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title text-center">Assign New Task</h2>
      </div>
      <div class="modal-body rounded-0">
        <div class="row">
          <div class="col-md-12">
            <form role="form" action="" method="post" autocomplete="off">
              <div class="form-horizontal">
                <div class="form-group">
                  <label class="control-label text-p-reset">Year</label>
                  <div class="">
                    <input type="year" name="task_year" id="task_year" class="form-control rounded-0" placeholder="2023" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label text-p-reset">Task Title</label>
                  <div class="">
                    <input type="text" placeholder="Task Title" id="task_title" name="task_title" list="expense" class="form-control rounded-0" id="default" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label text-p-reset">Task Description</label>
                  <div class="">
                    <textarea name="task_description" id="task_description" placeholder="Text Deskcription" class="form-control rounded-0" rows="5" cols="5"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label text-p-reset">Start Time</label>
                  <div class="">
                    <input type="calender" name="t_start_time" id="t_start_time" class="form-control rounded-0">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label text-p-reset">End Time</label>
                  <div class="">
                    <input type="calender" name="t_end_time" id="t_end_time" class="form-control rounded-0">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label text-p-reset">Product Name</label>
                  <div class="">
                    <?php
                    $q = "SELECT  `products` FROM `products` WHERE 1";
                    $info1 = $obj_admin->manage_all_info($q);
                    ?>

                    <select class="form-control rounded-0" name="select_product" id="
                    select_product" required>
                      <option value="">Select Product...</option>
                      <?php while ($row1 = $info1->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row1['products']; ?>"><?php echo $row1['products']; ?></option>
                      <?php } ?>



                    </select>
                  </div>






                </div>
                <div class="form-group">
                  <label class="control-label text-p-reset">Assign To</label>
                  <div class="">
                    <?php
                    $sql = "SELECT user_id, fullname FROM tbl_admin WHERE user_role = 2";
                    $info = $obj_admin->manage_all_info($sql);
                    ?>
                    <select class="form-control rounded-0" name="assign_to" id="aassign_to" required>
                      <option value="">Select Employee...</option>

                      <?php while ($row = $info->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row['user_id']; ?>"><?php echo $row['fullname']; ?></option>
                      <?php } ?>
                    </select>
                  </div>



                </div>


                <div class="form-group">
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-3">
                    <button type="submit" name="add_task_post" class="btn btn-primary rounded-0 btn-sm">Assign Task</button>
                  </div>
                  <div class="col-sm-3">
                    <button type="submit" class="btn btn-default rounded-0 btn-sm" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>





<div class="row">
  <div class="col-md-6">
    <div class="well well-custom rounded-0">
      <div class="gap"></div>
      <div class="row">
        <div class="col-md-8">
          <div class="btn-group">
            <?php if ($user_role == 1) { ?>
              <div class="btn-group">
                <button class="btn btn-info btn-menu" data-toggle="modal" data-target="#myModal">Assign New Task</button>
                <!-- <input class="input m-3" data-toggle="modal" data-target="#myModal">Assign New Task</input> -->
              </div>
            <?php } ?>

          </div>

        </div>


      </div>
      <center>
        <div style="display: flex;">
          <h3>Today Tickets</h3>
          <div class="h-20" style="margin-top:16px; margin-left:16px">
            <a href="./task-info-dashboard.php"><button class="btn-sm btn-info btn-sm">All Tickets</button></a>


          </div>
        </div>
      </center>
      <div class="gap"></div>

      <div class="gap"></div>

      <div class="table-responsive">
        <table class="table table-codensed table-custom">
          <thead>
            <tr>
              <th>Sr <br>No</th>
              <th>Ticket No</th>
              <th>Task Title</th>
              <th>Assigned To</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php

            if ($user_role == 1) {
              $date = date('d-m-y');
              $sql = "SELECT a.*, b.fullname FROM task_info a INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id) WHERE `t_start_time` = $date ORDER BY a.task_id DESC";
            } else {
              // $sql = "SELECT a.*, b.fullname FROM task_info a INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id) WHERE t_start_time = $date = date('d-m-y') ORDER BY a.task_id DESC";
            }










            $info = $obj_admin->manage_all_info($sql);
            $serial  = 1;
            $serial1  = 1;
            $num_row = $info->rowCount();
            if ($num_row == 0) {
              echo '<tr><td colspan="7">No Data found</td></tr>';
            }
            while ($row = $info->fetch(PDO::FETCH_ASSOC)) {
            ?>



              <tr>


                <td><?php echo $serial1;
                    $serial1++; ?></td>
                <td>SSI/<?php echo $row['select_product']; ?>/<?php echo $row['t_year']; ?>/<?php echo $serial;
                                                                                            $serial++; ?></td>

                <td><?php echo $row['t_title']; ?></td>
                <td><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['t_start_time']; ?></td>
                <td><?php echo $row['t_end_time']; ?></td>
                <td>
                  <?php if ($row['status'] == 1) {
                    // echo "In Progress <span style='color:#5bcad9;' class=' glyphicon glyphicon-refresh' >";
                    echo '<small class="label label-warning px-3">In Progress <span class="glyphicon glyphicon-refresh" ></small>';
                  } elseif ($row['status'] == 2) {
                    echo '<small class="label label-success px-3">Completed <span class="glyphicon glyphicon-ok" ></small>';
                    // echo "Completed <span style='color:#00af16;' class=' glyphicon glyphicon-ok' >";
                  } else {
                    echo '<small class="label label-default border px-3">Incomplete <span class="glyphicon glyphicon-remove" ></small>';
                  } ?>

                </td>

                <td><a title="Update Task" href="edit-task.php?task_id=<?php echo $row['task_id']; ?>"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
                  <a title="View" href="task-details.php?task_id=<?php echo $row['task_id']; ?>"><span class="glyphicon glyphicon-folder-open"></span></a>&nbsp;&nbsp;
                  <?php if ($user_role == 1) { ?>
                    <a title="Delete" href="?delete_task=delete_task&task_id=<?php echo $row['task_id']; ?>" onclick=" return check_delete();"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
              <?php } ?>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="well well-custom rounded-0">

      <center>
        <div style="display: flex;">
          <h3>Pending Tickets</h3>
          <div class="h-20" style="margin-top:16px; margin-left:16px">
            <a href="./task-info-comp.php"><button class="btn-sm btn-info btn-sm">Completed Tickets</button></a>
            <a href="./new_search.php"><button class="btn-sm btn-info btn-sm">Search</button></a>
            

            <!-- <button class="btn btn-success btn-sm" href="javascript:void(0)" onclick="searchRecord()">Search</button> -->

          </div>
        </div>
      </center>

      <div class="table-responsive" id="srcRTable">

      </div>
      <div class="table-responsive">
        <table class="table table-codensed table-custom">
          <thead>
            <tr>

              <th>Sr.No</th>
              <th>Ticket No</th>
              <th>Task Title</th>
              <th>Assigned To</th>
              <th>Start Time</th>
              <th>End Time</th>

            </tr>
          </thead>
          <tbody>

            <?php

            if ($user_role == 1) {
              $sql = "SELECT a.*, b.fullname FROM task_info a INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id) WHERE `status` = 0 ORDER BY a.task_id DESC";
            } else {
              // $sql = "SELECT a.*, b.fullname FROM task_info a INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id) WHERE t_start_time = $date = date('d-m-y') ORDER BY a.task_id DESC";
            }










            $info = $obj_admin->manage_all_info($sql);
            $serial  = 1;
            $serial1  = 1;
            $num_row = $info->rowCount();
            if ($num_row == 0) {
              echo '<tr><td colspan="7">No Data found</td></tr>';
            }
            while ($row = $info->fetch(PDO::FETCH_ASSOC)) {
            ?>



              <tr>


                <td><?php echo $serial1;
                    $serial1++; ?></td>
                <td>SSI/<?php echo $row['select_product']; ?>/<?php echo $row['t_year']; ?>/<?php echo $serial;
                                                                                            $serial++; ?></td>

                <td><?php echo $row['t_title']; ?></td>
                <td><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['t_start_time']; ?></td>
                <td><?php echo $row['t_end_time']; ?></td>




              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<?php

include("include/footer.php");



?>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script type="text/javascript">
  flatpickr('#t_start_time', {
    enableTime: true
  });

  flatpickr('#t_end_time', {
    enableTime: true
  });
</script>

<!-- <script>
  function searchRTable() {
    let searchRTable = "searchRTable";
    $.ajax({
      url: "backend1.php",
      type: "post",
      data: {
        searchRTable: searchRTable
      },
      success: function(data, status) {
        $('#srcRTable').html(data)
      }
    });
  }

  function searchRecord() {
    let empName = $('#empName').val();
    let prdName = $('#prdName').val();
    let srcDate = $('#srcDate').val();



    $.ajax({
      url: "searchBackend.php",
      type: 'post',
      data: {
        empName,
        prdName,
        srcDate
      },
      success: function(data, status) {
        searchRTable()
      }
    })
  }
</script> -->

<script type="text/javascript">
  $(documnet).ready(function() {
    $("#live_search").keyup(function() {
      let input = $(this).val();
      if (input != "") {
        $.ajax({
          url: "searchBackend.php",
          method: "post",
          data: {
            input: input
          },

          success: function(data) {
            $("#searchRTable").html(data);
          }
        })
      } else {
        $("#searchRTable").css("display", "none");
      }
    })
  })
</script>