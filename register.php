<?php

	require_once 'config/config.php';

	$username = $password = $confirm_password = $nickname = "";
	$username_err = $password_err = $confirm_password_err = $nickname_err = "";

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		if (empty(trim($_POST['username']))) {
			$username_err = "Insira seu nome de Usuário!";

		} else {

			$sql = 'SELECT id_user FROM users WHERE username = ?';

			if ($stmt = $mysql_db->prepare($sql)) {
	
				$param_username = trim($_POST['username']);
				$stmt->bind_param('s', $param_username);

				if ($stmt->execute()) {

					$stmt->store_result();

					if ($stmt->num_rows == 1) {
						$username_err = 'Esse Nome de Usuário já foi escolhido!';
					} else {
						$username = trim($_POST['username']);
					}
				} else {
					echo "Oops! ${$username}, Algo deu errado, Tente Novamente!";
				}
				$stmt->close();
			} else {
				$mysql_db->close();
			}
		}

		if (empty(trim($_POST['nickname']))) {
			$nickname_err = "Insira seu Nickname!";
		}
		else{
	        $nickname = trim($_POST["nickname"]);
	    }

	    if(empty(trim($_POST["password"]))){
	        $password_err = "Insira uma Senha!";     
	    } elseif(strlen(trim($_POST["password"])) < 6){
	        $password_err = "A Senha deve possuir no mínimo 6 caracteres!";
	    } else{
	        $password = trim($_POST["password"]);
	    }
    
	    if(empty(trim($_POST["confirm_password"]))){
	        $confirm_password_err = "Insira a confirmação da Senha!";     
	    } else{
	        $confirm_password = trim($_POST["confirm_password"]);
	        if(empty($password_err) && ($password != $confirm_password)){
	            $confirm_password_err = "As Senhas não Batem!";
	        }
	    }

	    if (empty($username_err) && empty($password_err) && empty($confirm_err) && empty($nickname_err)) {

			$sql = 'INSERT INTO users (username, password, nickname) VALUES (?,?,?)';

			if ($stmt = $mysql_db->prepare($sql)) {

				$param_username = $username;
				$param_password = password_hash($password, PASSWORD_DEFAULT);
				$param_nickname = $nickname;

				$stmt->bind_param('sss', $param_username, $param_password, $param_nickname);
				echo "Diabo2!";

				if ($stmt->execute()) {
					echo "Diabo3!";

					$param_id_stats = mysqli_insert_id($mysql_db);
		
					$sqlStats = "INSERT INTO stats (n_partidas_jogadas, n_tot_perg_resp, premio_total, n_util_eli_duas_altern, n_derr_erro, n_derr_parada, id_user_stats) 
					VALUES(0, 0, 0, 0, 0, 0, '$param_id_stats')";
							
					if ($stmt = $mysql_db->prepare($sqlStats)) {
						echo "Diabo4!";
						if ($stmt->execute()) {
							header('location: ./index.php');
						} 
						else {
							echo "Algo deu errado, Tente Novamente!";
						}
						$stmt->close();	
					}
				}
			}
			$mysql_db->close();
	    }
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cadastro</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<link rel="shortcut icon" href="./img/12130brain_109577.ico" />
	<style>
		*{
			margin: 0;
			padding: 0;
			font-family: 'Poppins', sans-serif;
		}
		main{
			background-color: transparent;
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
		.container {
			width: 100vw;
			height: 100vh;
			background-color: transparent;
			display: flex;
			flex-direction: row;
			justify-content: center;
			align-items: center;
		}
		.box {
			width: 400px;
			height: 640px;
			padding: 2rem;
			border-radius: 10px;
			background-color: rgb(252, 252, 252);
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 70px rgba(0, 198, 0, 0.6);
		}
		.display-4.pt-3{
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 2.5rem;
			font-weight: 500;
			color: rgb(85, 85, 85);
			
			margin-bottom: 2rem;
		}
		.form-control{
			border-radius: 5px;
		}
		.form-control:focus{
			border-color: #00c600;
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(0, 198, 0, 0.6);
		}
		.CriarConta{
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 12px;
			margin-top: 0.5rem;
		}
		.cadastreButton{
			margin-left: 5px;
			color: #00bd45;
		}
		.cadastreButton:hover{
			color: rgb(0, 145, 0);
		}

		.btn.btn-block.btn-outline-success{
			margin-top: 2rem;
		}
		img{
		width: 200px;
		margin-top: -65px;
		margin-left: 65px;
		}
	</style>
</head>
<body>
	<main>
		<div class="bg-video">
			<video autoplay src="./video/videoplayback.mp4"></video>
		</div>
		<section class="container">
			<div class="box">
				<img src="./img/dollarhead-logo.png" alt="dollarhead-logo">
				<h2 class="display-4 pt-3">Cadastrar-se</h2>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
					<div class="form-group <?php (!empty($username_err))?'has_error':'';?>">
						<label for="username">Nome de Usuário</label>
						<input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
						<span class="help-block"><?php echo $username_err;?></span>
					</div>
					<div class="form-group <?php (!empty($nickname_err))?'has_error':'';?>">
						<label for="nickname">Nickname</label>
						<input type="text" name="nickname" id="nickname" class="form-control" value="<?php echo $nickname ?>">
						<span class="help-block"><?php echo $nickname_err;?></span>
					</div>
					<div class="form-group <?php (!empty($password_err))?'has_error':'';?>">
						<label for="password">Senha</label>
						<input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
						<span class="help-block"><?php echo $password_err; ?></span>
					</div>
					<div class="form-group <?php (!empty($confirm_password_err))?'has_error':'';?>">
						<label for="confirm_password">Confirme a senha</label>
						<input type="password" name="confirm_password" id="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
						<span class="help-block"><?php echo $confirm_password_err;?></span>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-block btn-outline-success" value="Enviar">
						<input type="reset" class="btn btn-block btn-outline-warning" value="Limpar">
					</div>
					<p class="CriarConta">Já possui uma conta? <a  class="cadastreButton" href="index.php">Entre Aqui</a></p>
				</form>
			</div>
		</section>
	</main>
</body>
</html>
