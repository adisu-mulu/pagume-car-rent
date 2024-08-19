<?php
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
    <?php include "adminsidemenu.php" ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h3><i class="fa fa-th-list"></i> Employee Registration</h3>
                
            </div>

        </div>
        <!-- employee registration -->
        <form class="row" action="../crud.php" method="post">            
            <div class="col-sm-12 col-md-8 col-lg-8">
            <h3 id="regsx" style="display: none;"><i class="fa fa-th-list"></i> Registration successful</h3>
            <h3 id="regfl" style="display: none;"><i class="fa fa-th-list"></i> Registration not successful</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">First Name</label>
                        <input type="text" class="form-control" id="inputEmail4" pattern="[a-zA-Z]+" title="Name should contain only letters" placeholder="First Name" name="fname" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Last Name</label>
                        <input type="text" class="form-control" id="inputEmail4" pattern="[a-zA-Z]+" title="Name should contain only letters" placeholder="Last Name" name="lname" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Phone number</label>
                        <input type="number" class="form-control" id="inputEmail4" placeholder="Phone no" name="pnumber" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputState">Birth day</label>
                    <input type="date" class="form-control" id="inputAddress2" placeholder="Birthday" name="bdate" onchange="check_date.call(this)" id="bdate" required>
                </div>
                <div class="form-group">
                        <label for="inputState">Gender</label>
                        <select id="inputState" class="form-control" name="gender">
                            <option selected>Male</option>
                            <option>Female</option>
                        </select>
                </div>
                <div class="form-group">
                        <label for="inputState">Role</label>
                        <select id="inputState" class="form-control" name="role">
                            <option selected>Manager</option>
                            <option>Logistics</option>
                            <option selected>Finance</option>
                            <option>Sales</option>
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
            <button type="submit" class="btn btn-primary" name="empRegister">Register</button>&nbsp;&nbsp;&nbsp;&nbsp;
            <button id="btn1" class="btn btn-primary" onclick="window.location='vehicles.php'"><b>Cancel</b></button>
        </form>

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
    //to make the edit vehicles modal pop up with detail of the selected vehicle
if(isset($_GET["reg"])){
    if($_GET["reg"]=="y")
    echo "<script>document.getElementById('regsx').style.display='block';</script>";
    else echo "<script>document.getElementById('regfl').style.display='block';</script>";
}
?>
</body>

</html>