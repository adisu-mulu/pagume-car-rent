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
                <h1 id="listVehicleLabel"><i class="fa fa-th-list"></i> Vehicles list</h1>
                <h1 id="regVehicleLabel" style="display: none;"><i class="fa fa-th-list"></i> Register Vehicle</h1>

            </div>
            <ul class="app-breadcrumb breadcrumb side">

                <li class="breadcrumb-item"><button id="btn1"><i class="fa fa-plus" onclick="register_form()"><b>Add
                                New</b></i></button></li>

            </ul>
        </div>
        <!-- car list -->       
        <div class="row" id="list">
          <?php
                                $query= "SELECT *from vehicles";
                                $res = $obj->fetch($query);
                                $result = $res->fetchAll();
                                    foreach($result as $val){
                                      $c=$val['plate'];  
                                ?>
            <div class="col-sm-12  col-md-6 col-lg-4">
                <div class="card">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                        <a href="moreImages" class="ripple">
                            <img src="../images/cars/ <?php echo $c; ?>/ front.jpg" class="img-fluid" />

                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Car Info</h5>
                        <table style="width: 100%;">
                        <thead >
                            <tr>
                                    <th>Owner</th>
                                    <th>Model</th>                                                                      
                                    <th>Price/day</th>
                                    <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                                    <td><i><?php echo $val['owner'];?></i></td>
                                    <td><i><?php echo $val['model_year']; ?></i></td>
                                    <td><i><?php echo $val['price_per_day'];?></i></td>
                                    <td><i><?php echo $val['status']; ?></i></td>
                        </tr>
                        <tr>
                                    <td><i><a href=""><i>Post</i></a></td>
                                    <td><i></i></td>
                                    <td><i></i></td>
                                    <td><a href="edit_vehicles.php?cdetails=<?php echo $val['plate'];?>"><i>Edit</i></a>
                                    <a href="vehicles_more.php?cdetails=<?php echo $val['plate'];?>"><i>Detail</i></a></td>
                                    <a href="../crud.php?cdetails?<?php echo $val['plate'];?>"><i>Delete</i></a></td>
                        </tr>
                        </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <!-- car registration -->
        <div id="register_form" style="display: none;">
            <div class="card">
                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <a href="moreImages" class="ripple">

                        <img src="" class="img-fluid" style="display: none; height: 250px; width: 300px;"
                            id="coverPic"><br>
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                </div>
                <div class="card-body">

                    <form class="row" action="../crud.php" method="post" enctype="multipart/form-data">
                        <div class="col-sm-12 col-md-8 col-lg-8">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Owner Name</label>

                                    <select id="owner" class="form-control" name="owner"
                                        onchange="showPrivateForm(this)" ;>
                                        <option value="company" selected>Company</option>
                                        <option value="private">Private</option>
                                    </select>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">vehicle Type</label>
                                    <select id="inputState" class="form-control" name="vtype">
                                        <option selected>Toyota</option>
                                        <option>v8</option>
                                    </select>
                                </div>
                            </div>
                            <!-- registering owner of the car -->
                            <div id="privateOwner" style="display: none" ;>
                                <hr>
                                <strong style="text-align: center">Owner's basic information</strong>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">First name</label>
                                        <input type="text" class="form-control" id="inputEmail4" name="fname"
                                            placeholder="First name" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Last name</label>
                                        <input type="text" class="form-control" id="inputEmail4" name="lname"
                                            placeholder="Last name" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Passport/ID number</label>
                                        <input type="text" class="form-control" id="inputEmail4" name="idNo"
                                            placeholder="Passport/kebele id" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Phone number</label>
                                        <input type="number" class="form-control" id="inputEmail4" name="pnumber"
                                            placeholder="Phone no" >
                                    </div>
                                </div>
                                <hr>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Plate</label>
                                    <input type="text" class="form-control" id="inputEmail4" name="plate"
                                        placeholder="plate" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Price per day</label>
                                    <input type="number" class="form-control" id="inputEmail4" name="ppd"
                                        placeholder="p/d" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Mileage</label>
                                    <input type="number" class="form-control" id="inputEmail4" name="mileage"
                                        placeholder="mileage" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Model year</label>
                                    <input type="number" class="form-control" id="inputEmail4" name="model_year"
                                        placeholder="model_year" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputState">Fuel type</label>
                                    <select id="inputState" class="form-control" name="ftype">
                                        <option selected>fuel 0</option>
                                        <option>fuel1</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Seat capacity</label>
                                    <input type="number" class="form-control" id="inputEmail4" name="seat_capacity"
                                        placeholder="seat_capacity" required>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="inputPassword4">Image of car</label>
                            <div class="form-group col-md-6">
                                <label style="margin-top: -30px;">Front view</label>
                                <input type="file" name="front" onchange="showImage.call(this)" id="file" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label style="margin-top: -30px;">Left view</label>
                                <input type="file" name="left" onchange="showImage.call(this)" id="file" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label style="margin-top: -30px;">Rear view</label>
                                <input type="file" name="rear" onchange="showImage.call(this)" id="file" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label style="margin-top: -30px;">Back view</label>

                                <input type="file" name="back" onchange="showImage.call(this)" id="file" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label style="margin-top: -30px;">Right view</label>
                                <input type="file" name="right" onchange="showImage.call(this)" id="file" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"
                            name="vehicleRegistration">Register</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" id="btn1" class="btn btn-primary"
                        onclick="window.location='vehicles.php'"><b>Cancel</b></button>            
                    </form>
                    
                </div>
            </div>
        </div>
    </main>
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

    function showPrivateForm(element) {
        var value = element.value;
        if (value == 'private') {
            document.getElementById("privateOwner").style.display = 'block';
        }
        if (value == 'company') {
            document.getElementById("privateOwner").style.display = 'none';
        }
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
if(isset($_GET["vreg"])){
    if($_GET["vreg"]=="y") 
    {
    echo "<script>alert('vehicle registered successfully'); </script>"; 
    header("Location: vehicles.php");
    }
    else {
       
        echo "<script>alert('vehicle registered successfully'); </script>";
        header("Location: vehicles.php");
    }
    }

    //to make the edit vehicles modal pop up with detail of the selected vehicle
if(isset($_GET["id"])){
    echo "
    <script>$(document).ready(function(){ $('#edit').modal();});
    </script>
    ";
    }

//to make the vehicles modal image pop up with detail of the selected vehicle
if(isset($_GET["img"])){
    echo "
    <script>$(document).ready(function(){ $('#img').modal();});
    </script>
    ";
}
?>
</body>

</html>