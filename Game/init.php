<?php

	session_start();

	require_once '../config/config.php';

	$_SESSION["prize"] = 0;

	$quests_one = "SELECT * FROM questoes_respostas WHERE valida = 'v' AND indice_dif = 1"; 
    $ques_one = $mysql_db->query($quests_one) or die($mysql_db->error);
    $row_dif_1 = mysqli_fetch_all($ques_one);
    shuffle($row_dif_1);

    $quests_two = "SELECT * FROM questoes_respostas WHERE valida = 'v' AND indice_dif = 2"; 
    $ques_two = $mysql_db->query($quests_two) or die($mysql_db->error);
    $row_dif_2 = mysqli_fetch_all($ques_two);
    shuffle($row_dif_2);

    $quests_three = "SELECT * FROM questoes_respostas WHERE valida = 'v' AND indice_dif = 3"; 
    $ques_three = $mysql_db->query($quests_three) or die($mysql_db->error);
    $row_dif_3 = mysqli_fetch_all($ques_three);
    shuffle($row_dif_3);

    $param_id = $_SESSION['id_user'];

	$consulta = "SELECT * FROM stats WHERE id_user_stats = '$param_id'";
    $cons = $mysql_db->query($consulta) or die($mysql_db->error);
	$dado = $cons->fetch_array();

	if($dado['user_level'] == 'Rasga Moeda'){
		$_SESSION["elimina_alternativas"] = 2;
	}
	else{
		$_SESSION["elimina_alternativas"] = 1;
	}
	$_SESSION['n_respostas'] = 0;
	$_SESSION['acertar'] = "Acertar: R$ 1 Mil";
	$_SESSION['parar'] = "Parar: R$ 0 Mil";
	$_SESSION['errar'] = "Errar: R$ 0 Mil";
	$_SESSION['quest_atual'] = 1;
	$_SESSION["quest_1"] = $row_dif_1[1];
	$_SESSION["quest_2"] = $row_dif_1[2];
	$_SESSION["quest_3"] = $row_dif_2[1];
	$_SESSION["quest_4"] = $row_dif_2[2];
	$_SESSION["quest_5"] = $row_dif_2[3];
	$_SESSION["quest_6"] = $row_dif_3[1];
	$_SESSION["quest_7"] = $row_dif_3[2];
	$_SESSION['quest'] = "quest_1";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tela Inicial</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<link rel="shortcut icon" href="../img/12130brain_109577.ico" />
	<style>
		body {
            font-family: 'Poppins', sans-serif;
            position: relative;
            top: 20%;
            transform: translateY(60%); 
        }
        .wrapper{ 
        	width: 1800px; 
        	padding: 60px; 
        }
        .wrapper h1 {
			text-align: center;
		}
        .wrapper form .form-group span {color: red;}
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
			<div class="page-header">
				<h1 class="display-5"><strong>Está preparado(a) <?php echo $_SESSION['nickname']; ?>?<strong></h1> <br><br>
			</div>

			<a href="Quests.php" class="btn btn-block btn btn-outline-success">Iniciar</a>
            <a href="../welcome.php" class="btn btn-block btn-link bg-light">Sair</a>

		</section>
	</main>
</body>
</html>
