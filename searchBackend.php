<?php
extract($_POST);
include('config1.php');

echo "<script>alert('file cal');</script>";

$empName = $_POST['empName'];   
$prdName = $_POST['prdName'];
$srcDate = $_POST['srcDate'];

if(isset($_POST['empName'])|| isset($_POST['prdName']) || isset($_POST['srcDate'])) 
{
    $displayName = "SELECT a.*, b.`fullname` FROM `task_info` a INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id) WHERE `fullname` = $empName";
    echo $displayName;
}


?>


<!-- 
<?php
include('config1.php');

extract($_POST);


$empName = $_POST['empName'];   
$prdName = $_POST['prdName'];
$srcDate = $_POST['srcDate'];

if(isset($_POST['empName'])|| isset($_POST['prdName']) || isset($_POST['srcDate'])) 
{   

    $displayName = "SELECT a.*, b.`fullname` FROM `task_info` a INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id) WHERE `fullname` = $empName";
    
    $result = mysqli_query($con,$displayName);
    echo $result;
    if(mysqli_num_rows($result)>0) {
        $num = 1;

        while ($row = mysqli_fetch_array($result)) {
            $data .=  '<tbody>
            <tr>
            <td>' . $num . '</td>
            <td>' . $row['t_num'] . '</td>
            <td>' . $row['t_title'] . '</td>
            <td>' . $row['t_user_id'] . '</td>
            <td>' . $row['t_start_date'] . '</td>
            <td>' . $row['t_end_date'] . '</td>
            <td>' . $row['status'] . '</td>
            </tr>';
            $num++;
        }
    }
}


?>  -->
