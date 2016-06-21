<?php

/***************************
  Sample using an FDF file
****************************/

require('../src/fpdm.php');

$pdf = new MaDnh\FPDM\FPDM('template.pdf', 'fields.fdf');
$pdf->Merge();
$pdf->Output();
?>
