<?php

	session_start();
    
	require_once '../config/config.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $param_id = $_SESSION["key"];
        $param_id_user = $_SESSION['id_user'];

        $sqldv = "DELETE FROM denuncia_validacao WHERE id_quest = $param_id";

        if (mysqli_query($mysql_db, $sqldv)) {
            $sqlquests = "DELETE FROM questoes_respostas WHERE id_questao = $param_id";

            if (mysqli_query($mysql_db, $sqlquests)) {

                $consulta = "SELECT * FROM stats WHERE id_user_stats = $param_id_user";
                $cons = $mysql_db->query($consulta) or die($mysql_db->error);
                $dado = $cons->fetch_array();
                
                $param_num_contributions = $dado['num_contributions'] + 1;
                $param_user_level = $dado['user_level'];

                if($param_num_contributions >= 20){
                    $param_user_level = 'Abundante';
                }
                else if($param_num_contributions >= 50){
                    $param_user_level = 'Rasga Moeda';
                }
    
                $sqlStats = "UPDATE stats SET num_contributions = '$param_num_contributions', user_level = '$param_user_level' WHERE id_user_stats = '$param_id_user'";
                
                if($stmt = $mysql_db->prepare($sqlStats)){  
                    if($stmt->execute()){
                        header("location: ../question_list.php");
                    }
                    else {
                        echo "Algo deu errado, Tente Novamente!";
                    }
                }
            } 
            else {
                echo "Erro ao Deletar!";
            }
        }
        else {
            echo "Erro ao Deletar!";
        }

	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Deletar Questão</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="../img/12130brain_109577.ico" />
	<style type="text/css">
        body {
            font-family: 'Poppins', sans-serif;
            position: relative;
            top: 20%;
            transform: translateY(15%); 
        }
        .wrapper{ 
        	width: 1800px; 
        	padding: 20px; 
        }
        .wrapper h1 {
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
		<section class="container wrapper"> <br>

        <h2>Deseja realmente deletar esta questão?</h2>

        <br><br>

        <?php

            require_once '../config/config.php';


            $param_key = $_SESSION["key"];
            
            $quest = "SELECT *FROM questoes_respostas WHERE id_questao = $param_key";
            $ques = $mysql_db->query($quest) or die($mysql_db->error);

            $dado = $ques->fetch_array();

            echo "<div id='quest'>";
                echo "<h3><strong> Pergunta: " . $dado['pergunta'] . "</strong></h3>";
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
