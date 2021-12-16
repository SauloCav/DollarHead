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
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="./img/12130brain_109577.ico" />
	<style>
        body {
                background-image: url("./img/photo-1638913658828-afb88c3d4d11.jpeg");

                height: 100%;

                background-position:inherit;
                background-size:cover;
        }
        .wrapper{ 
        	width: 1400px; 
        	padding: 100px; 
        }
        .wrapper h1 {
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
            <h1 class="display-5"><strong>Stats de <?php echo $_SESSION['nickname']; ?></strong></h1>
                <br>    

                <?php $pos = 1; ?>

                <table class="table" border="1">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Nº DE PARTIDAS JOGADAS</th>
                        <th scope="col">Nº DE PERGUNTAS RESPONDIDAS</th>
                        <th scope="col">Nº DE DERROTAS POR ERRO</th>
                        <th scope="col">Nº DE DERROTAS POR PARADA</th>
                        <th scope="col">Nº DE ELIMINAÇÕES DE DUAS ALTERNATIVAS</th>
                        <th scope="col">PREMIAÇÃO TOTAL ACUMULADA</th>
                      </tr>       
                    </td><?php while($dado = $cons->fetch_array()) { ?> 
                        <tr> 
                            <th><?php echo $dado['n_partidas_jogadas']; ?></th>
                            <th><?php echo $dado['n_tot_perg_resp']; ?></th>
                            <th><?php echo $dado['n_derr_erro']; ?></th>
                            <th><?php echo $dado['n_derr_parada']; ?></th>
                            <th><?php echo $dado['n_util_eli_duas_altern']; ?></th>
                            <th><?php echo $dado['premio_total']; ?></th>
                        </tr> 
                    <?php } ?> 
                </table>

                <a class="btn btn-block btn-link bg-light" href="welcome.php">Sair</a>
                
		</section>
	</main>
</body>
</html>
