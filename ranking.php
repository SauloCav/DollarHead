<?php

    session_start();

	require_once 'config/config.php';

	$ranking = "SELECT ra.pontuacao, us.nickname, ra.data_pont
	FROM (ranking ra 
		  JOIN 
          users us
          ON 
          ra.id_usuario = us.id_user) 
	ORDER BY pontuacao DESC LIMIT 10";      

	$ran = $mysql_db->query($ranking) or die($mysql_db->error);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hall da Fama</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="./img/12130brain_109577.ico" />
	<style>
        body {
            font-family: 'Poppins', sans-serif;
            position: relative;
            top: 20%;
            transform: translateY(8%); 
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
        .wrapper form .form-group span {color: red;}
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
				<h1 class="display-5"><strong>Hall da Fama<strong></h1>
                <br>

                <?php $pos = 1; ?>

                <table class="table" border="3">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Posição</th>
                        <th scope="col">Nickname</th>
                        <th scope="col">Pontuação</th>
                        <th scope="col">Data e Hora da Jogada</th>
                      </tr>       
                    </td><?php while($dado = $ran->fetch_array()) { ?> 
                        <tr> 
                            <th><?php echo $pos; ?></th>
                            <th><?php echo $dado['nickname']; ?></th>
                            <th><?php echo $dado['pontuacao']; ?></th> 
                            <th><?php echo $dado['data_pont']; ?></th>
                            <?php $pos++; ?>
                        </tr> 
                    <?php } ?> 
                </table>

                <a class="btn btn-block btn-link bg-light" href="welcome.php">Sair</a>
                
		</section>
	</main>
</body>
</html>
