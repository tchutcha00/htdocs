<?PHP
date_default_timezone_set('America/Araguaina');
$name = stripslashes(ucwords(strtolower(trim($_REQUEST['name']))));
if(empty($name))
		$main_content .= 'Here you can get detailed information about a certain player on '.$config['server']['serverName'].'.<BR>  <form action="?subtopic=characters" method="post"><div class="TableContainer">  <table class="Table1" cellpadding="0" cellspacing="0">    <div class="CaptionContainer">      <div class="CaptionInnerContainer">        <span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>        <span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>        <span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>        <span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>        <div class="Text">Search Character</div>        <span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>        <span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>        <span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>        <span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>      </div>    </div>    <tr>      <td>        <div class="InnerTableContainer">          <table width="100%"><tr><td style="vertical-align:middle" class="LabelV150"><b>Character Name:</b></td><td style="width:170px"><input style="width:165px" name="name" value="" size="29" maxlength="29"/></td><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)"><div onmouseover="MouseOverBigButton(this)" onmouseout="MouseOutBigButton(this)"><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif)"></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif"></div></div></td></tr>          </table>        </div>  </table></div></td></tr></form></center>';

else
{
	if(check_name($name)) 
	{
		$player = new Player();
		$player->find($name);
		if($player->isLoaded()) 
		{
			$account = $player->getAccount();
			$account_db = new Account();
			if($config['site']['show_flag'])
			{
				$flagg = $account->getCustomField("flag");
				$flag = '<image src="http://images.boardhost.com/flags/'.$flagg.'.png"/> ';
			}
		$main_content .=
'<div class="TableContainer">
	<table class="Table3" cellpadding="0" cellspacing="0">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
				<div class="Text">Informações dos Personagens</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
			</div>
		</div>
		<tr>
			<td>
				<div class="InnerTableContainer">
					<table width="100%">
						<tr>
						<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
														
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>';
																	
			$main_content .= '<TABLE BORDER=0 CELLPADDING=4 CELLSPACING=0 WIDTH=100%></TR>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD WIDTH=20%>Name:</TD><TD>'.$flag.'<font color="';
				$main_content .= '">'.$player->getName().'     </font>';
				$main_content .= ($player->isOnline()) ?  '<img src="images/inventario/online.gif"/>' : '<img src="images/inventario/offline.gif"/>';	
				if($player->isDeleted())
					$main_content .= '<font color="red"> [DELETED]</font>';
				if($player->isNameLocked())
					$main_content .= '<font color="red"> [NAMELOCK]</font>';
				$main_content .= '</TD></TR>';
				
			/*
			if($player->getOldName())
			{
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
					if($player->isNameLocked())
						$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Proposition:</TD><TD>'.$player->getOldName().'</TD></TR>';
					else
						$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Old name:</TD><TD>'.$player->getOldName().'</TD></TR>';
			}
			*/
			
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Sex:</TD><TD>';
				$main_content .= ($player->getSex() == 0) ? 'female' : 'male';
				$main_content .= '</TD></TR>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Profession:</TD><TD>' . htmlspecialchars(Website::getVocationName($player->getVocation(), $player->getPromotion())) . '</TD></TR>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Level:</TD><TD>'.$player->getLevel().'</TD></TR>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>World:</TD><TD>'.$config['site']['worlds'][$player->getWorld()].'</TD></TR>';
			if(!empty($towns_list[$player->getWorld()][$player->getTownId()]))
			{
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Residence:</TD><TD>'.$towns_list[$player->getWorld()][$player->getTownId()].'</TD></TR>';
			}
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Marital status:</TD><TD>';
				$marriage = new Player();
				$marriage->load($player->getMarriage());
				if($marriage->isLoaded())
					$main_content .= 'married to <a href="?subtopic=characters&name='.urlencode($marriage->getName()).'"><b>'.$marriage->getName().'</b></a></TD></TR>';
				else
					$main_content .= 'single</TD></TR>';
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                        $playerhp = $player->getHealth(); 
                        $playermaxhp = $player->getHealthMax(); 
                        $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><td>Vida Maxíma:</td><td><font color="red"><b>' .number_format($playermaxhp).'</b></font></TD></TR>';
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                       $playermana = $player->getMana(); 
                        $playermaxmana = $player->getManaMax();  
                        $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><td>Mana Maxíma:</td><td><font color="blue"><b>' .number_format($playermaxmana).'</b></font></TD></TR>';
                if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                        $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Money:</TD><TD><font color="#ffcc00"><b>'.$player->getBalance(0).' Gold Coins.</b></font></TD></TR>';						
			$house = $SQL->query( 'SELECT `houses`.`name`, `houses`.`town`, `houses`.`lastwarning` FROM `houses` WHERE `houses`.`world_id` = '.$player->getWorld().' AND `houses`.`owner` = '.$player->getId().';' )->fetchAll();
			if ( count( $house ) != 0 )
			{
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>House:</TD><TD colspan="2">';
					$main_content .= $house[0]['name'].' ('.$towns_list[$player->getWorld()][$house[0]['town']].') is paid until '.date("j M Y G:i", $house[0]['lastwarning']).'</TD></TR>';
			}
			$rank_of_player = $player->getRank();
			if(!empty($rank_of_player))
			{
				{
					$guild_id = $rank_of_player->getGuild()->getId();
					$guild_name = $rank_of_player->getGuild()->getName();
					if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Guild Membership:</TD><TD>'.$rank_of_player->getName().' of the <a href="?subtopic=guilds&action=show&guild='.$guild_id.'">'.$guild_name.'</a></TD></TR>';
				}
			}
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$lastlogin = $player->getLastLogin();
				if(empty($lastlogin))
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Last login:</TD><TD colspan="2">Never logged in.</TD></TR>';
				else
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Last login:</TD><TD colspan="2">'.date("j F Y, g:i a", $lastlogin).'</TD></TR>';

			$comment = $player->getCustomField("comment");
			$comment = preg_replace(array('/<s(.*?)>/', '/<S(.*?)>/', '/<\/s(.*?)>/', '/<\/S(.*?)>/', '/< s(.*?)>/', '/< S(.*?)>/'), '', $comment);

			$newlines   = array("\r\n", "\n", "\r");
			$comment_with_lines = str_replace($newlines, '<br />', $comment, $count);
			if($count < 50)
				$comment = $comment_with_lines;
			if(!empty($comment))
			{
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD VALIGN=top>Comment:</TD><TD>'.$comment.'</TD></TR>';
			}
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$account_status .= ($account->isPremium()) ? 'Premium Account' : 'Free Account';
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Account Status:</TD><TD>'.$account_status.'</TD></TR>';
				// ** OUTFIT SHOWER -- fixed by Sekk
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
$main_content .= '<TD BGCOLOR="'.$bgcolor.'">Outfit:<TD style="background-color: '.$bgcolor.'"><image src="animatedOutfits1099/animoutfit.php?id='.$player->getLookType().'&addons='.$player->getLookAddons().'&head='.$player->getLookHead().'&body='.$player->getLookBody().'&legs='.$player->getLookLegs().'&feet='.$player->getLookFeet().'"/></TD></TD>';
//END OUTFIT SHOWER
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
			$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD VALIGN=top>Inventario:</TD><TD> <img id="btnItems" style="vertical-align:middle;cursor:pointer;" src="images/show.gif"> </TD></TR>';
			$main_content .= '<table id="tableItems" style="display:none;" width=100%><tr>';
//equipment shower by ballack13
$id = $player->getCustomField("id");
$number_of_items = 1;
$main_content .= '<td align=center><table with=100% style="border: solid 1px #000000;" CELLSPACING="0"><TR>';
$list = array('2','1','3','6','4','5','9','7','10','8');
foreach ($list as $pid => $name) {
$top = $SQL->query('SELECT * FROM player_items WHERE player_id = '.$id.' AND pid = '.$list[$pid].';')->fetch();
if($top[itemtype] == false) {
if($list[$pid] == '8') {
$main_content .= '<td BGCOLOR="#262626" ; text-align: center;"><font color="white"><small>Soul:<br/>'.$player->getSoul().'</small></font></td>';
}
if(is_int($number_of_items / 3)){
$main_content .= '<td BGCOLOR="#262626" ; text-align: center;"><img src="images/items/'.$list[$pid].'.gif" width="35"/></TD></tr><tr>';
} else {
$main_content .= '<td BGCOLOR="#262626" ; text-align: center;"><img src="images/items/'.$list[$pid].'.gif" width="35"/></TD>';
}
$number_of_items++;
}
else
{
if($list[$pid] == '8') {
$main_content .= '<td BGCOLOR="#262626" ; text-align: center;"><font color="white"><small>Soul:<br/>'.$player->getSoul().'</small></font></td>';
}
if(is_int($number_of_items / 3))
$main_content .= '<td BGCOLOR="#262626" ; text-align: center;"><img src="images/items/'.$top[itemtype].'.gif" width="35"/></TD></tr><tr>';
else
$main_content .= '<td BGCOLOR="#262626" ; text-align: center;"><img src="images/items/'.$top[itemtype].'.gif" width="35"/></TD>';
$number_of_items++;
}
if($list[$pid] == '8') {
$main_content .= '<td BGCOLOR="#262626" ; text-align: center;"><small><font color="white">Cap:<br/>'.$player->getCap().'</small></font></td>';
}
}
$main_content .= '</tr></TABLE></td>';

				$main_content .= '</TABLE>';            
                $main_content .= '</TD></TR></TABLE>';
                        $main_content .= '</TR></TABLE></div>';
                        

 //modified status scripts by ballack13
 //rogaforyn2 tried to edit this to get more hide and show stuffs
   $main_content .= '<br />
            </td>
                </tr></tbody>
            </table>';  

				
				$main_content .=
'<div class="TableContainer">
	<table class="Table3" cellpadding="1" cellspacing="1">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
				<div class="Text">Quests</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
			</div>
		</div>
		<tr>
			<td>
				<div class="InnerTableContainer">
					<table width="100%">
						<tr>
						<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
														
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>';
				
			// Quest list show
			if($config['site']['showQuests'])
			{
				$main_content .= '<br />
            <table border="0" cellspacing="1" cellpadding="4" width="100%">
                <tbody><tr bgcolor="#505050"><td colspan="2" class="white">
                    <img id="btnQsts" style="vertical-align:middle;cursor:pointer;" src="images/show.gif"> 
                    <b>Quests</b></td>
                </tr></tbody>
            </table>';                     
				$quests = $config['site']['quests'];
				$questCount = count($config['site']['quests']);
				$questCountDone = 0;
				foreach($quests as $storage => $name) 
				{
					if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
					$quest = $SQL->query('SELECT * FROM player_storage WHERE player_id = '.$player->getId().' AND `key` = '.$quests[$storage].';')->fetch();
					$questList .= '<TR bgcolor="'.$bgcolor.'"><TD WIDTH=98%>'.$storage.'</TD>';
					if($quest == false) 
					{
						$questList .= '<TD><img src="images/false.png"/></TD></TR>';
					}
					else
					{
						$questList .= '<TD><img src="images/true."/></TD></TR>';
						 $questCountDone++;
                    }
                }
                $ilosc_procent = ( $questCountDone / $questCount ) * 100;
                $questComplet .= '<tr bgcolor='.$bgcolor.'><td colspan=2><table width=100%><center><b>Quest Progress</b>: '.round($ilosc_procent, 0).'%</center></td><td><div title="'.round($ilosc_procent, 0).'%" style="width: 100%; height: 9px; border: 1px solid #000000;"><div style="background: green; width: '.$ilosc_procent.'%; height: 3px;"></td></tr></table>
                    </td></tr>';
                     $main_content .= '<table id="tableQsts" border="0" cellspacing="1" cellpadding="4" width="100%" style="display:none;">'.$questComplet.''.$questList.'</table>';
            }
			 $main_content .= '</TABLE>';            
                $main_content .= '</TD></TR></TABLE>';
                        $main_content .= '</TR></TABLE></div><br />';
			
			$main_content .=
'<div class="TableContainer">
	<table class="Table3" cellpadding="0" cellspacing="0">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
				<div class="Text">Frags and Deaths</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
			</div>
		</div>
		<tr>
			<td>
				<div class="InnerTableContainer">
					<table width="100%">
						<tr>
						<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
														
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>';
				  //deaths list
        $player_deaths = $SQL->query('SELECT ' . $SQL->fieldName('id') . ', ' . $SQL->fieldName('date') . ', ' . $SQL->fieldName('level') . ' FROM ' . $SQL->tableName('player_deaths') . ' WHERE ' . $SQL->fieldName('player_id') . ' = '.$player->getId().' ORDER BY ' . $SQL->fieldName('date') . ' DESC LIMIT 10');
        foreach($player_deaths as $death)
        {
            $bgcolor = (($number_of_rows++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
            $deads++;
            $dead_add_content .= "<tr bgcolor=\"".$bgcolor."\"><td width=\"20%\" align=\"center\">".date("j M Y, H:i", $death['date'])."</td><td>";
            $killers = $SQL->query('SELECT ' . $SQL->tableName('environment_killers') . '.' . $SQL->fieldName('name') . ' AS monster_name, ' . $SQL->tableName('players') . '.' . $SQL->fieldName('name') . ' AS player_name, ' . $SQL->tableName('players') . '.' . $SQL->fieldName('deleted') . ' AS player_exists FROM ' . $SQL->tableName('killers') . ' LEFT JOIN ' . $SQL->tableName('environment_killers') . ' ON ' . $SQL->tableName('killers') . '.' . $SQL->fieldName('id') . ' = ' . $SQL->tableName('environment_killers') . '.' . $SQL->fieldName('kill_id') . ' LEFT JOIN ' . $SQL->tableName('player_killers') . ' ON ' . $SQL->tableName('killers') . '.' . $SQL->fieldName('id') . ' = ' . $SQL->tableName('player_killers') . '.' . $SQL->fieldName('kill_id') . ' LEFT JOIN ' . $SQL->tableName('players') . ' ON ' . $SQL->tableName('players') . '.' . $SQL->fieldName('id') . ' = ' . $SQL->tableName('player_killers') . '.' . $SQL->fieldName('player_id') . '  WHERE ' . $SQL->tableName('killers') . '.' . $SQL->fieldName('death_id') . ' = ' . $SQL->quote($death['id']) . ' ORDER BY ' . $SQL->tableName('killers') . '.' . $SQL->fieldName('final_hit') . ' DESC, ' . $SQL->tableName('killers') . '.' . $SQL->fieldName('id') . ' ASC')->fetchAll();

            $i = 0;
            $count = count($killers);
            foreach($killers as $killer)
            {
                $i++;
                if($i == 1)
                {
                    if($count <= 4)
                        $dead_add_content .= "killed at level <b>".$death['level']."</b> by ";
                    elseif($count > 4 and $count < 10)
                        $dead_add_content .= "slain at level <b>".$death['level']."</b> by ";
                    elseif($count > 9 and $count < 15)
                        $dead_add_content .= "crushed at level <b>".$death['level']."</b> by ";
                    elseif($count > 14 and $count < 20)
                        $dead_add_content .= "eliminated at level <b>".$death['level']."</b> by ";
                    elseif($count > 19)
                        $dead_add_content .= "annihilated at level <b>".$death['level']."</b> by ";
                }
                elseif($i == $count)
                    $dead_add_content .= " and ";
                else
                    $dead_add_content .= ", ";

                if($killer['player_name'] != "")
                {
                    if($killer['monster_name'] != "")
                        $dead_add_content .= htmlspecialchars($killer['monster_name'])." summoned by ";

                    if($killer['player_exists'] == 0)
                        $dead_add_content .= "<a href=\"?subtopic=characters&name=".urlencode($killer['player_name'])."\">";

                    $dead_add_content .= htmlspecialchars($killer['player_name']);
                    if($killer['player_exists'] == 0)
                        $dead_add_content .= "</a>";
                }
                else
                    $dead_add_content .= htmlspecialchars($killer['monster_name']);
            }

            $dead_add_content .= "</td></tr>";
        }

        $main_content .= '<br />
            <table border="0" cellspacing="1" cellpadding="4" width="100%">
                <tbody><tr bgcolor="#505050"><td colspan="2" class="white">
                    <img id="btnDeaths" style="vertical-align:middle;cursor:pointer;" src="images/show.gif"> 
                    <b>Character Deaths</b></td>
                </tr></tbody>
            </table>';
            $main_content .= '<table id="tableDeaths" border="1" cellspacing="1" cellpadding="4" width="100%" style="display:none;">' . $dead_add_content . '</table>';
            //frags by Mateus Fiereck
            $frags_limit = 999; 
            $player_frags = $SQL->query('SELECT `player_deaths`.*, `players`.`name`, `killers`.`unjustified` FROM `player_deaths` LEFT JOIN `killers` ON `killers`.`death_id` = `player_deaths`.`id` LEFT JOIN `player_killers` ON `player_killers`.`kill_id` = `killers`.`id` LEFT JOIN `players` ON `players`.`id` = `player_deaths`.`player_id` WHERE `player_killers`.`player_id` = '.$player->getId().' AND `killers`.`unjustified` = 0 ORDER BY `date` DESC LIMIT 0,'.$frags_limit.';');
            if (count($player_frags)) {
                $main_content .= '<br />
            <table border="0" cellspacing="1" cellpadding="4" width="100%">
                <tbody><tr bgcolor="#505050"><td colspan="2" class="white">
                    <img id="btnJustified" style="vertical-align:middle;cursor:pointer;" src="images/show.gif"> 
                    <b>Frags Justified</b></td>
                </tr></tbody>
            </table>';
                
                $frags = 0; 
                $frag_add_content .= '<table id="tableJustified" border="0" cellspacing="1" cellpadding="4" width="100%" style="display:none;">'; 
				
                foreach($player_frags as $frag) {
                    $frags++; 
                    if (is_int($number_of_rows / 2)) $bgcolor = $config['site']['darkborder']; else $bgcolor = $config['site']['lightborder']; 
                    $number_of_rows++; 
                    $frag_add_content .= "<tr bgcolor=\"".$bgcolor."\"> 
                    <td width=\"20%\" align=\"center\">".date("j M Y, H:i", $frag['date'])."</td> 
                    <td>".(($player->getSex() == 0) ? 'She' : 'He')." fragged <a href=\"index.php?subtopic=characters&name=".$frag['name']."\">".$frag['name']."</a> at level ".$frag['level'].""; 
                    $frag_add_content .= ". (".(($frag['unjustified'] == 0) ? "<font size=\"1\" color=\"green\">Justified</font>" : "<font size=\"1\" color=\"red\">Unjustified</font>").")</td></tr>"; 
                }
                if($frags >= 1) 
					
                    $main_content .= $frag_add_content . '</TABLE>'; 
				
            }
            
            $player_frags2 = $SQL->query('SELECT `player_deaths`.*, `players`.`name`, `killers`.`unjustified` FROM `player_deaths` LEFT JOIN `killers` ON `killers`.`death_id` = `player_deaths`.`id` LEFT JOIN `player_killers` ON `player_killers`.`kill_id` = `killers`.`id` LEFT JOIN `players` ON `players`.`id` = `player_deaths`.`player_id` WHERE `player_killers`.`player_id` = '.$player->getId().' AND `killers`.`unjustified` = 1 ORDER BY `date` DESC LIMIT 0,'.$frags_limit.';'); 
            if (count($player_frags2)) {
                $main_content .= '<br />
            <table border="0" cellspacing="1" cellpadding="4" width="100%">
                <tbody><tr bgcolor="#505050"><td colspan="2" class="white">
                    <img id="btnUnjustified" style="vertical-align:middle;cursor:pointer;" src="images/show.gif"> 
                    <b>Frags Unjustified</b></td>
                </tr></tbody>
            </table>';
                
                $frags2 = 0; 
                $frag_add_content2 .= '<table id="tableUnjustified" border="0" cellspacing="1" cellpadding="4" width="100%" style="display:none;">'; 
                foreach($player_frags2 as $frag) {
                    $frags2++; 
                    if (is_int($number_of_rows / 2)) $bgcolor = $config['site']['darkborder']; else $bgcolor = $config['site']['lightborder']; 
                    $number_of_rows++; 
                    $frag_add_content2 .= "<tr bgcolor=\"".$bgcolor."\"> 
                    <td width=\"20%\" align=\"center\">".date("j M Y, H:i", $frag['date'])."</td> 
                    <td>".(($player->getSex() == 0) ? 'She' : 'He')." fragged <a href=\"index.php?subtopic=characters&name=".$frag['name']."\">".$frag['name']."</a> at level ".$frag['level'].""; 
                    $frag_add_content2 .= ". (".(($frag['unjustified'] == 0) ? "<font size=\"1\" color=\"green\">Justified</font>" : "<font size=\"1\" color=\"red\">Unjustified</font>").")</td></tr>"; 
                }
                if($frags2 >= 1)
                    $main_content .= $frag_add_content2 . '</TABLE>'; 
            }
            
            $main_content .= '<br />
            
                                                                        </tr></tbody>
            </table>';
            {
                if (is_int($number_of_rows / 2)) $bgcolor = $config['site']['darkborder']; else $bgcolor = $config['site']['lightborder']; 
                $number_of_rows++;
                $main_content .= "<tr bgcolor=\"".$bgcolor."\"> 
                <td width=\"20%\" align=\"center\">".$task[0]."</td> 
                ".$qtd."".$task[2]."</tr>";
            } 
            $main_content .= '</table>';
            
            $main_content .= "
            <script>
            $(function() {
                $('#btnDeaths').click(function() {
                    $('#tableDeaths').toggle();
                    if ($(this).attr('src') == 'images/show.gif') {
                        $(this).attr('src', 'images/hide.gif');
                    } else {
                        $(this).attr('src', 'images/show.gif');
                    }
                });
                
                $('#btnQsts').click(function() {
                    $('#tableQsts').toggle();
                    if ($(this).attr('src') == 'images/show.gif') {
                        $(this).attr('src', 'images/hide.gif');
                    } else {
                        $(this).attr('src', 'images/show.gif');
                    }
                });
                
 $('#btnItems').click(function() {
                    $('#tableItems').toggle();
                       $('#tableSkills').toggle();
                    if ($(this).attr('src') == 'images/show.gif') {
                        $(this).attr('src', 'images/hide.gif');
                    } else {
                        $(this).attr('src', 'images/show.gif');
                    }
                     
                });
                
                
                $('#btnJustified').click(function() {
                    $('#tableJustified').toggle();
                    if ($(this).attr('src') == 'images/show.gif') {
                        $(this).attr('src', 'images/hide.gif');
                    } else {
                        $(this).attr('src', 'images/show.gif');
                    }
                });
                
                $('#btnUnjustified').click(function() {
                    $('#tableUnjustified').toggle();
                    if ($(this).attr('src') == 'images/show.gif') {
                        $(this).attr('src', 'images/hide.gif');
                    } else {
                        $(this).attr('src', 'images/show.gif');
                    }
                });
                
                $('#btnTasks').click(function() {
                    $('#tableTasks').toggle();
                    if ($(this).attr('src') == 'images/show.gif') {
                        $(this).attr('src', 'images/hide.gif');
                    } else {
                        $(this).attr('src', 'images/show.gif');
                    }
                });
            })</script>";
				$main_content .= '</TABLE>';            
                $main_content .= '</TD></TR></TABLE>';
                        $main_content .= '</TR></TABLE></div><br />';
			// onther info
			$main_content .=
'<div class="TableContainer">
	<table class="Table3" cellpadding="0" cellspacing="0">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
				<div class="Text">Account Information</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
			</div>
		</div>
		<tr>
			<td>
				<div class="InnerTableContainer">
					<table width="100%">
						<tr>
						<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
														
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>';
			if(!$player->getHideChar()) 
			{
				$main_content .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>';
	
	            $group = $player->getGroup();
            if ($group == 2){$group_name = 'Tutor';}
            if ($group == 3){$group_name = 'Senior Tutor';}
            if ($group == 4){$group_name = 'Gamemaster';}
            if ($group == 5){$group_name = 'Community Manager';}
            if ($group == 6){$group_name = 'God';}
            if ($group == 7){$group_name = 'Administrador';}

            if($group != 1)
            {

               
                $main_content .= '<TR BGCOLOR='.$config['site']['darkborder'].'><TD>Position:</TD><TD>'.$group_name.'</TD></TR>';
            }			
				
				
				$name = $account->getRLName();
				if(!empty($name)){
				$main_content .= '<TR BGCOLOR='.$config['site']['lightborder'].'><TD WIDTH=20%>Real Name:</TD><TD>'.htmlspecialchars($account->getRLName()).'</TD></TR>';	
				}
				$location = $account->getLocation();
				if(!empty($location)){
				$main_content .= '<TR BGCOLOR='.$config['site']['darkborder'].'><TD WIDTH=20%>Location:</TD><TD>'.htmlspecialchars($account->getLocation()).'</TD></TR>';
				}
				if($account->getCreateDate())
				{
					if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
					$main_content .= '<TR BGCOLOR='.$config['site']['lightborder'].'><TD WIDTH=20%>Created:</TD><TD>'.date("j F Y, g:i a", $account->getCreateDate()).'</TD></TR>';
                
				/*Vip Status*/ 
            if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;  
            $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Vip Status:</TD><TD>';  
            $main_content .= ($account->getVipTime()) ? '<font color="#00CD00"><b>Vip Account</b></font>' : '<font color="#FF0000"><b>Not Vip Account</b></font>';
				}
				if($account->isBanned())
                                        if($account->getBanTime() > 0)
						$main_content .= '<font color="red"> [Banished until '.date("j F Y, G:i", $account->getBanTime()).']</font>';
					else
						$main_content .= '<font color="red"> [Banished FOREVER]</font>';
				
				$main_content .= '</TABLE>';            
                $main_content .= '</TD></TR></TABLE>';
                        $main_content .= '</TR></TABLE></div><br />';
						$main_content .=
'<div class="TableContainer">
	<table class="Table3" cellpadding="0" cellspacing="0">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
				<div class="Text">Account Information</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>
			</div>
		</div>
		<tr>
			<td>
				<div class="InnerTableContainer">
					<table width="100%">
						<tr>
						<tr>
												<td>
													<div class="TableShadowContainerRightTop" >
														<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rt.gif);" ></div>
													</div>
													<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rm.gif);" >
														<div class="TableContentContainer" >
														
															<table class="TableContent" width="100%"  style="border:1px solid #faf0d7;" >
																<tr>';
				$main_content .= '<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=4 WIDTH=100%></TR>
					<TR BGCOLOR='.$config['site']['darkborder'].'><TD><B>Name</B></TD><TD><B>World</B></TD><TD><b>Status</b></TD><TD><B>&#160;</B></TD></TR>';
				$account_players = $account->getPlayersList();
				$player_number = 0;
				foreach($account_players as $player_list)
				{
					if(!$player_list->getHideChar())
					{
						$player_number++;
						if(is_int($player_number / 2))
							$bgcolor = $config['site']['darkborder'];
						else
							$bgcolor = $config['site']['lightborder'];
						if(!$player_list->isOnline())
							$player_list_status = '<b><font color="red">Offline</font></b>';
						else
							$player_list_status = '<b><font color="#00CD00">Online</font></b>';
						$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD WIDTH=18%><NOBR>'.$player_number.'.&#160;'.$player_list->getName();
						$main_content .= ($player_list->isDeleted()) ? '<font color="red"> [DELETED]</font>' : '';
						$main_content .= '</NOBR></TD><TD WIDTH=12%>'.$config['site']['worlds'][$player_list->getWorld()].'<TD WIDTH="60%"><b>'.$player_list_status.'</b></TD><TD><TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0><FORM ACTION="?subtopic=characters" METHOD=post><TR><TD><INPUT TYPE=hidden NAME=name VALUE="'.$player_list->getName().'"><INPUT TYPE=image NAME="View '.$player_list->getName().'" ALT="View '.$player_list->getName().'" SRC="'.$layout_name.'/images/buttons/sbutton_view.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></FORM></TABLE></TD></TR>';
					}
				}
				$main_content .= '</TABLE>';            
                $main_content .= '</TD></TR></TABLE>';
                        $main_content .= '</TR></TABLE></div>';
			}
			$main_content .= '<br><form action="?subtopic=characters" method="post"><div class="TableContainer">  <table class="Table1" cellpadding="0" cellspacing="0">    <div class="CaptionContainer">      <div class="CaptionInnerContainer">        <span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>        <span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>        <span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>        <span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>        <div class="Text">Search Character</div>        <span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>        <span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>        <span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>        <span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>      </div>    </div>    <tr>      <td>        <div class="InnerTableContainer">          <table width="100%"><tr><td style="vertical-align:middle" class="LabelV150"><b>Character Name:</b></td><td style="width:170px"><input style="width:165px" name="name" value="" size="29" maxlength="29"/></td><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)"><div onmouseover="MouseOverBigButton(this)" onmouseout="MouseOutBigButton(this)"><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif)"></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif"></div></div></td></tr>          </table>        </div>  </table></div></td></tr></form></center>';
			$main_content .= '</TABLE>';
		}
		else
			$search_errors[] = 'Character <b>'.$name.'</b> does not exist.';
	}
	else
		$search_errors[] = 'This name contains invalid letters. Please use only A-Z, a-z and space.';
	if(!empty($search_errors))
	{
		$main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b><br/>';
		foreach($search_errors as $search_error)
		$main_content .= '<li>'.$search_error;
		$main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br/>';
		$main_content .= '<BR><form action="?subtopic=characters" method="post"><div class="TableContainer">  <table class="Table1" cellpadding="0" cellspacing="0">    <div class="CaptionContainer">      <div class="CaptionInnerContainer">        <span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>        <span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>        <span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>        <span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>        <div class="Text">Search Character</div>        <span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif)"></span>        <span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif)"></span>        <span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>        <span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif)"></span>      </div>    </div>    <tr>      <td>        <div class="InnerTableContainer">          <table width="100%"><tr><td style="vertical-align:middle" class="LabelV150"><b>Character Name:</b></td><td style="width:170px"><input style="width:165px" name="name" value="" size="29" maxlength="29"/></td><td><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)"><div onmouseover="MouseOverBigButton(this)" onmouseout="MouseOutBigButton(this)"><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif)"></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif"></div></div></td></tr>          </table>        </div>  </table></div></td></tr></form></center>';
	}
}
?>
