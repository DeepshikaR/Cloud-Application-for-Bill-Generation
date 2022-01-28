<?php
	require 'Bill.php';

	$s = $_POST['SNO'];
    $n = $_POST['Name'];
    $q = $_POST['Quant'];
    $p = $_POST['Price'];

	addToPrdtList($s, $n, $q, $p);

?>