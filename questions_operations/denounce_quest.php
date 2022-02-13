<?php

	session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Denunciar Questão</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="../img/12130brain_109577.ico" />
	<style type="text/css">
        body {
            font-family: 'Poppins', sans-serif;
            position: relative;
            top: 20%;
            transform: translateY(35%); 
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

        <h2 class="display-5">Deseja realmente denunciar esta questão?</h2>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(array_key_exists('sim', $_POST)) {

                require_once '../config/config.php';

                $param_id = $_SESSION["key"];

                $denunciar = "SELECT qr.id_questao, qr.valida, dv.num_denuncias, dv.username_1, dv.username_2, dv.id_quest
                FROM (questoes_respostas qr 
                JOIN 
                denuncia_validacao dv
                ON 
                dv.id_quest = qr.id_questao)
                WHERE id_quest = $param_id";

                $den = $mysql_db->query($denunciar) or die($mysql_db->error);

                $dado = $den->fetch_array();

                if ($dado[2] === '2') {
                    if (($_SESSION['username'] != $dado[3]) && ($_SESSION['username'] != $dado[4])) {
                        $param_num_denuncias = 0;
                        $param_username_1 = NULL;
                        $param_username_2 = NULL;
                        $param_valida = 'i';

                        $sqldenuncia = "UPDATE denuncia_validacao SET num_denuncias = '$param_num_denuncias', username_1 = '$param_username_1', username_2 = '$param_username_2' WHERE id_quest = '$param_id'";
                    
                        if($stmt = $mysql_db->prepare($sqldenuncia)){
                            if($stmt->execute()){

                                $sql_update_valida = "UPDATE questoes_respostas SET valida = '$param_valida' WHERE id_questao = '$param_id'";

                                if($stmt = $mysql_db->prepare($sql_update_valida)){
                                    if($stmt->execute()){

                                        if ($_SESSION["denounces_from_where"] === 0) {
                                            header("location: ../question_list.php");
                                        }
                                        elseif ($_SESSION["denounces_from_where"] === 1) {
                                            header("location: ../Game/Quests.php");
                                        }
                                        
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
                        echo '<br/><h4>Você já denunciou essa Questão!</h4>';
                    }
                }
                elseif ($dado[2] === '1') {
                    if (($_SESSION['username'] != $dado[3]) && ($_SESSION['username'] != $dado[4])) {
                        $param_num_denuncias = 2;
                        $param_username_2 = $_SESSION['username'];

                        $sqldenuncia = "UPDATE denuncia_validacao SET num_denuncias = '$param_num_denuncias', username_2 = '$param_username_2' WHERE id_quest = '$param_id'";
                    
                        if($stmt = $mysql_db->prepare($sqldenuncia)){
                            if($stmt->execute()){

                                if ($_SESSION["denounces_from_where"] === 0) {
                                    header("location: ../question_list.php");
                                }
                                elseif ($_SESSION["denounces_from_where"] === 1) {
                                    header("location: ../Game/Quests.php");
                                }

                                exit();
                            } else{
                                echo "Oops! Algo deu errado, tente novamente mais tarde!";
                            }
                            $stmt->close();
                        }
                        $mysql_db->close();
                    }
                    else {
                        echo '<br/><h4>Você já denunciou essa Questão!</h4>';
                    }
                }
                elseif ($dado[2] === '0') {
                    $param_num_denuncias = 1;
                    $param_username_1 = $_SESSION['username'];
                
                    $sqldenuncia = "UPDATE denuncia_validacao SET num_denuncias = '$param_num_denuncias', username_1 = '$param_username_1' WHERE id_quest = '$param_id'";
                    
                    if($stmt = $mysql_db->prepare($sqldenuncia)){

                        if($stmt->execute()){

                            if ($_SESSION["denounces_from_where"] === 0) {
                                header("location: ../question_list.php");
                            }
                            elseif ($_SESSION["denounces_from_where"] === 1) {
                                header("location: ../Game/Quests.php");
                            }

                            exit();
                        } else{
                            echo "Oops! Algo deu errado, tente novamente mais tarde!";
                        }
                        $stmt->close();
                    }
                    $mysql_db->close();
                }

            }
            elseif(array_key_exists('nao', $_POST)) {
                if ($_SESSION["denounces_from_where"] === 0) {
                    header("location: ../question_list.php");
                }
                elseif ($_SESSION["denounces_from_where"] === 1) {
                    header("location: ../Game/Quests.php");
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

                echo "<br><h3><strong> Pergunta: " . $dado['pergunta'] . "</strong></h3>";
                echo "<h3><strong> Resposta correta: " . $dado['resp_correta'] . "</strong></h3>"; 
                echo "<h3><strong> Resposta incorreta 1: " . $dado['resp_a'] . "</strong></h3>";
                echo "<h3><strong> Resposta incorreta 2: " . $dado['resp_b'] . "</strong></h3>";
                echo "<h3><strong> Resposta incorreta 3: " . $dado['resp_c'] . "</strong></h3><br><br>";

            echo "</div>";

            echo '<form method="post">';
            echo '<input type="submit" name="sim" class="btn btn-block btn-primary" value="Sim"><br>';
            echo '<input type="submit" name="nao" class="btn btn-block btn-link bg-light" value="Nao">';
            echo '</form>';

        ?>

		</section>
	</main>
</body>
</html>
