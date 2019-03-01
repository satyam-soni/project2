<?php

include("classes/config.php");
$conn=db();

if(isset($_POST['Submit']))
{
 $email=($_POST['email']);
 $sql="SELECT email FROM users where  email='$email'";
 $check =  $conn->query($sql) ;
 $num = $check->num_rows;
if($num>0){

   header('Refresh: 1, forgetPass.php?query='.base64_encode($email));
 }
 else {
   echo "Incorrect Email";
    header('Refresh: 1, emailForgetPass.php');
 }
}
 ?>


 <!DOCTYPE html>
 <html>
 <head>
   <title>Forget Password</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script language="javascript" type="text/javascript">


   function valid()
   {
         if(document.newemail.npwd.value=="")
         {
         alert("New Password Filed is Empty !!");
         //document.chngpwd.npwd.focus();
         return false;
        }

  }

  </script>
</head>
<body>
  <p style="color:red;"></p>
  <form name="newemail" action="" method="post" onSubmit="return valid();">
  <table align="center">
  <tr height="50">
  <td>Email :</td>
  <td><input type="email" name="email" id="email"></td>
  </tr>

  <tr>
  <td><a href="login.php">Back   </a></td>
  <td><input type="submit" name="Submit" value="Submit" /></td>
  </tr>
   </table>
  </form>
</body>
</html>
