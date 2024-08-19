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

                        <!-- image slide show-->
                        <div class="slideshow-container">
                            <div class="mySlides fade">
                                <img src="../images/cars/ <?php echo $c; ?>/ front.jpg" style="width:100%">
                            </div>
                            <div class="mySlides fade">
                                <img src="../images/cars/ <?php echo $c; ?>/ back.jpg" style="width:100%">
                            </div>
                            <div class="mySlides fade">
                                <img src="../images/cars/ <?php echo $c; ?>/ left.jpg" style="width:100%">
                            </div>
                            <a class="prev" onclick="plusSlides(-1)">❮</a>
                            <a class="next" onclick="plusSlides(1)">❯</a>

                        </div>
                        <br>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div>
                            <!-- owners basic info -->
                            <hr>
                            <h5 style="text-align: center">Owner's basic information</h5>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">First name</label><br>
                                    <i><?php echo $result['O_fname']; ?></i>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Last name</label><br>
                                    <i><?php echo $result['O_lname']; ?></i>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Passport/ID number</label><br>
                                    <i><?php echo $result['O_id']; ?></i>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Phone number</label><br>
                                    <i><?php echo $result['O_phone']; ?></i>
                                </div>
                            </div>
                            <hr>
                            <!-- cars  info -->

                            <h5 style="text-align: center">Vehicle information</h5>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Vehicle Type</label><br>
                                    <i><?php echo $result['vtype']; ?></i>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Fuel Type</label><br>
                                    <i><?php echo $result['ftype']; ?></i>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Mileage</label><br>
                                    <i><?php echo $result['mileage']; ?></i>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Price per day</label><br>
                                    <i><?php echo $result['price_per_day']; ?></i>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Model Year</label><br>
                                    <i><?php echo $result['model_year']; ?></i>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Seat Capacity</label><br>
                                    <i><?php echo $result['seat_capacity']; ?></i>
                                </div>
                            </div>
                            <hr>
                        </div>
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

    //script for slide images begins
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
    //script for slide images ends
    </script>

    <?php
    //display notification of succesful or failure of registration of vehicles
if(isset($_GET["reg"])){
    if($_GET["reg"]=="y") 
    {
    echo "<script>document.getElementById('regVehicleSuccess').style.display='block'; </script>"; 
    }
    else {
    echo "<script>document.getElementById('regVehiclefail').style.display='block'; </script>";
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