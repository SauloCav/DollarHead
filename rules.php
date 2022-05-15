<?php
	session_start();

	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: index.php');
		exit;
	}

	require_once 'config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Rules</title>
	<link rel="shortcut icon" href="./img/12130brain_109577.ico" />
	<style>
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
            <h1>rules of the game</h1>
		</section>
	</main>
</body>
</html>
