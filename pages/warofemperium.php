<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?PHP
$woe = $SQL->query("
	SELECT w.id AS id, w.time AS time, g.name AS guild, p.name AS name, w.started AS start, w.guild AS guild_id
		FROM woe AS w
	INNER JOIN players AS p
		ON p.id = w.breaker
	INNER JOIN guilds AS g
		ON g.id = w.guild
	ORDER BY id DESC LIMIT 10;	
");

foreach ($woe as $k=>$v) {
	$winners .="
		<TR BGCOLOR=\"".$config['site'][($k % 2 == 1 ? 'light' : 'dark').'border']."\">
			<TD>{$v[id]}</TD>
			<TD><a href='index.php?subtopic=guilds&action=show&guild=" . $v[guild_id] . "'>$v[guild]</a></TD>
			<TD>{$v[name]}</TD>
			<TD>" . date("d/m/y   H:i:s", $v[start]) . "</TD>
			<TD>" . date("d/m/y   H:i:s", $v[time]) . "</TD>
		</TR>
	";
}
$main_content .= '
<center><h1><img src="woe.png"></h1></center>
<br>
';

if(!$winners) {
	$main_content .= '
		<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>
			<TR BGCOLOR="'.$config['site']['vdarkborder'].'">
				<TD CLASS=white>
					<B>Vencedor do Pvp Castle</B>
				</TD>
			</TR>
			<TR BGCOLOR='.$config['site']['darkborder'].'>
				<TD>
					Ainda n&atilde;o h&aacute; vencedores no Pvp Castle do '.$config['server']['serverName'].' .
				</TD>
			</TR>
		</TABLE>
		<br>';
} else {
	$main_content .= "
		<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>
			<TR BGCOLOR=\"{$config['site']['vdarkborder']}\">
				<TD CLASS=white width=5%>
					<B>No.</B>
				</TD>
				<TD CLASS=white width=30%>
					<B>Winner guild</B>
				</TD>
				<TD CLASS=white width=25%>
					<B>Conquest by</B>
				</TD>
				<TD CLASS=white width=20%>
					<B>Start time</B>
				</TD>
				<TD CLASS=white width=20%>
					<B>Last conquest</B>
				</TD>
			</TR>
			$winners
		</TABLE>
	";
}
$main_content .='<table width="100%" cellspacing="1" cellpadding="6">

	<tr widht="100%" bgcolor="#505050">

		<th align="center">Informa&ccedil;&otilde;es do Castle</th>

	</tr>

	<tr widht="100%" bgcolor="#D4C0A1">

		<td>Todos os dias  as <font color="red"><b>21:00</b></font> horas, no qual as Guilds tentam dominar o castelo combatendo seus inimigos até as 22:30.</td>

	</tr>

	<tr widht="100%" bgcolor="#F1E0C6">

		<td><b>A guild que ter o dominio do castelo ganhara durante o periodo que estiver dominando Hunts Exclusivas.</b></td>

	</tr>

	
	<tr widht="100%" bgcolor="#F1E0C6">

		

	</tr>

	<tr widht="100%" bgcolor="#D4C0A1">

		<td>Durante 1:30 minutos, as guilds tem que tentar tomar o m&aacute;ximo de controle do Pvp Castle, ela ter&aacute; que defender o seu dom&iacute;nio no castelo evitando que outras guilds dominem o Castle, isso durante o tempo restante do castelo. </td>

	</tr>

	<tr widht="100%" bgcolor="#F1E0C6">

		<td>Sempre que o evento come&ccedil;ar ira abri um teleporte no  <b>Templo do BaiakPvp</b> poder&aacute; ser acessado por todos que possuirem guild.</td>

	</tr>

	<tr widht="100%" bgcolor="#D4C0A1">

		

	</tr>

	<tr widht="100%" bgcolor="#F1E0C6">

		<td>


		<ul>

		<li>

		

		</li>

		<li>

		

		</li>

		</td>

	</tr>

	<tr width="100%" bgcolor="#D4C0A1">

	</tr>

</table></center>



<br>
';

?>