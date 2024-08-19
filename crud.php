<?php
session_start();
include 'database.php';
$obj =new database();

//login
if(isset($_POST['login'])){
    $username= $_POST["username"];
    $password= $_POST["password"];
    $query= "SELECT *from account, employees where username='$username' and password='$password' and status='Activated' and account.id=employees.id";
    $res = $obj->fetch($query);
   if($result = $res->fetch()){
   $_SESSION["id"]= $result["id"];
   if($result["role"]=="Manager")
   header("Location: manager/index.php");
   if ($result["role"]=="Logistics")
   header("Location: logistics/index.php");
   if ($result["role"]=="Sales")
   header("Location: sales/index.php");
   if ($result["role"]=="Finance")
   header("Location: finance/index.php");
   if ($result["role"]=="Admin")
   header("Location: admin/index.php");
   }
   else{
    $query= "SELECT *from account, employees where username='$username' and password='$password' and status='Deactivated' and account.id=employees.id";
    $res = $obj->fetch($query);
    if($result = $res->fetch()){
        header("Location: login.php?act=da");
    }
    else header("Location: login.php?act=dn");
   }
}

//logout
if(isset($_GET["lg"])){
    session_destroy();
    header("Location: login.php");
}

//registering a vehicle
if(isset($_POST["vehicleRegistration"])){  
    $vtype= $_POST['vtype'];   
    $pnumber= $_POST['pnumber'];
    $plateNo= $_POST['plate'];
    $mileage= $_POST['mileage'];
    $ftype= $_POST['ftype'];
    $ppd= $_POST['ppd'];
    $my=$_POST['model_year'];
    $seat= $_POST['seat_capacity'];
    $front=$_FILES['front']['tmp_name'];
    $back=$_FILES['back']['tmp_name'];
    $rear=$_FILES['rear']['tmp_name'];
    $left=$_FILES['left']['tmp_name'];
    $right=$_FILES['right']['tmp_name']; 
     $owner= $_POST['owner'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $phone= $_POST['pnumber'];
    $Oid= $_POST['idNo'];
    mkdir("images\cars\ $plateNo",0777,true);  
    $vdir="images\cars\ $plateNo\ ";
    move_uploaded_file($front, $vdir."front.jpg");
    move_uploaded_file($back, $vdir."back.jpg");
    move_uploaded_file($rear, $vdir."rear.jpg");
    move_uploaded_file($left, $vdir."left.jpg");
    move_uploaded_file($right, $vdir."right.jpg");
    if($owner=="company"){
      $query="INSERT INTO `vehicles`(`plate`, `vtype`,`ftype`, `mileage`,`price_per_day`,`model_year`,`seat_capacity`, `owner`, `status`)
     VALUES ('$plateNo','$vtype','$ftype','$mileage','$ppd','$my','$seat','$owner','Not set')";   
     $query2= "INSERT INTO `vehicle_owners`(`O_id`,`O_fname`,`O_lname`,`O_phone`,`O_car_plate`) VALUES ('$owner','','','','$plateNo')";
    }else{
        $query="INSERT INTO `vehicles`(`plate`, `vtype`,`ftype`, `mileage`,`price_per_day`,`model_year`,`seat_capacity`, `owner`, `status`)
        VALUES ('$plateNo','$vtype','$ftype','$mileage','$ppd','$my','$seat','$Oid','Not set')";
        $query2= "INSERT INTO `vehicle_owners`(`O_id`,`O_fname`,`O_lname`,`O_phone`,`O_car_plate`) VALUES ('$Oid','$fname','$lname','$phone','$plateNo')";
    }  
    $res = $obj->insert($query);
    if($res == 1){
        $res2 = $obj->insert($query2);
        if($res2==1){            
           header("Location: logistics/vehiclestrial.php?vreg=y");  
        }
       else {        
        header("Location: logistics/vehiclestrial.php?vreg=n");
       }
    }else {     
        header("Location: logistics/vehiclestrial.php?vreg=n");
    }
 
}

//updating vehicles owner
if(isset($_POST['editOwner'])){
    $cp= $_GET['cd'];
    $fname= $_POST['fname'];  $lname=$_POST['lname'];
    $oid=$_POST['oid'];  $phone=$_POST['pnumber'];
   
   $query="UPDATE `vehicle_owners` 
   SET `O_id`='$oid',`O_fname`='$fname',`O_lname`='$lname',`O_phone`='$phone' WHERE O_car_plate='$cp'";
   
  if($obj->update($query)){
      header("Location: logistics/edit_vehicles.php?oud=y&&cdetails=$cp");
  }else {
       header("Location: logistics/edit_vehicles.php?oud=n");
  }
}
//editing/updating vehicle
if(isset($_POST['vedit'])){
     $cp=$_GET['cd']; 
     $vtype= $_POST['vtype'];
     $ftype= $_POST['ftype'];
     $mileage= $_POST['mileage'];
     $ppd= $_POST['ppd'];
     $myear= $_POST['myear'];
     $seat= $_POST['seat'];
     $front=$_FILES['front']['tmp_name'];
     $back=$_FILES['back']['tmp_name'];
     $rear=$_FILES['rear']['tmp_name'];
     $left=$_FILES['left']['tmp_name'];
     $right=$_FILES['right']['tmp_name']; 
     $vdir="images\cars\ $cp\ ";
    $query="UPDATE `vehicles` 
    SET `vtype`='$vtype',`ftype`='$ftype',`mileage`='$mileage',`price_per_day`='$ppd',
    `model_year`='$myear',`seat_capacity`='$seat' WHERE plate='$cp'";
    if($front!=''){
        echo $front;
        unlink("images\cars\ $cp\ front.jpg");
        move_uploaded_file($front, $vdir."front.jpg");
    }
    if($back!=''){
        unlink("images\cars\ $cp\ back.jpg");
        move_uploaded_file($back, $vdir."back.jpg");
    }
    if($rear!=''){
        unlink("images\cars\ $cp\ rear.jpg");
        move_uploaded_file($rear, $vdir."rear.jpg");
    }
    if($left!=''){
        unlink("images\cars\ $cp\ left.jpg");
        move_uploaded_file($left, $vdir."left.jpg");
    }
    if($right!=''){
        unlink("images\cars\ $cp\ right.jpg");
        move_uploaded_file($right, $vdir."right.jpg");
    }

    if($obj->update($query)){
        header("Location: logistics/edit_vehicles.php?vup=y&&cdetails=$cp");
    }else {
       header("Location: logistics/edit_vehicles.php?vup=n");
    }
}

//registering a driver
if(isset($_POST["driverRegister"])){
    $fname= $_POST['fname'];
    $lname= $_POST['lname'];
    $email= $_POST['email'];
    $pnumber= $_POST['pnumber'];
    $license= $_POST['license'];
    $bdate= $_POST['bdate'];
    $imgname= $_FILES['image']['name'];
    $imgtmp= $_FILES['image']['tmp_name'];
   
    $vdir="images/license/ ";
   
    move_uploaded_file($imgtmp, $vdir.$imgname);
    
   
    $query="INSERT INTO `drivers`(`drfname`, `drlname`, `dremail`, `drpnumber`, `drlicense`,`drimage`, `drbday`, `drstatus`) 
    VALUES ('$fname','$lname','$email','$pnumber','$license','$imgname','$bdate','Available')";
    
    $res = $obj->insert($query);
    if($res == 1){
        header("Location: logistics/drivers.php?drReg=y");
    }else {
        header("Location: logistics/drivers.php?drReg=n");
    }
}

//editing driver info
if(isset($_POST["editDriver"])){
    $id= $_POST['id'];
    $fname= $_POST['fname'];
    $lname= $_POST['lname'];
    $email= $_POST['email'];
    $pnumber= $_POST['pnumber'];
    $license= $_POST['license'];
    $sth= $_POST['sth'];
    $bdate= $_POST['bdate'];
    $status= $_POST['status'];

    $query="UPDATE `drivers` 
    SET `drfname`='$fname',`drlname`='$lname',`dremail`='$email',`drpnumber`='$pnumber',`drlicense`='$license', `drstatus`='$status' WHERE drid='$id'";
    
    if($obj->update($query)){
        header("Location: logistics/drivers.php?drup='y'");
    }else {
        header("Location: logistics/drivers.php?drud='n'");
    }
}

//delete vehicle
if(isset($_GET["vecdel_id"])){
    $id= $_GET["vecdel_id"];
    $query="delete from vehicles where plate='$id'";
    if($obj->delete($query)){
        header("Location: logistics/vehicles.php?dv='y'");
    }else {
       header("Location: logistics/vehicles.php?dv='n'");
    }
}

#delete drive
if(isset($_GET["drdel_id"])){
    $id= $_GET["drdel_id"];
    $query="delete from drivers where drid='$id'";
    if($obj->delete($query)){
        header("Location: logistics/drivers.php?ddr='y'");
    }else {
       header("Location: logistics/drivers.php?ddr='n'");
    }
}

//registering employee
if(isset($_POST["empRegister"])){
    $fname= $_POST['fname'];
    $lname= $_POST['lname'];
    $email= $_POST['email'];
    $pnumber= $_POST['pnumber'];
    $bdate= $_POST['bdate'];
    $gender= $_POST['gender'];
    $role= $_POST['role'];
    
   
    $query="INSERT INTO `employees`(`fname`, `lname`, `email`, `phone`, `bdate`, `gender`, `photo`, `role`) 
    VALUES ('$fname','$lname','$email','$pnumber','$bdate','$gender','D','$role')";
    
    $res = $obj->insert($query);
    if($res == 1){
        //selecting the id of the employee registered
        
        $query= " SELECT * from employees order by id desc limit 1";
        $res = $obj->fetch($query);
        $result = $res->fetch();
        $id= $result["id"];
        //creating account for the employee
        $username=$fname."_".$lname;
        $password= $obj->randomPassword();
        $query="INSERT INTO `account`(`username`, `password`, `status`,`id`) VALUES ('$username','$password','Pending','$id')";
        $res = $obj->insert($query);
        if($res == 1){
        header("Location: admin/registration.php?reg=y");
        }
    }else {
        header("Location: admin/registration.php?reg=n");
    }   
}

//change account status
if(isset($_POST["editAct"])){
     $status= $_POST["status"];
     $id= $_POST["id"];

    $query="UPDATE `account` 
    SET `status`='$status' WHERE id='$id'";
    
    if($obj->update($query)){
        header("Location: admin/account.php?ac='y'");
    }else {
        header("Location: admin/account.php?ac='n'");
    }
}

//deleting account
if(isset($_GET["actdel"])){
    $id= $_GET["actdel"];
    $query="delete from account where id='$id'";
    if($obj->delete($query)){
        header("Location: admin/account.php?dels='y'");
    }else {
       header("Location: admin/account.php?delf='n'");
    }
}

//requesting a car via saleperson
if(isset($_POST["car_req_by_sales"])){
   $requester= $_SESSION["id"];
   $car= $_POST["plateNo"];
   $driver= $_POST["driver"];
   $sdate= $_POST["sdate"];
   $edate= $_POST["edate"];

   $query="INSERT INTO `car_requests`(`requested_by`, `sdate`, `edate`, `car`, `driver`,`req_status`) 
   VALUES ('$requester','$sdate','$edate','$car','$driver','Pending')";
   
   $res = $obj->insert($query);
   if($res == 1){
        
       header("Location: sales/request_v.php?srq=y");
   }else {
   
       header("Location: sales/request_v.php?srq=n");
   }
}

//approving car request by logistic
if(isset($_GET["laprId"])){
    $laprID= $_GET["laprId"];
    $date= date("y-m-d");
    $query="UPDATE `car_requests` SET `req_status`='L_approved',`l_approve`='$date' where rq_id= '$laprID'";
    if($obj->update($query)){
        header("Location: logistics/view_req.php?lA=y");
    }else {
        header("Location: logistics/view_req.php?lA=n");
    }
}
//approving car request by finance
if(isset($_GET["faprId"])){
    $rqid= $_GET["faprId"];
    $date= date("y-m-d");
    $query="UPDATE `car_requests` SET `req_status`='F_approved', `f_approve`='$date' where rq_id= '$rqid'";
    if($obj->update($query)){
        header("Location: finance/requests.php?frA=y");
    }else {
        header("Location: finance/requests.php?frA=n");
    }
}

//approving car request by manager
if(isset($_GET["mgrapr"])){
    $rqid= $_GET["mgrapr"];
    $cplate=$_GET["cplate"];
    $drid= $_GET["dr"];
    $date= date("y-m-d");
    $query="UPDATE `car_requests` SET `req_status`='M_approved',`m_approve`='$date' where rq_id= '$rqid'";
    $query2="UPDATE `vehicles` SET `status`='Rented' where plate= '$cplate'";
    $query3="UPDATE `drivers` SET `drstatus`='On duty' where drid= '$drid'";

    if($obj->update($query)){
        if($obj->update($query2)){
            if($obj->update($query3)){
                    header("Location: manager/requests.php?mgrA=y");
            
            } else echo "could not update driver";
        }else{
            echo "could not update car status";
        }
       
    }
    else {
        header("Location: manager/requests.php?mgrA=n");
    }
}

//processing return form
if(isset($_POST["returnForm"])){
        $date= date("y-m-d");
        $id=$_POST["plateNo"];
        $status= $_POST["status"];
    $query="UPDATE car_requests INNER JOIN vehicles ON car_requests.car= vehicles.plate 
    SET  vehicles.status='Available', returned_date='$date'  where vehicles.plate='$id'";
    $query2="UPDATE car_requests INNER JOIN drivers on car_requests.driver=drivers.drid set drstatus='Available' where car_requests.car='$id'";
   
     if($obj->update($query))
     {
                if($obj->update($query2))
                {
                    $car_log="SELECT *from car_requests where car='$id'";
                    $cars=$obj->fetch($car_log);
                    $carslist= $cars->fetchAll();
                            foreach($carslist as $val)
                            {
                                $rqBy=$val['requested_by']; $rdate=$val['sdate']; $car=$val['car']; $driver=$val['driver']; $l_approve=$val['l_approve'];
                                $f_approve=$val['f_approve']; $m_approve=$val['m_approve']; $retdate=$val['returned_date'];
                            }
                            $histlist="INSERT INTO `car_log`( `requested_by`, `rdate`, `car`, `driver`, `l_approve`, `f_approve`, `m_approve`, `returned_date`) 
                            VALUES ('$rqBy','$rdate','$car','$driver','$l_approve','$f_approve','$m_approve','$retdate')";
                                if($obj->insert($histlist))
                                {
                                    $clr="DELETE from car_requests where car='$id'";
                                    if($obj->delete($clr)){
                                    header("Location: logistics/return_form.php?rt=y");
                                    }
                                    else{
                                        header("Location: logistics/return_form.php?rt=n");
                                    }
                                }
                                else header("Location: logistics/return_form.php?rt=n");
                } 
                else header("Location: logistics/return_form.php?rt=n");
    }
    else 
    {
        header("Location: logistics/return_form.php?rt=n");
    }
}

?>