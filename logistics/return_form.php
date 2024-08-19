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
                <h1 id="listVehicleLabel"><i class="fa fa-th-list"></i> Rented Vehicles list</h1>
               
            </div>
       
        </div>
        <!-- car list -->
        <div class="row" id="list">
            <div class="col-md-12">
                <h3 id="regVehicleSuccess" style="display: none;"><i class="fa fa-th-list"></i> Vehicle registered
                    successfully</h3>
                <h3 id="regVehiclefail" style="display: none;"><i class="fa fa-th-list"></i> could not register vehicle
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
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query= "SELECT *from vehicles where status='Rented'";
                                $res = $obj->fetch($query);
                                $result = $res->fetchAll();
                                    foreach($result as $val){
                                        
                                ?>
                                <tr>
                                    <td><?php echo $val['owner']; ?></td>
                                    <td><?php echo $val['vtype']; ?></td>
                                    <td><?php echo $val['ftype']; ?></td>
                                    <td><?php echo $val['plate']; ?></td>
                                    <td><?php echo $val['mileage']; ?></td>
                                    <td><img class="app-sidebar__user-avatar"
                                            src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg"
                                            alt="User Image"></td>
                                    <td><?php echo $val['status']; ?></td>
                                    <th><a class="btn btn-info waves-effect btn-sm"
                                            href="return_form.php?id=<?php echo $val['plate']; ?>"><i
                                                class="fa fa-info"></i></a>&nbsp;&nbsp;
                                       

                                    </th>
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
    <!-- edit modal -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p>Edit car detail</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- edit car -->

                    <form class="row" action="../crud.php" method="post">

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <?php
                            $c= $_GET["id"];
                            $query= "SELECT *from vehicles where plate='$c'";
                            $res = $obj->fetch($query);
                           $result = $res->fetch();
                        ?>
                     
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option selected><?php echo $result['status']; ?></option>
                                    <option>Available</option>
                                    <option>Rented</option>
                                </select>
                            </div>
                                <input type="text" name="plateNo" hidden value="<?php echo $c;?>">
                            <div class="form-row">
                                <div class="form-group">
                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn btn-primary" name="returnForm">Save
                                            changes</button>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <button type="button" class="btn btn-primary"
                                        onclick="window.location='vehicles.php'" ;>cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
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

    if(isset($_GET["rt"])){
        if($_GET["rt"]=="y")
        echo "<script>alert('Vehicle returned successfully');</script>";
        else echo "<script>alert('vehicle return failed');</script>";
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