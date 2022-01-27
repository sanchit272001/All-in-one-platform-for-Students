<?php session_start(); ?>
<?php $con = new mysqli("localhost","root","","budget_calculator");$tablename = $_SESSION["username"]."-expectations"; ?>
<?php
if (isset($_SESSION['username'])) {
    $total = 0;
    $sql = "SELECT * FROM `".$tablename."`;";
    $result = mysqli_query($con, $sql);
    while($row = $result->fetch_assoc()){
        $total = $total + $row['amount'];
        }
        $sql = "SELECT * FROM `".$_SESSION["username"]."-transactions"."`;";
        $result = mysqli_query($con, $sql);
        $sum_expect = 0;
        while($row = $result->fetch_assoc()){
        $sum_expect = $sum_expect + $row['amount'];
        }
        $total_left = $total - $sum_expect;
}
else{
    header("location: login.php");
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Management System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
.analyzer{
    display: block;
    width: 100%;
}
.col-md-4{
    width: 100%;
}
</style>
<body>
<header>
        <h1>Budget Management System</h1>
    </header>
    <nav>
    <a href="index.php">Home</a>
        <a href="homepage.php">Create a New Budget</a>
        <a href="homepage_trans.php">Transactions</a>
        
        <a href="http://localhost/jobex/mainpage.html">Logout</a>
        <!-- <a href="#">Contact Us</a>
        <a href="#">Terms of Use</a> -->
        <!-- <a href="#">&copy; 2020 | BMS</a> -->
    </nav>
    <nav class="navbar navbar-dark bg-primary text-center">
    <span class="navbar-brand mb-0 h1 text-center">Analyzer</span>
    </nav>
    <br><br><br>
    <div class="container">
        <div class="analyzer">
            <div>
                <H1>Summary</H1>
                <H1>Expectations</H1>
                <p>
                    Total Amount: Rs. <?php echo $total; ?> 
                </p>
                <p>
                    Amount Left: Rs. <?php echo $total_left; ?>
                </p>
                <?php 
                     if($total_left<0){
                         echo "<p style='color:red;font-weight: bold;'>Status: OverSpending &#10005;</p>";
                     }
                     else{
                         echo "<p style='color:#00d619;font-weight: bold;'>Status: Your Well Within The Budget &#10003;</p>";
                     }
                ?>
                <p>
                    Percentage: <?php 
                    if($total!=0){
                        if($total_left<0){
                            echo "<span style='color:red;font-weight: bold;'>".($total_left/$total*100)."% </span>";
                        }
                        else{
                            echo "<span style='color:#00d619;font-weight: bold;'>".($total_left/$total*100)."% </span>";
                        }
                    }
                    else echo "";
                    ?>
                </p>
                <p>
                <?php
                    $sql = "SELECT * FROM ";
                    $result = mysqli_query($con, $sql);
                    if($total_left == $total){
                        echo "Please Spend Money";
                        }
                        if($total_left/$total*100>=75 and $total_left/$total*100<=99.999){
                            echo "Undoubtedly there has been no flaws in your expenditures.<br> However, by saving too much money you miss out on things like medical care or your favourite hobby. By keeping your life balanced you will get all of the advantages of saving and not the disadvantages of saving money.<br>Be smart with money! <br>";
                        }
                        if($total_left/$total*100>=50 and $total_left/$total*100<75){
                            echo "Undoubtedly there has been no flaws in your expenditures.<br> However, by saving too much money you miss out on things like medical care or your favourite hobby. By keeping your life balanced you will get all of the advantages of saving and not the disadvantages of saving money.<br>Be smart with money! <br>";
                        }
                        if($total_left/$total*100>=25 and $total_left/$total*100<50){
                            echo "You have done fairly well in managing your expenditure. <br> Your strategy has been fairly effective.<br> However, a more systematic approach could place you into consistency in the upcoming months. <br>Be smart with money! <br>";
                        }
                        if($total_left/$total*100>=0 and $total_left/$total*100<25){
                            echo "You have done fairly well in managing your expenditure. <br> However you need to be more cautious with your expenditure due to the high chance of falling into a negative percentage.<br> Be smart with money! <br>";
                        }
                        if($total_left/$total*100>=-25 and $total_left/$total*100<0){
                            echo "You could optimize your expenditure and save some more money.<br>A simple pre-planned expenditure would ease your process.<br> Optimized resources utilization could help you save a lot of money.<br> Be smart with money! <br> You have the potential to obtain a positive percentage." ;
                        }
                        if($total_left/$total*100>=-50 and $total_left/$total*100<-25){
                            echo "You could optimize your expenditure and save some more money.<br>Find a better strategy with the insights given below based on your expected expenditure and actual expenditure.<br>A simple pre-planned expenditure would ease your process.<br> Optimized resources utilization could help you save a lot of money.<br> Be smart with money! " ;
                        }
                        if($total_left/$total*100>=-75 and $total_left/$total*100<-50){
                            echo "You could optimize your expenditure and save some more money.<br>Find a better strategy with the insights given below based on your expected expenditure and actual expenditure.<br>You need to ensure that you meet your saving objectives.<br> Optimized resources utilization could help you save a lot of money.<br> Be smart with money! " ;
                        }
                        if($total_left/$total*100>=-100 and $total_left/$total*100<-75){
                            echo "You could optimize your expenditure and save some more money.<br>Find a better strategy with the insights given below based on your expected expenditure and actual expenditure.<br>You need to ensure that you meet your saving objectives.<br> Optimized resources utilization could help you save a lot of money.<br> Be smart with money! " ;
                        }
                        if($total_left/$total*100<-100){
                            echo "You could optimize your expenditure and save some more money.<br>Find a better strategy with the insights given below based on your expected expenditure and actual expenditure.<br>You need to ensure that you meet your saving objectives.<br> Optimized resources utilization could help you save a lot of money.<br> Be smart with money! " ;
                        }
                     
                ?>
                </p>
                <?php
                    $acctual = 0;
                    $expected = 0;
                    $sql = "SELECT * FROM `".$_SESSION["username"]."-expectations` ;";
                    $result = mysqli_query($con, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row_expected = mysqli_fetch_assoc($result)){
                            $acctual = 0;
                            $expected = 0;
                            $expected = $row_expected["amount"];                           
                            
                            $sql1 = "SELECT * FROM `".$_SESSION["username"]."-transactions` WHERE `category`='".$row_expected["category"]."' ;";
                            $result1 = mysqli_query($con, $sql1);
                            while($row_transac = mysqli_fetch_assoc($result1)){
                                $acctual += $row_transac["amount"];
                            }
                            if($acctual> $expected){
                                echo "<p style='color:red;font-weight: bold;'> We suggest you to reduce your expenditure in ".$row_expected["category"]." category or allocate more budget for ".$row_expected["category"]." category next time. </p>";
                            }
                            if($acctual == 0){
                                echo "<p style='color:#c3d100;font-weight: bold;'> You didn't spend money allocated in ".$row_expected["category"]." category ! </p>";
                            }
                            else if($acctual <= $expected){
                                echo "<p style='color:#00d619;font-weight: bold;'> You spent Within Your Budget in ".$row_expected["category"]." category. &#10003;</p>";
                            }
                        }
                    }
                    if($total_left >= 0){
                        echo "<p style='color:#00d619;font-weight: bold;'> You saved Rs. ".($total_left)."</p>";
                    }
                    else{
                        echo "<p style='color:red;font-weight: bold;'> You over spent Rs. ".($total_left)."</p>";
                    }
                    
                ?>
                </div>
            </div>
        </div>
    </div>

<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>