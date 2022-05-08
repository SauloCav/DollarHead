<?php

	session_start();

	require_once '../config/config.php';

	class Node {
		public $data;
		public $num;
		public $next;
	}
	
	class LinkedList {
		public $head;
	
		public function __construct(){
			$this->head = null;
		}
	
		public function findObject($number) {
			$temp = new Node();
			$temp = $this->head;

			if($temp != null) {
				while($temp != null) {
					if($temp->num === $number){
						return $temp->data;
					}
					$temp = $temp->next;
				}
				echo "\n";
			} 
			else {
				echo "The list is empty.\n";
			}
		}

	};

	$quests = "SELECT * FROM questoes_respostas WHERE id_questao IS NOT NULL AND valida = 'v' AND indice_dif = '1'"; 
    $ques = $mysql_db->query($quests) or die($mysql_db->error);
    $row_dif_1 = mysqli_fetch_all($ques);
    $quests = "SELECT * FROM questoes_respostas WHERE id_questao IS NOT NULL AND valida = 'v' AND indice_dif = '2'"; 
    $ques = $mysql_db->query($quests) or die($mysql_db->error);
    $row_dif_2 = mysqli_fetch_all($ques);
    $quests = "SELECT * FROM questoes_respostas WHERE id_questao IS NOT NULL AND valida = 'v' AND indice_dif = '3'"; 
    $ques = $mysql_db->query($quests) or die($mysql_db->error);
    $row_dif_3 = mysqli_fetch_all($ques);
    
    $_SESSION["prize"] = 0;

    shuffle($row);

    $MyList = new LinkedList();

    $first = new Node();
    $first->data = $row_dif_1[0];
    $first->next = null;
    $first->num = 0;
    $MyList->head = $first;

    $second = new Node();
    $second->data = $row_dif_1[1];
    $second->next = null;
    $second->num = 1;
    $first->next = $second;

    $third = new Node();
    $third->data = $row_dif_2[2];
    $third->next = null;
    $third->num = 2;
    $second->next = $third;

    $fourth = new Node();
    $fourth->data = $row_dif_2[3];
    $fourth->next = null;
    $fourth->num = 3;
    $third->next = $fourth;

    $fifth = new Node();
    $fifth->data = $row_dif_2[4];
    $fifth->next = null;
    $fifth->num = 4;
    $fourth->next = $fifth;

    $sixth = new Node();
    $sixth->data = $row_dif_3[5];
    $sixth->next = null;
    $sixth->num = 5;
    $fifth->next = $sixth;

    $seventh = new Node();
    $seventh->data = $row_dif_3[6];
    $seventh->next = null;
    $seventh->num = 6;
    $sixth->next = $seventh;

?>
