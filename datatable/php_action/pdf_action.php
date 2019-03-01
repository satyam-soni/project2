<?php
$host = 'localhost';
$user = 'root';
$pass = 'girnar';
$db = 'datatables_crud';

$connect = new mysqli($host, $user, $pass, $db) or die("Cannot connect." . mysql_error());
mysql_select_db($db) or die("Cannot connect.");

$query = "SELECT id,name,contact,active,address from members";

$result = mysql_query($query) or die('Error, query failed');

    while(mysql_fetch_array($result))
    {
        header("Content-length: $size");
        header("Content-type: $type");
        header("Content-Disposition: inline; filename=$username-$description.pdf");
    }
    echo $content;
    mysql_close($link);
    exit;

?>
<script src="http://www.fpdf.org/"></script>
<script src="http://www.tcpdf.org/"></script>
