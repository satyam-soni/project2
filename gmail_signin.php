<?php
  session_start();
  include "../classes/config.php";

   $conn = db();

   $email = $_REQUEST['email'];
   $name = $_REQUEST['fullname'];

   if(!empty($email) && !empty($name)){
//echo 1; die;
        $sql = "SELECT * FROM users WHERE email = '$email' AND type = 2";
      $result = $conn->query($sql);
      $data = $result->fetch_assoc();
    //  print_r($result);
      //die();
        $count_row = $result->num_rows;

        if($count_row > 0){
          $_SESSION['login'] = true;

          //echo "email is match";

          $_SESSION['uid'] = $data['id'];
        $_SESSION['name'] = $data['name'];

           $_SESSION['email'] = $data['email'];

           	//header('location: ../datatable/index.php');
            //$res = "success";
          //  $json_res = json_encode($res);
          //  echo $json_res;
          echo json_encode( array('success' => true ));
            die();

        }
        else{
                $sql2 = "INSERT INTO users (email,name,type) VALUES('$email','$name',2)";
                 $result = $conn->query($sql2);

              //  header('location': ../datatable/index.php);


              $_SESSION['login'] = true;


               $sql3 = "SELECT LAST_INSERT_id()";
               $result2 = $conn->query($sql3);
               $data = $result2->fetch_assoc();

            $_SESSION['uid'] = $data['id'];


            $_SESSION['name'] = $name;

               $_SESSION['email'] = $email;

               print_r($_SESSION);die;

              echo json_encode( array('success' => true ));

               //$json_res = json_encode($res);
               //echo $json_res;
               //die();

                   }
   }


   //echo "success";


 ?>
