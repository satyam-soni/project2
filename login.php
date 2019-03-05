<?php
	session_start();
if(isset($_SESSION['uid']))
  {
    header("location:datatable/index.php");
  //  die("ss");
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<meta name="google-signin-client_id" content="580529046635-huhs7smsvshdec8q2slufjpbpbbf9csj.apps.googleusercontent.com">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script>
	    function onSignIn(googleUser)
			{
	          var profile = googleUser.getBasicProfile();
				  //	console.log(profile);
						var email = profile.U3;
						var fullname = profile.ig;
						//window.location.href='functions/gmail_signin.php?query='.(email);
					$.ajax({
							url: 'functions/gmail_signin.php',
							type : 'POST',
						 //	datatype: 'JSON',
							data:{fullname: fullname, email: email},
               success : function(response){
								 //console.log("hi");
								 //alert(response);

									window.location.href="home.php";
									//window.location.reload(true);

							}


						});


      }
	</script>


</head>
<body>
	<div class="container">
	<div style="margin-top: 4%;"></div>
	<div class="row">
	<div class="col-sm-4"></div>
	<div class="col-sm-4 well">
	<h2 class="text-center">Login Here</h2>
		<form action="include/login.php" method="post" name="login">
		<div class="form-group">
		<label> Email:</label>


		<input class="form-control" type="text" name="email" required=""  value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>"/>
		</div>
		<div class="form-group">
		<label>Password:</label>
		<input class="form-control" type="password" name="password" required="" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>"/>
		</div>
		<div class="form-group">
    <label>  <input type="checkbox" name="remember" id="remember" /> Remember me </label>
    </div>

		<input class="btn btn-primary" type="submit" name="login" value="Login" />
		<a href="registration.php">Register new user</a>
    <br/>
		<div class="col-sm-3 col-sm-offset-9 "><a href="emailForgetPass.php">Forget Password</a></div>

		</form>




	<br>
	<?php
	// Show any success or error message
		if(isset($_SESSION['msg'])) {
			echo $_SESSION['msg'];
			session_unset($_SESSION['msg']);
		}
	?>
	</div>
	<div class="col-sm-4"></div>
	</div> <!-- End row -->
	</div> <!-- End container -->
	<div class="container">
	<div class="row">
	<div class="col-sm-offset-4">

	<div class="g-signin2 btn btn-center" style ="width : 380px; right : 200px;" data-onsuccess="onSignIn"></div>
	</div>
</div>

</div>

</body>
</html>
