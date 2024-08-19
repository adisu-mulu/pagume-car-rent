<?php
session_start();
error_reporting(0);
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
    <link rel="stylesheet" type="text/css" href="../imageSlider.css">
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

        </div>

        <!-- vehicles detail -->
        <?php
                            $c= $_GET["cdetails"];
                            $query= "SELECT *from vehicles, vehicle_owners where vehicles.plate=vehicle_owners.O_car_plate and vehicles.plate='$c'";
                            $res = $obj->fetch($query);
                           $result = $res->fetch();
                           
                        ?>
        <div class="card" style="height: 100%" ;>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                <!-- owner information -->
                        <hr>
                        <h5 style="display: none;" id="oud">Updated successfully</h5>
                        <h5 style="display: none;" id="oudn">Could not update owner information</h5>
                            <h5 style="text-align: center">Owner's basic information</h5>
                        <form action="../crud.php?cd=<?php echo $c;?>" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">First name</label><br>
                                    <input type="text" name="fname" value="<?php echo $result['O_fname']; ?>">
                                   
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Last name</label><br>
                                    <input type="text" name="lname" value="<?php echo $result['O_lname']; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Passport/ID number</label><br>
                                    <input type="text" name="oid" value="<?php echo $result['O_id']; ?>">                                  
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Phone number</label><br>
                                    <input type="text" name="pnumber" value="<?php echo $result['O_phone']; ?>">
                                </div>
                            </div>
                            <button type="submit" class="btn-primary" name="editOwner" >Save Changes</button>
                            </form>
                            <hr>
                    </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <!-- cars  info -->
                            <hr>
                            <h5 style="display: none;" id="vup">Vehicle Updated successfully</h5>
                            <h5 style="display: none;" id="vupn">Could not update vehicle</h5>
                            <h5 style="text-align: center">Vehicle information</h5>
                            <form action="../crud.php?cd=<?php echo $c;?>" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Vehicle Type</label><br>
                                    
                                    <select id="inputState" class="form-control" name="vtype">
                                        <option selected><?php echo $result['vtype'];?></option>
                                        <option>v8</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Fuel Type</label><br>
                                    
                                    <select id="inputState" class="form-control" name="ftype">
                                        <option selected><?php echo $result['ftype'];?></option>
                                        <option>benzene</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Mileage</label><br>
                                    <input type="text" name="mileage" value="<?php echo $result['mileage']; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Price per day</label><br>
                                    <input type="text" name="ppd" value="<?php echo $result['price_per_day']; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Model Year</label><br>
                                    <input type="text" name="myear" value="<?php echo $result['model_year']; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Seat Capacity</label><br>
                                    <input type="text" name="seatCap" value="<?php echo $result['seat_capacity']; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                <label style="margin-top: -30px;">Front view</label>
                                <input type="file" name="front" onchange="showImage.call(this)" id="file" >
                            </div>
                            <div class="form-group col-md-4">
                                <label style="margin-top: -30px;">Left view</label>
                                <input type="file" name="left" onchange="showImage.call(this)" id="file" >
                            </div>
                            <div class="form-group col-md-4">
                                <label style="margin-top: -30px;">Rear view</label>
                                <input type="file" name="rear" onchange="showImage.call(this)" id="file" >
                            </div>
                            <div class="form-group col-md-4">
                                <label style="margin-top: -30px;">Back view</label>

                                <input type="file" name="back" onchange="showImage.call(this)" id="file" >
                            </div>
                            <div class="form-group col-md-4">
                                <label style="margin-top: -30px;">Right view</label>
                                <input type="file" name="right" onchange="showImage.call(this)" id="file" >
                            </div>
                            <img src="" class="img-fluid" style="display: none; height: 250px; width: 300px;"
                            id="coverPic"><br>
                            </div>
                            <button type="submit" class="btn-primary" name="vedit">Save changes</button>
                            <hr>
                            </form>
                    </div>
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
    //display notification of succesful or failure of owner update
if(isset($_GET["oud"])){
    if($_GET["oud"]=="y") 
    {
    echo "<script>document.getElementById('oud').style.display='block'; </script>"; 
    }
    else {
    echo "<script>document.getElementById('oudn').style.display='block'; </script>";
    }
    }

//to make the edit vehicles modal pop up with detail of the selected vehicle
if(isset($_GET['vup'])){
    if($_GET['vup']=="y"){
        echo "<script>document.getElementById('vup').style.display='block'; </script>"; 
    }
    else {
        echo "<script>document.getElementById('vupn').style.display='block'; </script>";
        }
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