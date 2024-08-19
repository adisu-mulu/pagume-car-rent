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
                <h1 id="listVehicleLabel"><i class="fa fa-th-list"></i> Driver list</h1>
                <h1 id="regVehicleLabel" style="display: none;"><i class="fa fa-th-list"></i> Register Driver</h1>

            </div>
            <ul class="app-breadcrumb breadcrumb side">

                <li class="breadcrumb-item"><button id="btn1"><i class="fa fa-plus" onclick="register_form()"><b>Add
                                New</b></i></button></li>

            </ul>
        </div>
        <!-- list of drivers -->
        <div class="row" id="list">
            <div class="col-md-12">
                <h3 id="driverSuccess" style="display: none;"><i class="fa fa-th-list"></i> Driver Registered</h3>
                <h3 id="driverfail" style="display: none;"><i class="fa fa-th-list"></i> Driver Registration Failed</h3>
                <div class="tile">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone no</th>
                                    <th>License number</th>
                                    <th>Birth day</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tboody>
                                <?php 
                            $query= "SELECT *from drivers";
                                $res = $obj->fetch($query);
                                $result = $res->fetchAll();
                                    foreach($result as $val){
                                        
                                ?>
                                <tr>
                                    <td><?php echo $val['drfname']." ".$val['drlname']; ?></td>
                                    <td><?php echo $val['drpnumber']; ?> </td>
                                    <td><?php echo $val['drlicense']; ?></td>
                                    <td><?php echo $val['drbday']; ?></td>
                                    <td><?php echo $val['dremail']; ?></td>
                                    <td><a href="drivers.php?lc=<?php echo $val['drimage'];?> ">Show image</td>
                                    <td><?php echo $val['drstatus'];?></td>
                                    <th>
                                        <a class="btn btn-info waves-effect btn-sm"
                                            href="drivers.php?drid=<?php echo $val['drid']; ?>"><i
                                                class="fa fa-info"></i></a>&nbsp;&nbsp;
                                        <a class="btn btn-info waves-effect btn-sm" href="#1"><i
                                                class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                        <a class="btn btn-danger waves-effect btn-sm"
                                            href="../crud.php?drdel_id=<?php echo $val['drid'];?>"><i
                                                class="fa fa-trash"></i></a>
                                    </th>
                                </tr>
                                <?php } ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- driver registration -->
        <div id="register_form" style="display: none;">
            <form class="row" action="../crud.php" method="post" enctype="multipart/form-data">
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">First Name</label>
                            <input type="text" class="form-control" id="inputEmail4" pattern="[a-zA-Z]+" title="Name should contain only letters"
                                placeholder="First Name" name="fname" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Last Name</label>
                            <input type="text" class="form-control" id="inputEmail4" pattern="[a-zA-Z]+" title="Name should contain only letters"
                                placeholder="Last Name" name="lname" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Phone number</label>
                            <input type="number" class="form-control" id="inputEmail4" placeholder="Phone no"
                                name="pnumber" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">License</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="License"
                            name="license" required>
                    </div>
                    <div class="form-group">
                        <label for="inputState">Birth day</label>
                        <input type="date" class="form-control" id="bdate"  name="bdate" onchange="check_date.call(this)" id="bdate"  required>
                    </div>

                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group col-md-6">
                        <label style="margin-top: -30px;">Cover_photo</label>
                        <img src="" style="display: none; height: 250px; width: 300px;" id="coverPic"><br>
                        <input type="file" name="image" onchange="showImage.call(this)" id="file" required>
                    </div>
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary"
                    name="driverRegister">Register</button>&nbsp;&nbsp;&nbsp;&nbsp;

            </form>
            <button id="btn1" class="btn btn-primary" onclick="window.location='vehicles.php'"><b>Cancel</b></button>

        </div>
    </main>
    <!-- edit modal -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p>Edit driver detail</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row" action="../crud.php" method="post">
                        <?php
                            $c= $_GET["drid"];
                            $query= "SELECT *from drivers where drid='$c'";
                            $res = $obj->fetch($query);
                           $result = $res->fetch();
                        ?>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-row">
                                <input type="text" name="id" value="<?php echo $c; ?>" hidden>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">First Name</label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="First Name"
                                        pattern="[a-zA-Z]+" name="fname" value="<?php echo $result['drfname'];?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Last Name</label>
                                    <input type="text" class="form-control" id="inputEmail4" placeholder="Last Name"
                                        pattern="[a-zA-Z]+" name="lname" value="<?php echo $result['drlname'];?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email"
                                        name="email" value="<?php echo $result['dremail'];?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Phone number</label>
                                    <input type="number" class="form-control" id="inputEmail4" placeholder="Phone no"
                                        name="pnumber" value="<?php echo $result['drpnumber'];?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">License</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="Plate no."
                                    name="license" value="<?php echo $result['drlicense'];?>" readonly>
                            </div>

                            <div class="form-group">
                                <label for="inputState">Birth day</label>
                                <input type="date" class="form-control" id="inputAddress2" placeholder="Mileage"
                                    name="bdate" value="<?php echo $result['drbday'];?>">
                            </div>
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option selected><?php echo $result['drstatus'];?></option>

                                </select>
                            </div>
                        </div>

                        <!-- <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group col-md-6">
                                <label style="margin-top: -30px;">Cover_photo</label>
                                <img src="" style="display: none; height: 250px; width: 300px;" id="coverPic"><br>
                                <input type="file" name="image" onchange="showImage.call(this)" id="file">
                            </div>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                        <button type="submit" class="btn btn-primary" name="editDriver">Save
                            changes</button>&nbsp;&nbsp;&nbsp;&nbsp;

                    </form>
                    <button id="btn1" class="btn btn-primary"
                        onclick="window.location='drivers.php'"><b>Cancel</b></button>
                </div>
            </div>
        </div>
    </div>
    <!--  modal of driver's images -->
    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="modal fade" id="img" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p>Images of the car</p>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!--  images -->
                            <?php
                           echo $image=$_GET["lc"];
                          ?>
                            <div class="form-group col-md-6">

                                <img src="../images/license/ <?php echo $image; ?>" style="height: 250px; width: 300px;"
                                    id="coverPic"><br>

                            </div>
                        </div>
                    </div>
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

    function check_date(){
        var date= document.getElementById("bdate").value;
        var today= new Date().toISOString().split('T')[0]
       
        if((date==today) || (date>today)){
            alert("Birth date has to be less than today");
            document.getElementById("bdate").value=" ";
            return false;
        } 
    }
    </script>
    <?php
    //display notification of succesful or failure of registration of vehicles
if(isset($_GET["drReg"])){
    if($_GET["drReg"]=="y") 
    {
    echo "<script>document.getElementById('driverSuccess').style.display='block'; </script>"; 
    }
    else {
    echo "<script>document.getElementById('driverfail').style.display='block'; </script>";
    }
    }

    //to make the edit vehicles modal pop up with detail of the selected vehicle
if(isset($_GET["drid"])){
    echo "
    <script>$(document).ready(function(){ $('#edit').modal();});
    </script>
    ";
    }
if(isset($_GET["lc"])){
        echo "
        <script>$(document).ready(function(){ $('#img').modal();});
        </script>
        ";
    }


?>
</body>

</html>