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
	<style>
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
            <h1>rules of the game</h1>
		DollarHead é um Jogo de perguntas e respostas onde o conteúdo é gerenciado pela comunidade de jogadores. O jogo permite aos usuários ampliação e teste dos seus conhecimentos, de forma simples e divertida. O gerenciamento das perguntas pela comunidade mantém as questões atuais e corretas, como ocorre em outros conteúdos geridos por comunidades com o Wikipédia. DollarHead é semelhante a sucessos como o Show do Milhão e Who Wants to Be a Millionaire?

O objetivo é conseguir o prêmio de 1 milhão de dólares. As perguntas são de múltipla escolha com quatro alternativas. Em cada pergunta, o jogador poderá: responder a pergunta; parar de responder; errar a resposta; pedir a eliminação de duas respostas erradas; ou denunciar a pergunta por enunciado, alternativas ou resposta incorreta. O jogador poderá pedir a eliminação de duas respostas erradas uma única vez. Se responder corretamente, o jogador passa para a próxima pergunta. De acordo com a pergunta em que o jogador estiver, ele receberá um prêmio em dinheiro se o jogador responder corretamente, parar ou errar a resposta de acordo com a tabela:
		É possível criar uma conta própria de usuário. Após a criação é possível realizar a edição e a exclusão da mesma.
Todo usuário é capaz de adicionar e editar questões por meio do painel de questões, sendo possível também denúnciar e validar as mesmas 1 vez por cada usuário. Uma questão passa a ser inválida quando recebe 3 denuncias. A mesma pode passar a ser válida caso receba 3 validações. A cada ação de adição, edição, dunúncia, validação e remoção de questões o usuário recebe uma contribuição.
Existem níveis de usuários. Os níveis são 3: Indigente, Abundante e Rasga Moeda. Indigente é o nível inicial que todo usuário recebe ao criar uma conta. Caso o jogador atinja 20 contribuições, ele passa a ser um Abundante. Caso ele contabilize 50 contribuições passará a ser um Rasga Moeda. Usuários Abundates e Rasgadores de moeda podem validar e denunciar questões instantaneamente, ou seja, sua ação de denúncia e validação vale por 3. Além disso, jogadores Rasgadores de Moeda possuem autoridade de excluir questões e podem realizar a eliminação de duas alternativas duas vezes ao longo do jogo.
			Há uma aba na tela inicial denominada Hall da fama onde é possível ver o ranking dos usuários com melhor pontuação. Nela é possível também visualizar a data e a hora da jogada em questão.
		</section>
	</main>
</body>
</html>
