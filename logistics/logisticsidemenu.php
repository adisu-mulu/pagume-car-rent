<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar" style="background-colohr: #99738E;">
    <div class="app-sidebar__user">
        <div>
            <?php

$id= $_SESSION["id"];
$query= "SELECT *from employees where id='$id'";
$res = $obj->fetch($query);
$result = $res->fetch(); 

$rqc= "SELECT *from car_requests, employees, drivers,vehicles, account where car_requests.car=vehicles.plate and
car_requests.requested_by=employees.id and car_requests.requested_by=account.id 
and car_requests.req_status='Pending'";
$crs = $obj->fetch($rqc); 

   ?>
            <p class="app-sidebar__user-name"><?php echo $result['fname']." ".$result['lname'];?></p>
            <p class="app-sidebar__user-designation"><?php echo $result['role'];?></p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item active" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span
                    class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item" href="vehicles.php"><i class="app-menu__icon fa fa-users fa-1x"></i><span
                    class="app-menu__label">Vehicles</span></a></li>
        
        <li><a class="app-menu__item" href="drivers.php"><i class="app-menu__icon fa fa-users fa-1x"></i><span
                    class="app-menu__label">Drivers</span></a></li>
        <li><a class="app-menu__item" href="view_req.php"><i class="app-menu__icon fa fa-info-circle"></i><span
                    class="app-menu__label">View Requests <i style="color: red"><?php if($crs->rowCount()>0) echo $crs->rowCount();?></i></span></a></li>
        <li><a class="app-menu__item" href="return_form.php"><i class="app-menu__icon fa fa-info-circle"></i><span
                    class="app-menu__label">Return Form</span></a></li>
        <li><a class="app-menu__item" href="history.php"><i class="app-menu__icon fa fa-info-circle"></i><span
                    class="app-menu__label">History.php</span></a></li>
    </ul>
</aside>