<?php
session_start();
if(!isset($_SESSION['id'])){
    header("Location: ../login.php");
}
include "../database.php";
$obj= new database();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Pagume Logistic System</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="../font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">
    <?php include "../includes/header.php" ?>
    <?php include "logisticsidemenu.php" ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1 id="listVehicleLabel"><i class="fa fa-th-list"></i>View History</h1>
                <h1 id="regVehicleLabel" style="display: none;"><i class="fa fa-th-list"></i> Register A Driver</h1>
            </div>
        </div>
          <!-- request list -->
          <div class="row" id="list">
            <div class="col-md-12">
                
                <div class="tile">
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Requested By</th>
                                    <th>Requested on</th>                                  
                                    <th>Plate Number</th>
                                    
                                    <th>Driver</th>   
                                    <th>Approved by Logistics On</th>                               
                                    <th>Approved by Finance On</th>
                                    <th>Approved by Manager On</th>
                                    <th>Returned Date </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query= "SELECT *from car_log, employees,account, drivers where car_log.requested_by=employees.id and car_log.requested_by=account.id
                                and car_log.driver=drivers.drid";
                                $res = $obj->fetch($query);
                                $result = $res->fetchAll();
                                    foreach($result as $val){
                                        
                                ?>
                                <tr>
                                    <td><?php echo $val['fname']." ".$val['lname']." (".$val['username'].")"; ?></td>
                                    
                                   
                                    <td><?php echo $val['rdate']; ?></td>
                                    <td><?php echo $val['car']; ?></td>
                                    <td><?php echo $val['drfname']." ".$val['drlname']; ?></td>
                                    <td><i><?php echo $val['l_approve']; ?></i></td>
                                    <td><i><?php echo $val['f_approve']; ?></i></td>
                                    <td><i><?php echo $val['m_approve']; ?></i></td>
                                    <td><i><?php echo $val['returned_date']; ?></i></td>  
                                </tr>
                                <?php

                                    }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="../js/plugins/pace.min.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
    <!-- Google analytics script-->
    <script type="text/javascript">
    $('#sampleTable').DataTable();
    $('#sampleTable1').DataTable();                               
    function register_form() {
        document.getElementById("listVehicleLabel").style.display = 'none';
        document.getElementById("regVehicleLabel").style.display = 'block';
        document.getElementById("list").style.display = 'none';
        document.getElementById("register_form").style.display = 'block';
    }

    function showImage() {
        var fileinput = document.getElementById("file");
        var filepath = fileinput.value;
        var allowedext = /(\.jpeg|\.jpg|\.png)$/i;

        if (!allowedext.exec(filepath)) {
            alert("please choose an image");
            fileinput.value = '';
            return false;
        } else {
            if (this.files && this.files[0]) {
                var obj = new FileReader();
                obj.onload = function(data) {
                    var image = document.getElementById("coverPic");
                    image.src = data.target.result;
                    image.style.display = "block";
                }
                obj.readAsDataURL(this.files[0]);
            }
        }
    }
    </script>


    <?php
//to make the edit vehicles modal pop up with detail of the selected vehicle
if(isset($_GET["drid"])){
    echo "
    <script>$(document).ready(function(){ $('#edit').modal();});
    </script>
    ";
}
?>
</body>

</html>