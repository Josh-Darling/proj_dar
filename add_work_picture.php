<?php
/**
 * this page is for the cotinual adding of big picture page elements to a project.
 */
header('Content-Type: text/html; charset=utf-8');
if (!isset($_SESSION)) {session_start();}											// starts a session if none detected already

$cat_id=$_GET['cat_id'];

require_once '/var/www/at_werk/home/require_all/require_all.php';
require_once '/var/www/at_werk/home/accordion/accordion.php';
require_once '/var/www/at_werk/home/progress_bar/progress_bar.php';

# for status states (words over numbers):
$status_states = array('in progress','completed','done for now','killed');

# $project_name = "project_darling";
$project_name = $_COOKIE['proj'];

$task = $_POST['task'];

$status = $_POST['status'];
$location = $_POST['location'];
$purpose = $_POST['purpose'];
$catagory_id =$cat_id;
$type = $_POST['type'];
$visability = $_POST['visability'];
$phase_id = $_POST['phase_id'];


#	task_order	time_stamp
$purpose = mysql_real_escape_string($purpose);
$task = mysql_real_escape_string($task);
if($_POST['task']!=null){
	$db->exec("INSERT INTO $project_name (id,task,status,location,u_r_l,purpose,catagory_id,type,visability,task_order,time_stamp) ".
			"VALUES ('','$task','$status','$location','www.someplace.com','$purpose','$catagory_id','$type','0','0','');");
#	print_r($db->errorinfo());

}



$work_from_db = array();
$stat=array();
$c_array =1;
$statement = "SELECT id, task, status, purpose, location, type FROM $project_name WHERE catagory_id=$cat_id;";
$st = $db->query($statement);
foreach ($st->fetchAll() as $row) {
	$work_from_db["id$c_array"] = $row['id'];
	$work_from_db["task$c_array"] = $row['task'];
	$source_status= $row['status'];
	$stat[$c_array] = $source_status;
	$work_from_db["status$c_array"]=$source_status;
	$work_from_db["purpose$c_array"] = $row['purpose'];
	$work_from_db["location$c_array"] = $row['location'];
	$work_from_db["type$c_array"] = $row['type'];
	$c_array++;
	}

$statement = "SELECT id, cat_name, cat_purrr, created_by FROM catagory_$project_name WHERE id=$cat_id;";
$st = $db->query($statement);
foreach ($st->fetchAll() as $row) {
	$catagory = $row['cat_name'];
	$cat_des = $row['cat_purrr'];
}



require_once '/var/www/at_werk/home/nav_bar/nav_bar.php';

if(($_COOKIE['loged_in']==null)&&($_COOKIE['user_name']==null)){
	Nav_Bar::nav_bar_comp_out();
}
elseif(($_COOKIE['loged_in']!=null)&&($_COOKIE['user_name']!=null)){
	Nav_Bar::nav_bar_comp();
}
?>

    <!-- row 1 -->
    <div class="row">
    	<article class="col-md-8 thumbnail">
            <h2><span class="label label-primary">Welcome to Project Darling,</span></h2><b>a software planing, devlopement
				and comunication system.</b><p><br>
				Job completion status:
			<p>
	           <?php
	           $n4ray =0;
	           $stat = array();
	           $statement = "SELECT status FROM $project_name WHERE catagory_id =$catagory_id;";
	           $st = $db->query($statement);
	           foreach ($st->fetchAll() as $row) {
					if ($row['status'] ==1){
		           $stat[$n4ray] = $row['status'];
		           $n4ray++;
		           }

	           }
	           $c_stat = " SELECT count(*)as total FROM $project_name WHERE catagory_id =$catagory_id;";
	           $st = $db->query($c_stat);
	           foreach ($st->fetchAll() as $row) {
	           	$total = $row['total'];
	           }

	           Progress_Bar::bar($stat,$total);

	           ?>
            </p>
 		</article>
        <aside class="col-md-4">
        	<h4><span class="label label-info">Project Darling, the Darling of all your projects.</span></h4>
            <p>
Something better needs to go here.
            </p>
            <hr>
	     <ol class="breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li><a href="add_big_picture.php">&nbsp;&gt;&gt;&gt;&nbsp;Add Big Picture</a></li>
              <li class="active"><a href="add_work_picture.php">&nbsp;&gt;&gt;&gt;&nbsp;Add Work to Picture</a></li>
            </ol>
         </aside>
</div>
			<div class="row">
				<div class="col-md-7 well">
				<?php
				echo "<h3>$catagory</h3>$cat_des<p>";

				if (in_array(1,$stat)){Progress_Bar::bar($stat,$total);}
				else {echo "<span class='label label-default'>No jobs entered or completed</span>";}

				?>

						<!-- BE SURE TO UP DATE ALL STATIC VALUE I PUT IN HERE!!!
	ALSO THIS FORM IS JUST A TEMP NEEDS TO BE FIXXED! THIS WILL NOT WORK FOR REAL STUFF -->

		<form action="" method="post" role="form">
			<div class="form-group thumbnail">
				<?php
				echo '<input type="hidden" name="project_name" value="'.$project_name.'">';

				?>


<div class="input-group">
<span class="input-group-addon">Name:</span>
<input name="task" type="text" class="form-control" value="" placeholder="Name of Work that needs to be done."/></div>
<!-- <span class="input-group-addon">Purpose:</span> -->
<textarea rows="10" cols="90" class="form-control" name="purpose" id="work_pur" value="" placeholder="Description of work that needs to be done."></textarea>
</div>

<div class="input-group">
<span class="input-group-addon">Location:</span>
<input name="location" type="text" class="form-control" value="" placeholder="folder, file, sparehard drive, backup copies in head."/>
</div>

<div class="input-group">
<span class="input-group-addon">Type:</span>
<input name="type" type="text" class="form-control" value="" placeholder="file,object,db."/>
</div>






				<input type="hidden" name="created_by" value="The Grand Architect">
				<input type="hidden" name="status" value="0">
				<input type="hidden" name="visability" value="0">

		<br>
				<div class="btn-group">
					<button type="submit" class="btn btn-success" name="submit" value="Add Work">Add More Work</button>
					</form>
				</div>
			</div>

				<div class="col-md-5 thumbnail">



					<h3>Work Added:</h3>

					<?php

$num=1;
echo '<div class="panel-group" id="accordion">';


foreach(array_keys($work_from_db) as $view){
#	echo "$view<br>";
	if ($view=="task$num"){
	#	echo "{$work_from_db["task$num"]}"."<br>";


$collapse = "collapse$num";

$accordion_body = <<< EOD
<div class="panel panel-default">
	<div class="panel-heading">
	<h4 class="panel-title">
	<a data-toggle="collapse" data-parent="#accordion" href="#$collapse">
	{$work_from_db["task$num"]}
	</a></h4> <!-- matches h4 -->
	</div>											<!-- div class="panel-heading" -->
<div id="$collapse" class="panel-collapse collapse">
<div class="panel-body">
<p><b>Purpose:</b><pre> {$work_from_db["purpose$num"]}</pre></p>
<p><b>Status:</b> {$status_states[$work_from_db["status$num"]]}</p>
<p><b>Location:</b> {$work_from_db["location$num"]}</p>
<p><b>Type:</b> {$work_from_db["type$num"]}</p>
<p><a href="edit_jobs.php?work_id={$work_from_db["id$num"]}">Edit Task &gt;&gt;&gt;</a></p>
</div>											<!-- div id="collapseOne" class="panel-collapse collapse in" -->
</div>											<!-- div class="panel-body" -->
</div>
EOD;

$num++;
echo $accordion_body;
}
}

					echo '</div> <!-- class="panel-group" id="accordion"> -->';
					?>

				</div> <!-- <div class="col-md-5 thumbnail"> -->
			</div>




</div><!-- container      -->
<script type="text/javascript">
$('.selectpicker').selectpicker();
</script>

<?php

require_once '/var/www/at_werk/home/boots_feet.php';

