<?php
	$limitt = 100; 
	$patentes = array(
		1 => "Soldado Raso",
		2 => "Soldado de Primeira Classe",
		3 => "Cabo",
		4 => "Sargento",
		5 => "Sargento-Ajudante 1",
		6 => "Sargento-Ajudante 2",
		7 => "Sargento-Chefe",
		8 => "Sargento-Mestre 1",
		9 => "Sargento-Mestre 2",
		10 => "Sargento-Mestre 3",
		11 => "Sargento-Mestre 4",
		12 => "Sargento-Mor do Comando",
		13 => "Segundo-Tenente 1",
		14 => "Segundo-Tenente 2",
		15 => "Segundo-Tenente 3",
		16 => "Segundo-Tenente 4",
		17 => "Primeiro-Tenente 1",
		18 => "Primeiro-Tenente 2",
		19 => "Primeiro-Tenente 3",
		20 => "Primeiro-Tenente 4",
		21 => "Primeiro-Tenente 5",
		22 => "Capitao 1",
		23 => "Capitao 2",
		24 => "Capitao 3",
		25 => "Capitao 4",
		26 => "Capitao 5",
		27 => "Major 1",
		28 => "Major 2",
		29 => "Major 3",
		30 => "Major 4",
		31 => "Major 5",
		32 => "Tenente-Coronel 1",
		33 => "Tenente-Coronel 2",
		34 => "Tenente-Coronel 3",
		35 => "Tenente-Coronel 4",
		36 => "Tenente-Coronel 5",
		37 => "Coronel 1",
		38 => "Coronel 2",
		39 => "Coronel 3",
		40 => "Coronel 4",
		41 => "Coronel 5",
		42 => "General",
	);
	
	$result = $SQL->query('SELECT `level`, `name`, `army_level` FROM `players` ORDER BY `army_level` DESC, `level` DESC LIMIT 0,50;'); 
	$number_of_rows = 0; 
	$main_content .= '
		<center><h1>Heroic Patentes Ranking</h1>
		<h2>Mate jogadores e conquiste sua condecoracao</h2></br>

		O sistema e voltado para aqueles jogadores que gostam de matar outros. Todo jogador comeca como Saldado Raso e pode avançar para novas patentes quando adquirir EXP. Para conseguir EXP o player deve matar um jogador que seja nivel maior ou igual ao seu.</br></br>
		</center>
		<TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 WIDTH=100%>
	<tr bgcolor="#af2126">
		<td><font color="white">Nome</font></td>
		<td><font color="white">Patente</font></td>
	</tr>
	';	
	foreach($result as $infoPatente) { 
	if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; }
		$number_of_rows++; 
		$patente = $patentes[$infoPatente['army_level']];
	$main_content .= '
	<tr bgcolor="'.$bgcolor.'">
		<td>
			<a href="index.php?subtopic=characters&name='.urlencode($infoPatente['name']).'">
			<b> '.$infoPatente['name'].'</a> - Level '.$infoPatente['level'].'</b>
		</td>
		<td>
			<img style="width:30px;height:30px;" src="images/patentes/'. $infoPatente['army_level'] .'.png"/>  ' . $patente . '
		</td>
	</tr>
		';
	}
	$main_content .= '
		</tr>	
	</table>
	</br>
	<center>Desenvolvido por <a href="www.chaitosoft.com">ChaitoSoft.com</a>.</center>
	';

?>
