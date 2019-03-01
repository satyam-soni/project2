<?php
  session_start();
	include_once 'classes/user.php';
	$user = new User();
	 $id = $_SESSION['uid'];
	if (!$user->get_session()){
	 header("location:login.php");
	 exit();
	}

	if (isset($_GET['q'])){
  $user->user_logout();
	 header("location:login.php");
	 exit();
	 }
?>


<!DOCTYPE html>
<html>
<head>
	<title>home page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>


  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">


  <div class="collapse navbar-collapse col-xs-3 col-xs-offset-9 " id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto  ">
      <li class="nav-item active  ">
        <a class="nav-link" href="include/changePass.php">change Password <span class="sr-only">(current)</span></a>
      </li>


  </div>
</nav>

	<!-- n -->
	<div class="jumbotron text-center">
		<h2>Hello <small><?php $user->get_name($id); ?>!</small></h2>
		<a class="btn btn-primary btn-md" href="home.php?q=logout">LOGOUT</a>




	</div>
</body>
	</html>
