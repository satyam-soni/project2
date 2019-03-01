<?php
    include "config.php";
   //session_start();
      class User{

	        public $db;



	        /*** for registration process ***/
	        public function reg_user($name, $username, $password, $email, $mobile, $salary){
               $conn = db();

	           // $password = md5($password);
	            $sql="SELECT * FROM users WHERE username='$username' OR email='$email'";

	            //checking if the username or email is available in db
              $check =  $conn->query($sql) ;
              $count_row = $check->num_rows;

	            //if the username is not in db then insert to the table
	            if ($count_row == 0){

	              $sql1= "INSERT INTO users(username, password, name, email, mobile , salary) VALUES('$username', '$password', '$name', '$email', '$mobile', '$salary')";
	              $result = $conn->query($sql1) or die(mysqli_connect_errno()."Data cannot inserted");
	                return $result;
	            }
	            else { return false;}
	        }

	        /*** for login process ***/
	        public function check_login($email, $password){

           $conn = db();


	           // $password = md5($password);
	            $sql2="SELECT * from users WHERE email='$email' AND password='$password'";

	            //checking if the username is available in the table
              $result = $conn->query($sql2);
             $user_data = $result->fetch_assoc();
              $count_row = $result->num_rows;



              if ($count_row == 1)
              {

                  $_SESSION['login'] = true;

                  $_SESSION['uid'] = $user_data['id'];//user_data id variable
                  //  $_SESSION['username'] = $user_data['username'];

                   $_SESSION['email'] = $user_data['email'];


                  return TRUE;
              }

	            else{

               $_SESSION['msg']="email or password not valid";

         header('location:../login.php');
         return false;
	            }
	        }


         /*** for showing the username or fullname ***/
	        public function get_name($uid){
              $conn = db();
	            $sql3="SELECT name FROM users WHERE id = $uid";
	            $result = $conn->query($sql3);
	            $user_data = $result->fetch_assoc();
	            echo $user_data['name'];
	        }

	        /*** starting the session ***/
	        public function get_session(){
	           return $_SESSION['login'];



	        }

	        public function user_logout() {
	            $_SESSION['login'] = FALSE;
                session_unset();
	              session_destroy();

	        }
  }
?>
