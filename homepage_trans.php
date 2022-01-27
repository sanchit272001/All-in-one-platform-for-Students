<?php require_once 'process_trans.php';?>
<?php  if(isset($_SESSION['message'])): ?>
<?php
$con = new mysqli("localhost","root","","budget_calculator");
$tablename = $_SESSION["username"]."-transactions";
$sql = "CREATE TABLE `".$tablename."` (id INT(100) NOT NULL AUTO_INCREMENT, category VARCHAR(100) NOT NULL, amount INT(100) NOT NULL, date DATE, PRIMARY KEY (id));";
?>

<?php endif ?> 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Management System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <h1>Budget Management System</h1>
    </header>
    <nav>
    <a href="index.php">Home</a>
        <a href="homepage.php">Create a New Budget</a>
        
        <a href="analyzer.php">Analyzer</a>
        <a href="http://localhost/jobex/mainpage.html">Logout</a>
        <!-- <a href="#">Contact Us</a>
        <a href="#">Terms of Use</a> -->
        <!-- <a href="#">&copy; 2020 | BMS</a> -->
    </nav>
    <nav class="navbar navbar-dark bg-primary text-center">
    <span class="navbar-brand mb-0 h1 text-center">Transactions</span>
    </nav>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="text-center">Today's Transactions</h2>
                <hr><br>
                <form action="process_trans.php" method="POST">
                    <div class="form-group">
                        <label for="category"><b>Enter Category</b></label>
                        <input type="hidden"  name="id" value="<?php echo $id; ?>"><br>
                        <select name="category" style="width: 100%;" id="category" class="category" style="width:100%;">
                            <?php
                                $sql = "SELECT * FROM `".$_SESSION["username"]."-expectations` ;";
                                $result = mysqli_query($con, $sql);
                                if(mysqli_num_rows($result) > 0){
                                    if($update == true)
                                    echo "<option value=\"".$category."\">".$category."</option>";
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "<option value=\"".$row["category"]."\">".$row["category"]."</option>";
                                    }
                                }
                                else{
                                    echo "Add Category In the New Budget.";
                                }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount"><b>Expenses Involved</b></label>
                        <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Amount" required  value="<?php echo $amount; ?>">
                    </div>
                    <?php if($update == true): ?>
                    <button type="submit" name="update" class="btn btn-success btn-block">Update</button>
                    <?php else: ?>
                    <button type="submit" name="save" class="btn btn-primary btn-block">Save</button>
                    <?php endif; ?>
                </form>
            </div>
            <div class="col-md-8">
                <h2 class="text-center">Amount Left = Rs. <?php echo $total_left;?></h2>
                <hr>
                <br><br>

                <?php 

                    if(isset($_SESSION['message'])){
                        echo    "<div class='alert alert-{$_SESSION['msg_type']} alert-dismissible fade show ' role='alert'>
                                    <strong> {$_SESSION['message']} </strong>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                ";
                    }
                ?>
                <h2>Today's Transaction</h2>

                <?php
                    $sql = "SELECT * FROM `".$tablename."` WHERE date='".$date."';";
                    $result = mysqli_query($con, $sql);
                ?>
                <div class="row justify-content-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th colspan="6">Actions</th>
                            </tr>
                        </thead>
                        <?php 
                            while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['category']; ?></td>
                                <td>Rs. <?php echo $row['amount']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td>
                                    <a href="homepage_trans.php?edit=<?php echo $row['category']; ?>" class="btn btn-success">Change</a>
                                    <a href="process_trans.php?delete=<?php echo $row['category']; ?>"  class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>