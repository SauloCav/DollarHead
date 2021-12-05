<?php

	session_start();

	require_once '../config/config.php';
	require_once 'linked_list.php';

	$_SESSION["elimina_alternativas"] = 0;
	$_SESSION['n_respostas'] = 0;
	$_SESSION["quest_1"] = $MyList->findObject(0);
	$_SESSION["quest_2"] = $MyList->findObject(1);
	$_SESSION["quest_3"] = $MyList->findObject(2);
	$_SESSION["quest_4"] = $MyList->findObject(3);
	$_SESSION["quest_5"] = $MyList->findObject(4);
	$_SESSION["quest_6"] = $MyList->findObject(5);
	$_SESSION["quest_7"] = $MyList->findObject(6);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tela Inicial</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<link rel="shortcut icon" href="../img/12130brain_109577.ico" />
	<style>
        .wrapper{ 
        	width: 800px; 
        	padding: 140px; 
        }
        .wrapper h1 {text-align: center}
        .wrapper form .form-group span {color: red;}
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
			<div class="page-header">
				<h1 class="display-5">Está preparado <?php echo $_SESSION['nickname']; ?>?</h1> <br><br>
			</div>

			<a href="Quest_01.php" class="btn btn-block btn btn-outline-success">Iniciar</a>
            <a href="../welcome.php" class="btn btn-block btn-link bg-light">Sair</a>

		</section>
	</main>
</body>
</html>
