  <?php
	define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'Satyam@1998');
	define('DB_DATABASE', 'Project1');

  function db(){
    static $conn;

    if($conn === NULL){
      $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }

    return $conn;
  }
?>
