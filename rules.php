<?php
	session_start();

	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: index.php');
		exit;
	}

	require_once 'config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Rules</title>
	<link rel="shortcut icon" href="./img/12130brain_109577.ico" />
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<link rel="shortcut icon" href="./img/12130brain_109577.ico" />
	<style>
		body {
            font-family: 'Poppins', sans-serif;
            position: relative;;
            transform: translateY(5%); 
			margin-bottom: 5%;
        }
        .wrapper{ 
        	width: 100%; 
        }
        .wrapper h2 {
			text-align: center;
		}
		.wrapper p {
			text-align: center;
		}
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
            <h2>Regras e Funcionalidades</h2>
			<p>DollarHead é um Jogo de perguntas e respostas onde o conteúdo é gerenciado pela comunidade de jogadores. O jogo permite aos usuários ampliação e teste dos seus conhecimentos, de forma simples e divertida. O gerenciamento das perguntas pela comunidade mantém as questões atuais e corretas, como ocorre em outros conteúdos geridos por comunidades com o Wikipédia. DollarHead é semelhante a sucessos como o Show do Milhão e Who Wants to Be a Millionaire?</p>
			<p>O objetivo é conseguir o prêmio de 1 milhão de dólares. As perguntas são de múltipla escolha com quatro alternativas. Em cada pergunta, o jogador poderá: responder a pergunta; parar de responder; errar a resposta; pedir a eliminação de duas respostas erradas; ou denunciar a pergunta por enunciado, alternativas ou resposta incorreta. O jogador poderá pedir a eliminação de duas respostas erradas uma única vez. Se responder corretamente, o jogador passa para a próxima pergunta. De acordo com a pergunta em que o jogador estiver, ele receberá um prêmio em dinheiro se o jogador responder corretamente, parar ou errar a resposta de acordo com a tabela:</p>
			<p><img src="Readme/table.png" /></p>
			<p>É possível criar uma conta própria de usuário. Após a criação é possível realizar a edição e a exclusão da mesma.Todo usuário é capaz de adicionar e editar questões por meio do painel de questões, sendo possível também denúnciar e validar as mesmas 1 vez por cada usuário. Uma questão passa a ser inválida quando recebe 3 denuncias. A mesma pode passar a ser válida caso receba 3 validações. A cada ação de adição, edição, dunúncia, validação e remoção de questões o usuário recebe uma contribuição.</p>
			<p>Existem níveis de usuários. Os níveis são 3: Indigente, Abundante e Rasga Moeda. Indigente é o nível inicial que todo usuário recebe ao criar uma conta. Caso o jogador atinja 20 contribuições, ele passa a ser um Abundante. Caso ele contabilize 50 contribuições passará a ser um Rasga Moeda. Usuários Abundates e Rasgadores de moeda podem validar e denunciar questões instantaneamente, ou seja, sua ação de denúncia e validação vale por 3. Além disso, jogadores Rasgadores de Moeda possuem autoridade de excluir questões e podem realizar a eliminação de duas alternativas duas vezes ao longo do jogo.</p>
			<p>Há uma aba na tela inicial denominada Hall da fama onde é possível ver o ranking dos usuários com melhor pontuação. Nela é possível também visualizar a data e a hora da jogada em questão.</p>
			<p>Em stats é possível visualizar as estatísticas do usuário atualmente logado. Informações como número de partidas jogadas, número de derrotas por erro, Número de derrotas por parada, Número de eliminações de duas alternativas, premiação total acumulada, número de contibuições e nível de usuário. Além disso há um gráfico que ilustra as 10 últimas partidas do jogador e a premiação recebida nas jogadas em questão.</p>

			<a class="btn btn-block btn-link bg-light" href="welcome.php">Sair</a>

		</section>
	</main>
</body>
</html>
