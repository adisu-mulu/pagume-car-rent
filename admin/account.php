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
                <h1 id="listVehicleLabel"><i class="fa fa-th-list"></i> List of drivers</h1>
                <h1 id="regVehicleLabel" style="display: none;"><i class="fa fa-th-list"></i> Register A Driver</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">

                <li class="breadcrumb-item"><button id="btn1"><i class="fa fa-plus" onclick="register_form()"><b>Add
                                New</b></i></button></li>

            </ul>
        </div>
        <!-- list of accounts -->
        <div class="row" id="list">
            <div class="col-md-12">
                <div class="tile">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Password</th>

                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tboody>
                                <?php 
                            $query= "SELECT *from account, employees where account.id=employees.id";
                                $res = $obj->fetch($query);
                                $result = $res->fetchAll();
                                    foreach($result as $val){
                                        
                                ?>
                                <tr>
                                    <td><?php echo $val['fname']." ".$val['lname']; ?></td>
                                    <td><?php echo $val['username']; ?> </td>
                                    <td><?php echo $val['password']; ?></td>

                                    <td><?php echo $val['status'];?></td>
                                    <th><a class="btn btn-info waves-effect btn-sm"
                                            href="account.php?acid=<?php echo $val['id']; ?>"><i
                                                class="fa fa-info"></i></a>&nbsp;&nbsp;
                                       
                                        <a class="btn btn-danger waves-effect btn-sm"
                                            href="../crud.php?actdel=<?php echo $val['id'];?>"><i
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
      
    </main>
    <!-- edit modal -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p>Edit account</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row" action="../crud.php" method="post">
                        <?php
                            $c= $_GET["acid"];
                            $query= "SELECT *from account where id='$c'";
                            $res = $obj->fetch($query);
                           $result = $res->fetch();
                        ?>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="text" name="id" hidden value=<?php echo $c; ?>>
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option selected><?php echo $result['status'];?></option>
                                    <option value="Pending">Pending</option>
                                    <option value="Activated">Activate</option>
                                    <option value="Deactivated">Deactivate</option>

                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" name="editAct">Save
                            changes</button>&nbsp;&nbsp;&nbsp;&nbsp;

                    </form>
                    <button id="btn1" class="btn btn-primary"
                        onclick="window.location='account.php'"><b>Cancel</b></button>
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
    </script>


    <?php
//to make the edit vehicles modal pop up with detail of the selected vehicle
if(isset($_GET["acid"])){
    echo "
    <script>$(document).ready(function(){ $('#edit').modal();});
    </script>
    ";
}
?>
</body>

</html>