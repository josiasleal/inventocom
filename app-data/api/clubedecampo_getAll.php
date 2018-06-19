<?php include '../DAO/clubedecampoDAO.php' ?>

<?php

	$clubedecampo = new clubedecampoDAO();
	$results = $clubedecampo->getAll();
	echo $results;

?>