<?php

    session_start();

	require_once 'config/config.php';

	$ranking = "SELECT ra.pontuacao, us.nickname, ra.data_pont
	FROM (ranking ra 
		  JOIN 
          users us
          ON 
          ra.id_usuario = us.id_user) 
	ORDER BY pontuacao DESC LIMIT 10";      

	$ran = $mysql_db->query($ranking) or die($mysql_db->error);
    $i = 0;

    while($dado = $ran->fetch_array()) { 
        $dataPoints[$i] = array("label"=> $dado['nickname'], "y"=> (int)$dado['pontuacao']);
        $i = $i + 1;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="./img/12130brain_109577.ico" />
    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light1",
                title: {
                    text: "Top 10 melhores pontuações"
                },
                axisY: {
                    title: "Pontuação" 
                },
                data: [{
                    type: "column",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
        
    </script>
	<style>
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
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
				<h1 class="display-5"><strong>Hall da Fama<strong></h1><br>

                <div id="internalDivStyle">
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                </div>
                
		</section>
	</main>
</body>
</html>
