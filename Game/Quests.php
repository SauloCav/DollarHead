<?php
	session_start();
	require_once 'linked_list.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Jogo</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<link rel="shortcut icon" href="../img/12130brain_109577.ico" />
	<style>
		body {
            font-family: 'Poppins', sans-serif;
            position: relative;
            top: 20%;
            transform: translateY(4%); 
        }
        .wrapper{ 
        	width: 1800px; 
        	padding: 60px; 
        }
        .wrapper h1 {
			text-align: center;
		}
		.wrapper h3 {
			text-align: center;
		}
		.wrapper h5 {
			transform: translateY(-20%); 
			text-align: center;
			color: green;
		}
        .wrapper form .form-group span {color: red;}
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
			<div class="page-header">
				<h1 class="display-5"><strong> Questão <?php echo $_SESSION['quest_atual']; ?></strong></h1>
				<h5 class="display-5"><strong> ( <?php echo $_SESSION[$_SESSION["quest"]][7]; ?> ) </strong></h5>
			</div>

			<?php
				if ($_SERVER['REQUEST_METHOD'] === 'POST') {

					foreach ($_POST as $key => $value) {
						$_SESSION["keys"] = $key;
						$_SESSION["value"] = $value;
					}

					$_SESSION["key"] = $_SESSION[$_SESSION["quest"]][0];

					if(array_key_exists('buttom', $_POST)) {
						$_SESSION['quest_atual'] = $_SESSION['quest_atual'] + 1;

						if ($_SESSION["quest_atual"] === 2) {
							$_SESSION["prize"] = 0;
							header('location: playerOver.php');
						}
						elseif ($_SESSION["quest_atual"] === 3) {
							$_SESSION["prize"] = 500;
							header('location: playerOver.php');
						}
						elseif ($_SESSION["quest_atual"] === 4) {
							$_SESSION["prize"] = 2500;
							header('location: playerOver.php');
						}
						elseif ($_SESSION["quest_atual"] === 5) {
							$_SESSION["prize"] = 25000;
							header('location: playerOver.php');
						}
						elseif ($_SESSION["quest_atual"] === 6) {
							$_SESSION["prize"] = 50000;
							header('location: playerOver.php');
						}
						elseif ($_SESSION["quest_atual"] === 7) {
							$_SESSION["prize"] = 150000;
							header('location: playerOver.php');
						}
						elseif ($_SESSION["quest_atual"] === 8) {
							$_SESSION["prize"] = 0;
							header('location: playerOver.php');
						}
					}
					elseif (array_key_exists('buttomCorrect', $_POST)) {
						$_SESSION['quest_atual'] = $_SESSION['quest_atual'] + 1;

						if ($_SESSION["quest_atual"] === 2) {
							$_SESSION['acertar'] = "Acertar: R$ 5 Mil";
							$_SESSION['parar'] = "Parar: R$ 1 Mil";
							$_SESSION['errar'] = "Errar: R$ 0.5 Mil";
							$_SESSION['quest'] = "quest_2";
							header('location: Quests.php');
						}
						elseif ($_SESSION["quest_atual"] === 3) {
							$_SESSION['acertar'] = "Acertar: R$ 50 Mil";
							$_SESSION['parar'] = "Parar: R$ 5 Mil";
							$_SESSION['errar'] = "Errar: R$ 2.5 Mil";
							$_SESSION['quest'] = "quest_3";
							header('location: Quests.php');
						}
						elseif ($_SESSION["quest_atual"] === 4) {
							$_SESSION['acertar'] = "Acertar: R$ 100 Mil";
							$_SESSION['parar'] = "Parar: R$ 50 Mil";
							$_SESSION['errar'] = "Errar: R$ 25 Mil";
							$_SESSION['quest'] = "quest_4";
							header('location: Quests.php');
						}
						elseif ($_SESSION["quest_atual"] === 5) {
							$_SESSION['acertar'] = "Acertar: R$ 300 Mil";
							$_SESSION['parar'] = "Parar: R$ 100 Mil";
							$_SESSION['errar'] = "Errar: R$ 50 Mil";
							$_SESSION['quest'] = "quest_5";
							header('location: Quests.php');
						}
						elseif ($_SESSION["quest_atual"] === 6) {
							$_SESSION['acertar'] = "Acertar: R$ 500 Mil";
							$_SESSION['parar'] = "Parar: R$ 300 Mil";
							$_SESSION['errar'] = "Errar: R$ 150 Mil";
							$_SESSION['quest'] = "quest_6";
							header('location: Quests.php');
						}
						elseif ($_SESSION["quest_atual"] === 7) {
							$_SESSION['acertar'] = "Acertar: R$ 1 Milhão";
							$_SESSION['parar'] = "Parar: R$ 500 Mil";
							$_SESSION['errar'] = "Errar: R$ 0 Mil";
							$_SESSION['quest'] = "quest_7";
							header('location: Quests.php');
						}
						elseif ($_SESSION["quest_atual"] === 8) {
							$_SESSION["prize"] = 1000000;
							header('location: playerWin.php');
						}
					}
					elseif (array_key_exists('parar', $_POST)) {
						$_SESSION['quest_atual'] = $_SESSION['quest_atual'] + 1;

						if ($_SESSION["quest_atual"] === 2) {
							$_SESSION["prize"] = 0;
							header('location: playerStop.php');
						}
						elseif ($_SESSION["quest_atual"] === 3) {
							$_SESSION["prize"] = 1000;
							header('location: playerStop.php');
						}
						elseif ($_SESSION["quest_atual"] === 4) {
							$_SESSION["prize"] = 5000;
							header('location: playerStop.php');
						}
						elseif ($_SESSION["quest_atual"] === 5) {
							$_SESSION["prize"] = 50000;
							header('location: playerStop.php');
						}
						elseif ($_SESSION["quest_atual"] === 6) {
							$_SESSION["prize"] = 100000;
							header('location: playerStop.php');
						}
						elseif ($_SESSION["quest_atual"] === 7) {
							$_SESSION["prize"] = 300000;
							header('location: playerStop.php');
						}
						elseif ($_SESSION["quest_atual"] === 8) {
							$_SESSION["prize"] = 500000;
							header('location: playerStop.php');
						}
						
					}

					if ($_SESSION["value"] === 'Denunciar') {
						$_SESSION["denounces_from_where"] = 1;
						header('location: ../questions_operations/denounce_quest.php');
					}

				}
			?>

			<br/><h3 style="text-align: center;" class="display-5"><strong> <?php echo $_SESSION[$_SESSION["quest"]][1];?> </strong></h3>

			<form method="post">

				<?php

					if (array_key_exists('elimina', $_POST)) {

						$_SESSION["elimina_alternativas"] = 1;

						$divs = array('<div id="divFirst"><input type="submit" name="buttomCorrect" 
						class="btn btn-block btn btn-outline-primary" value= "'.$_SESSION[$_SESSION["quest"]][2].'" /> <br/></div>',
						'<div id="divFirst"><input type="submit" name="buttom" 
						class="btn btn-block btn btn-outline-primary" value= "'.$_SESSION[$_SESSION["quest"]][3].'" /> <br/></div>');

						shuffle($divs);

						echo $divs[0];
						echo $divs[1];
						
					}
					else {

						$divs = array('<div id="divFirst"><input type="submit" name="buttomCorrect" 
						class="btn btn-block btn btn-outline-primary" value= "'.$_SESSION[$_SESSION["quest"]][2].'" /> <br/></div>',
						'<div id="divFirst"><input type="submit" name="buttom" 
						class="btn btn-block btn btn-outline-primary" value= "'.$_SESSION[$_SESSION["quest"]][3].'" /> <br/></div>',
						'<div id="divFirst"><input type="submit" name="buttom" 
						class="btn btn-block btn btn-outline-primary" value= "'.$_SESSION[$_SESSION["quest"]][4].'" /> <br/></div>',
						'<div id="divFirst"><input type="submit" name="buttom" 
						class="btn btn-block btn btn-outline-primary" value= "'.$_SESSION[$_SESSION["quest"]][5].'" /> <br/></div>');

						shuffle($divs);

						echo $divs[0];
						echo $divs[1];
						echo $divs[2];
						echo $divs[3];

					}

					if ($_SESSION["elimina_alternativas"] === 0) {
						echo '<input type="submit" name="elimina" class="btn btn-block btn btn-warning"value="Eliminar duas Alternativas">';
					}

					echo "<br/><br/>";
					echo '<input type="submit" name="parar" class="btn btn-block btn btn-dark" value="Parar">';

					echo "<br/><br/>";
					echo '<input type="submit" name='.$_SESSION["quest_1"][0].' class="btn btn-block btn btn-danger" value="Denunciar">';
	
				?>
				
			</form>

			<div id="prize">
				<h3><br><strong> <?php echo $_SESSION['acertar']; ?> || <?php echo $_SESSION['parar']; ?> || <?php echo $_SESSION['errar'];?> </strong></h3>
			</div>

		</section>
	</main>
</body>
</html>
