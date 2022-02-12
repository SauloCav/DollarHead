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
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<link rel="shortcut icon" href="./img/12130brain_109577.ico" />

	<style>
		*{
			--green: #00c600;
			--dark-green: #005200;
			font-family: 'Poppins', sans-serif;
		}

		.bg-video {
			position: absolute;
			top: 0;
			left: 0;
			z-index: -1;
			width: 100%;
			height: 100%;
			overflow: hidden;
		}
		.bg-video > video {
			width: 100%;
		}

        .wrapper{
			position: absolute;
			height: 100vh;
			text-align: center;
			
        	padding: 40px; 

			right: 0%;
			left: 63%;
			background-color: rgb(248, 248, 248);

        }
        .wrapper h1 {
			padding: 5px; 
			text-align: center;
			color:rgb(42, 194, 37) ;
			font-size: 50px;
		}
		.wrapper h2 {
			padding: 10px; 
			text-align: center;
			color: rgb(102, 102, 102);
			font-size: 18px;
		}
		a.btn.btn-block.btn-secondary.btn-outline-warning{
			width: 350px;
			height: auto;
			border-radius: 50px;
			border-color: rgb(50,50,50);
			border-color: var(--green);
			background-color: var(--dark-green);
			box-shadow: 3px 3px 15px var(--green) inset;
			box-shadow: -3px -3px 15px var(--green) inset;
			color: rgb(255, 255, 255);

			margin-top:0;
			margin-bottom: 5%;
		}
		a.btn.btn-block.btn-secondary.btn-outline-warning:hover{
			background-color: rgb(31, 255, 1);
		}
		.buttons-menu{
			position:absolute;
			left: 14.2vh;
		}
		img#dollarhead-logo{
			width: 45vh;
		}
		img#money-icon{
			justify-content: center;
			justify-items: center;
			width: 15vh;
			margin-top:0;
			margin-top: 50vh;
		}
		.txtSubtitle{
			margin-top: 10px;
			margin-bottom: 15px;
		}
	</style>
</head>
<body>
	<main>
		<div class="bg-video">
			<video autoplay src="./video/videoplayback.mp4"></video>
		</div>

		<section class="wrapper">
			
			<div class="page-header">
				<img id="dollarhead-logo" src="./img/dollarhead-logo.png" alt="logo">
				<h2 class="display-6 txtSubtitle"><strong>Bem Vindo(a) <?php echo $_SESSION['nickname']; ?></strong></h1>
			</div>
			<div class="section buttons-menu">
				<a href="./Game/init.php" class="btn btn-block btn-secondary btn-outline-warning">Jogar</a>
				<a href="edit_account.php" class="btn btn-block btn-secondary btn-outline-warning">Editar Conta</a>
				<a href="question_board.php" class="btn btn-block btn-secondary btn-outline-warning">Painel de Perguntas</a>
				<a href="ranking.php" class="btn btn-block btn-secondary btn-outline-warning" >Hall da Fama</a>
				<a href="stats.php" class="btn btn-block btn-secondary btn-outline-warning">Visualizar Stats</a>
				<a href="logout.php" class="btn btn-block btn-secondary btn-outline-warning" href="welcome.php">Sair</a>
			</div>
			<div class="page-footer">
				<img id="money-icon" src="./img/money-icon.png" alt="logo">
			</div>
		
		</section>
	</main>
</body>
</html>
