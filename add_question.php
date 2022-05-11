<?php

require_once 'config/config.php';

$questao = $resposta_certa = $resposta_a = $resposta_b = $resposta_c = $indice_dif = $assunto_quest = "";
$questao_err = $resposta_certa_err = $resposta_a_err = $resposta_b_err = $resposta_c_err = $indice_dif_err = $assunto_quest_err = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty(trim($_POST['questao']))) {
        $questao_err = "A Pergunta Deve Ser Informada!";
    } else {
        $questao = trim($_POST["questao"]);
    }

    if (empty(trim($_POST['resposta_certa']))) {
        $resposta_certa_err = "A Resposta Correta Deve Ser Informada!";
    } else {
        $resposta_certa = trim($_POST["resposta_certa"]);
    }

    if (empty(trim($_POST['resposta_a']))) {
        $resposta_a_err = "Ambas as Respostas Incorretas Devem Ser Informadas!";
    } else {
        $resposta_a = trim($_POST["resposta_a"]);
    }

    if (empty(trim($_POST['resposta_b']))) {
        $resposta_b_err = "Ambas as Respostas Incorretas Devem Ser Informadas!";
    } else {
        $resposta_b = trim($_POST["resposta_b"]);
    }

    if (empty(trim($_POST['resposta_c']))) {
        $resposta_c_err = "Ambas as Respostas Incorretas Devem Ser Informadas!";
    } else {
        $resposta_c = trim($_POST["resposta_c"]);
    }

    if (empty(trim($_POST['indice_dif']))) {
        $indice_dif_err = "O Índice de Dificuldade deve ser Informado: (1|2|3)!";
    } else {
        $indice_dif = trim($_POST["indice_dif"]);
    }

    if (empty(trim($_POST['assunto_quest']))) {
        $assunto_quest_err = "O Assunto da Questão deve ser Informado!";
    } else {
        $assunto_quest = trim($_POST["assunto_quest"]);
    }

    if (empty($questao_err) && empty($resposta_certa_err) && empty($resposta_a_err) && empty($resposta_b_err) && empty($resposta_c_err) && empty($indice_dif_err)) {

        $param_questao = $questao;
        $param_resposta_certa = $resposta_certa;
        $param_resposta_a = $resposta_a;
        $param_resposta_b = $resposta_b;
        $param_resposta_c = $resposta_c;
        $param_indice_dif = (int)$indice_dif;

        $sql = "INSERT INTO questoes_respostas (pergunta, resp_correta, resp_a, resp_b, resp_c, indice_dif, valida) 
                VALUES ('$param_questao', '$param_resposta_certa', '$param_resposta_a', '$param_resposta_b', '$param_resposta_c', '$param_indice_dif', 'i')";

        if ($stmt = $mysql_db->prepare($sql)) {

            echo ('1');

            if ($stmt->execute()) {

                echo ('2');

                if ($stmt = $mysql_db->prepare($sql)) {

                    echo ('3');

                    $param_id_resp = mysqli_insert_id($mysql_db);

                    $sqldv = "INSERT INTO denuncia_validacao (num_denuncias, num_validacoes, id_quest) 
                            VALUES (0, 0, '$param_id_resp')";

                    if ($stmt = $mysql_db->prepare($sqldv)) {

                        if ($stmt->execute()) {

                            if ($stmt = $mysql_db->prepare($sqldv)) {

                                header('location: ./question_board.php');
                            } else {
                                echo "Algo deu errado, Tente Novamente!";
                            }
                        } else {
                            echo "Algo deu errado, Tente Novamente!";
                        }

                        $stmt->close();
                    }
                } else {
                    echo "Algo deu errado, Tente Novamente!";
                }
            } else {
                echo "Algo deu errado, Tente Novamente!";
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
    <title>Adicionar Questão</title>
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="./img/12130brain_109577.ico" />
    <style type="text/css">
        body {
            font-family: 'Poppins', sans-serif;
            position: relative;
            top: 20%;
            transform: translateY(5%);
        }

        .wrapper {
            width: 1800px;
            padding: 20px;
        }

        .wrapper h1 {
            text-align: center;
        }

        .wrapper form .form-group span {
            color: red;
        }

        .table {
            text-align: center;
        }

        .wrapper h2 {
            text-align: center
        }

        .wrapper form .form-group span {
            color: red;
        }
    </style>
</head>

<body>
    <main class="container wrapper">
        <section>
            <h2>Adicionar Questão</h2><br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
                <div class="form-group" >
                    <label>Pergunta:</label>
                    <input type="text" name="questao" class="form-control" value="<?php echo $questao; ?>">
                    <span class="help-block"><?php echo $questao_err; ?></span>
                </div>

                <div class="form-group" >
                    <label>Resposta Correta:</label>
                    <input type="text" name="resposta_certa" class="form-control" value="<?php echo $resposta_certa; ?>">
                    <span class="help-block"><?php echo $resposta_certa_err; ?></span>
                </div>

                <div class="form-group" >
                    <label>Resposta Incorreta 01:</label>
                    <input type="text" name="resposta_a" class="form-control" value="<?php echo $resposta_a; ?>">
                    <span class="help-block"><?php echo $resposta_a_err; ?></span>
                </div>

                <div class="form-group" >
                    <label>Resposta Incorreta 02:</label>
                    <input type="text" name="resposta_b" class="form-control" value="<?php echo $resposta_b; ?>">
                    <span class="help-block"><?php echo $resposta_b_err; ?></span>
                </div>

                <div class="form-group" >
                    <label>Resposta Incorreta 03:</label>
                    <input type="text" name="resposta_c" class="form-control" value="<?php echo $resposta_c; ?>">
                    <span class="help-block"><?php echo $resposta_c_err; ?></span>
                </div>

                <div class="col-md-14" style="display: flex;">
                    <div class="col-md-6" style="padding-left: 0%;">
                        <div class="form-group" >
                            <label>Índice de Dificuldade:</label><br>
                                <select type="select" class="form-control" name="indice_dif" id="indice_dif">
                                <option disabled selected value="null">Selecione um Índice</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <span class="help-block"><?php echo $indice_dif_err; ?></span>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-right: 0%;">
                        <div class="form-group" >
                            <label>Assunto da Questão:</label><br>
                            <select type="select" class="form-control" name="assunto_quest" id="assunto_quest">
                                <option disabled selected value="null">Selecione um Assunto</option>
                                <option value="Ciências da Natureza">Ciências da Natureza</option>
                                <option value="Ciências Humanas">Ciências Humanas</option>
                                <option value="Conhecimentos Gerais">Conhecimentos Gerais</option>
                                <option value="Esportes">Esportes</option>
                                <option value="Linguagens">Linguagens</option>
                                <option value="Artes">Artes</option>
                                <option value="Exatas">Exatas</option>
                            </select>
                            <span class="help-block"><?php echo $assunto_quest_err; ?></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-block btn-primary" value="Enviar">
                    <a class="btn btn-block btn-link bg-light" href="question_board.php">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
</body>

</html>