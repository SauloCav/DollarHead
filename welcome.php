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
	<title>Quem Quer Dinheiro</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<link rel="shortcut icon" href="./img/12130brain_109577.ico" />
	<style>

		body {
			background-image: url(./img/Money_Cash-min.jpg);
		}
        .wrapper{ 
        	width: 800px; 
        	padding: 120px; 
        }
        .wrapper h1 {
			padding: 20px; 
			text-align: center;
			color:gold;
			-webkit-text-stroke-width: 1px;
			-webkit-text-stroke-color:black;
		}
        .wrapper form .form-group span {color: red;}
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
			<div class="page-header">
				<h1 class="display-5"><strong><strong>Bem Vindo ao "Quem Quer Dinheiro" <?php echo $_SESSION['nickname']; ?></strong></strong></h1>
			</div>

			<a href="./Game/init.php" class="btn btn-block btn btn-success">Jogar</a>
			<a href="edit_account.php" class="btn btn-block btn btn-warning">Editar Conta</a>
			<a href="question_board.php" class="btn btn-block btn btn-info">Painel de Perguntas</a>
			<a href="ranking.php" class="btn btn-block btn btn btn-primary" >Hall da Fama</a>
			<a href="stats.php" class="btn btn-block btn btn-dark">Visualizar Stats</a>
			<a href="logout.php" class="btn btn-block btn-link bg-light" href="welcome.php">Deslogar</a>

		</section>
	</main>
</body>
</html>
