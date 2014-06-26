<?php
/**
 * page for adding to do's
 */

require_once '/var/www/at_werk/home/require_all/require_all.php';

# $project_name = "project_darling";
$project_name = $_COOKIE['proj'];

if(($_COOKIE['loged_in']==null)&&($_COOKIE['user_name']==null)){
	Nav_Bar::nav_bar_comp_out();
}
elseif(($_COOKIE['loged_in']!=null)&&($_COOKIE['user_name']!=null)){
	Nav_Bar::nav_bar_comp();
}

print_r($_POST);


?>
