<?php include '../DAO/coloniadeferiasDAO.php' ?>

<?php

	$coloniadeferias = new coloniadeferiasDAO();
	$results = $coloniadeferias->getAll();
	echo $results;

?>