<?PHP

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password="lucas2324"; // Mysql password 
$db_name="baiak"; // Database name 
$tbl_name="players"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$getcss= '<link rel="stylesheet" type="text/css" href="equipshower/js/tooltip.css" />';
$getjs ='<script src=\'equipshower/js/tooltip.js\'></script>';

//Classes of the grades
 $config['class']['normal']="norm";
 $config['class']['rare']="rare";
 $config['class']['epic']="epic";
 $config['class']['legendary']="lege";
 
 //Amount Of Attributes Determine Grade.
 $config['normal']['attributes']=3;
 $config['rare']['attributes']=4;
 $config['epic']['attributes']=5;
 $config['legendary']['attributes']=6;
 
 // Installer config don't change any 
 //unless you know what you're doing
 $files[0]='s_items.sql';
 $files[1]='s_attributes.sql';
 
 
  //Exceptions array CASE SENSITIVE
  //First letter must be a capital, further no capitals
  //And no capitals in the grades either
  //Unless there are more capitals in the item name
  //Just put the grade index in the => value.
 $exceptions= array(
        'Magic plate armor'=>'epic',
 );

?>