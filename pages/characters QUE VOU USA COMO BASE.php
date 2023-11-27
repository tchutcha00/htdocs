<?php
if(!defined('INITIALIZED'))
	exit;




$name = stripslashes(ucwords(strtolower(trim($_REQUEST['name']))));
if(empty($name)) {
        $main_content .= 'Here you can get detailed information about a certain player on '.$config['server']['serverName'].'.<BR>  <FORM ACTION="?subtopic=characters" METHOD=post><TABLE WIDTH=100% BORDER=1 CELLSPACING=1 CELLPADDING=4><TR><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>Procurar Player</B></TD></TR><TR><TD BGCOLOR="'.$config['site']['darkborder'].'"><TABLE BORDER=0 CELLPADDING=1><TR><TD>Nome:</TD><TD><INPUT NAME="name" VALUE=""SIZE=29 MAXLENGTH=29></TD><TD><INPUT TYPE=image NAME="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></TABLE></TD></TR></TABLE></FORM>';
}
else
{  
 if(check_name($name)) {
                $player = new Player();
		$player->find($name);
		if($player->isLoaded()) {
			$account = $player->getAccount();
			//check is premy account
			if($account->getCustomField("premdays") == 0) {
				$account_status = '<b><span class="red">Free Account</span></b>';
			}
			else
			{
				$account_status = '<b><span class="green">Premium Account</span></b>';
			}
			//set sex name
			if($player->getSex() == 0)
				$sex = 'female';
			else
				$sex = 'male';
                        $main_content .= '
			<div class="TableContainer" >  
				   
					<div class="CaptionContainer" >      
						<div class="CaptionInnerContainer" >        
							<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>        
							<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>        
							<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);" ></span>        
							<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></span>        
							<div class="Text" >Character Information</div>        
							<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></span>        
							<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);" ></span>        
							<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>        
							<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>      
						</div>    
					</div>
<table class="Table1" cellpadding="0" cellspacing="0">
		<tbody><tr>
			<td>
				<div class="InnerTableContainer">
					<table width="100%">
						<tbody>
						
						
						</tr>
	';
                        $main_content .= '<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=4 WIDTH=100%>';
                        if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                        $main_content .= '<td class="LabelV150"><b>Name:</b></TD><TD><font color="';
                        $main_content .= ($player->isOnline()) ? 'green' : 'red';
                        $main_content .= '"><b>'.$player->getName().'</b></font>';
                        if($player->isDeleted())
                                $main_content .= '<font color="red"> [DELETED]</font>';
                        if($player->isNameLocked())
                                $main_content .= '<font color="red"> [NAMELOCK]</font>';
                        $main_content .= '</TD></TR>';
                        if($player->getName())
                        {
                                if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                                if($player->isNameLocked())
                                        $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Proposition:</TD><TD>'.$player->getOldName().'</TD></TR>';  
                              else
$main_content .= '</TR>';                                
                        }
                                    // BEGIN Position Showing *** Fixed by jerryb1988 from otfans.net
            $group = $player->getGroup();
            if ($group == 2){$group_name = 'Tutor';}
            if ($group == 3){$group_name = 'Senior Tutor';}
            if ($group == 4){$group_name = 'Gamemaster';}
            if ($group == 5){$group_name = 'Community Manager';}
            if ($group == 6){$group_name = 'ADMINISTRADOR';}

            if($group != 1)
            {

                if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD><b>Posição:</b></TD><TD>'.$group_name.'</TD></TR>';
            }
            // END Position Showing
                        if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                        $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD><b>Sex:</b></TD><TD>';
                        $main_content .= ($player->getSex() == 0) ? 'Female' : 'Male';
                        $main_content .= '</TD></TR>';
                        if($config['site']['show_marriage_info'])
                        {
                                if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                                $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Marital status:</TD><TD>';
                                $marriage = new OTS_Player();
                                $marriage->load($player->getMarriage());
                                if($marriage->isLoaded())
                                        $main_content .= 'married to <a href="?subtopic=characters&name='.urlencode($marriage->getName()).'"><b>'.$marriage->getName().'</b></a></TD></TR>';
                                else
                                        $main_content .= 'single</TD></TR>';
                        }




                        if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                        $main_content .= '<tr bgcolor="' . $bgcolor . '"><td><b>Profession:</b></td><td>' . htmlspecialchars(Website::getVocationName($player->getVocation(), $player->getPromotion())) . '</td></tr>';
                        if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                        $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD><b>Level:</b></TD><TD>'.$player->getLevel().'</TD></TR>';
                        if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                        $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD><b>World:</b></TD><TD>'.$config['site']['worlds'][$player->getWorld()].'</TD></TR>';  
                        if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                        $playerhp = $player->getHealth(); 
                        $playermaxhp = $player->getHealthMax(); 
                        $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><td><b>Life Max:</b></td><td>' .number_format($playermaxhp).'</TD></TR>';
                        if ($player->getManaMax() > 0) {
                        $playermana = $player->getMana(); 
                        $playermaxmana = $player->getManaMax(); 
                        $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><td><b>Mana Max:</b></td><td>' .number_format($playermaxmana).'</td>'; 
                        }
                        $main_content .= '</TD></TR>';                                       
                        if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                        
                        if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                        $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD><b>Gold:</B></TD><TD>'.$player->getBalance(0).' Gold Coins.</TD></TR>';
                        {                       
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
                                $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD><b>Last Login:</b></TD><TD>Never logged in.</TD></TR>';
                        else
                                $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD><b>Last Login:</b></TD><TD>'.date("j F Y, g:i a", $lastlogin).'</TD></TR>';
                                if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
                        if($config['site']['show_creationdate'] && $player->getCreated())
                        {
                                $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD><b>Created:</b></TD><TD>'.date("j F Y, g:i a", $player->getCreated()).'</TD></TR>';
                        }
			$comment = $player->getCustomField("comment");
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
			$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD><b>Account Status:</b></TD><TD>'.$account_status.'</TD></TR></TABLE>';

				       


$main_content .= '</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div><br/>
			<div class="TableContainer" >  
				<table class="Table1" cellpadding="0" cellspacing="0" >    
					<div class="CaptionContainer" >      
						<div class="CaptionInnerContainer" >        
							<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>        
							<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>        
							<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);" ></span>        
							<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></span>        
							<div class="Text" >Quests</div>        
							<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></span>        
							<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);" ></span>        
							<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>        
							<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>      
						</div>    
					</div> 
<table class="Table1" cellpadding="0" cellspacing="0">

		<tbody><tr>
			<td>
				<div class="InnerTableContainer">
					<table width="100%">
						<tbody>
						<tr style="background-color:#af2126;">
							
						</tr>
	';
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
                        $questList .= '<TD><img src="images/true.png"/></TD></TR>';
                        $questCountDone++;
                    }
                }
                $ilosc_procent = ( $questCountDone / $questCount ) * 100;
                $questComplet .= '<tr bgcolor='.$bgcolor.'><td colspan=2><table width=100%><tr><td width=50%><b>Quest Progress</b>: '.round($ilosc_procent, 0).'%</td><td><div title="'.round($ilosc_procent, 0).'%" style="width: 100%; height: 3px; border: 1px solid #000;"><div style="background: green; width: '.$ilosc_procent.'%; height: 3px;"></td></tr></table>
                    </td></tr>';
                     $main_content .= '<table id="tableQsts" border="0" cellspacing="1" cellpadding="4" width="100%" style="display:none;">'.$questComplet.''.$questList.'</table>';
            }
                


$main_content .= '</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div><br/>
			<div class="TableContainer" >  
				<table class="Table1" cellpadding="0" cellspacing="0" >    
					<div class="CaptionContainer" >      
						<div class="CaptionInnerContainer" >        
							<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>        
							<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>        
							<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);" ></span>        
							<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></span>        
							<div class="Text" >Quests</div>        
							<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></span>        
							<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);" ></span>        
							<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>        
							<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span>      
						</div>    
					</div> 
<table class="Table1" cellpadding="0" cellspacing="0">

		<tbody><tr>
			<td>
				<div class="InnerTableContainer">
					<table width="100%">
						<tbody>
						<tr style="background-color:#af2126;">
							
						</tr>
	';
                        
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
                        
                        $deads = 0;

                        //deaths list
                        $player_deaths = $SQL->query('SELECT `id`, `date`, `level` FROM `player_deaths` WHERE `player_id` = '.$player->getId().' ORDER BY `date` DESC LIMIT 0,10;');
                        foreach($player_deaths as $death)
                        {
                                if(is_int($number_of_rows / 2))
                                        $bgcolor = $config['site']['darkborder']; else $bgcolor = $config['site']['lightborder'];

                                $number_of_rows++; $deads++;
                                $dead_add_content .= "<tr bgcolor=\"".$bgcolor."\">
                                <td width=\"20%\" align=\"center\">".date("j M Y, H:i", $death['date'])."</td>
                                <td>";
                                $killers = $SQL->query("SELECT environment_killers.name AS monster_name, players.name AS player_name, players.deleted AS player_exists FROM killers LEFT JOIN environment_killers ON killers.id = environment_killers.kill_id
LEFT JOIN player_killers ON killers.id = player_killers.kill_id LEFT JOIN players ON players.id = player_killers.player_id
WHERE killers.death_id = ".$SQL->quote($death['id'])." ORDER BY killers.final_hit DESC, killers.id ASC")->fetchAll();

                                $i = 0;
                                $count = count($killers);
                                foreach($killers as $killer)
                                {
                                        $i++;
                                        if(in_array($i, array(1, $count)))
                                                $killer['monster_name'] = str_replace(array("an ", "a "), array("", ""), $killer['monster_name']);

                                        if($killer['player_name'] != "")
                                        {
                                                if($i == 1)
                                                        $dead_add_content .= "Dead at level <b>".$death['level']."</b> por ";
                                                else if($i == $count)
                                                        $dead_add_content .= " e ";
                                                else
                                                        $dead_add_content .= ", ";

                                                if($killer['monster_name'] != "")
                                                        $dead_add_content .= $killer['monster_name']." summoned by ";

                                                if($killer['player_exists'] == 0)
                                                        $dead_add_content .= "<a href=\"index.php?subtopic=characters&name=".urlencode($killer['player_name'])."\">";

                                                $dead_add_content .= $killer['player_name'];
                                                if($killer['player_exists'] == 0)
                                                        $dead_add_content .= "</a>";
                                        }
                                        else
                                        {
                                                if($i == 1)
                                                        $dead_add_content .= "Dead at level <b>".$death['level']."</b> por ";
                                                else if($i == $count)
                                                        $dead_add_content .= " e ";
                                                else
                                                        $dead_add_content .= ", ";

                                                $dead_add_content .= $killer['monster_name'];
                                        }

                                        if($i == $count)
                                                $dead_add_content .= ".";
                                }

                                $dead_add_content .= "";
                        }

                        if($deads > 0)
                                $main_content .= '<TABLE BORDER=18 CELLSPACING=1 CELLPADDING=5 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=2 CLASS=white><Center><B>Deaths:</B></TD></TR></center>'. $dead_add_content . '</TABLE>';


//frags list by Xampy 
             
            $frags_limit = 5; // frags limit to show? // default: 5 
            $player_frags = $SQL->query('SELECT `player_deaths`.*, `players`.`name`, `killers`.`unjustified` FROM `player_deaths` LEFT JOIN `killers` ON `killers`.`death_id` = `player_deaths`.`id` LEFT JOIN `player_killers` ON `player_killers`.`kill_id` = `killers`.`id` LEFT JOIN `players` ON `players`.`id` = `player_deaths`.`player_id` WHERE `player_killers`.`player_id` = '.$player->getId().' ORDER BY `date` DESC LIMIT 0,'.$frags_limit.';'); 
            if(count($player_frags)) 
            { 
                $frags = 0; 
                $frag_add_content .= '<TABLE BORDER=18 CELLSPACING=1 CELLPADDING=5 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=2 CLASS=white><Center><B>Vitimas:</B></TD></TR></center>'; 
                foreach($player_frags as $frag)
  
                { 
                $frags++; 
                    if(is_int($number_of_rows / 2)) $bgcolor = $config['site']['darkborder']; else $bgcolor = $config['site']['lightborder']; 
                    $number_of_rows++; 
                    $frag_add_content .= "<tr bgcolor=\"".$bgcolor."\"> 
                    <td width=\"20%\" align=\"center\">".date("j M Y, H:i", $frag['date'])."</td> 
                    <td>".(($player->getSex() == 0) ? 'She' : 'He')." killed <a href=\"index.php?subtopic=characters&name=".$frag[name]."\">".$frag[name]."</a> at Level ".$frag[level].""; 
 
                    $frag_add_content .= ". (".(($frag[unjustified] == 0) ? "<font size=\"1\" color=\"green\">Justificado</font>" : "<font size=\"1\" color=\"red\">Injustificado</font>").")</td></tr>"; 
                } 
            if($frags >= 1) 
                $main_content .= $frag_add_content . '</TABLE>'; 
            } 
            // end of frags list by Xampy




                        //end
                        if(!$player->getHideChar()) {
                                
                                if($account->isBanned())
                                        if($account->getBanTime() > 0)
                                                $main_content .= '<font color="red"> [Banished until '.date("j F Y, G:i", $account->getBanTime()).']</font>';
                                        else
                                                $main_content .= '<font color="red"> [Banished FOREVER]</font>';
                                $main_content .= '';
                                $main_content .= '<TABLE BORDER=0></TABLE><TABLE BORDER=18 CELLSPACING=1 CELLPADDING=5 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=5 CLASS=white><center><B>Outros Personagems:</B></TD></TR></center>
                                <TR BGCOLOR='.$config['site']['darkborder'].'><TD><B>Name</B></TD><TD><B>World</B></TD><TD><B>Level</B></TD><TD><b>Status</b></TD><TD><B>*</B></TD></TR>';
                                $account_players = $account->getPlayersList();
                                $account = $player->getAccount();
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
                                                        $player_list_status = '<font color="red">Offline</font>';
                                                else
                                                        $player_list_status = '<font color="green">Online</font>';
                                                $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD WIDTH=52%><NOBR>'.$player_number.'.&#160;'.$player_list->getName();
                                                $main_content .= ($player_list->isDeleted()) ? '<font color="red"> [DELETED]</font>' : '';
                                                
					$main_content .= '</NOBR></TD><TD WIDTH=15%>'.$config['site']['worlds'][$player_list->getWorld()].'</TD><TD WIDTH=30%>'.$player_list->getLevel().' '.htmlspecialchars($vocation_name[$player_list->getPromotion()][$player_list->getVocation()]).'</TD><TD WIDTH="10%"><b>'.$player_list_status.'</b></TD><TD><TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0><FORM ACTION="?subtopic=characters" METHOD=post><TR><TD><INPUT TYPE="hidden" NAME="name" VALUE="'.htmlspecialchars($player_list->getName()).'"><INPUT TYPE=image NAME="View '.htmlspecialchars($player_list->getName()).'" ALT="View '.htmlspecialchars($player_list->getName()).'" SRC="'.$layout_name.'/images/buttons/sbutton_view.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></FORM></TABLE></TD></TR>';
                                        }
                                }
                                $main_content .= '</TABLE></TD><TD> </TD></TR></TABLE>';
                        }
                        $main_content .= '<FORM ACTION="?subtopic=characters" METHOD=post><TABLE WIDTH=100% BORDER=18 CELLSPACING=1 CELLPADDING=5><TR><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>Procurar Player</B></TD></TR><TR><TD BGCOLOR="'.$config['site']['darkborder'].'"><TABLE BORDER=0 CELLPADDING=1><TR><TD>Nome:</TD><TD><INPUT NAME="name" VALUE=""SIZE=29 MAXLENGTH=29></TD><TD><INPUT TYPE=image NAME="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></TABLE></TD></TR></TABLE></FORM>';
                        $main_content .= '</TABLE>';
                }
                else
                        $search_errors[] = 'Player <b>'.$name.'</b> não existe.';
        }
        else
                $search_errors[] = 'This name contains invalid letters. Please use only A-Z, a-z and space.';
        if(!empty($search_errors))
        {
                $main_content .= '<div class="SmallBox" >  <div class="MessageContainer" >    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="ErrorMessage" >      <div class="BoxFrameVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="BoxFrameVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></div>      <div class="AttentionSign" style="background-image:url('.$layout_name.'/images/content/attentionsign.gif);" /></div><b>The Following Errors Have Occurred:</b></br>';
                foreach($search_errors as $search_error)
                        $main_content .= '<li>'.$search_error;
                $main_content .= '</div>    <div class="BoxFrameHorizontal" style="background-image:url('.$layout_name.'/images/content/box-frame-horizontal.gif);" /></div>    <div class="BoxFrameEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>    <div class="BoxFrameEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></div>  </div></div><br/>';
                $main_content .= '<FORM ACTION="?subtopic=characters" METHOD=post><TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4><TR><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>Procurar Players</B></TD></TR><TR><TD BGCOLOR="'.$config['site']['darkborder'].'"><TABLE BORDER=1 CELLPADDING=1><TR><TD>Nome:</TD><TD><INPUT NAME="name" VALUE=""SIZE=29 MAXLENGTH=29></TD><TD><INPUT TYPE=image NAME="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=1 WIDTH=120 HEIGHT=18></TD></TR></TABLE></TD></TR></TABLE></FORM>';

        }

}
?>