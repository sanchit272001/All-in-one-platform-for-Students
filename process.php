<?php
session_start();
// Create connection
$con = new mysqli("localhost","root","","budget_calculator");
$tablename = $_SESSION["username"]."-expectations";
$sql = "CREATE TABLE `".$tablename."` (category VARCHAR(100) NOT NULL, amount INT(100) NOT NULL, PRIMARY KEY (category));";
mysqli_query($con, $sql);

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

        $budget = $_POST['budget'];
        $category = $_POST['category'];
        $amount = $_POST['amount'];
        
        $sql = "SELECT * FROM `".$tablename."` WHERE category='".$category."';";
        $query = mysqli_query($con,$sql ); 
        if($category != '')
        if(mysqli_num_rows($query)==1){
            $sql = "UPDATE `".$tablename."` SET amount=amount + ".$amount." WHERE category='".$category."';";
            $query = mysqli_query($con,$sql ); 
        }
        else{
            $sql = "INSERT INTO `".$tablename."` (category, amount) VALUE ('$category', '$amount');";
            $query = mysqli_query($con,$sql ); 
        }
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "primary";

        header("location: homepage.php?result=true");


    }

    //calculate Total budget
    $result = mysqli_query($con, "SELECT * FROM `".$tablename."`;");
    while($row = $result->fetch_assoc()){
        $total = $total + $row['amount'];
    }

    //delete data

    if(isset($_GET['delete'])){
        $category = $_GET['delete'];

        $sql = "DELETE FROM `".$_SESSION["username"]."-expectations` WHERE category='".$category."';";
        $query = mysqli_query($con, $sql);
        $sql = "DELETE FROM `".$_SESSION["username"]."-transactions` WHERE category='".$category."';";
        $query = mysqli_query($con, $sql);
        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: homepage.php");

    }
    
    if(isset($_GET['edit'])){
        $category = $_GET['edit'];
        $update = true;
        $result = mysqli_query($con, "SELECT * FROM `".$tablename."` WHERE category='".$category."';");

      
        if( mysqli_num_rows($result) == 1){
            $row = $result->fetch_assoc();
            $category = $row['category'];
            $amount = $row['amount'];
        }
    
    }

    if(isset($_POST['update'])){
        $budget = $_POST['budget'];
        $category = $_POST['category'];
        $amount = $_POST['amount'];

        $query = mysqli_query($con, "UPDATE `".$tablename."` SET category='$category', amount='$amount' WHERE category='".$category."';");
        $_SESSION['msg_type'] = "success";
        $_SESSION['message'] = "Record has been Updated!";
        header("location: homepage.php");
    }
?>