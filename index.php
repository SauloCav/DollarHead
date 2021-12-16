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
  <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
  <link rel="shortcut icon" href="./img/12130brain_109577.ico" />
  <style>
      body {
                  background-image: url("./img/photo-1592495989201-d5162c4267ce.jpeg");

                  height: 100%;
                  background-size:auto;
                  text-align: left;
      }
      .wrapper h2 {
        text-align: center;
        color:gold;
        -webkit-text-stroke-width: 1px;
        -webkit-text-stroke-color:black;
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
      <h2 class="display-4 pt-3">Entrar:</h2>
          <p class="text-center">Insira seu Nome e Senha:</p>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <div class="form-group <?php (!empty($username_err))?'has_error':'';?>">
              <label for="username">Nome de Usuário:</label>
              <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
              <span class="help-block"><?php echo $username_err;?></span>
            </div>

            <div class="form-group <?php (!empty($password_err))?'has_error':'';?>">
              <label for="password">Senha:</label>
              <input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
              <span class="help-block"><?php echo $password_err;?></span>
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-block btn-outline-primary" value="Entrar">
            </div>
            <p>Ainda não possui uma conta? <a href="register.php">Cadastre-se</a></p>
            
          </form>
    </section>
  </main>
</body>
</html>
