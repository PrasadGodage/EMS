<?php
include('config1.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>






    <div class="col-12">
        <h4 class="text-center">Live Search Bar</h4>
        <label for="">Dynamic</label>
        <input class="form_control" placeholder="Employee Name" id="live_search" type="text">
        <br>
    </div>
    
    <hr>
    <div>
        <label for="">Enter Employee Name</label>
        <input class="form_control" placeholder="Employee Name" id="empName" type="text">
        <label for="">Enter Product Name</label>
        <input class="form_control" placeholder="Product Name" id="prdName" type="text">
        <input type="date" id="srcDate">
        <button class="btn-success" onclick="">Search</button>
    </div>
    <hr>


    <div id="searchRTable"></div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#live_search").keyup(function() {
                let input = $(this).val();
                console.log(input)
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


            });
        });
    </script>

<script type="text/javascript">
    
</script>
</body>






</html>
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
      url: "searchBackend1.php",
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

    