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
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<link rel="shortcut icon" href="./img/12130brain_109577.ico" />
	<style>
		body {
                  background-image: url("./img/photo-1592496001020-d31bd830651f.jpeg");

                  height: 100%;

                  background-position:inherit;
                  background-size:cover;
      }
        .wrapper{ 
        	width: 500px; 
        	padding: 20px; 
        }
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: red;}
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
			<h2 class="display-4 pt-3">Cadastrar-se</h2>
        	<p class="text-center">Insira suas Informações para Cadastrar-se</p>
        	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

        		<div class="form-group <?php (!empty($username_err))?'has_error':'';?>">
        			<label for="username">Nome de Usuário:</label>
        			<input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
        			<span class="help-block"><?php echo $username_err;?></span>
        		</div>

				<div class="form-group <?php (!empty($nickname_err))?'has_error':'';?>">
        			<label for="nickname">Nickname:</label>
        			<input type="text" name="nickname" id="nickname" class="form-control" value="<?php echo $nickname ?>">
        			<span class="help-block"><?php echo $nickname_err;?></span>
        		</div>

        		<div class="form-group <?php (!empty($password_err))?'has_error':'';?>">
        			<label for="password">Senha:</label>
        			<input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
        			<span class="help-block"><?php echo $password_err; ?></span>
        		</div>

        		<div class="form-group <?php (!empty($confirm_password_err))?'has_error':'';?>">
        			<label for="confirm_password">Confirme sua Senha:</label>
        			<input type="password" name="confirm_password" id="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
        			<span class="help-block"><?php echo $confirm_password_err;?></span>
        		</div>

        		<div class="form-group">
        			<input type="submit" class="btn btn-block btn-outline-success" value="Enviar">
        			<input type="reset" class="btn btn-block btn-outline-primary" value="Limpar">
        		</div>
        		<p>Já possui uma conta? <a href="index.php">Entre Aqui</a></p>
        	</form>
		</section>
	</main>
</body>
</html>
