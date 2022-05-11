<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Validar Questão</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="../img/12130brain_109577.ico" />
	<style type="text/css">
        body {
            font-family: 'Poppins', sans-serif;
            position: relative;
            top: 20%;
            transform: translateY(20%); 
        }
        .wrapper{ 
        	width: 1800px; 
        	padding: 20px; 
        }
        .wrapper h1 {
			text-align: center;
		}
        .wrapper h4 {
			color: red;
            text-align: center;  
		}
        .wrapper form .form-group span {color: red;}
        .table {
			text-align: center;  
		}
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: red;}
    </style>
</head>
<body>
	<main>
		<section class="container wrapper"> 

        <h2 class="display-5">Deseja realmente aprovar esta questão?</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(array_key_exists('sim', $_POST)) {

                require_once '../config/config.php';

                $param_id = $_SESSION["key"];

                $consulta = "SELECT qr.id_questao, qr.valida, dv.num_validacoes, dv.username_1, dv.username_2, dv.id_quest
                FROM (questoes_respostas qr 
                JOIN 
                denuncia_validacao dv
                ON 
                dv.id_quest = qr.id_questao)
                WHERE id_quest = $param_id";

                $con = $mysql_db->query($consulta) or die($mysql_db->error);
                $dado = $con->fetch_array();

                if ($dado[2] === '2') {
                    if (($_SESSION['username'] != $dado[3]) && ($_SESSION['username'] != $dado[4])) {
                        $param_num_validacoes = 0;
                        $param_username_1 = NULL;
                        $param_username_2 = NULL;
                        $param_valida = 'v';

                        $sql = "UPDATE denuncia_validacao SET num_validacoes = '$param_num_validacoes', username_1 = '$param_username_1', username_2 = '$param_username_2' WHERE id_quest = '$param_id'";
                    
                        if($stmt = $mysql_db->prepare($sql)){
                            if($stmt->execute()){

                                $sql_update_valida = "UPDATE questoes_respostas SET valida = '$param_valida' WHERE id_questao = '$param_id'";

                                if($stmt = $mysql_db->prepare($sql_update_valida)){
                                    if($stmt->execute()){
                                        header("location: ../question_list.php");
                                        exit();
                                    }
                                }

                            } else{
                                echo "Oops! Algo deu errado, tente novamente mais tarde!";
                            }
                            $stmt->close();
                        }
                        $mysql_db->close();
                    }
                    else {
                        echo '<br/><h4>Você já validou essa Questão!</h4>';
                    }
                }
                elseif ($dado[2] === '1') {
                    if (($_SESSION['username'] != $dado[3]) && ($_SESSION['username'] != $dado[4])) {
                        $param_num_validacoes = 2;
                        $param_username_2 = $_SESSION['username'];

                        $sql = "UPDATE denuncia_validacao SET num_validacoes = '$param_num_validacoes', username_2 = '$param_username_2' WHERE id_quest = '$param_id'";
                    
                        if($stmt = $mysql_db->prepare($sql)){
                            if($stmt->execute()){
                                header("location: ../question_list.php");
                                exit();
                            } else{
                                echo "Oops! Algo deu errado, tente novamente mais tarde!";
                            }
                            $stmt->close();
                        }
                        $mysql_db->close();
                    }
                    else {
                        echo '<br/><h4>Você já validou essa Questão!</h4>';
                    }
                }
                elseif ($dado[2] === '0') {
                    $param_num_validacoes = 1;
                    $param_username_1 = $_SESSION['username'];
                
                    $sql = "UPDATE denuncia_validacao SET num_validacoes = '$param_num_validacoes', username_1 = '$param_username_1' WHERE id_quest = '$param_id'";
                    
                    if($stmt = $mysql_db->prepare($sql)){

                        if($stmt->execute()){
                            header("location: ../question_list.php");
                            exit();
                        } else{
                            echo "Oops! Algo deu errado, tente novamente mais tarde!";
                        }
                        $stmt->close();
                    }
                    $mysql_db->close();
                }         

            }
	    }
        ?>

        <?php

            require_once '../config/config.php';

            $param_key = $_SESSION["key"];
            
            $quest = "SELECT *FROM questoes_respostas WHERE (id_questao = $param_key)";
            $ques = $mysql_db->query($quest) or die($mysql_db->error);

            $dado = $ques->fetch_array();

            echo "<div id='quest'>";
                echo '<br><br>';
                echo "<h3><strong> Pergunta: " . $dado['pergunta'] . "</strong></h3> ";
                echo "<h3><strong> (" . $dado['quest_topico'] . ")</strong></h3><br>";
                echo "<h3><strong> Resposta correta: " . $dado['resp_correta'] . "</strong></h3>"; 
                echo "<h3><strong> Resposta incorreta 1: " . $dado['resp_a'] . "</strong></h3>";
                echo "<h3><strong> Resposta incorreta 2: " . $dado['resp_b'] . "</strong></h3>";
                echo "<h3><strong> Resposta incorreta 3: " . $dado['resp_c'] . "</strong></h3><br>";
                echo "<h3><strong> Índice de dificuldade: " . $dado['indice_dif'] . "</strong></h3><br><br>";

            echo "</div>";

            echo '<form method="post">';
            echo '<input type="submit" name="sim" class="btn btn-block btn-primary" value="Sim"><br>';
            echo '</form>';

            echo '<a class="btn btn-block btn-link bg-light" href="../question_list.php">Nao</a>';

        ?>

		</section>
	</main>
</body>
</html>
