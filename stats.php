<?php

    session_start();

	require_once 'config/config.php';

    $param_id = $_SESSION['id_user'];

	$consulta = "SELECT * FROM stats WHERE id_user_stats = '$param_id'";
    $cons = $mysql_db->query($consulta) or die($mysql_db->error);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Stats</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="./img/12130brain_109577.ico" />
	<style>
        body {
            font-family: 'Poppins', sans-serif;
            position: relative;
            top: 20%;
            transform: translateY(75%); 
        }
        .wrapper{ 
        	width: 1800px; 
        	padding: 20px; 
        }
        .wrapper h1 {
			text-align: center;
		}
        .wrapper form .form-group span {color: red;}
        .table {
			text-align: center;  
		}
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
            <h1 class="display-5"><strong>Stats de <?php echo $_SESSION['nickname']; ?></strong></h1>
                <br>    

                <?php $pos = 5; ?>

                <table class="table" border="3">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Nº DE PARTIDAS JOGADAS</th>
                        <th scope="col">Nº DE DERROTAS POR ERRO</th>
                        <th scope="col">Nº DE DERROTAS POR PARADA</th>
                        <th scope="col">Nº DE ELIMINAÇÕES DE DUAS ALTERNATIVAS</th>
                        <th scope="col">PREMIAÇÃO TOTAL ACUMULADA</th>
                        <th scope="col">Nº DE CONTRIBUIÇÕES</th>
                        <th scope="col">NÍVEL DO USUÁRIO</th>
                      </tr>       
                    </td><?php while($dado = $cons->fetch_array()) { ?> 
                        <tr> 
                            <th><?php echo $dado['n_partidas_jogadas']; ?></th>
                            <th><?php echo $dado['n_derr_erro']; ?></th>
                            <th><?php echo $dado['n_derr_parada']; ?></th>
                            <th><?php echo $dado['n_util_eli_duas_altern']; ?></th>
                            <th><?php echo $dado['premio_total']; ?></th>
                            <th><?php echo $dado['num_contributions']; ?></th>
                            <th><?php echo $dado['user_level']; ?></th>
                        </tr> 
                    <?php } ?> 
                </table>

                <a class="btn btn-block btn-link bg-light" href="welcome.php">Sair</a>
                
		</section>
	</main>
</body>
</html>
