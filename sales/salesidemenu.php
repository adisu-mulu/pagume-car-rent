
<!-- Sidebar menu-->
<div  class="app-sidebar__overlay" data-toggle="sidebar"></div>

    <aside class="app-sidebar" style="background-colohr: #99738E;">
      <div class="app-sidebar__user">
        <div>
        <?php
  
   $id= $_SESSION["id"];
   $query= "SELECT *from employees where id='$id'";
   $res = $obj->fetch($query);
   $result = $res->fetch();                                               
      ?> 
        <p class="app-sidebar__user-name"><?php echo $result['fname']." ".$result['lname'];?></p>
          <p class="app-sidebar__user-designation"><?php echo $result['role'];?></p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        
       <!-- <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-car"></i><span class="app-menu__label">
        Vehicle </span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="register_Vehicle.php"><i class="icon fa fa-plus"></i> Register Vehicle</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-edit"></i>Post Vehicle</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-info-circle"></i>Vehicle Status</a></li>
          </ul>
        </li> -->
        <li><a class="app-menu__item" href="request_v.php"><i class="app-menu__icon fa fa-users fa-1x"></i><span class="app-menu__label">Request Vehicle</span></a></li>
        <li><a class="app-menu__item" href="view_requests.php"><i class="app-menu__icon fa fa-info-circle"></i><span class="app-menu__label">View Requests</span></a></li>
      </ul>
    </aside>
