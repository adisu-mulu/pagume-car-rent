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

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="../font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">
    <?php include "../includes/header.php" ?>
    <?php include "managersidemenu.php" ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
                <p>Pagume Logistics System</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ul>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                        <div class="info">
                            <h4><small><b>Total Customer</b></small></h4>
                            <p><b>5</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                        <div class="info">
                            <h4><small><b>Available vehicles</b></small></h4>
                            <p><b><?php 
                                $query= "SELECT *FROM vehicles WHERE status='Available'";
                                $res = $obj->fetch($query);
                                echo $res->rowCount();
                                
                            ?></b></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                        <div class="info">
                            <h4><small><b>Rented vehicles</b></small></h4>
                            <p><b>
                            <?php 
                                $query= "SELECT *FROM vehicles WHERE status='Rented'";
                                $res = $obj->fetch($query);
                                echo $res->rowCount();
                                
                            ?>
                            </b></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                        <div class="info">
                            <h4><small><b>Available drivers</b></small></h4>
                            <p><b>5</b></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="tile">
                        <h3 class="tile-title">Monthly Sales</h3>
                        <div class="embed-responsive embed-responsive-16by9">
                            <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="tile">
                        <h3 class="tile-title">Support Requests</h3>
                        <div class="embed-responsive embed-responsive-16by9">
                            <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
                        </div>
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
    <!-- <script src="js/plugins/pace.min.js"></script> -->
</body>

</html>