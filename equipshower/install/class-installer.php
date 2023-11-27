<?php
class EQShower {
    function item_info($val,$attributes)
    {
        $EQShower=new EQShower;
        $cl=$EQShower->item_grade($attributes,$val[0]);
        
        empty($val[1])?$desc_str="":$desc_str="<br /><br />".$val[1];
        empty($val[2])?$arm_str="":$arm_str="Armor: ".$val[2]."<br />";
        empty($val[4])?$size_str="":$size_str="Size: ".$val[4]." slots";
        empty($val[5])?$att_str="":$att_str="Attack: ".$val[5]."<br />";
        empty($val[6])?$sp_str="":$sp_str="Speed: + ".$val[6]."<br />";
        empty($val[13])?$def_a="":$def_a="+ ".$val[13];
        empty($val[7])?$def_str="":$def_str="Defense: ".$val[7]." $def_a<br />";
        if(!empty($val[8])){$el_str="Fire: ".$val[8]."<br />";}
        if(!empty($val[9])){$el_str="Ice: ".$val[9]."<br />";}
        if(!empty($val[10])){$el_str="Earth: ".$val[10]."<br />";}
        if(!empty($val[11])){$el_str="Energy: ".$val[11]."<br />";}
        empty($val[12])?$ran_str="":$ran_str="Range: ".$val[12]."<br />";
        empty($val[14])?$sk_sh="":$sk_sh="Shielding: + ".$val[14]."<br />";
        empty($val[15])?$sk_mag="":$sk_mag="Magic: + ".$val[15]."<br />"; 
        empty($val[16])?$eb_all="":$eb_all="Protection All: ".$val[16]."%<br />"; 
        empty($val[17])?$charg_str="":$charg_str="Charges: ".$val[17]."<br />";
        empty($val[18])?$sk_dist="":$sk_dist="Distance: + ".$val[18]."<br />"; 
        empty($val[19])?$eb_fire="":$eb_fire="Protection fire: ".$val[19]."%<br />"; 
        empty($val[20])?$eb_earth="":$eb_earth="Protection earth: ".$val[20]."%<br />"; 
        empty($val[21])?$eb_ice="":$eb_ice="Protection ice: ".$val[21]."%<br />"; 
        empty($val[22])?$eb_ene="":$eb_ene="Protection energy: ".$val[22]."%<br />";   
        empty($val[23])?$eb_dth="":$eb_dth="Protection death: ".$val[23]."%<br />"; 
        empty($val[24])?$eb_hol="":$eb_hol="Protection holy: ".$val[24]."%<br />"; 
        empty($val[25])?$eb_pys="":$eb_pys="Protection physical: ".$val[25]."%<br />"; 
        empty($val[26])?$sk_axe="":$sk_axe="Axe: + ".$val[26]."<br />";
        empty($val[27])?$sk_club="":$sk_club="Club: + ".$val[27]."<br />";
        empty($val[28])?$sk_sword="":$sk_sword="Sword: + ".$val[28]."<br />";
        empty($val[29])?$dura="":$dura="Duration: ".$val[29]." minutes.<br />";
        empty($val[30])?$sk_fist="":$sk_fist="Fist: + ".$val[30]."<br />";
        empty($val[31])?$eb_mana="":$eb_mana="Protection manadrain: ".$val[31]."%<br />"; 
        empty($val[32])?$eb_life="":$eb_life="Protection lifedrain: ".$val[32]."%<br />";
        empty($val[33])?$eb_drop="":$eb_drop="Protection drop: ".$val[33]."%<br />";
        empty($val[34])?$hit_ch="":$hit_ch="Hit chance: ".$val[34]."%<br />";
        empty($val[35])?$sh_type="":$sh_type="Element: ".$val[35]."<br />";
        
        if(empty($val[8]) AND empty($val[9]) AND empty($val[10]) AND empty($val[11])){$ele_str="";}
        
        $str="<div class=\'$cl\'>".$val[0]."</div><font class=\'attr\'>$arm_str $sp_str $sh_type $att_str $ran_str $def_str $hit_ch $sk_sh $sk_sword $sk_axe $sk_club $sk_fist $sk_mag $sk_dist $eb_all $eb_drop $eb_mana $eb_life $eb_fire $eb_earth $eb_ice $eb_ene $eb_dth $eb_hol $eb_pys $el_str $charg_str $dura Weight: ".$val[3]." oz $desc_str</font>";
        return $str;
    }
    
    function item_grade($attributes,$name)
    {
        require('equipshower/eqshower-config.php');
        
        if(!array_key_exists($name,$exceptions)){
            if($attributes<=$config['normal']['attributes']){return $config['class']['normal'];}
            if($attributes==$config['rare']['attributes']){return $config['class']['rare'];}
            if($attributes==$config['epic']['attributes']){return $config['class']['epic'];}
            if($attributes>=$config['legendary']['attributes']){return $config['class']['legendary'];}
        }else{
            return $config['class'][$exceptions[$name]];
        }
    }
    
    function table_exists ($table, $db) { 
	$tables = mysql_list_tables ($db); 
	while (list ($temp) = mysql_fetch_array ($tables)) {
		if ($temp == $table) {
			return TRUE;
		}
	}
	return FALSE;
}
}
?>