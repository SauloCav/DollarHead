<?php

    session_start();

	require_once 'config/config.php';

	$ranking = "SELECT ra.pontuacao, us.nickname
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
                background-image: url("./img/photo-1562953842-188bb7ce6588.jpeg");

                height: 100%;

                background-position: center;
                background-size: cover;
        }
        .wrapper{ 
        	width: 1000px;
        	padding: 20px;  
        }
        .wrapper h1 {text-align: center}
        .wrapper form .form-group span {color: red;}
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
				<h1 class="display-5"><strong>Hall da Fama<strong></h1>
                <br>

                <?php $pos = 1; ?>

                <table class="table" border="1">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">POSIÇÃO</th>
                        <th scope="col">PONTUAÇÃO</th>
                        <th scope="col">NICKNAME DO JOGADOR</th>
                      </tr>       
                    </td><?php while($dado = $ran->fetch_array()) { ?> 
                        <tr> 
                            <th><?php echo $pos; ?></th>
                            <th><?php echo $dado['pontuacao']; ?></th> 
                            <th><?php echo $dado['nickname']; ?></th>
                            <?php $pos++; ?>
                        </tr> 
                    <?php } ?> 
                </table>

                <a class="btn btn-block btn-link bg-light" href="welcome.php">Sair</a>
                
		</section>
	</main>
</body>
</html>
