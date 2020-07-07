<?php 

  session_start();

  require 'connect2.php';
  require 'functions.php';

  if(isset($_POST['login'])) {

    $uname = clean($_POST['username']);
    $pword = clean($_POST['password']);

    $query = "SELECT * FROM students WHERE username = '$uname' AND password = '$pword'";

    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result)>0) {

      $row = mysqli_fetch_assoc($result);

      $_SESSION['userid'] = $row['id'];
      $_SESSION['username'] = $row['username'];
      $_SESSION['password'] = $row['password'];

      header("location:profile2.php");
      exit;

    } else {

      $_SESSION['errprompt'] = "Wrong username or password.";

    }

  }

  if(!isset($_SESSION['username'], $_SESSION['password'])) {

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Student Login - Attendance System</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>
<body>

  <?php include 'header.php'; ?>

  <section class="center-text">
    
    <strong>Log In</strong>

    <div class="login-form box-center">
      <?php 

        if(isset($_SESSION['prompt'])) {
          showPrompt();
        }

        if(isset($_SESSION['errprompt'])) {
          showError();
        }

      ?>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        
        <div class="form-group">
          <label for="username" class="sr-only">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
        </div>

        <div class="form-group">
          <label for="password" class="sr-only">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        
        <a href="studentregister.php">Need an account?</a>
        <input class="btn btn-primary" type="submit" name="login" value="Log In">

      </form>
    </div>

  </section>
  <footer id="footer">
		<div id="back-top-wrapper">
			<p id="back-top">
				<a href="#top">Top</a>
			</p>
		</div>
		<div class="container_16 clearfix">
			<div id="footer-text" class="grid_6">
																


			<div class="grid_10">
				  
					<nav class="footer">
						<ul id="menu-footer-menu" class="footer-nav">
                        
                                                 
                         </ul>
                        </nav>
							</div>
			<div id="widget-footer" class="clearfix">
								  <!--Widgetized Footer-->
							</div>
		</div><!--.container-->
	</footer>


	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php

  } else {
    header("location:profile.php");
    exit;
  }

  unset($_SESSION['prompt']);
  unset($_SESSION['errprompt']);

  mysqli_close($con);

?>