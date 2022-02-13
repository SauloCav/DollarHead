<?php

    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      header("location: welcome.php");
      exit;
    }

    require_once 'config/config.php';

    $username = $password = '';
    $username_err = $password_err = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(empty(trim($_POST['username']))){
          $username_err = 'O Nome de Usuário deve ser informado!';
        } else{
          $username = trim($_POST['username']);
        }

        if(empty(trim($_POST['password']))){
          $password_err = 'A Senha deve ser informada!';
        } else{
          $password = trim($_POST['password']);
        }

        if (empty($username_err) && empty($password_err)) {
          
          $sql = 'SELECT id_user, username, password, nickname FROM users WHERE username = ?';

          if ($stmt = $mysql_db->prepare($sql)) {

            $param_username = $username;

            $stmt->bind_param('s', $param_username);

            if ($stmt->execute()) {
    
              $stmt->store_result();

                if ($stmt->num_rows == 1) {
                  $stmt->bind_result($id_user, $username, $hashed_password, $nickname);

                  if ($stmt->fetch()) {
                      if (password_verify($password, $hashed_password)) {
                          session_start();

                          $_SESSION['loggedin'] = true;
                          $_SESSION['id_user'] = $id_user;
                          $_SESSION['username'] = $username;
                          $_SESSION['nickname'] = $nickname;

                          header('location: welcome.php');
                      } 
                      else {
                        $password_err = 'Senha Inválida';
                      }
                  }

                } else {
                  $username_err = "Esse Nome de Usuário NÃO existe!";
                }
            } else {
              echo "Oops! Algo deu errado, Tente novamente!";
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
  <title>Entrar</title>
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
      main{
          background-color: transparent;
      }
      .box {
          width: 400px;
          height: 450px;
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
          margin-top: 2rem;
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
        <h2 class="display-4 pt-3">Entrar</h2>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
          
          <div class="form-group <?php (!empty($username_err))?'has_error':'';?>">
            <label for="username">Nome de Usuário</label>
            <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
            <span class="help-block"><?php echo $username_err;?></span>
          </div>

          <div class="form-group <?php (!empty($password_err))?'has_error':'';?>">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
            <span class="help-block"><?php echo $password_err;?></span>
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-block btn-outline-success" value="Entrar">
          </div>
          <p class="CriarConta">Ainda não possui uma conta? <a class="cadastreButton" href="register.php"> Cadastre-se</a></p>

        </form>
      </div>
    </section>
  </main>
</body>
</html>
