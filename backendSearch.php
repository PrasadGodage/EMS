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



extract($_POST);

$empName = $_POST['empName'];   
$prdName = $_POST['prdName'];
$srcDate = $_POST['srcDate'];


// for 3 items
if(isset($empName) || isset($prdName) || isset($srcDate) ){

    $output="";

    $displayName = "SELECT a.*, b.`fullname` FROM `task_info` a INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id) WHERE `fullname` = '$empName' AND `select_product` = '$prdName' AND `t_start_time` = '$srcDate'";

    echo $displayName;

    $result = mysqli_query($con, $displayName);
    if($result) {
        echo true;
    }

    if (mysqli_num_rows($result) > 0) {
		$num = 1;
		while ($row = mysqli_fetch_assoc($result)) {
			$output .= "
            <tr>
            <th scope='row'>".$num."</th>
              <td>".$row['t_num']."</td>
              <td>".$row['t_title']."</td>
              <td>".$row['fullname']."</td>
              <td>".$row['t_start_time']."</td>
              <td>".$row['t_end_time']."</td>
              <td>".$row['status']."</td>
            </tr>					   
			";
			$num++;
		}
	} 
	echo $output;
}

// for 2 items 
if(isset($empName) && isset($prdName)){

    $output="";

    $displayName = "SELECT a.*, b.`fullname` FROM `task_info` a INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id) WHERE `fullname` = '$empName' AND `select_product` = '$prdName'";

    echo $displayName;

    $result = mysqli_query($con, $displayName);
    if($result) {
        echo true;
    }

    if (mysqli_num_rows($result) > 0) {
		$num = 1;
		while ($row = mysqli_fetch_assoc($result)) {
			$output .= "
            <tr>
            <th scope='row'>".$num."</th>
              <td>".$row['t_num']."</td>
              <td>".$row['t_title']."</td>
              <td>".$row['fullname']."</td>
              <td>".$row['t_start_time']."</td>
              <td>".$row['t_end_time']."</td>
              <td>".$row['status']."</td>
            </tr>					   
			";
			$num++;
		}
	}
	echo $output;
}


if(isset($empName) || isset($srcDate)){

    $output="";

    $displayName = "SELECT a.*, b.`fullname` FROM `task_info` a INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id) WHERE `fullname` = '$empName' AND `t_start_time` = '$srcDate'";

    echo $displayName;

    $result = mysqli_query($con, $displayName);
    if($result) {
        echo true;
    }

    if (mysqli_num_rows($result) > 0) {
		$num = 1;
		while ($row = mysqli_fetch_assoc($result)) {
			$output .= "
            <tr>
            <th scope='row'>".$num."</th>
              <td>".$row['t_num']."</td>
              <td>".$row['t_title']."</td>
              <td>".$row['fullname']."</td>
              <td>".$row['t_start_time']."</td>
              <td>".$row['t_end_time']."</td>
              <td>".$row['status']."</td>
            </tr>					   
			";
			$num++;
		}
	}
	echo $output;
}



if(isset($prdName) || isset($srcDate)){

    $output="";

    $displayName = "SELECT a.*, b.`fullname` FROM `task_info` a INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id) WHERE `select_product` = '$prdName' AND `t_start_time` = '$srcDate'";

    echo $displayName;

    $result = mysqli_query($con, $displayName);
    if($result) {
        echo true;
    }

    if (mysqli_num_rows($result) > 0) {
		$num = 1;
		while ($row = mysqli_fetch_assoc($result)) {
     
			$output .= "
            <tr>
            <th scope='row'>".$num."</th>
              <td>".$row['t_num']."</td>
              <td>".$row['t_title']."</td>
              <td>".$row['fullname']."</td>
              <td>".$row['t_start_time']."</td>
              <td>".$row['t_end_time']."</td>
              <td>".$row['status']."</td>
            </tr>					   
			";
			$num++;
		}
	} 
	echo $output;
}

// For single item search
// if(isset($prdName)){

//     $output="";

//     $displayName = "SELECT a.*, b.`fullname` FROM `task_info` a INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id) WHERE `select_product` = '$prdName'";

//     echo $displayName;

//     $result = mysqli_query($con, $displayName);
//     if($result) {
//         echo true;
//     }

//     if (mysqli_num_rows($result) > 0) {
// 		$num = 1;
// 		while ($row = mysqli_fetch_assoc($result)) {
// 			$output .= "
//             <tr>
//             <th scope='row'>".$num."</th>
//               <td>".$row['t_num']."</td>
//               <td>".$row['t_title']."</td>
//               <td>".$row['fullname']."</td>
//               <td>".$row['t_start_time']."</td>
//               <td>".$row['t_end_time']."</td>
//               <td>".$row['status']."</td>
//             </tr>					   
// 			";
// 			$num++;
// 		}
// 	}
// 	echo $output;
// }

// if(isset($empName)){

//     $output="";

//     $displayName = "SELECT a.*, b.`fullname` FROM `task_info` a INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id) WHERE `fullname` = '$empName'";

//     echo $displayName;

//     $result = mysqli_query($con, $displayName);
//     if($result) {
//         echo true;
//     }

//     if (mysqli_num_rows($result) > 0) {
// 		$num = 1;
// 		while ($row = mysqli_fetch_assoc($result)) {
// 			$output .= "
//             <tr>
//             <th scope='row'>".$num."</th>
//               <td>".$row['t_num']."</td>
//               <td>".$row['t_title']."</td>
//               <td>".$row['fullname']."</td>
//               <td>".$row['t_start_time']."</td>
//               <td>".$row['t_end_time']."</td>
//               <td>".$row['status']."</td>
//             </tr>					   
// 			";
// 			$num++;
// 		}
// 	} 
// 	echo $output;
// }

// if(isset($srcDate)){

//     $output="";

//     $displayName = "SELECT a.*, b.`fullname` FROM `task_info` a INNER JOIN tbl_admin b ON(a.t_user_id = b.user_id) WHERE `t_start_time` = '$srcDate'";

//     echo $displayName;

//     $result = mysqli_query($con, $displayName);
//     if($result) {
//         echo true;
//     }

//     if (mysqli_num_rows($result) > 0) {
// 		$num = 1;
// 		while ($row = mysqli_fetch_assoc($result)) {
// 			$output .= "
//             <tr>
//             <th scope='row'>".$num."</th>
//               <td>".$row['t_num']."</td>
//               <td>".$row['t_title']."</td>
//               <td>".$row['fullname']."</td>
//               <td>".$row['t_start_time']."</td>
//               <td>".$row['t_end_time']."</td>
//               <td>".$row['status']."</td>
//             </tr>					   
// 			";
// 			$num++;
// 		}
// 	}
// 	echo $output;
// }
else {
  echo "Select atleast two field";
}
?>

