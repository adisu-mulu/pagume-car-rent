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
    <?php include "salesidemenu.php" ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h4><i class="fa fa-th-list"></i> Car request form</h4>

            </div>

        </div>

        <!-- edit car -->
        <form class="row" action="../crud.php" method="post">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <?php
                       $c= $_GET["pl"];
                       $query= "SELECT *from vehicles where plate='$c'";
                       $res = $obj->fetch($query);
                      $result = $res->fetch();
                   ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Owner Name</label>
                        <input type="text" class="form-control" id="inputEmail4" name="owner" readonly
                            value="<?php echo $result['owner']; ?>" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">vehicle Type</label>
                        <select id="inputState" class="form-control" name="vtype" readonly> 
                            <option selected><?php echo $result['vtype']; ?></option>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputAddress">Plate Number</label>
                    <input type="text" class="form-control" id="inputAddress" name="plateNo" readonly
                        value="<?php echo $result['plate']; ?>">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Mileage</label>
                    <input type="text" class="form-control" id="inputAddress2" name="mileage" readonly
                        value="<?php echo $result['mileage']; ?>">
                </div>
                <div class="form-group">
                    <label for="inputState">Fuel type</label>
                    <input type="text" class="form-control" id="inputAddress2" name="mileage" readonly
                        value="<?php echo $result['ftype']; ?>">
                </div>
                <div class="form-group">
                    <label for="inputState">Available Drivers</label>
                    <select id="inputState" class="form-control" name="driver">
                    <option></option>
                        <?php
                                $query= "SELECT *from drivers where drstatus='Available'";
                                $res = $obj->fetch($query);
                                $result = $res->fetchAll();
                                    foreach($result as $driver){                                      
                                ?>
                        <option value="<?php echo $driver['drid']; ?>">
                            <?php echo $driver['drfname']." ".$driver['drlname'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputState">Start date</label>
                    <input type="date" class="form-control" id="inputAddress2" name="sdate">
                </div>
                <div class="form-group">
                    <label for="inputState">End date</label>
                    <input type="date" class="form-control" id="inputAddress2" name="edate">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary" name="car_req_by_sales">Save changes</button>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <button type="button" class="btn btn-primary" onclick="window.location='request_v.php'"
                            ;>cancel</button>
                    </div>
                </div>
            </div>
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