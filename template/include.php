<?php
	require_once 'core/config.php';
	require_once 'core/function.php';
	$conn = connect();
	$cat = getAllCatInfo($conn);
?>