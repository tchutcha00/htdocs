<?php
/**
 * @author Soulreaper
 * @copyright 2010
 * Parse items to MYSQL database script.
 */
 
$time = microtime(); 
$time = explode(" ", $time); 
$time = $time[1] + $time[0]; 
$start = $time; 
 
echo "
<style type='text/css'>
*,html {margin:0;padding:0;font-size:12pt;}
body {text-align:center;background-color:#CCC;}
.box {
    padding:5px;
    border: 1px solid #797979;
    width:785px; 
    background-color:#AFAFAF;   
}

.bar {
    padding:5px;
    border:1px solid #AAAAFF;
    background-color:#CCCCFF;
    color:#000055;
    margin:0px auto;
    width:750px;   
}
.succes {
    padding:5px;
    border:1px solid #AAFFAA;
    background-color:#CCFFCC;
    margin-bottom:2px;
    color:#005500;
    margin:0px auto;
    width:750px;
}
.error {
    padding:5px;
    border:1px solid #FFAAAA;
    background-color:#FFCCCC;
    margin-bottom:2px;
    color:#550000;
    margin:0px auto;
    width:750px;
}
h1 {
   font-size:9pt;
   color:#004400;
   text-decoration:underline;
   margin-left:25px;
}
h2 {
   font-size:9pt;
   color:#440000;
   text-decoration:underline;
   margin-left:25px;
}
</style>
";

echo "
<div class='box'>
<div class='bar'>
Powered by Soulreaper, SoulAAC dev.<br />
Items.xml -> MySQL Database Parser V1.0<br />
Be sure to use a cleaned up items.xml else ur database becomes a mess.
</div>
<br />
";

include('../eqshower-config.php');
include('class-installer.php');
$EQShower=new EQShower;

$bool1=$EQShower->table_exists('s_items',$db_name);
$bool2=$EQShower->table_exists('s_items',$db_name);
if($bool1 == "0" OR $bool2 =="0"){
    echo "
    <div class='error'>
     Error: Neccesary tables not found.<br />
     <h1>Attempting to create neccesary tables</h1>
    </div>
    <Br />
    ";
    
    $query=mysql_query("DROP TABLE `s_attributes`");
    $query=mysql_query("DROP TABLE `s_items`");
    
    $ii=0;
    $e=0;
    foreach($files as $file)
    {
        $contents=file_get_contents($file);
        $content=explode(";",$contents);
        foreach($content as $sql)
        {
            mysql_query($sql)?$ii++:$e++;
        }
    }
    
    echo "
    <div class='succes'>
     Executed ".($ii-$e)."/".$ii ."query's succesfully.<br />
     <h1>Attempted to create neccesary tables.</h1>
    </div>
    <Br />
    ";
    
}else{  
    $filepath="items.xml";
    $xml = new DOMDocument;
    $xml->load($filepath);
    
    $empty=mysql_query("TRUNCATE TABLE `s_items`");
    $empty=mysql_query("TRUNCATE TABLE `s_attributes`");
    
    $i=0;$err=0;$errors=array();
    foreach($xml->getElementsByTagName('item') as $item)
    {  
        unset($arr);
        $arr=array();
        
        $itemxmlid=$item->getAttribute('id');
        $arr[0]=mysql_real_escape_string(ucfirst($item->getAttribute('name')));
        foreach($item->getElementsByTagName('attribute') as $attr)
        {
            if($attr->getAttribute('key')=="description"){$arr[1]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="armor"){$arr[2]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="weight"){$arr[3]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="containerSize"){$arr[4]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="attack"){$arr[5]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="speed"){$arr[6]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="defense"){$arr[7]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="elementFire"){$arr[8]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="elementIce"){$arr[9]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="elementEarth"){$arr[10]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="elementEnergy"){$arr[11]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="range"){$arr[12]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="extradef"){$arr[13]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="skillShield"){$arr[14]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="magiclevelpoints"){$arr[15]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="absorbPercentAll"){$arr[16]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="charges"){$arr[17]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="skillDist"){$arr[18]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="absorbPercentFire"){$arr[19]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="absorbPercentEarth"){$arr[20]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="absorbPercentIce"){$arr[21]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="absorbPercentEnergy"){$arr[22]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="absorbPercentDeath"){$arr[23]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="absorbPercentHoly"){$arr[24]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="absorbPercentPhysical"){$arr[25]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="skillAxe"){$arr[26]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="skillClub"){$arr[27]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="skillSword"){$arr[28]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="duration"){$arr[29]=$attr->getAttribute('value')/60;}
            if($attr->getAttribute('key')=="skillFist"){$arr[30]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="absorbPercentManaDrain"){$arr[31]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="absorbPercentLifeDrain"){$arr[32]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="preventDrop"){$arr[33]=$attr->getAttribute('value')*100;}
            if($attr->getAttribute('key')=="hitChance"){$arr[34]=$attr->getAttribute('value');}
            if($attr->getAttribute('key')=="shootType"){$arr[35]=$attr->getAttribute('value');}
        }
        $insert_item=mysql_query("INSERT INTO `s_items` (`name` ,`descr` ,`weight`,`itemid`) VALUES ('".$arr[0]."','".mysql_real_escape_string($arr[1])."','".$arr[3]."','$itemxmlid')");
        
        $retrieve_index=mysql_query("SELECT * FROM `s_items` WHERE name='".$arr[0]."' AND itemid='$itemxmlid'");
        $result=mysql_fetch_assoc($retrieve_index);
        $item_id=$result['id'];
        
        $insert_attributes=("
                            INSERT INTO `s_attributes` 
                            VALUES
                            ('$item_id','".$arr[5]."','".$arr[2]."','".$arr[7]."','".$arr[13]."','".$arr[12]."','".$arr[6]."'
                            ,'".$arr[8]."','".$arr[9]."','".$arr[10]."','".$arr[11]."','".$arr[14]."','".$arr[18]."','".$arr[30]."'
                            ,'".$arr[27]."','".$arr[26]."','".$arr[28]."','".$arr[15]."','".$arr[16]."','".$arr[19]."','".$arr[20]."'
                            ,'".$arr[22]."','".$arr[21]."','".$arr[23]."','".$arr[24]."','".$arr[25]."','".$arr[31]."','".$arr[32]."'
                            ,'".$arr[17]."','".$arr[29]."','".$arr[33]."','".$arr[4]."','".$arr[34]."','".$arr[35]."')
                           ");
        $query=$insert_attributes;
        $insert_attributes=mysql_query($insert_attributes);
        
        if($insert_attributes){$str="<h1>Inserted attributes succesfull.<br/>Item ID:$itemxmlid<br />DB ID:$item_id</h1>";}else{$str="<h2>Warning: Failed inserting attributes.<br />Item ID:$itemxmlid<br />DB ID:$item_id<br/>$query</h1>";}
        if($insert_item){
            echo "<div class='succes'>Succesfully inserted: ".$arr[0]."<br />$str</div>";
        }else{
            echo "<div class='error'>Failed inserting: ".$arr[0]."<br />$str</div>";
            
            $errors[$err]['name']=$arr[0];
            $errors[$err]['descr']=$arr[1];
            $errors[$err]['weight']=$arr[3];
            $err++;
            }
        $i++;
    }
        $i=$i-$err;
        echo "<br /><div class='succes'>Succesfully inserted $i rows. </div><div class='error'>And failed to insert $err rows:</div><br />";
        
        foreach($errors as $error)
        {
            echo "
            <div class='error' style='margin-bottom:15px;'>
             <br />Name:".$error['name']."<br />
             Description:".$error['descr']."<br />
             Weight:".$error['weight']."<br />
            </div>
            ";
        }
}
$time = microtime(); 
$time = explode(" ", $time); 
$time = $time[1] + $time[0]; 
$finish = $time; $totaltime = ($finish - $start); 
printf ("<div class='bar'>Powered by Soulreaper, SoulAAC dev.<br />Parsing took %f seconds.</div>", $totaltime); 
echo "</div>";
?>