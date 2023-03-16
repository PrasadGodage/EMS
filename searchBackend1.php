<?php
include('config1.php');

extract($_POST);

$empName = $_POST['empName'];
$prdName = $_POST['prdName'];
$srcDate = $_POST['srcDate'];

if (isset($_POST['searchRTable'])) {
    $data = '<table class="table table-codensed table-custom">
      <thead>
        <tr>
          <th>Sr <br>No</th>
        //   <th>Ticket No</th>
          <th>Task Title</th>
          <th>Assigned To</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Status</th>
          </tr>
          </thead>';

    $displayName = "SELECT a.`t_start_time`, a.`select_product`, b.fullname FROM `task_info` a INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id) WHERE `fullname` = $empName  AND `select_product` = $prdName AND `t_start_time` = $srcDate ";
    echo $displayName;
    $result = mysqli_query($con, $displayName);
    if (mysqli_num_rows($result) > 0) {
        $serial2 = 1;

        while ($row = mysqli_fetch_array($result)) {
            $data .=  '<tr>
            <td>' . $serial2 . '</td>
            <td>' . $row['t_title'] . '</td>
            </tr>';
            $serial2++;
        }
    }
}





