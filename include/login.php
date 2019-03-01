<?php
     session_start();
	    include_once ("../classes/user.php");



    if (isset($_REQUEST['login'])) {
			$user = new User();

	        extract($_REQUEST);



	        $login = $user->check_login($email, $password);

	        if ($login) {
            // Registration Success
            if(!empty($_POST["remember"])) {

              //COOKIES for username
               setcookie ("email",$_POST["email"],time()+(30*86400), "/");

              //COOKIES for password
              setcookie ("password",$_POST["password"],time()+(30*86400), "/"); // 30days

           }else {
                 if(isset($_COOKIE["user_login"]))
                {
                     setcookie ("user_login","");
                }
                 if(isset($_COOKIE["password"]))
                 {
                   setcookie ("password","");
  	            	}
         	}

         header("location:../home.php");
        exit();
    	} else {
    	// login Failed

	     	die();
		}
	    }
?>
