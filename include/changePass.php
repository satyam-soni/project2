<?php
session_start();
include("../classes/config.php");
$conn=db();

if(isset($_POST['Submit']))
{
 $oldpass=($_POST['opwd']);
 $email=$_SESSION['email'];
 $newpassword=($_POST['npwd']);

 $sql="SELECT password FROM users where password ='$oldpass' AND email='$email'";
 $check =  $conn->query($sql) ;
 $num = $check->num_rows;

if($num > 0)
{

 $sql1="UPDATE users set password='$newpassword' where email='$email'";
 $check =  $conn->query($sql1) ;
$_SESSION['msg1']="Password Changed Successfully !!";
header('Refresh: 2, ../home.php');
}
else
{
$_SESSION['msg1']="Old Password not match !!";
}
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Change Password</title>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<script language="javascript" type="text/javascript">


function valid()
{
if(document.chngpwd.opwd.value=="")
{
alert("Old Password Filed is Empty !!");
//document.chngpwd.opwd.focus();
return false;
}
else if(document.chngpwd.npwd.value=="")
{
alert("New Password Filed is Empty !!");
//document.chngpwd.npwd.focus();
return false;
}
else if(document.chngpwd.cpwd.value=="")
{
alert("Confirm Password Filed is Empty !!");
//document.chngpwd.cpwd.focus();
return false;
}
else if(document.chngpwd.npwd.value!= document.chngpwd.cpwd.value)
{
alert("Password and Confirm Password Field do not match  !!");
//document.chngpwd.cpwd.focus();
return false;
}
return true;
}
</script>
</head>
<body>
  <p style="color:red;"><?php if(isset($_SESSION['msg1'])){echo $_SESSION['msg1'];}?>  <?php echo $_SESSION['msg1']= "";?></p>
  <form name="chngpwd" action="" method="post" onSubmit="return valid();">
  <table align="center">
  <tr height="50">
  <td>Old Password :</td>
  <td><input type="password" name="opwd" id="opwd"></td>
  </tr>
  <tr height="50">
  <td>New Passowrd :</td>
  <td><input type="password" name="npwd" id="npwd"></td>
  </tr>
  <tr height="50">
  <td>Confirm Password :</td>
  <td><input type="password" name="cpwd" id="cpwd"></td>
  </tr>
  <tr>
  <td><a href="../home.php">Back   </a></td>
  <td><input type="submit" name="Submit" value="Change Passowrd" /></td>
  </tr>
   </table>
  </form>
</body>
</html>
