<?php session_start();

if(isset($_SESSION['uid']))
{
  header("location:home.php");

}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script language="javascript" type="text/javascript">
            $(document).ready(function() {
                var x_timer;
                $("#username").keyup(function (e){
                    clearTimeout(x_timer);
                    var user_name = $(this).val();
                    x_timer = setTimeout(function(){
                        check_username_ajax(user_name);
                    }, 1000);
                });

            function check_username_ajax(username){
                $("#user-result").html(' loading...');
                $.post('username-checker.php', {'username':username}, function(data) {
                $("#user-result").html(data);
                });
            }
            });




        </script>

        <script>
        function validate(){
          var name = document.forms["reg"]["name"].value;
    var email = document.forms["reg"]["email"].value;
    var mobile = document.forms["reg"]["mobile"].value;
    var username =  document.forms["reg"]["username"].value;
    var password = document.forms["reg"]["password"].value;
    var salary = document.forms["reg"]["salary"].value;



    if (name == "")
  {
      window.alert("Please enter your name.");
      //name.focus();
      return false;
  }

  if (username == "")
{
    window.alert("Please enter your user-name.");
    //username.focus();
    return false;
}

  if (email == "")
  {
      window.alert("Please enter a valid e-mail address.");
      //email.focus();
      return false;
  }

  if (email.indexOf("@", 0) < 0)
  {
      window.alert("Please enter a valid e-mail address.");
      //email.focus();
      return false;
  }

  if (email.indexOf(".", 0) < 0)
  {
      window.alert("Please enter a valid e-mail address.");
      //email.focus();
      return false;
  }

  if (password == "")
  {
      window.alert("Please enter your password");
      //password.focus();
      return false;
  }

  if (password.length <6 )
  {
      window.alert("Please enter minimum 6 digit password");
      //password.focus();
      return false;
  }

  if (mobile == "")
  {
      window.alert("Please enter your mobile number.");
      //mobile.focus();
      return false;
  }
  if (isNaN(mobile))
  {
      window.alert("Please enter valid mobile number.");
      //mobile.focus();
      return false;
  }

  if (mobile.length < 10 )
  {
      window.alert("Please enter 10 digit mobile number.");
      //mobile.focus();
      return false;
  }

  if (salary == "")
  {
      window.alert("Please enter your salary");
      //salary.focus();
    return false;
  }
  if(salary.length >8){
    window.alert("Please enter valid salary");
    return false;
  }


}

$(document).ready(function(){
  $('#testf').keyup(function(){
    val=$(this).val();
    $(this).val(Number(val.replace(/\,/g,'')).toLocaleString('en'));
   });
})


  </script>
</head>
<body>
<div class="container">
<div class="row" style="margin-top: 4%;">
<div class="col-md-4"></div>
<div class="col-md-4 well">
<h1 class="text-center">Register Here</h1>
	<form action="include/register.php" method="post" name="reg" onsubmit="return validate()">
		<div class="form-group">
		<label>Full Name:</label>
	<input id="name" name="name" class="form-control" type="text" pattern="^[a-zA-Z ]{2,30}" placeholder=" minimum length 2 "  />
		</div>
		<div class="form-group">
                    <div id="registration-form">
                    <label>User Name:</label>
                    <input class="form-control" type="text" minlength="3" maxlength="15" name="username" autocomplete="off" id="username"  /> <span id="user-result"></span>
                    </div>
		</div>
		<div class="form-group">
		<label>Email:</label>
		<input class="form-control" type="email" name="email" placeholder="@gmail.com" />
		</div>
		<div class="form-group">
		<label>Password:</label>
		<input class="form-control" type="password" name="password"  />
		</div>
    <div class="form-group">
    <label>Mobile:</label>
    <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="mobile number" pattern="[7-9]{1}[0-9]{9}" autocomplete="off"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
            maxlength = "10"/>
    </div>
    	<div class="form-group">
  		<label>Salary:</label>
  		<input class="form-control" type="text" id="testf" name="salary" />
  		</div>

		<button class="btn btn-primary" type="submit" name="register">Register</button>
		<a href="login.php">Already registered! Click Here!</a></td>
	</form>
	<br>
	<?php
	// Show any error or success message
		if(isset($_SESSION['msg'])) {
			echo $_SESSION['msg'];
			session_unset($_SESSION['msg']);
		}
	?>
</div>
<div class="col-md-4"></div>
</div> <!-- End row -->
</div> <!-- End container -->
</body>
</html>
