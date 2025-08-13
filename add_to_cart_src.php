<?php
	$subCatArr = array();
	if((isset($_POST['subCatArr'])) && (!empty($_POST['subCatArr']))){
		$subCatArr = $_POST['subCatArr'];
	}

	print"<pre>";
	print_r($_POST['subCatArr']);
	exit;
?>