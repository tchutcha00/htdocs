<?PHP
$main_content .='<style type="text/css">
/*System created by Leandro*/
a.equipment{border:none;cursor:help}a.equipment img{border:none}a.equipment span{visibility:hidden;display:none}a.equipment:hover{position:relative;text-decoration:none}a:hover.equipment span{border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;box-shadow:3px 3px 3px rgba(0,0,0,.4);-webkit-box-shadow:3px 3px rgba(0,0,0,.4);-moz-box-shadow:3px 3px rgba(0,0,0,.4);font-family:Verdana,sans-serif;position:absolute;left:.25em;top:1.25em;z-index:99;background:#333;border:2px solid #111;font-weight:400;text-align:center;text-decoration:none;padding:.1em;width:175px;display:block;opacity:.95;filter:alpha(opacity=95);z-index:150}#equipment .EquipTitleNormal{font-size:12px;color:#1eff00}#equipment .EquipTitleMagical{font-size:12px;color:#0070dd}#equipment .EquipTitleDonation{font-size:12px;font-weight:700;color:yellow}#equipment .EquipText{font-size:10px;color:#fff}.CharAttrHeader{font-size:10px;font-weight:700;text-align:right;padding-right:5px;background:#d4c0a1}.CharAttrText{font-size:9px;text-align:left;background:#f1e0c6}.ItemSlotStroke{color:#fff;text-shadow:-1px -1px 0 #000,1px -1px 0 #000,-1px 1px 0 #000,1px 1px 0 #000;position:absolute;padding-top:18px;z-index:150}#equipment a:hover span,#equipment a:active span,#equipment a:focus span{visibility:visible}#equipment a:hover,#equipment a:focus{visibility:visible}
</style>';
date_default_timezone_set('America/Araguaina');
$name = stripslashes(ucwords(strtolower(trim($_REQUEST['name']))));
if(empty($name))
		$main_content .= '<FORM ACTION="?subtopic=characters" METHOD=post>
		<div class="TableContentContainer">
		<TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4><TR><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>Search Character</B></TD></TR><TR><TD BGCOLOR="'.$config['site']['darkborder'].'">
		<TABLE BORDER=0 CELLPADDING=1>
			<TR>
				<TD>Name:</TD>
				<TD><input name="name" maxlength="30" type="text" class="custom-field" value="" /></TD>
				<TD><INPUT TYPE=image NAME="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD>
			</TR>
		</TABLE></TD></TR></TABLE></div></FORM>';
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
				$flag = '<image src="images/flags/'.$flagg.'.gif"/> ';
			}
			$main_content .= '<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=100%><TR><TD></TD><TD>
			<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
			<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
			<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
			<div class="Text">Character Information</div>
			<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
			<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
			<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				</div>
					</div>
						<table class="Table3" cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
									<td>
									<div class="InnerTableContainer">
										<table style="width:100%;">
											<tbody>
												<tr>
													<td>
														<div class="TableShadowContainerRightTop">
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
														</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
			<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'></TR>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD WIDTH=20%>Name:</TD><TD>';
				$main_content .= ''.$player->getName().' '.$flag.'';
				$main_content .= ($player->isOnline()) ? '<img src="images/online.gif"/>' : '<img src="images/offline.gif"/>';
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
			$house = $SQL->query( 'SELECT `houses`.`name`, `houses`.`town`, `houses`.`lastwarning` FROM `houses` WHERE `houses`.`world_id` = '.$player->getWorld().' AND `houses`.`owner` = '.$player->getId().';' )->fetchAll();
			if ( count( $house ) != 0 )
			{
				if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>House:</TD><TD colspan="2">';
					$main_content .= $house[0]['name'].' ('.$towns_list[$player->getWorld()][$house[0]['town']].') is paid until '.date("j M Y G:i", $house[0]['lastwarning']).'</TD></TR>';
			}
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$lastlogin = $player->getLastLogin();
				if(empty($lastlogin))
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Last login:</TD><TD colspan="2">Never logged in.</TD></TR>';
				else
					$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Last login:</TD><TD colspan="2">'.date("j F Y, g:i a", $lastlogin).'</TD></TR>';

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
				$account_status .= ($account->isPremium()) ? 'Premium Account' : 'Free Account';
				$main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Account Status:</TD><TD>'.$account_status.'</TD></TR>';
			if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
			// Equip
			$number_of_items = 1;
			$items = simplexml_load_file($config['site']['server_path'].'C:/Users/Kalunga/Downloads/Otserv/data/items/items.xml') or die('<b>Could not load items!</b>');
			$itemcout = 0;
            foreach($items->item as $v)
            $itemList[(int)$v['id']] = ucwords(strtolower($v['name']));
				
				$contentEquipment .= '

				<div id="equipment" class="signBgrnd">
				<div class="cap"><a class="equipment" style="color: rgb(199, 197, 193)">Cap:<br>'.$player->getCap().'<span><font class="EquipTitleDonation">Cap:</font><br><font class="EquipText">'.$player->getCap().'</font></span></a></div>
				<div class="soul"><a class="equipment" style="color: rgb(199, 197, 193)">Soul:<br>'.$player->getSoul().'<span><font class="EquipTitleDonation">Soul:</font><br><font class="EquipText">'.$player->getSoul().'</font></span></a></div>
				';
                $itensname = $config['site']['itensname'];				
				$list = array('2','1','3','6','4','5','9','7','10','8'); 
				foreach ($list as $pid => $name) 
				{ 
					$top = $SQL->query('SELECT * FROM player_items WHERE player_id = '.$player->getId().' AND pid = '.$list[$pid].' AND itemtype;')->fetch();			
					if($top[itemtype] == true)  
					{ 
						if($list[$pid] == '1') {
							$contentEquipment .= '<div class="helm"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
								<img src="images/items/'.$top[itemtype].'.gif" style="max-width:64px" /><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a>
							</div>';
						}
						if($list[$pid] == '2') {
							$contentEquipment .= '<div class="amulet"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
								<img src="images/items/'.$top[itemtype].'.gif" style="max-width:64px" /><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a>
							</div>';
						}
						if($list[$pid] == '3') {
							$contentEquipment .= '<div class="backpack"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
								<img src="images/items/'.$top[itemtype].'.gif" style="max-width:64px" /><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a>
							</div>';
						}
						if($list[$pid] == '4') {
							$contentEquipment .= '<div class="arm"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
								<img src="images/items/'.$top[itemtype].'.gif" style="max-width:64px" /><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a>
							</div>';
						}
						if($list[$pid] == '5') {
							$contentEquipment .= '<div class="shield"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
								<img src="images/items/'.$top[itemtype].'.gif" style="max-width:64px" /><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a>
							</div>';
						}
						if($list[$pid] == '6') {
							$contentEquipment .= '<div class="wep"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
								<img src="images/items/'.$top[itemtype].'.gif" style="max-width:64px" /><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a>
							</div>';
						}
						if($list[$pid] == '7') {
							$contentEquipment .= '<div class="legs"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
								<img src="images/items/'.$top[itemtype].'.gif" style="max-width:64px" /><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a>
							</div>';
						}
						if($list[$pid] == '8') {
							$contentEquipment .= '<div class="boots"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
								<img src="images/items/'.$top[itemtype].'.gif" style="max-width:64px" /><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a>
							</div>';
						}
						if($list[$pid] == '9') {
							$contentEquipment .= '<div class="ring"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
								<img src="images/items/'.$top[itemtype].'.gif" style="max-width:64px" /><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a>
							</div>';
						}
						if($list[$pid] == '10') {
							$contentEquipment .= '<div class="arrow"><a class="equipment" style="text-align:center;"><span class="itemStroke">1</span></a><a class="equipment">
								<img src="images/items/'.$top[itemtype].'.gif" style="max-width:64px" /><span><font class="EquipTitleDonation">'.$itemList[(int)$top[itemtype]].'</font><br>' .(($top['count'] >= 2) ? '<font class="EquipText"><b>Quantidade:</b> '.$top['count'].'<br/>' : '').'</font>	<font class="EquipText">'.$itensname[$top[itemtype]].'</font></font></span></a>
							</div>';
						}
						$number_of_items++; 
					} 
				}
				$contentEquipment .= '</div>';
				$staminaDefault = 151200000;
				$staminaPlayer = $player->getCustomField("stamina");
				$currentlevelexp = (50 * ($player->getLevel() - 1) * ($player->getLevel() - 1) * ($player->getLevel() - 1) - 150 * ($player->getLevel() - 1) * ($player->getLevel() - 1) + 400 * ($player->getLevel() - 1)) / 3; 
				function getTime($value)
				{
				$h = floor($value / 3600000);
				$m = floor(($value - $h * 3600000) / 60000);
				if($m == '0') {
					$m = '00';
				}
				return $h.':'.$m;
				}
				if($staminaPlayer <= 50400000)
					$colorbg = 'red';
				elseif($staminaPlayer <= 144000000)
					$colorbg = 'orange';
				else
					$colorbg = 'lime';
				$stamminaPer = ($staminaPlayer / $staminaDefault) * 100;
				$hp = ($player->getHealth() / $player->getHealthMax() * 100);
                $mana = ($player->getMana() / $player->getManaMax() * 100);
				$contentSkills .= '
				<table>
				<div class="lifebarpercent" style="width: '.$hp.'%";><span class="hptext">'.$player->getHealth().'</span>
				<div class="lifebarbk"></div></div>
				<div class="manapercent" style="width: '.$mana.'%";><span class="manatext">'.$player->getMana().'</span>
				<div class="manabk"></div></div>
				<div id="equipment" class="SkillsBgrnd">
				<div class="exp">'.number_format($currentlevelexp, 0).'</div>
				<div class="level">'.$player->getLevel().'</div>
				<div class="hitpoints"><font style="text-shadow: -1px -1px 0 rgba(0,0,0,0.50),1px -1px 0 rgba(0,0,0,0.50),-1px 1px 0 rgba(0,0,0,0.50),1px 1px 0 rgba(0,0,0,0.50);" color="red">'.$player->getHealth().'</font></div>
				<div class="mana"><font style="text-shadow: -1px -1px 0 rgba(0,0,0,0.50),1px -1px 0 rgba(0,0,0,0.50),-1px 1px 0 rgba(0,0,0,0.50),1px 1px 0 rgba(0,0,0,0.50);" color="DodgerBlue">'.$player->getMana().'</font></div>
				<div class="soul">'.$player->getSoul().'</div>
				<div class="cap">'.number_format($player->getCap(), 0).'</div>
				<div class="stamina"><font style="text-shadow: -1px -1px 0 rgba(0,0,0,0.50),1px -1px 0 rgba(0,0,0,0.50),-1px 1px 0 rgba(0,0,0,0.50),1px 1px 0 rgba(0,0,0,0.50);" color="'.$colorbg.'">'.getTime($staminaPlayer).'</font></div>
				<div class="magiclevel">'.$player->getMagLevel().'</div>
				<div class="Fist">'.$player->getSkill(0).'</div>
				<div class="Club">'.$player->getSkill(1).'</div>
				<div class="Sword">'.$player->getSkill(2).'</div>
				<div class="Axe">'.$player->getSkill(3).'</div>
				<div class="Distance">'.$player->getSkill(4).'</div>
				<div class="Shield">'.$player->getSkill(5).'</div>
				<div class="Fishing">'.$player->getSkill(6).'</div>		
				</div></table>';
				
				$citizen = $player->getStorage(48500) && $player->getStorage(48501);
				$hunter = $player->getStorage(48502) && $player->getStorage(48503);
				$knight = $player->getStorage(48504) && $player->getStorage(48505);
				$mage = $player->getStorage(48506) && $player->getStorage(48507);
				$summoner = $player->getStorage(48508) && $player->getStorage(48509);
				$barbarian = $player->getStorage(48510) && $player->getStorage(48511);
				$druid = $player->getStorage(48512) && $player->getStorage(48513);
				$nobleman = $player->getStorage(48514) && $player->getStorage(48515);
				$oriental = $player->getStorage(48516) && $player->getStorage(48517);
				$warrior = $player->getStorage(48518) && $player->getStorage(48519);
				$wizard = $player->getStorage(48520) && $player->getStorage(48521);
				$assassin = $player->getStorage(48522) && $player->getStorage(48523);
				$beggar = $player->getStorage(48524) && $player->getStorage(48525);
				$pirate = $player->getStorage(48526) && $player->getStorage(48527);
				$shaman = $player->getStorage(48528) && $player->getStorage(48529);
				$norseman = $player->getStorage(48530) && $player->getStorage(48531);
				$jester = $player->getStorage(48532) && $player->getStorage(48533);
				$demonhunter = $player->getStorage(48534) && $player->getStorage(48535);
				$nightmare = $player->getStorage(48536) && $player->getStorage(48537);
				$brotherhood = $player->getStorage(48538) && $player->getStorage(48539);
				$yalaharian = $player->getStorage(48540) && $player->getStorage(48541);
				$warmaster = $player->getStorage(48542) && $player->getStorage(48543);
				$wayfarer = $player->getStorage(48544) && $player->getStorage(48545);
				
				$getLookType .= '
				<table>
				<div id="equipment" class="OutfitBgrnd">
					<div style="text-align: center;margin-top: 11px;">';
				if($player->getSex() == 1) {
					if($citizen > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=128&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=128&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($hunter > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=129&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=129&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($knight > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=131&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=131&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($mage > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=130&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=130&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($summoner > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=133&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=133&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($barbarian > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=143&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=143&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($druid > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=144&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=144&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($nobleman > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=132&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=132&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($oriental > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=146&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=146&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($warrior > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=134&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=134&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($wizard > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=145&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=145&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($assassin > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=152&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=152&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($beggar > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=153&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=153&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($pirate > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=151&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=151&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($shaman > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=154&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=154&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($norseman > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=251&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=251&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($jester > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=273&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=273&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($demonhunter > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=289&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=289&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($nightmare > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=268&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=268&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($brotherhood > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=278&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=278&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($yalaharian > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=325&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=325&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($warmaster > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=335&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=335&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($wayfarer > 0)
						$getLookType .= '<img class="img" src="' . $config['site']['outfit_images_url'] . '?id=367&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=367&addons=3&head=0&body=0&legs=0&feet=0"/>';
				}
				if($player->getSex() == 0) {
					if($citizen > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=136&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=136&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($hunter > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=137&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=137&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($knight > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=139&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=139&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($mage > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=141&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=141&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($summoner > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=138&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=138&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($barbarian > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=147&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=147&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($druid > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=148&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=148&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($nobleman > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=140&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=140&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($oriental > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=150&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=150&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($warrior > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=142&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=142&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($wizard > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=149&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=149&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($assassin > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=156&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=156&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($beggar > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=157&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=157&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($pirate > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=155&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=155&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($shaman > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=158&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=158&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($norseman > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=252&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=252&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($jester > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=270&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=270&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($demonhunter > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=288&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=288&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($nightmare > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=269&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=269&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($brotherhood > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=279&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=279&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($yalaharian > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=324&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=324&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($warmaster > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=336&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=336&addons=3&head=0&body=0&legs=0&feet=0"/>';
					if($wayfarer > 0)
						$getLookType .= '<img src="' . $config['site']['outfit_images_url'] . '?id=366&addons=3&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '"/>';
					else
						$getLookType .= '<img class="grayimg" src="' . $config['site']['outfit_images_url'] . '?id=366&addons=3&head=0&body=0&legs=0&feet=0"/>';
				}
				$getLookType .= '</div></div></table>';
				if(!$player->getHideChar()) 
				{
					$main_content .= '<tr bgcolor="'.$bgcolor.'"><td>Inventário:</td><td><img id="ButtonEMail" onMouseDown="ToggleMaskedText(\'EMail\');" style="cursor:pointer;" src="'.$layout_name.'/images/general/show.gif"/><span id="DisplayEMail" ></span><span id="MaskedEMail" style="visibility:hidden;display:none" ></span><span id="ReadableEMail" style="visibility:hidden;display:none" ><br><br>'.$contentEquipment.''.$contentSkills.''.$getLookType.'</span></td></tr>';
					if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
					$main_content .= '
					<tr bgcolor="'.$bgcolor.'"><td>Outfit:</td>
					<td>
					<img id="ButtonOutfit" onMouseDown="ToggleMaskedText(\'Outfit\');" style="cursor:pointer;" src="'.$layout_name.'/images/general/show.gif"/>
					<span class="itemStroke"></span>
					<span id="DisplayOutfit" >
					</span>
					<span id="MaskedOutfit" style="visibility:hidden;display:none" >
					</span>
					<span id="ReadableOutfit" style="visibility:hidden;display:none">
					<br><br>
					<image src="/outfits/animoutfit.php?id='.$player->getLookType().'&addons='.$player->getLookAddons().'&head='.$player->getLookHead().'&body='.$player->getLookBody().'&legs='.$player->getLookLegs().'&feet='.$player->getLookFeet().'" width="64" height="64" style="width: 64px; height: 64px; position: absolute; background-position: 0 0; background-repeat: no-repeat; left: 137px; margin-top: -10px;"/>
					<script type="text/javascript">
						$(function(){
						//Preparar o data array com as img urls
						var dataArray=new Array();
						dataArray[0]="' . $config['site']['outfit_images_url'] . '?id=' . $player->getLookType() . '&addons=' . $player->getLookAddons() . '&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '&feet=86&direction=2.png";
						dataArray[1]="' . $config['site']['outfit_images_url'] . '?id=' . $player->getLookType() . '&addons=' . $player->getLookAddons() . '&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '&feet=86&direction=3.png";
						dataArray[2]="' . $config['site']['outfit_images_url'] . '?id=' . $player->getLookType() . '&addons=' . $player->getLookAddons() . '&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '&feet=86&direction=4.png";
						dataArray[3]="' . $config['site']['outfit_images_url'] . '?id=' . $player->getLookType() . '&addons=' . $player->getLookAddons() . '&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '&feet=86&direction=1.png";
						dataArray[4]="' . $config['site']['outfit_images_url'] . '?id=' . $player->getLookType() . '&addons=' . $player->getLookAddons() . '&head=' . $player->getLookHead() . '&body=' . $player->getLookBody() . '&legs=' . $player->getLookLegs() . '&feet=' . $player->getLookFeet() . '&feet=86&direction=2.png";
				
						//startar com id=0 depois de 0.5 segundos
						var thisId=0;

						window.setInterval(function(){
							$("#ImagemOutfit").attr("src",dataArray[thisId]);
							thisId++; //increment data array id
							if (thisId==4) thisId=0; //repetir
						},500);        
					});
					;
					</script>
					<img style="margin-bottom: 10px;margin-left: 0px;margin-top: 3px;margin: 3px;width: 57px;height: 57px;background: rgba(155, 155, 155, 0.53);border-radius: 10px;border: 1.5px solid #434040;box-shadow: inset 0px 0px 10px rgba(0,0,0,0.5);" src="images/outfitbg.gif" width="64" height="64">
					</td>
					</tr>
					</span>';
				}
				$rank_of_player = $player->getRank();
				if(!empty($rank_of_player))
				{
				{
					$guild_id = $rank_of_player->getGuild()->getId();
					$guild_name = $rank_of_player->getGuild()->getName();
					if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
				$main_content .= '
				<TR BGCOLOR="'.$bgcolor.'"><td colspan="2">
				<img src="/guild_image.php?id='.$guild_id.'" width="100" height="100" border="0" style="border: 1.5pt solid #333332;border-radius: 10px;background-color: rgba(2, 18, 34, 0.38);box-shadow: inset 0px 0px 10px rgba(0,0,0,0.5);margin-left: 10%;"/></a></br>
					<div style="position: absolute;margin-top: -100px;margin-left: 30%;">
					<b style="font-size: x-large;">'.$rank_of_player->getName().' da Guild <span style="color: brown !important;">'.$guild_name.'</span></b></br>Rank: '.$rank_of_player->getName().' of the <a href="?subtopic=guilds&action=show&guild='.$guild_id.'">'.$guild_name.'</a><br>';
				$castle24 = $SQL->query('SELECT `winner_name`, `winner_guild`, `winner_guild_id`, `data`,`hora` FROM `castle` ORDER BY `id` DESC;');
				$epiccastle = $SQL->query('SELECT `winner_name`, `winner_guild`, `winner_guild_id`, `data`,`hora` FROM `epiccastle` ORDER BY `id` DESC;');
				foreach($castle24 as $info) {
				if ($info['winner_guild_id'] == ''.$guild_id.'')
				$main_content .= '
				<img src="images/castle.png" style="margin:0 0px -1px 0" border="0"><b> <span style="background: transparent url(images/bg.gif);color:white;text-shadow: black 1px 1px 10px;">Guild dona do Castle 24 Horas atualmente. </b></span><img src="images/castle.png" style="margin:0 0px -1px 0" border="0"><br>';
				}
				foreach($epiccastle as $info) {
				if ($info['winner_guild_id'] == ''.$guild_id.'')
				$main_content .= '
				<img src="images/castle.png" style="margin:0 0px -1px 0" border="0"><b> <span style="background: transparent url(images/bg.gif);color:white;text-shadow: black 1px 1px 10px;">Guild dona do Epic Castle atualmente! </b></span><img src="images/castle.png" style="margin:0 0px -1px 0" border="0">';
				}
				$main_content .= '</div></TD></TR>';
				}
				}
				$main_content .= '</TD></TR></TABLE>
				</div>
									</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
											<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
											<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</td>
				</div>
			</tr>
		</tbody>
	</table>
</div>
';

			// Quest list show
			if($config['site']['showQuests'])
			{
				$main_content .= '';               
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
						$questList .= '<TD><img src="images/false.gif"/></TD></TR>';
					}
					else
					{
						$questList .= '<TD><img src="images/true.gif"/></TD></TR>';
						$questCountDone++;
					}
				}
				$ilosc_procent = ( $questCountDone / $questCount ) * 100;
				$questComplet .= '
				<tr bgcolor='.$bgcolor.'>
				<td colspan=2>
				<table width=100%>
				<tr>
				<td width=30%><b>Quest Complet</b>: '.round($ilosc_procent, 0).'%</td>
				<td>
				<div class="loading-container-6" title="'.round($ilosc_procent, 0).'%" style="width: 100%; height: 6px; border: 1px solid #000;border-radius: 10px;">
				<div style="background: url(\'images/questsbar.png\'); width: '.$ilosc_procent.'%; height: 6px;">
				</div>
				</div>
				</td>
				</tr>
				</table>
				</td>
				</tr>';
				$main_content .= '<BR>
				<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
			<span class="CaptionEdgeLeftTop" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightTop" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionBorderTop" style="background-image:url(./layouts/tibiarl/images/content/table-headline-border.gif);"></span>
			<span class="CaptionVerticalLeft" style="background-image:url(./layouts/tibiarl/images/content/box-frame-vertical.gif);"></span>
			<div class="Text">Quests</div>
			<span class="CaptionVerticalRight" style="background-image:url(./layouts/tibiarl/images/content/box-frame-vertical.gif);"></span>
			<span class="CaptionBorderBottom" style="background-image:url(./layouts/tibiarl/images/content/table-headline-border.gif);"></span>
			<span class="CaptionEdgeLeftBottom" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightBottom" style="background-image:url(./layouts/tibiarl/images/content/box-frame-edge.gif);"></span>
		</div>
	</div>
	<table class="Table5" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<div class="InnerTableContainer">
						<table style="width:100%;">
							<tbody>
								<tr>
									<td>
										<div class="TableShadowContainerRightTop" >
											<div class="TableShadowRightTop" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rt.gif);" ></div>
										</div>
										<div class="TableContentAndRightShadow" style="background-image:url(./layouts/tibiarl/images/global/content/table-shadow-rm.gif);" >
										<div class="TableContentContainer" >

				<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR=#505050><TD COLSPAN=2 CLASS=white><img id="ButtonQuests" onMouseDown="ToggleMaskedText(\'Quests\');" style="vertical-align:middle;cursor:pointer;" src="'.$layout_name.'/images/global/general/show.gif"/> <B>Quests</B></TD></TR></TABLE>
				<span id="DisplayQuests" ></span>
				<span id="MaskedQuests" style="visibility:hidden;display:none" ></span>
				<span id="ReadableQuests" style="visibility:hidden;display:none" >
				<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>
				'.$questComplet.''.$questList.'
				</TABLE></span>
				</div>
									</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
											<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
											<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</td>
				</div>
			</tr>
		</tbody>
	</table>
</div>
				';
			}

			// Vip List show
			if($config['site']['showVipList'])
			{
				// Table player_viplist: player_id, vip_id
				// Table account_viplist: account_id, world_id, player_id
				$vip = 0;
				if($config['server']['separateVipListPerCharacter'] == false)
					$vipLists = $SQL->query('SELECT * FROM `account_viplist` WHERE `account_id` = '.$account->getId().';');
				else
					$vipLists = $SQL->query('SELECT * FROM `player_viplist` WHERE `player_id` = '.$player->getId().';');
				foreach($vipLists as $vipList) 
				{
					if($config['server']['separateVipListPerCharacter'] == false)
						$result = $SQL->query('SELECT * FROM `players` WHERE `id` = '.$vipList['player_id'].';');
					else
						$result = $SQL->query('SELECT * FROM `players` WHERE `id` = '.$vipList['vip_id'].';');
					foreach($result as $listVip)
					{
						$vip++;
						if($config['site']['show_flag'])
						{
							$accounts = $SQL->query('SELECT * FROM accounts WHERE id = '.$listVip['account_id'].'')->fetch();
							$flags = '<image src="http://images.boardhost.com/flags/'.$accounts['flag'].'.png"/> ';
						}
						if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
							$vipResult .= '<tr bgcolor='.$bgcolor.'>
								<td>'.$vip.'</td>
								<td>
									'.$flags.'<a href="index.php?subtopic=characters&name='.urlencode($listVip['name']).'">'.$listVip['name'].'</a>';
									if($config['site']['showMoreInfo'])
										$vipResult .= '<br><small>Level: '.$listVip['level'].', '.$vocation_name[$listVip['world_id']][$listVip['promotion']][$listVip['vocation']].', '.$config['site']['worlds'][$listVip['world_id']].'</small>';
								$vipResult .= '</td>
							</tr>';
					}
				}
				if($vip > 0)
					$main_content .= '<br><table border=0 cellspacing=1 cellpadding=4 width=100%><TR bgcolor='.$config['site']['vdarkborder'].'><TD align="left" COLSPAN=2 CLASS=white><B>Vip List</B></TD></TR>'.$vipResult.'</table>';
			}
			// Deaths list
			$deads = 0;
			$player_deaths = $SQL->query('SELECT `id`, `date`, `level` FROM `player_deaths` WHERE `player_id` = '.$player->getId().' ORDER BY `date` DESC LIMIT 0,'.$config['site']['limitDeath'].'');
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
							$dead_add_content .= "Killed at level <b>".$death['level']."</b> by ";
						else 
							if($i == $count)
								$dead_add_content .= " and by ";
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
							$dead_add_content .= "Died at level <b>".$death['level']."</b> by ";
						else 
							if($i == $count)
								$dead_add_content .= " and by ";
							else
								$dead_add_content .= ", ";
						$dead_add_content .= $killer['monster_name'];
					}
					if($i == $count)
						$dead_add_content .= ".";
				}
				$dead_add_content .= ".</td></tr>";
			}
				
            //frags list by Xampy 
             
            $frags_limit = 250; // frags limit to show? // default: 10 
            $player_frags = $SQL->query('SELECT `player_deaths`.*, `players`.`name`, `killers`.`unjustified` FROM `player_deaths` LEFT JOIN `killers` ON `killers`.`death_id` = `player_deaths`.`id` LEFT JOIN `player_killers` ON `player_killers`.`kill_id` = `killers`.`id` LEFT JOIN `players` ON `players`.`id` = `player_deaths`.`player_id` WHERE `player_killers`.`player_id` = '.$player->getId().' AND `killers`.`unjustified` = 0 ORDER BY `date` DESC LIMIT 0,'.$frags_limit.';'); 
            if(count($player_frags)) 
            {
				 $frag_add_content .= '<br>
				<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<div class="Text">Frags and Deaths</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
					</div>
						</div>
							<table class="Table5" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td>
										<div class="InnerTableContainer">
											<table style="width:100%;">
												<tbody>				
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR=#505050><TD COLSPAN=2 CLASS=white><img id="ButtonInjust" onMouseDown="ToggleMaskedText(\'Injust\');" style="vertical-align:middle;cursor:pointer;" src="'.$layout_name.'/images/global/general/show.gif"/> <B>Frags Justified</B></TD></TR></TABLE>

				<span id="DisplayInjust" ></span>
				<span id="MaskedInjust" style="visibility:hidden;display:none" ></span>'; 
                $frags = 0; 
                $frag_add_content .= '<span id="ReadableInjust" style="visibility:hidden;display:none" >
				
				<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>'; 
                foreach($player_frags as $frag) 
                { 
                $frags++; 
                    if(is_int($number_of_rows / 2)) $bgcolor = $config['site']['darkborder']; else $bgcolor = $config['site']['lightborder']; 
                    $number_of_rows++; 
                    $frag_add_content .= "<tr bgcolor=\"".$bgcolor."\"> 
                    <td width=\"20%\" align=\"center\">".date("j M Y, H:i", $frag['date'])."</td> 
                    <td>".(($player->getSex() == 0) ? 'She' : 'He')." fragged <a href=\"index.php?subtopic=characters&name=".$frag[name]."\">".$frag[name]."</a> at level ".$frag[level].""; 
 
                    $frag_add_content .= ". (".(($frag[unjustified] == 0) ? "<font size=\"1\" color=\"green\">Justified</font>" : "<font size=\"1\" color=\"red\">Unjustified</font>").")</td></tr>"; 
                } 
                $main_content .= $frag_add_content . '</TABLE></span>
				</div>
														</div>											
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >
				';  
				}

			 //frags list by Xampy 
             
            $frags_limit = 250; // frags limit to show? // default: 10 
            $player_frags_unjust = $SQL->query('SELECT `player_deaths`.*, `players`.`name`, `killers`.`unjustified` FROM `player_deaths` LEFT JOIN `killers` ON `killers`.`death_id` = `player_deaths`.`id` LEFT JOIN `player_killers` ON `player_killers`.`kill_id` = `killers`.`id` LEFT JOIN `players` ON `players`.`id` = `player_deaths`.`player_id` WHERE `player_killers`.`player_id` = '.$player->getId().' AND `killers`.`unjustified` = 1 ORDER BY `date` DESC LIMIT 0,'.$frags_limit.';'); 
            if(count($player_frags_unjust)) 
            { 
				$frag_unjust_add_content .= '
				<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR=#505050><TD COLSPAN=2 CLASS=white><img id="ButtonUnjust" onMouseDown="ToggleMaskedText(\'Unjust\');" style="vertical-align:middle;cursor:pointer;" src="'.$layout_name.'/images/global/general/show.gif"/> <B>Frags Unjustified</B></TD></TR></TABLE>
				<span id="DisplayUnjust" ></span>
				<span id="MaskedUnjust" style="visibility:hidden;display:none" ></span>';
				
                $frags = 0; 
                $frag_unjust_add_content .= '<span id="ReadableUnjust" style="visibility:hidden;display:none" >
				<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>'; 
                foreach($player_frags_unjust as $frag_unjust) 
                { 
                $frags++; 
                    if(is_int($number_of_rows / 2)) $bgcolor = $config['site']['darkborder']; else $bgcolor = $config['site']['lightborder']; 
                    $number_of_rows++; 
                    $frag_unjust_add_content .= "<tr bgcolor=\"".$bgcolor."\"> 
                    <td width=\"20%\" align=\"center\">".date("j M Y, H:i", $frag_unjust['date'])."</td> 
                    <td>".(($player->getSex() == 0) ? 'She' : 'He')." fragged <a href=\"index.php?subtopic=characters&name=".$frag_unjust[name]."\">".$frag_unjust[name]."</a> at level ".$frag_unjust[level].""; 
 
                    $frag_unjust_add_content .= ". (".(($frag_unjust[unjustified] == 0) ? "<font size=\"1\" color=\"green\">Justified</font>" : "<font size=\"1\" color=\"red\">Unjustified</font>").")</td></tr>"; 
                } 
				
                $main_content .= $frag_unjust_add_content . '</TABLE></span>	
														</div>
														</div>											
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
												<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
													<div class="TableContentContainer" >
				<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD COLSPAN=2 CLASS=white><img id="ButtonDeaths" onMouseDown="ToggleMaskedText(\'Deaths\');" style="vertical-align:middle;cursor:pointer;" src="'.$layout_name.'/images/global/general/show.gif"/> <B>Deaths</B></TD></TR></TABLE>
				<span id="DisplayDeaths" ></span>
				<span id="MaskedDeaths" style="visibility:hidden;display:none" ></span>
				<span id="ReadableDeaths" style="visibility:hidden;display:none">
				<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>
				' . $dead_add_content . '
				</TABLE></span>
													</div>
												</div>
												<div class="TableShadowContainer" >
													<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
													<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
													<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
													</div>
												</div>
											</td>
										</tr>			
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</tbody>
		</table>
	</div>';  
			}	
				
				
			// onther info
			if(!$player->getHideChar()) 
			{
				$main_content .= '<BR>
									<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<div class="Text">Account Information</div>
				<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
				<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
					</div>
						</div>
							<table class="Table5" cellpadding="0" cellspacing="0">
								<tbody>
									<tr>
										<td>
										<div class="InnerTableContainer">
											<table style="width:100%;">
												<tbody>
												<tr>
													<td>
														<div class="TableShadowContainerRightTop" >
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rt.gif);" ></div>
														</div>
														<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-rm.gif);" >
															<div class="TableContentContainer" >

				<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'></TR>';
	
	            $group = $player->getGroup();
			if ($group == 1){$group_name = 'Player';}
            if ($group == 2){$group_name = 'Tutor';}
            if ($group == 3){$group_name = 'Senior Tutor';}
            if ($group == 4){$group_name = 'Gamemaster';}
            if ($group == 5){$group_name = 'Community Manager';}
            if ($group == 6){$group_name = 'God';}
            if ($group == 7){$group_name = 'Administrador';}

                $main_content .= '<TR BGCOLOR='.$config['site']['darkborder'].'><TD>Group:</TD><TD>'.$group_name.'</TD></TR>';		
				
				
				$name = $account->getRLName();
				if(!empty($name)){
				$main_content .= '<TR BGCOLOR='.$config['site']['lightborder'].'><TD WIDTH=20%>Real Name:</TD><TD>'.$account->getRLName().'</TD></TR>';	
				}
				$location = $account->getLocation();
				if(!empty($location)){
				$main_content .= '<TR BGCOLOR='.$config['site']['darkborder'].'><TD WIDTH=20%>Location:</TD><TD>'.$account->getLocation().'</TD></TR>';
				}
				if($account->getCreateDate())
				{
					if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
					$main_content .= '<TR BGCOLOR='.$config['site']['lightborder'].'><TD WIDTH=20%>Created:</TD><TD>'.date("j F Y, g:i a", $account->getCreateDate()).'</TD></TR>';
                
				/*Vip Status*/ 
            if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['darkborder']; } $number_of_rows++;  
            $main_content .= '<TR BGCOLOR="'.$bgcolor.'"><TD>Premium Status:</TD><TD>';  
            $main_content .= ($account->isPremium() > 0) ? '<font color="#00CD00" style="text-shadow: 1px 1px #014b01;"><b>Premium Account</b></font>' : '<font color="#FF0000" style="text-shadow: 1px 1px #580208;"><b>Free Account</b></font>';
				}
				if($account->isBanned())
                                        if($account->getBanTime() > 0)
						$main_content .= '<font color="red"> [Banished until '.date("j F Y, G:i", $account->getBanTime()).']</font>';
					else
						$main_content .= '<font color="red"> [Banished FOREVER]</font>';
				
				$main_content .= '</TABLE>
													</div>
														</div>																
														<div class="TableShadowContainer" >
															<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bm.gif);" >
																<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-bl.gif);" ></div>
																<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/global/content/table-shadow-br.gif);" ></div>
															</div>
														</div>
													</td>
												</tr>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
				';
				$main_content .= '<BR>
				<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
			<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
			<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
			<div class="Text">Characters</div>
			<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
			<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
			<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				</div>
					</div>
						<table class="Table3" cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
									<td>
									<div class="InnerTableContainer">
										<table style="width:100%;">
											<tbody>
												<tr>
													<td>
														<div class="TableShadowContainerRightTop">
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
														</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
				<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'></TR>
					<TR BGCOLOR='.$config['site']['darkborder'].'><TD><B>Outfit</B></TD><TD><B>Name</B></TD><TD><B>World</B></TD><TD><b>Status</b></TD><TD><B>&#160;</B></TD></TR>';
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
							$player_list_status = '';
						else
							$player_list_status = '<font color="#00CD00" style="text-shadow: 1px 1px #043d00;"><b>Online</b></font>';
						$main_content .= '<tr bgcolor="'.$bgcolor.'"><td style="border:1px solid #faf0d7;"> <div style="position: relative; width: 32px; height: 32px;"> <div style="background-image: url(' . $config['site']['outfit_images_url'] . '?id='.$player_list->getLookType().'&addons='.$player_list->getLookAddons().'&head='.$player_list->getLookHead().'&body='.$player_list->getLookBody().'&legs='.$player_list->getLookLegs().'&feet='.$player_list->getLookFeet().');position: absolute; width: 64px; height: 80px; background-position: bottom right; background-repeat: no-repeat; right: -10px; bottom: 0px;"></div></div> </td></TD></TD><TD WIDTH=18%><NOBR>'.$player_number.'.&#160;'.$player_list->getName();
						$main_content .= ($player_list->isDeleted()) ? '<font color="red"> [DELETED]</font>' : '';
						$main_content .= '</NOBR><TD WIDTH=12%>'.$config['site']['worlds'][$player_list->getWorld()].'</TD><TD WIDTH="60%"><b>'.$player_list_status.'</b></TD><TD><TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0><FORM ACTION="?subtopic=characters" METHOD=post><TR><TD><INPUT TYPE=hidden NAME=name VALUE="'.$player_list->getName().'"><INPUT TYPE=image NAME="View '.$player_list->getName().'" ALT="View '.$player_list->getName().'" SRC="'.$layout_name.'/images/buttons/sbutton_view.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></FORM></TABLE></TD></TR>';
					}
				}
				$main_content .= '</TABLE>
				</div>
									</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
											<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
											<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</td>
				</div>
			</tr>
		</tbody>
	</table>
</div>';
			}
			$main_content .= '<BR><FORM ACTION="?subtopic=characters" METHOD=post>
			<div class="TableContainer">
	<div class="CaptionContainer">
		<div class="CaptionInnerContainer">
			<span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
			<span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
			<div class="Text">Search Character</div>
			<span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);"></span>
			<span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);"></span>
			<span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
			<span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);"></span>
				</div>
					</div>
						<table class="Table4" cellpadding="0" cellspacing="0">
							<tbody>
								<tr>
									<td>
									<div class="InnerTableContainer">
										<table style="width:100%;">
											<tbody>
												<tr>
													<td>
														<div class="TableShadowContainerRightTop">
															<div class="TableShadowRightTop" style="background-image:url('.$layout_name.'/images/content/table-shadow-rt.gif);"></div>
														</div>
													<div class="TableContentAndRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
			<TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4><TR></TR><TR><TD BGCOLOR="'.$config['site']['darkborder'].'">
			<TABLE BORDER=0 CELLPADDING=1><TR><TD>Name:</TD><TD><INPUT NAME="name" VALUE=""SIZE=29 MAXLENGTH=29></TD><TD><INPUT TYPE=image NAME="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></TABLE></TD></TR></TABLE>
			</div>
									</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bm.gif);">
											<div class="TableBottomLeftShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-bl.gif);"></div>
											<div class="TableBottomRightShadow" style="background-image:url('.$layout_name.'/images/content/table-shadow-br.gif);"></div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</td>
				</div>
			</tr>
		</tbody>
	</table>
</div>
			</FORM>';
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
		$main_content .= '<BR><FORM ACTION="?subtopic=characters" METHOD=post>
		<div class="TableContentContainer">
		<TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4><TR><TD BGCOLOR="'.$config['site']['vdarkborder'].'" CLASS=white><B>Search Character</B></TD></TR><TR><TD BGCOLOR="'.$config['site']['darkborder'].'"><TABLE BORDER=0 CELLPADDING=1><TR><TD>Name:</TD><TD><INPUT NAME="name" VALUE=""SIZE=29 MAXLENGTH=29></TD><TD><INPUT TYPE=image NAME="Submit" SRC="'.$layout_name.'/images/buttons/sbutton_submit.gif" BORDER=0 WIDTH=120 HEIGHT=18></TD></TR></TABLE></TD></TR></TABLE></div></FORM>';
	}
}
?>