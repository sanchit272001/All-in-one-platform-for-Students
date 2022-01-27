<?php require_once 'process.php'; ?>
<?php $con = new mysqli("localhost","root","","budget_calculator"); ?>
<?php  if(isset($_SESSION['message'])): ?>

<?php endif ?>
<?php $tablename = $_SESSION["username"]."-expectations"; ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Management System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body>
<header>
        <h1>Budget Management System</h1>
    </header>
    <nav>
        <a href="index.php">Home</a>
        <a href="homepage_trans.php">Transactions</a>
        <a href="analyzer.php">Analyzer</a>
        <a href="http://localhost/jobex/mainpage.html">Logout</a>
        <!-- <a href="#">Contact Us</a>
        <a href="#">Terms of Use</a> -->
        <!-- <a href="#">&copy; 2020 | BMS</a> -->
    </nav>
    <nav class="navbar navbar-dark bg-primary text-center">
    <span class="navbar-brand mb-0 h1 text-center">New Budget</span>
    </nav>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="text-center">Expense Details</h2>
                <hr><br>
                <form action="process.php" method="POST">
                    <div class="form-group">
                        <label for="category"><b>Create A Category: </b></label>
                        <input type="text" name="category" class="form-control" id="category" placeholder="Category" required autocomplete="off" value="<?php echo $category; ?>">
                    </div>
                    <div class="form-group">
                        <label for="amount"><b>Allocated A Budget To It: </b></label>
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
                <h2 class="text-center">Total Amount = Rs. <?php echo $total;?></h2>
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
                <h2>List</h2>

                <?php
                    $result = mysqli_query($con, "SELECT * FROM `".$tablename."`;");
                ?>
                <div class="row justify-content-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Amount</th>
                                <th colspan="6">Actions</th>
                            </tr>
                        </thead>
                        <?php 
                            while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['category']; ?></td>
                                <td>Rs. <?php echo $row['amount']; ?></td>
                                <td>
                                    <a href="homepage.php?edit=<?php echo $row['category']; ?>" class="btn btn-success">Update</a>
                                    <a href="process.php?delete=<?php echo $row['category']; ?>"  class="btn btn-danger">Delete</a>
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