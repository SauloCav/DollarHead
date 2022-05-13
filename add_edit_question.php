<?php

session_start();

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
        $indice_dif_err = "O Índice de Dificuldade deve ser Informado!";
    } else {
        $indice_dif = trim($_POST["indice_dif"]);
    }

    if (empty(trim($_POST['assunto_quest']))) {
        $assunto_quest_err = "O Assunto da Questão deve ser Informado!";
    } else {
        $assunto_quest = trim($_POST["assunto_quest"]);
    }

    if (empty($questao_err) && empty($resposta_certa_err) && empty($resposta_a_err) && empty($resposta_b_err) && empty($resposta_c_err) && empty($indice_dif_err) && empty($assunto_quest_err)) {

        $param_questao = $questao;
        $param_resposta_certa = $resposta_certa;
        $param_resposta_a = $resposta_a;
        $param_resposta_b = $resposta_b;
        $param_resposta_c = $resposta_c;
        $param_indice_dif = (int)$indice_dif;
        $param_assunto_quest = $assunto_quest;
        $param_id = $_SESSION['id_user'];

        if($_SESSION["isEdit"] === 0){
            $sql = "UPDATE questoes_respostas SET pergunta = '$param_questao', resp_correta = '$param_resposta_certa', resp_a = '$param_resposta_a', resp_b = '$param_resposta_b', resp_c = '$param_resposta_c', indice_dif = '$param_indice_dif', quest_topico = '$param_assunto_quest' WHERE id_questao = '$param_id'";
        }
        else {
            $sql = "INSERT INTO questoes_respostas (pergunta, resp_correta, resp_a, resp_b, resp_c, indice_dif, quest_topico, valida) 
                VALUES ('$param_questao', '$param_resposta_certa', '$param_resposta_a', '$param_resposta_b', '$param_resposta_c', '$param_indice_dif', '$param_assunto_quest', 'i')";
        }
        
        if ($stmt = $mysql_db->prepare($sql)) {

            if($_SESSION["isEdit"] === 0){
                if ($stmt->execute()) {
                    $consulta = "SELECT * FROM stats WHERE id_user_stats = '$param_id'";
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
        
                    $sqlStats = "UPDATE stats SET num_contributions = '$param_num_contributions', user_level = '$param_user_level' WHERE id_user_stats = '$param_id'";
                    
                    if($stmt = $mysql_db->prepare($sqlStats)){  
                        if($stmt->execute()){
                            header("location: question_list.php");
                        }
                        else {
                            echo "Algo deu errado, Tente Novamente!";
                        }
                    }
                } else {
                    echo "Algo deu errado, Tente Novamente!";
                }
            }
            else {
                if ($stmt->execute()) {

                    $param_id_resp = mysqli_insert_id($mysql_db);
    
                    $sqldv = "INSERT INTO denuncia_validacao (num_denuncias, num_validacoes, id_quest) 
                            VALUES (0, 0, '$param_id_resp')";
    
                    if ($stmt = $mysql_db->prepare($sqldv)) {
                        
                        $consulta = "SELECT * FROM stats WHERE id_user_stats = '$param_id'";
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
            
                        $sqlStats = "UPDATE stats SET num_contributions = '$param_num_contributions', user_level = '$param_user_level' WHERE id_user_stats = '$param_id'";
                        
                        if($stmt = $mysql_db->prepare($sqlStats)){  
                            if($stmt->execute()){
                                header('location: ./question_board.php');
                            }
                            else {
                                echo "Algo deu errado, Tente Novamente!";
                            }
                        }

                    }
                } else {
                    echo "Algo deu errado, Tente Novamente!";
                }
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
            transform: translateY(6%);
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

        <?php

            $param_key = $_SESSION["key"];
            
            $quest = "SELECT *FROM questoes_respostas WHERE (id_questao = $param_key)";
            $ques = $mysql_db->query($quest) or die($mysql_db->error);

            $dado = $ques->fetch_array();

        ?>

        <?php
        
            if($_SESSION["isEdit"] === 0){
                echo '<h2>Editar Questão</h2><br>';
            }
            else {
                echo '<h2>Adicionar Questão</h2><br>';
            }
        
        ?>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <div class="form-group" >
                    <label>Pergunta:</label>
                        <?php
                            if($_SESSION["isEdit"] === 0){
                                echo '<input type="text" name="questao" class="form-control" value= "'.$dado[1].'" />';
                            }
                            else {
                                echo '<input type="text" name="questao" class="form-control">';
                            }
                        ?>
                    <a class="help-block" style="color: red;"><?php echo $questao_err; ?></a>
                </div>

                <div class="form-group" >
                    <label>Resposta Correta:</label>
                        <?php
                            if($_SESSION["isEdit"] === 0){
                                echo '<input type="text" name="resposta_certa" class="form-control" value= "'.$dado[2].'" />';
                            }
                            else {
                                echo '<input type="text" name="resposta_certa" class="form-control">';
                            }
                        ?>
                    <a class="help-block" style="color: red;"><?php echo $resposta_certa_err; ?></a>
                </div>

                <div class="form-group" >
                    <label>Resposta Incorreta 01:</label>
                        <?php
                            if($_SESSION["isEdit"] === 0){
                                echo '<input type="text" name="resposta_a" class="form-control" value= "'.$dado[3].'" />';
                            }
                            else {
                                echo '<input type="text" name="resposta_a" class="form-control">';
                            }
                        ?>
                    <a class="help-block" style="color: red;"><?php echo $resposta_a_err; ?></a>
                </div>

                <div class="form-group" >
                    <label>Resposta Incorreta 02:</label>
                        <?php
                            if($_SESSION["isEdit"] === 0){
                                echo '<input type="text" name="resposta_b" class="form-control" value= "'.$dado[4].'" />';
                            }
                            else {
                                echo '<input type="text" name="resposta_b" class="form-control">';
                            }
                        ?>
                    <a class="help-block" style="color: red;"><?php echo $resposta_b_err; ?></a>
                </div>

                <div class="form-group" >
                    <label>Resposta Incorreta 03:</label>
                        <?php
                            if($_SESSION["isEdit"] === 0){
                                echo '<input type="text" name="resposta_c" class="form-control" value= "'.$dado[5].'" />';
                            }
                            else {
                                echo '<input type="text" name="resposta_c" class="form-control">';
                            }
                        ?>
                    <a class="help-block" style="color: red;"><?php echo $resposta_c_err; ?></a>
                </div>

                <div class="col-md-14" style="display: flex;">
                    <div class="col-md-6" style="padding-left: 0%;">
                        <div class="form-group" >
                            <label>Índice de Dificuldade:</label><br>
                                <select type="select" class="form-control" name="indice_dif" id="indice_dif">
                                    <?php
                                        if($_SESSION["isEdit"] === 0){
                                            if($dado[6] == 1){
                                                echo '<option selected value="1">1</option>';
                                                echo '<option value="2">2</option>';
                                                echo '<option value="3">3</option>';
                                            }
                                            if($dado[6] == 2){
                                                echo '<option value="1">1</option>';
                                                echo '<option selected value="2">2</option>';
                                                echo '<option value="3">3</option>';
                                            }
                                            if($dado[6] == 3){
                                                echo '<option value="1">1</option>';
                                                echo '<option value="2">2</option>';
                                                echo '<option selected value="3">3</option>';
                                            }
                                        }
                                        else {
                                            echo '<option disabled selected value="null">Selecione um Índice</option>';
                                            echo '<option value="1">1</option>';
                                            echo '<option value="2">2</option>';
                                            echo '<option value="3">3</option>';
                                        }
                                    ?>
                                </select>
                            <span class="help-block"><?php echo $indice_dif_err; ?></span>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-right: 0%;">
                        <div class="form-group" >
                            <label>Assunto da Questão:</label><br>
                            <select type="select" class="form-control" name="assunto_quest" id="assunto_quest">
                                    <?php
                                        if($_SESSION["isEdit"] === 0){
                                            if($dado[7] === 'Ciências da Natureza'){
                                                echo '<option selected value="Ciências da Natureza">Ciências da Natureza</option>';
                                                echo '<option value="Ciências Humanas">Ciências Humanas</option>';
                                                echo '<option value="Conhecimentos Gerais">Conhecimentos Gerais</option>';
                                                echo '<option value="Esportes">Esportes</option>';
                                                echo '<option value="Linguagens">Linguagens</option>';
                                                echo '<option value="Artes">Artes</option>';
                                                echo '<option value="Exatas">Exatas</option>';
                                            }
                                            if($dado[7] === 'Ciências Humanas'){
                                                echo '<option value="Ciências da Natureza">Ciências da Natureza</option>';
                                                echo '<option selected value="Ciências Humanas">Ciências Humanas</option>';
                                                echo '<option value="Conhecimentos Gerais">Conhecimentos Gerais</option>';
                                                echo '<option value="Esportes">Esportes</option>';
                                                echo '<option value="Linguagens">Linguagens</option>';
                                                echo '<option value="Artes">Artes</option>';
                                                echo '<option value="Exatas">Exatas</option>';
                                            }
                                            if($dado[7] === 'Conhecimentos Gerais'){
                                                echo '<option value="Ciências da Natureza">Ciências da Natureza</option>';
                                                echo '<option value="Ciências Humanas">Ciências Humanas</option>';
                                                echo '<option selected value="Conhecimentos Gerais">Conhecimentos Gerais</option>';
                                                echo '<option value="Esportes">Esportes</option>';
                                                echo '<option value="Linguagens">Linguagens</option>';
                                                echo '<option value="Artes">Artes</option>';
                                                echo '<option value="Exatas">Exatas</option>';
                                            }
                                            if($dado[7] === 'Esportes'){
                                                echo '<option value="Ciências da Natureza">Ciências da Natureza</option>';
                                                echo '<option value="Ciências Humanas">Ciências Humanas</option>';
                                                echo '<option value="Conhecimentos Gerais">Conhecimentos Gerais</option>';
                                                echo '<option selected value="Esportes">Esportes</option>';
                                                echo '<option value="Linguagens">Linguagens</option>';
                                                echo '<option value="Artes">Artes</option>';
                                                echo '<option value="Exatas">Exatas</option>';
                                            }
                                            if($dado[7] === 'Linguagens'){
                                                echo '<option value="Ciências da Natureza">Ciências da Natureza</option>';
                                                echo '<option value="Ciências Humanas">Ciências Humanas</option>';
                                                echo '<option value="Conhecimentos Gerais">Conhecimentos Gerais</option>';
                                                echo '<option value="Esportes">Esportes</option>';
                                                echo '<option selected value="Linguagens">Linguagens</option>';
                                                echo '<option value="Artes">Artes</option>';
                                                echo '<option value="Exatas">Exatas</option>';
                                            }
                                            if($dado[7] === 'Artes'){
                                                echo '<option value="Ciências da Natureza">Ciências da Natureza</option>';
                                                echo '<option value="Ciências Humanas">Ciências Humanas</option>';
                                                echo '<option value="Conhecimentos Gerais">Conhecimentos Gerais</option>';
                                                echo '<option value="Esportes">Esportes</option>';
                                                echo '<option value="Linguagens">Linguagens</option>';
                                                echo '<option selected value="Artes">Artes</option>';
                                                echo '<option value="Exatas">Exatas</option>';
                                            }
                                            if($dado[7] === 'Exatas'){
                                                echo '<option value="Ciências da Natureza">Ciências da Natureza</option>';
                                                echo '<option value="Ciências Humanas">Ciências Humanas</option>';
                                                echo '<option value="Conhecimentos Gerais">Conhecimentos Gerais</option>';
                                                echo '<option value="Esportes">Esportes</option>';
                                                echo '<option value="Linguagens">Linguagens</option>';
                                                echo '<option value="Artes">Artes</option>';
                                                echo '<option selected value="Exatas">Exatas</option>';
                                            }
                                        }
                                        else {
                                            echo '<option disabled selected value="null">Selecione um Assunto</option>';
                                            echo '<option value="Ciências da Natureza">Ciências da Natureza</option>';
                                            echo '<option value="Ciências Humanas">Ciências Humanas</option>';
                                            echo '<option value="Conhecimentos Gerais">Conhecimentos Gerais</option>';
                                            echo '<option value="Esportes">Esportes</option>';
                                            echo '<option value="Linguagens">Linguagens</option>';
                                            echo '<option value="Artes">Artes</option>';
                                            echo '<option value="Exatas">Exatas</option>';
                                        }
                                    ?>               
                            </select>
                            <span class="help-block"><?php echo $assunto_quest_err; ?></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-block btn-primary" value="Enviar">
                    <?php
                        if($_SESSION["isEdit"] === 0){
                            echo '<a class="btn btn-block btn-link bg-light" href="question_list.php">Cancelar</a>';
                        }
                        else {
                            echo '<a class="btn btn-block btn-link bg-light" href="question_board.php">Cancelar</a>';
                        }
                    ?>
                </div>
            </form>
        </section>
    </main>
</body>

</html>