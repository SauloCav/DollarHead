<?php

	session_start();

	require_once 'config/config.php';

	$consulta = "SELECT qr.id_questao, qr.pergunta, qr.resp_correta, qr.resp_a, qr.resp_b, qr.resp_c, qr.indice_dif, qr.valida, dv.num_denuncias, dv.num_validacoes
		FROM (questoes_respostas qr 
		  JOIN 
          denuncia_validacao dv
          ON 
    	dv.id_quest = qr.id_questao)";
	$cons = $mysql_db->query($consulta) or die($mysql_db->error);

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		foreach ($_POST as $key => $value) {
			$_SESSION["key"] = $key;
			$_SESSION["value"] = $value;
		}
		if ($_SESSION["value"] === 'Editar') {
			header('location: ./questions_operations/edit_quest.php');
		}
		if ($_SESSION["value"] === 'Validar') {
			header('location: ./questions_operations/approve_quest.php');
		}
		if ($_SESSION["value"] === 'Excluir') {
			header('location: ./questions_operations/delete_quest.php');
		}
		if ($_SESSION["value"] === 'Denunciar') {
			$_SESSION["denounces_from_where"] = 0;
			header('location: ./questions_operations/denounce_quest.php');
		}

	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lista de Perguntas</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<link rel="shortcut icon" href="./img/12130brain_109577.ico" />
	<style>
		body {
            font-family: 'Poppins', sans-serif;
            transform: translateY(1%); 
			padding: 50px; 
        }
        .wrapper h1 {
			text-align: center;
		}
        .table {
			text-align: center;  
			width: 1400px; 
			position: absolute;
			top: 5; bottom: 5;
			left: 0; right: 0;
			margin: auto;
		}
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: red;}
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
			<div class="page-header">
				<h1 class="display-5">Lista de Perguntas Adicionadas</h1>
				<a class="btn btn-block btn-link bg-light" href="question_board.php">Sair</a>
				<br>
			</div>

			<table class="table" border="3">
				<thead class="thead-light">
				<tr style="text-align: center;"> 
						<th scope="col">Questão</th> 
						<th scope="col">Resposta Correta</th> 
						<th scope="col">Resposta Incorreta 01</th> 
						<th scope="col">Resposta Incorreta 02</th> 
						<th scope="col">Resposta Incorreta 03</th> 
						<th scope="col">Índice Dificuldade</th> 
						<th scope="col">((V)/(I))</th>
						<th scope="col">Validações/ Denúncias</th> 
						<th scope="col">Validar/ Denunciar</th> 
						<th scope="col">Editar</th> 
						<th scope="col">Excluir</th> 
				</tr>
				</td><?php while($dado = $cons->fetch_array()) { ?> 
				<tr> 
					<th><?php echo $dado['pergunta']; ?></th>
					<th><?php echo $dado['resp_correta']; ?></th> 
					<th><?php echo $dado['resp_a']; ?></th>
					<th><?php echo $dado['resp_b']; ?></th>
					<th><?php echo $dado['resp_c']; ?></th>
					<th><?php echo $dado['indice_dif']; ?></th>
					<th style="text-align: center;"><?php echo $dado['valida']; ?></th>
					<?php $_SESSION["dados"] = $dado;?>

					<form method="post">
						<?php 
						
						if ($dado['valida'] === 'i') {
							echo '<th style="text-align: center;"> Validações: '.$dado["num_validacoes"].'</th>';
							echo '<th> <input type="submit" name='.$_SESSION["dados"][0].' class="btn btn-block btn btn-outline-dark" value="Validar"> </th>';
							echo '<th> <input type="submit" name='.$_SESSION["dados"][0].' class="btn btn-block btn btn-outline-dark" value="Editar"> </th>';
							echo '<th> <input type="submit" name='.$_SESSION["dados"][0].' class="btn btn-block btn btn-outline-dark" value="Excluir"> </th>';
						}
						else {
							echo '<th style="text-align: center;"> Denúncias: '.$dado["num_denuncias"].'</th>';
							echo '<th> <input type="submit" name='.$_SESSION["dados"][0].' class="btn btn-block btn btn-outline-dark" value="Denunciar"> </th>';
								echo '<th style="text-align: center;"> Não editável </th>';
								echo '<th style="text-align: center;"> Não excluível </th>';
						} 
						?> 
					</form>

				</tr> 
				<?php } ?> 
			</table>	

		</section>
	</main>
</body>
</html>

