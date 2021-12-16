<?php

    session_start();
    
    require_once 'config/config.php';

    $new_password = $confirm_password = '';
    $new_username = $new_username_err = '';
    $new_nickname = $new_nickname_err = '';
    $new_password_err = $confirm_password_err = '';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(empty(trim($_POST['new_username']))){
            $new_username_err = 'Insira seu novo Nome de Usuário!';     
        } else {

            $sql = 'SELECT id_user FROM users WHERE username = ?';

            if ($stmt = $mysql_db->prepare($sql)) {

                $param_username = trim($_POST['username']);

                $stmt->bind_param('s', $param_username);

                if ($stmt->execute()) {
                    
                    $stmt->store_result();

                    if ($stmt->num_rows == 1) {
                        $new_username_err = 'Esse Nome de Usuário já foi escolhido!';
                    } else {
                        $new_username = trim($_POST['new_username']);
                    }
                } else {
                    echo "Oops! ${$new_username}, Algo deu errado, Tente Novamente!";
                }

                $stmt->close();
            } else {
                $mysql_db->close();
            }
        }

        if (empty(trim($_POST['new_nickname']))) {
            $new_nickname_err = "Insira seu Nickname!";
        }
        else{
            $new_nickname = trim($_POST["new_nickname"]);
        }

        if(empty(trim($_POST['new_password']))){
            $new_password_err = 'Insira a senha!';     
        } elseif(strlen(trim($_POST['new_password'])) < 6){
            $new_password_err = 'A Senha deve ter no mínimo 6 caracteres!';
        } else{
            $new_password = trim($_POST['new_password']);
        }
    
        if(empty(trim($_POST['confirm_password']))){
            $confirm_password_err = 'Insira a confirmação da senha!';
        } else{
            $confirm_password = trim($_POST['confirm_password']);
            if(empty($new_password_err) && ($new_password != $confirm_password)){
                $confirm_password_err = 'As Senhas nao Batem!';
            }
        }
            
        if(empty($new_password_err) && empty($confirm_password_err) && empty($new_username_err) && empty($new_nickname_err)){

            $param_username = $new_username;
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_nickname = $new_nickname;
            $param_id = $_SESSION["id_user"];

            $sql = "UPDATE users SET username = '$param_username', password = '$param_password', nickname = '$param_nickname' WHERE id_user = '$param_id'";
            
            if($stmt = $mysql_db->prepare($sql)){
             
                if($stmt->execute()){
                    session_destroy();
                    header("location: index.php");
                    exit();
                } else{
                    echo "Oops! Algo deu errado, tente novamente mais tarde!";
                }
                $stmt->close();
            }
            $mysql_db->close();
        }

    }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Conta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="./img/12130brain_109577.ico" />
    <style type="text/css">
    body {
                background-image: url("./img/photo-1579621970563-ebec7560ff3e.jpeg");

                height: 100%;

                background-position:inherit;
                background-size:cover;
        }
        .wrapper h2 {
			text-align: center;
			color:gold;
			-webkit-text-stroke-width: 1px;
			-webkit-text-stroke-color:black;
		}
        .wrapper{ 
            width: 500px; 
        	padding: 50px;  
        }
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: red;}
    </style>
</head>
<body>
    <main class="container wrapper">
        <section>
            <h2>Editar Conta</h2>
            <p class="text-center">Insira suas novas informações:</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                <div class="form-group <?php echo (!empty($new_username_err)) ? 'has-error' : ''; ?>">
                    <label>Novo Nome de Usuário:</label>
                    <input type="text" name="new_username" class="form-control" value="<?php echo $new_username; ?>">
                    <span class="help-block"><?php echo $new_username_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($new_nickname_err)) ? 'has-error' : ''; ?>">
                    <label>Novo Nickname:</label>
                    <input type="text" name="new_nickname" class="form-control" value="<?php echo $new_nickname; ?>">
                    <span class="help-block"><?php echo $new_nickname_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                    <label>Nova Senha:</label>
                    <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                    <span class="help-block"><?php echo $new_password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label>Confirmar Senha:</label>
                    <input type="password" name="confirm_password" class="form-control">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-block btn-primary" value="Enviar">
                    <a class="btn btn-block btn btn-outline-dark" href="delete.php">Remover Conta</a>
                    <a class="btn btn-block btn-link bg-light" href="welcome.php">Cancelar</a>
                </div>
            </form>
        </section>
    </main>    
</body>

</html>
