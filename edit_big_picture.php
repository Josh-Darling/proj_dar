<?php



if (!isset($_SESSION)) {session_start();}
require_once '/var/www/at_werk/home/require_all/require_all.php';
require_once 'mysql/sql_update.php';

# Move these to arrays.php
$status_states = array('in progress','completed','done for now','killed');
$visability_ops = array('show','hide');


// additional code needs to be added to deal with "jumping to" these pages
if(is_numeric($_GET['cat_id'])){
	$go_get=$_GET['cat_id'];
	$_SESSION['cat_id']=$_GET['cat_id'];
}
else{
	#header to please no hacking page.
}

# $project_name = "project_darling";
$project_name = $_COOKIE['proj'];

$table_name = "catagory_$project_name";
if($_POST['return']=='checked'){
	array_shift($_POST);
	$db->exec($update->update_input($table_name,$go_get));
	if($_POST['status']==1){
		$db->exec("UPDATE $table_name SET cat_order='0' WHERE id='$go_get';");
	}
	header('Location: http://localhost/at_werk/home/big_picture.php');
	exit;
}
elseif($_POST['a_work']=='checked'){
	array_shift($_POST);
	$db->exec($update->update_input($table_name,$go_get));
	if($_POST['status']==1){
		$db->exec("UPDATE $table_name SET cat_order='0' WHERE id='$go_get';");
	}
	header('Location: http://localhost/at_werk/home/add_big_picture.php');
	exit;

}
elseif ($_POST['status']>=1){
		array_shift($_POST);
		$db->exec($update->update_input($table_name,$go_get));

			$stat = $_POST['status'];
			$epx = time()+60*30;
			setcookie("cat_info","$go_get,$stat",$epx);
		header('Location: http://localhost/at_werk/home/comp_big_picture.php');
		exit;
}
else{
	$db->exec($update->update_input($table_name,$go_get));
	if($_POST['status']==1){

		$db->exec("UPDATE $table_name SET cat_order='0' WHERE id='$go_get';");
	}
}





$find = "SELECT id, cat_name, cat_purrr,status, phase_id,created_by, time_stamp FROM catagory_$project_name WHERE id='$go_get';";
$st = $db->query($find);
foreach ($st->fetchAll() as $row) {
$work = $row['cat_name'];
$status = $row['status'];
$purpose = $row['cat_purrr'];
$location = $row['U_R_L'];
$phid = $row['phase_id'];
$id = $row['id'];
$visability = $row['created_by'];
}




?>

<script type="text/javascript">
	$(document).ready(function() {
	   $('.selectpicker').selectpicker();
	});
</script>

<?php


if(($_COOKIE['loged_in']==null)&&($_COOKIE['user_name']==null)){
	Nav_Bar::nav_bar_comp_out();
}
elseif(($_COOKIE['loged_in']!=null)&&($_COOKIE['user_name']!=null)){
	Nav_Bar::nav_bar_comp();
}
?>


	<!-- row 1 -->
	<div class="row">

		<article class="col-lg-8 thumbnail">
			<h2><span class="label label-primary">Welcome to Project Darling,</span></h2><b>a software planing, devlopement
				and comunication system.</b><br>
				What the headers are about.<br>

			<strong>rewrite:</strong> For work piece.<br>
		</article>
		<aside class="col-lg-4">
			<h4><span class="label label-info">Project Darling, editing tasks.</span></h4>
			Here is where you can make changes to the Big Picture, to make changes to work click here and to the project click here<p>
			<hr>
			<ol class="breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li class="active"><a href="edit_job.php">&nbsp;&gt;&gt;&gt;&nbsp;Edit The Big Picture</a></li>
            </ol>
		</aside>
	</div>


<?php

if(is_numeric($_GET['cat_id'])){

	require_once "/var/www/at_werk/home/edit_big/edit_big_edit.php";
	/*
	 * if big picture piece has already been selected
	 */

	}
else{
	require_once "/var/www/at_werk/home/edit_big/edit_big_selection.php";
	/*
	 * creates a list of big picture pieces to choose from.
	 */
	}

?>
<!--  # for breakage clarity -->

		</div>
	</div>
</div>
	<?php
require_once '/var/www/at_werk/home/boots_feet.php';
?>
