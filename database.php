<?php 
class database {

private $conn;
private $servername = "127.0.0.1";
private $username = "root";
private $password = "";


public function connect(){
        try {
    $this->conn = new PDO("mysql:host=$this->servername;dbname=car_rent", $this->username, $this->password);
    // set the PDO error mode to exception
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
        //echo "<script>alert('Connection successful');</script>"; 
        return $this->conn;  
        
    }
        catch(PDOException $e)
    {
    echo "<script>alert('Connection failed!! Try again');</script>";
    }
 }

    public function insert($query){
        try{
            if($this->connect()->exec($query)){
                return 1;
            }
             else print("something is wrong");
             }

       catch(PDOException $e)
            {
            echo error_log($e);
            }
}

    public function fetch($query){

        try{
            $stmnt= $this->connect()->prepare($query);
             $stmnt->execute();
             return $stmnt;
         }
           catch(PDOException $e)
    {
   // echo "<script>alert('operation failed!! Try again');</script>";
   echo error_log($e);
    } 
         }

    public function update($query){
        try{
            $stmnt= $this->connect()->prepare($query);
             $stmnt->execute();
             return $stmnt;
            }
            catch(PDOException $e)
            {
           echo "<script>alert('operation failed!! Try again');</script>";
            }
    }

    public function delete($query){
        try{
    $stm=$this->connect()->prepare($query);
            if($stm->execute())
        return 1;
    
}
    catch(PDOException $e)
    {
     echo "<script>alert('operation failed!! Try again');</script>";
    }
}
  
 public function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 15; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    $_SESSION['password']= implode($pass);

    return implode($pass); //turn the array into a string
}
}
?>