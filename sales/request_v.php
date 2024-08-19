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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="../font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">
    <?php include "../includes/header.php" ?>
    <?php include "salesidemenu.php" ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1 id="listVehicleLabel"><i class="fa fa-th-list"></i> Vehicles list</h1>
                <h1 id="regVehicleLabel" style="display: none;"><i class="fa fa-th-list"></i> Register Vehicle</h1>

            </div>
      
        </div>
        <!-- car list -->
        <div class="row" id="list">
            <div class="col-md-12">
                <h3 id="reqSc" style="display: none;"><i class="fa fa-th-list"></i> Request sent successfuly
                    </h3>
                <h3 id="reqFl" style="display: none;"><i class="fa fa-th-list"></i> Request not sent
                </h3>
                <div class="tile">
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Owner Name</th>
                                    <th>Vehicle Type</th>
                                    <th>Fuel Type</th>
                                    <th>Plate Number</th>
                                    <th>MileAge</th> 
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query= "SELECT *from vehicles";
                                $res = $obj->fetch($query);
                                $result = $res->fetchAll();
                                    foreach($result as $val){
                                        $car=$val['plate'];
                                ?>
                                <tr>
                                    <td><?php echo $val['owner']; ?></td>
                                    <td><?php echo $val['vtype']; ?></td>
                                    <td><?php echo $val['ftype']; ?></td>
                                    <td><?php echo $val['plate']; ?></td>
                                    <td><?php echo $val['mileage']; ?></td>  
                                    <?php
                                        $cst= "SELECT *FROM car_requests WHERE car='$car'";
                                        $res = $obj->fetch($cst);
                                        $result=$res->fetch();
                                        if($res->rowCount()>0){
                                        
                                            ?>
                                             <td>Requested</td>  
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <td><a href="req_form.php?pl=<?php echo $val['plate'];?>"><i>Request</i></a></td>   
                                            <?php 
                                        }
                                    ?>
                                    
                                </tr>
                               <?php }?>

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
    //display notification of succesful or failure of registration of vehicles
if(isset($_GET["srq"])){
    if($_GET["srq"]=="y") 
    {
    echo "<script>document.getElementById('reqSc').style.display='block'; </script>"; 
    }
    else {
    echo "<script>document.getElementById('reqFl').style.display='block'; </script>";
    }
}
//to make the edit vehicles modal pop up with detail of the selected vehicle
if(isset($_GET["id"])){
    echo "
    <script>$(document).ready(function(){ $('#edit').modal();});
    </script>
    ";
}
?>
</body>

</html>