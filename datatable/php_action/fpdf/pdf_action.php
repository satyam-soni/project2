<?php
include_once("db_connect.php");

$sql=" SELECT id,name,contact,active,address FROM members";

$resultset=$mysqli_query($conn,$sql) or die("datatbase error:".mysqli_error($conn));
require('../fpdf/fpdf.php');
$pdf=new FPDF();
$pdf=AddPage();
$pdf=setFont('Arial','B',12);
while ($field_info = mysqli_fetch_field($resultset)) {
$pdf->Cell(47,12,$field_info->name,1);
}
while($rows = mysqli_fetch_assoc($resultset)) {
$pdf->SetFont('Arial','',12);
$pdf->Ln();
foreach($rows as $column) {
$pdf->Cell(47,12,$column,1);
}
}
$pdf->Output();
?>
