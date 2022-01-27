<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="newstyle.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Budget Management System | Home</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
<!-- <img src="download.png" id="logoimg"> -->
    <header>
        <h1>Budget Management System</h1>
    </header>
    <nav>
        <a href="homepage.php">Create a New Budget</a>
        <a href="homepage_trans.php">Transactions</a>
        <a href="analyzer.php">Analyzer</a>
        <a href="http://localhost/jobex/mainpage.html">Logout</a>
        <!-- <a href="#">Contact Us</a>
        <a href="#">Terms of Use</a> -->
        <!-- <a href="#">&copy; 2020 | BMS</a> -->
    </nav>

<div class="header">
	<h2>Account</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<!-- <p> <a href="index.php?logout='1'" style="color: red;">Log Out</a> </p> -->
    <?php endif ?>
</div>
		
</body>
</html>
