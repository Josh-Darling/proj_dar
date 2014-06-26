<?php



if (!isset($_SESSION)) {session_start();}
require_once '/var/www/at_werk/home/require_all/require_all.php';


$status_states = array('in progress','completed','done for now','killed');


# $project_name = "project_darling";
$project_name = $_COOKIE['proj'];

$table_name = "workstat_$project_name";
list($go_get,$stat)=explode(',',$_COOKIE['cat_info']);

$y_comp = $_POST['y_comp'];
$y_comp = mysql_real_escape_string($y_comp);
if($_POST['y_comp']!=null){
	
	$u = $_COOKIE['loged_in'];
	
	$f_user = "SELECT id FROM people WHERE login='$u';";
	$st = $db->query($f_user);
	foreach ($st->fetchAll() as $row) {
		$uid = $row['id'];
	}
		
	$f_group = "SELECT group_name FROM groups_$project_name WHERE user_id=$uid;";
	$st = $db->query($f_group);
	foreach ($st->fetchAll() as $row) {
		$group_name = $row['group_name'];
	}
		
	$db->exec("INSERT INTO $table_name (id,cat_id,task_id,status,y_comp,comp_user,comp_group,time_stamp) ".
			"VALUES ('','$go_get','0','$stat','$y_comp','$user','$group_name','');");
	#print_r($db->errorinfo());
	header('Location: http://localhost/at_werk/home/add_big_picture.php');
	exit;
}
else{

	
	$find = "SELECT id, cat_name, cat_purrr,status, phase_id,created_by, time_stamp FROM catagory_project_darling WHERE id='$go_get';";
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
	
	$f_phase = "SELECT phase_name,description FROM phase_$project_name WHERE phase_id=$phid;";
	$st = $db->query($f_phase);
	foreach ($st->fetchAll() as $row) {
		$phase_name = $row['phase_name'];
		$phase_d = $row['description'];
	}
	
	$u = $_COOKIE['loged_in'];
	
	$f_user = "SELECT id FROM people WHERE login='$u';";
	$st = $db->query($f_user);
	foreach ($st->fetchAll() as $row) {
		$uid = $row['id'];
	}
	
	
	
	$f_group = "SELECT group_name FROM groups_$project_name WHERE user_id=$uid;";
	$st = $db->query($f_group);
	foreach ($st->fetchAll() as $row) {
		$group_name = $row['group_name'];
	}

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
			3 diffrent messages based on status, Congradulations on completion, Any notes for coming backing to later, 
			We're gonna take you donw town and ask you a few questions... The first being, why did you kill it?<p>
			There needs to be a link to skipping to adding work over doing this.
			<hr>
			<ol class="breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li class="active"><a href="comp_big_picture.php">&nbsp;&gt;&gt;&gt;&nbsp;Completion Survey</a></li>
            </ol>
		</aside>
	</div>

	<div class="row thumbnail">
		<div class="col-md-12 well">
	
			<?php 
			
			# require_once '/var/www/at_werk/home/drop_down/drop_work.php';
$drop_down = <<<EOD
<!-- Button trigger modal -->
<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
  View What You Completed
</button>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">
        $work
        </h4>
      </div>
      <div class="modal-body">
    <b>Status: </b> {$status_states[$status]}	
<hr>
<b>Purpose: </b>
$purpose
<hr>
<b>Phase: </b>
$phase_name
<hr>
<b>Phase Description: </b>
$phase_d 
<hr>
<b>Location: </b>
$location

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
EOD;

echo $drop_down;
?>	
			<form action="" method="post" role="form">
			<div class="form-group thumbnail">
	<textarea rows="10" cols="90" class="form-control" name="y_comp" id="work_pur" value="" placeholder="Notes on the work."></textarea>
	<div class="btn-group">
					<button type="submit" class="btn btn-success" name="submit" value="final_note">Add a final note</button>
	
	</form>
	</div>
		</div>
	</div>

	
	
	
	

		</div>
	</div>
</div>
	<?php 
require_once '/var/www/at_werk/home/boots_feet.php';
?>
