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
	<title>DollarHead</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<link rel="shortcut icon" href="./img/12130brain_109577.ico" />
	<style>

		@font-face {
			font-family: MeriendaOne-Regular;
			src: url(./fonts/MeriendaOne-Regular.ttf);
		}
		.background {
			background-image: url(./img/welcomeimg.jpeg);
			background-position: bottom;
			background-repeat: no-repeat;
			background-size: cover;
			height: 100vh;
			width: 100%;
		}
		.blur {
			background: rgba(255, 255, 255, 0.2);
			backdrop-filter: blur(4px);
			height: 100vh;
			width: 100%;
		}
        .wrapper{ 
        	width: 800px; 
        	padding: 40px; 
			background-color: rgba(100, 100, 100, 0.5);
			border-radius: 5px;
			margin: auto;
			text-align: center;
			position: absolute;
			left : 25%;
			top: 20%;
			width: 50%;
        }
        .wrapper h1 {
			padding: 10px; 
			text-align: center;
			color:black ;
			-webkit-text-stroke-width: 2px;
			-webkit-text-stroke-color:gold;
			font-family: MeriendaOne-Regular;
			font-size: 4em;
		}
		.wrapper h2 {
			padding: 10px; 
			text-align: center;
			color:gold;
			-webkit-text-stroke-width: 1px;
			-webkit-text-stroke-color:black;
			font-family: MeriendaOne-Regular;
			font-size: 2em;
		}
        .wrapper form .form-group span {color: red;}
	</style>
</head>
<body>
	<main>
	<div class="background">
  		<div class="blur"></div>
	</div>
		<section class="container wrapper">
			<div class="page-header">
				<h1 class="display-5"><strong><strong>MoneyHead</strong></strong></h1>
				<h2 class="display-6"><strong><strong>Bem Vindo(a) <?php echo $_SESSION['nickname']; ?></strong></strong></h1>
			</div>

			<a href="./Game/init.php" class="btn btn-block btn-secondary btn-outline-warning">Jogar</a>
			<a href="edit_account.php" class="btn btn-block btn-secondary btn-outline-warning">Editar Conta</a>
			<a href="question_board.php" class="btn btn-block btn-secondary btn-outline-warning">Painel de Perguntas</a>
			<a href="ranking.php" class="btn btn-block btn-secondary btn-outline-warning" >Hall da Fama</a>
			<a href="stats.php" class="btn btn-block btn-secondary btn-outline-warning">Visualizar Stats</a>
			<a href="logout.php" class="btn btn-block btn-secondary btn-outline-warning" href="welcome.php">Deslogar</a>

		</section>
	</main>
</body>
</html>
