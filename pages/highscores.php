<?PHP
$list = $_REQUEST['list'];
$page = $_REQUEST['page'];
switch($list)
{
  case "fist":
   $id = 0;
   $list_name = 'Fist Fighting';
   break;
  case "club":
   $id = 1;
   $list_name = 'Club Fighting';
   break;
  case "sword":
   $id = 2;
   $list_name = 'Sword Fighting';
   break;
  case "axe":
   $id = 3;
   $list_name = 'Axe Fighting';
   break;
  case "distance":
   $id = 4;
   $list_name = 'Distance Fighting';
   break;
  case "shield":
   $id = 5;
   $list_name = 'Shielding';
   break;
  case "fishing":
   $id = 6;
   $list_name = 'Fishing';
   break;
}
if(!isset($id))
	if($list == "magic")
		$list_name = "Magic Level";
	else
	{
		$list_name = 'Experience';
		$list = 'experience';
	}
if(count($config['site']['worlds']) > 1)
{
	$worlds .= '<i>Select world:</i> ';
	foreach($config['site']['worlds'] as $idd => $world_n)
	{
		if($idd == (int) $_GET['world'])
		{
			$world_id = $idd;
			$world_name = $world_n;
		}
	}
}
		if($idd == (int) $_GET['world'])
		{
			$world_id = $idd;
			$world_name = $world_n;
		}
if(!isset($world_id))
{
	$world_id = 0;
	$world_name = $config['server']['serverName'];
}
$offset = $page * 100;
if(isset($id))
	$skills = $SQL->query('SELECT * FROM players, player_skills WHERE players.world_id = '.$world_id.' AND players.deleted = 0 AND players.group_id < '.$config['site']['players_group_id_block'].' AND players.id = player_skills.player_id AND player_skills.skillid = '.$id.' AND players.account_id != 1 ORDER BY value DESC, count DESC LIMIT 101 OFFSET '.$offset);
else
{
	if($list == "magic") 
	{
		$list_name = 'Magic Level';
		$skills = $SQL->query('SELECT * FROM players WHERE players.world_id = '.$world_id.' AND players.deleted = 0 AND players.group_id < '.$config['site']['players_group_id_block'].' AND account_id != 1 ORDER BY maglevel DESC, manaspent DESC LIMIT 101 OFFSET '.$offset);
	}
	else
	{
		$skills = $SQL->query('SELECT * FROM players WHERE players.world_id = '.$world_id.' AND players.deleted = 0 AND players.group_id < '.$config['site']['players_group_id_block'].' AND account_id != 1 ORDER BY level DESC, experience DESC LIMIT 101 OFFSET '.$offset);
		$list_name = 'Experience';
		$list = 'experience';
	}
}
$main_content .= '<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=100%><TR><TD></TD><TD><CENTER><H2>Rankings</H2></CENTER>';
	if(count($config['site']['worlds']) > 1)
	{			    
		

	}
		
$main_content .= '<TABLE BGCOLOR='.$config['site']['darkborder'].' BORDER=15 CELLPADDING=6 CELLSPACING=2 WIDTH=100%>
<TR BGCOLOR='.$config['site']['vdarkborder'].'><TD WIDTH=15% CLASS=white COLSPAN=5><center><B>Skills:</B></TD></TR></center>';
{
	$main_content .= '


			    <tr bgcolor='. $config['site']['lightborder'] .' ><td><A HREF="index.php?subtopic=highscores&list=experience&world='.$world_id.'" CLASS="size_xs">Experience</TD><td><A HREF="index.php?subtopic=highscores&list=magic&world='.$world_id.'" CLASS="size_xs">Magic</TD><td><A HREF="index.php?subtopic=highscores&list=shield&world='.$world_id.'" CLASS="size_xs">Shield</TD></TR>			 
				
				 <tr bgcolor='. $config['site']['lightborder'] .' ><td><A HREF="index.php?subtopic=highscores&list=distance&world='.$world_id.'" CLASS="size_xs">Distance</TD><td><A HREF="index.php?subtopic=highscores&list=club&world='.$world_id.'" CLASS="size_xs">Club</TD><td><A HREF="index.php?subtopic=highscores&list=sword&world='.$world_id.'" CLASS="size_xs">Sword</TD></TR>
					 
				 <tr bgcolor='. $config['site']['lightborder'] .' ><td><A HREF="index.php?subtopic=highscores&list=axe&world='.$world_id.'" CLASS="size_xs">Axe</TD><td><A HREF="index.php?subtopic=highscores&list=fist&world='.$world_id.'" CLASS="size_xs">First</TD><td><A HREF="index.php?subtopic=highscores&list=fishing&world='.$world_id.'" CLASS="size_xs">Fishing</TD></TR>';

	$main_content .= '</tr></Br></Br>';			 
}
	$main_content .= '<TABLE BORDER=1 CELLPADDING=4 CELLSPACING=1 WIDTH=100%><TR BGCOLOR="'.$config['site']['vdarkborder'].'"><TD WIDTH=10% CLASS=whites><B>#</B></TD><TD WIDTH=75% CLASS=whites><B>Name</B></TD><TD WIDTH=15% CLASS=whites><b><center>Level</center></B></TD>';
if($list == "experience") 
{
	$main_content .= '<TD CLASS=whites><b><center>Experiencia</center></B></TD>';
}
$main_content .= '</TR><TR></Br>';
foreach($skills as $skill)
{
	if($number_of_rows < 100)
	{
		if($list == "magic")
			$skill['value'] = $skill['maglevel'];
		if($list == "experience")
			$skill['value'] = $skill['level'];
		if(!is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
		$main_content .= '<tr bgcolor="'.$bgcolor.'">
			<td>'.($offset + $number_of_rows).'.</td>
			<td>'.$flag.'<a href="index.php?subtopic=characters&name='.urlencode($skill['name']).'">'.$skill['name'].'</a>';
				if(count($config['site']['worlds']) > 1)
					$main_content .= ', '.$config['site']['worlds'][$skill['world_id']];
				$main_content .= '</small>';
		$main_content .= '</td><td>'.$skill['value'].'</td>';
		if($list == "experience") 
			$main_content .= '<td>'.number_format($skill['experience'],0).'</td>';
		$main_content .= '</tr>';
	}
	else
		$show_link_to_next_page = TRUE;
}
if (!$skill){
$main_content .='
<tr bgcolor="'.$config['site']['darkborder'].'">
	<td colspan="4" align="center"><i>'.$config['server']['serverName'].' no have players created on database.</i></td>
</tr>
';}
$main_content .= '</TABLE><TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 WIDTH=100%>';
if($page > 0) 
	$main_content .= '<TR><TD WIDTH=100% ALIGN=right VALIGN=bottom><A HREF="index.php?subtopic=highscores&list='.$list.'&world='.$world_id.'&page='.($page - 1).'" CLASS="size_xxs">Previous Page</A></TD></TR>';
if($show_link_to_next_page) 
	$main_content .= '<TR><TD WIDTH=100% ALIGN=right VALIGN=bottom><A HREF="index.php?subtopic=highscores&list='.$list.'&world='.$world_id.'&page='.($page + 1).'" CLASS="size_xxs">Next Page</A></TD></TR>';
$main_content .= '</TABLE></TD><TD>
	<TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1>
		<TR BGCOLOR="'.$config['site']['vdarkborder'].'">

</CENTER>
			</TD>
		</TR>
	</TABLE></TD><TD></TD></TR></TABLE>';
?>