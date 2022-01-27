<?php
session_start();
// Create connection
$con = new mysqli("localhost","root","","budget_calculator");
$tablename = $_SESSION["username"]."-transactions";
$sql = "CREATE TABLE `".$tablename."` (id INT(100) NOT NULL AUTO_INCREMENT, category VARCHAR(100) NOT NULL, amount INT(100) NOT NULL, date DATE, PRIMARY KEY (id));";
$query = mysqli_query($con, $sql);

//$date = date("Y-m-d");
$date = "2021-06-19";

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

$total = 0;
$update = false;
$id = 0;
$name = '';
$amount = '';
$category = '';

    if(isset($_POST['save'])){
       
        $transaction = $_POST['transaction'];
        $category = $_POST['category'];
        $amount = $_POST['amount'];
        $sql = "SELECT * FROM `".$tablename."` WHERE category='".$category."' AND date='".$date."';";
        $query = mysqli_query($con,$sql );
        if($category != ''){
            if(mysqli_num_rows($query)>0){
                $sql = "UPDATE `".$tablename."` SET amount=amount + ".$amount." WHERE category='".$category."' AND date='".$date."';";
                $query = mysqli_query($con, $sql);
            }
            else{
                $sql = "INSERT INTO `".$tablename."` (category, amount, date) VALUE ('$category', '$amount', '$date');";
                $query = mysqli_query($con, $sql);
            }
        }
        
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "primary";

        header("location: homepage_trans.php?result=true");
    }

    //calculate Total transaction
    $result = mysqli_query($con, "SELECT * FROM `".$tablename."`;");
    while($row = $result->fetch_assoc()){
        $total = $total + $row['amount'];
    }
    $sum_expect = 0;
    $result = mysqli_query($con, "SELECT * FROM `".$_SESSION["username"]."-expectations"."`;");
    while($row = $result->fetch_assoc()){
        $sum_expect = $sum_expect + $row['amount'];
    }
    $total_left = $sum_expect - $total;

    //delete data

    if(isset($_GET['delete'])){
        $category = $_GET['delete'];

        $sql = "DELETE FROM `".$tablename."` WHERE category='".$category."' AND `date`='".$date."';";
        $query = mysqli_query($con, $sql);
        echo $sql;

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: homepage_trans.php");

    }
    
    if(isset($_GET['edit'])){
        $category = $_GET['edit'];
        $update = true;
        
        
        
        $sql = "SELECT * FROM `".$tablename."` WHERE category='".$category."' AND `date`='".$date."';";
        $result = mysqli_query($con, $sql);

      
        if( mysqli_num_rows($result) >= 1){
            $row = $result->fetch_assoc();
            $category = $row['category'];
            $amount = $row['amount'];
        }
    
    }

    if(isset($_POST['update'])){
        $transaction = $_POST['transaction'];
        $category = $_POST['category'];
        $amount = $_POST['amount'];

        $sql = "UPDATE `".$tablename."` SET amount='".$amount."' WHERE category='".$category."' AND `date`='".$date."'";
        $query = mysqli_query($con, $sql);
        echo $sql;
        $_SESSION['msg_type'] = "success";
        $_SESSION['message'] = "Record has been Updated!";
        header("location: homepage_trans.php");
    }
?>