<?php

	session_start();

    require_once '../config/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $param_prize = $_SESSION["prize"];
        $param_id_usuario = $_SESSION["id_user"];

        $sql = "INSERT INTO ranking(pontuacao, id_usuario) VALUES('$param_prize', '$param_id_usuario')";

        if ($stmt = $mysql_db->prepare($sql)) {

            if ($stmt->execute()) {

                $param_id = $_SESSION['id_user'];

                $consulta = "SELECT * FROM stats WHERE id_user_stats = '$param_id'";
                $cons = $mysql_db->query($consulta) or die($mysql_db->error);
                $dado = $cons->fetch_array();

                $param_n_partidas_jogadas = $dado['n_partidas_jogadas'] + 1;
                if($_SESSION["elimina_alternativas"] === 1){
                    $param_n_util_eli_duas_altern = $dado['n_util_eli_duas_altern'] + 1;
                }
                else{
                    $param_n_util_eli_duas_altern = $dado['n_util_eli_duas_altern'];
                }
                $param_n_derr_erro = $dado['n_derr_erro'] + 1;
                $param_premio_total = $dado['premio_total'] + $_SESSION["prize"];
    
                $sqlStats = "UPDATE stats SET n_partidas_jogadas = '$param_n_partidas_jogadas', n_util_eli_duas_altern = '$param_n_util_eli_duas_altern', n_derr_erro = '$param_n_derr_erro', premio_total = '$param_premio_total' 
                WHERE id_user_stats = '$param_id'";
                
                if($stmt = $mysql_db->prepare($sqlStats)){  
                    if($stmt->execute()){

                        $consul = "SELECT * FROM latest_scores WHERE id_user_latest_scores = '$param_id_usuario'";
                        $con = $mysql_db->query($consul) or die($mysql_db->error);
                        $latest_scores = $con->fetch_array();

                        $param_recent_prize = $_SESSION["prize"];

                        if(($latest_scores['prize01'] != null) && ($latest_scores['prize02'] != null) && ($latest_scores['prize03'] != null) && ($latest_scores['prize04'] != null) && ($latest_scores['prize05'] != null)){
                            $param_prize02 = $latest_scores['prize02'];
                            $param_prize03 = $latest_scores['prize03'];
                            $param_prize04 = $latest_scores['prize04'];
                            $param_prize05 = $latest_scores['prize05'];

                            $sql_latest_scores = "UPDATE latest_scores SET prize05 = '$param_recent_prize', prize04 = '$param_prize05', prize03 = '$param_prize04', prize02 = '$param_prize03', prize01 = '$param_prize02' WHERE id_user_latest_scores = '$param_id_usuario'";
                        }
                        else{
                            if($latest_scores['prize01'] == null){
                                $sql_latest_scores = "UPDATE latest_scores SET prize01 = '$param_recent_prize' WHERE id_user_latest_scores = '$param_id_usuario'";
                            }
                            elseif($latest_scores['prize02'] == null){
                                $sql_latest_scores = "UPDATE latest_scores SET prize02 = '$param_recent_prize' WHERE id_user_latest_scores = '$param_id_usuario'";
                            }
                            elseif($latest_scores['prize03'] == null){
                                $sql_latest_scores = "UPDATE latest_scores SET prize03 = '$param_recent_prize' WHERE id_user_latest_scores = '$param_id_usuario'";
                            }
                            elseif($latest_scores['prize04'] == null){
                                $sql_latest_scores = "UPDATE latest_scores SET prize04 = '$param_recent_prize' WHERE id_user_latest_scores = '$param_id_usuario'";
                            }
                            elseif($latest_scores['prize05'] == null){
                                $sql_latest_scores = "UPDATE latest_scores SET prize05 = '$param_recent_prize' WHERE id_user_latest_scores = '$param_id_usuario'";
                            }
                        }

                        if($stmt = $mysql_db->prepare($sql_latest_scores)){  
                            if($stmt->execute()){
                                if(array_key_exists('reiniciar', $_POST)){
                                    header('location: init.php');
                                }
                                if(array_key_exists('sair', $_POST)){
                                    header('location: ../welcome.php');
                                }
                            }
                        }  
                    }
                    else {
                        echo "Algo deu errado, Tente Novamente!";
                    }
                }

            } 
            else {
                echo "Algo deu errado, Tente Novamente!";
            }

            $stmt->close();	
        }

        $mysql_db->close();

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Derrota</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="../img/12130brain_109577.ico" />
    <style>
        .wrapper h2 {
            margin-top: 2rem;
            text-align: center;
            color:rgb(51, 51, 51);
        }
        .wrapper{ 
            width: 350px; 
            padding: 30px; 
        }
        .wrapper h1 {text-align: center}
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: red;}
        button{
            margin: 0 15px;
        }
        img{
            width: 20vh;
            margin-left: 30%;
            margin-top: 5rem;
            margin-bottom: 2rem;
        }
	</style>
</head>

<body>
    <section class="container wrapper">
        <img src="../img/Hand 3.png" alt="">
        <h1>Você Perdeu! Tente outra Vez!</h1> <br/>
        <h2 class="display-5"><strong>Seu Prêmio: <?php echo $_SESSION["prize"];?> </strong></h2></strong></h2>
        
    </section>
    <div class="container wrapper">
        <form method="post">
            <input type="submit" name="reiniciar" class="btn btn-block btn btn-outline-dark" value="Reiniciar">
            <input type="submit" name="sair" class="btn btn-block btn-link bg-light" value="Sair">
        </form>
    </div>
</body>
</html>
