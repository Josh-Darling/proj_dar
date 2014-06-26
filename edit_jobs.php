<?php
if (!isset($_SESSION)) {session_start();}
require_once '/var/www/at_werk/home/require_all/require_all.php';
require_once 'mysql/sql_update.php';


# needs to go to top with header
/*			print_r($_POST);

 if()
 	array_shift($_POST);
 #$db->exec($update->update_input($table_name,$go_get));
 */


# Move these to arrays.php
$status_states = array('in progress','completed','done for now','killed');
$visability_ops = array('show','hide');


if(is_numeric($_GET['work_id'])){
	$go_get=$_GET['work_id'];
	$_SESSION['work_id']=$_GET['work_id'];
}
else{
	#header to please no hacking page.
}

# $project_name = "project_darling";
$project_name = $_COOKIE['proj'];

$table_name = $project_name;




$find = "SELECT id, task, status, purpose, location, type, catagory_id, visability, phase_id FROM project_darling WHERE id='".$go_get."';";
$st = $db->query($find);
foreach ($st->fetchAll() as $row) {
$task = $row['task'];
$status = $row['status'];
$purpose = $row['purpose'];
$location = $row['location'];
$type = $row['type'];
$catagory_id = $row['catagory_id'];
$visability = $row['visability'];
$phase_id = $row['phase_id'];
}

$f_phase = "SELECT phase_name,description FROM phase_$project_name WHERE phase_id=$phase_id;";
$st = $db->query($f_phase);
foreach ($st->fetchAll() as $row) {
	$phase_name = $row['phase_name'];
	$phase_d = $row['description'];
}

$f_cat = "SELECT cat_name,cat_purrr FROM catagory_$project_name WHERE id=$catagory_id;";
$st = $db->query($f_cat);
foreach ($st->fetchAll() as $row) {
	$catagory_name = $row['cat_name'];
	$cat_purrr = $row['cat_purrr'];
}

if($_POST['return']=='checked'){
	array_shift($_POST);
	$db->exec($update->update_input($table_name,$go_get));
	header('Location: http://localhost/at_werk/home/add_work_picture.php?cat_id='.$catagory_id);
	exit;
}
else{
	$db->exec($update->update_input($table_name,$go_get));
}


$db->exec("UPDATE catagory_$table_name SET time_stamp=NOW() WHERE id='$catagory_id'");

if(($_COOKIE['loged_in']==null)&&($_COOKIE['user_name']==null)){
	Nav_Bar::nav_bar_comp_out();
}
elseif(($_COOKIE['loged_in']!=null)&&($_COOKIE['user_name']!=null)){
	Nav_Bar::nav_bar_comp();
}
?>

<script type="text/javascript">
	$(document).ready(function() {
	   $('.selectpicker').selectpicker();
	});
</script>
	<!-- row 1 -->

	<div class="row">

		<article class="col-lg-8 thumbnail">
			<h2><span class="label label-primary">Welcome to Project Darling,</span></h2><b>a software planing, devlopement
				and comunication system.</b><br>
			What the headers are about.<br>
			
			<strong>Task:</strong> The idea of what needs to be worked
			on.<br><strong>Status:</strong> How far to done a
			given task is. Mind you if you click on the status option below you
			can see multipule options for status --there can be a grey area.<br>
			<strong>Purpose:</strong> Why this task is being done, what
			is does and why, sometimes how too!<br>
			<strong>Location:</strong>
			This could be a link, url, address on file system, a flash drive ...
			etc.<br><strong>Type:</strong> This one depends on the
			size of the task, it could be a file, object, method, function, loop,
			markup etc... Also could be a file type .pl .py .php .html .css .etc.<br>
			<strong>Visability:</strong> This is who can see/access the
			file or task, useful for security and a great way to hide your mistakes... Or someone elses.
		</article>
		<aside class="col-lg-4">
			<h4><span class="label label-info">Project Darling, editing tasks.</span></h4>
			Here is where you can edit a selections with in a given task. You can
			not however change a task but you can hide or kill it. Or even
			better, mark it completed.<p>
			<hr>
			<ol class="breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li class="active"><a href="edit_job.php">&nbsp;&gt;&gt;&gt;&nbsp;Edit Work</a></li>
            </ol>

		</aside>
		
	</div>
	<div class="row well">
		<div class="col-sm-4 thumbnail">

		<h4>Task:</h4>
		<?php 
echo "<span class='badge'>".$task."</span>";
?>
			</div>
			
			<div class="col-sm-4 thumbnail">		

			<?php 
			
			# require_once '/var/www/at_werk/home/drop_down/drop_work.php';
$drop_down = <<<EOD
<!-- Button trigger modal -->
<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
  View All Task Info
</button>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">
        $task
        </h4>
      </div>
      <div class="modal-body">
    <b>Status: </b> {$status_states[$status]}	
<hr>
<b>Purpose: </b>
$purpose
<hr>
<b>Belongs to: </b>
$catagory_name
<hr>
<b>Description: </b>
$cat_purrr
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
</div>
		

			
			
			<div class="col-sm-4 thumbnail">		
			<form action="" method="POST" role="form">
			<div class="form-group thumbnail">
			Automatically return to adding more tasks:
			<input type="checkbox" name="return" value="checked">

	
			</div>
					</div></div>
			
	<div class="row">
		<div class="col-sm-12 thumbnail">			
			
			
			
			<!--  <form action="" method="POST"> -->
		<div class="panel-group" id="accordion">
			<!-- start of status -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion"
							href="#collapseOne"> Status </a>
					</h4>
					<!-- matches H4 -->
				</div>
				<!-- line 3 "panel-heading"-->
				<div id="collapseOne" class="panel-collapse collapse">
					<div class="panel-body">


						<?php 
      echo "<span class='badge'>".$status_states[$status]."</span><p>";
      
      ?>
      <br> Change to: 
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="status" value="0"> in progress |
      <input type="radio" name="status" value="1"> completed |
      <input type="radio" name="status" value="2"> done for now |
      <input type="radio" name="status" value="3"> killed                 


					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion"
							href="#collapseTwo"> Purpose </a>
					</h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse">
					<div class="panel-body">
						<?php 
        echo "<p class='bg-info'>".$purpose."</p>";
        ?>
        <br> Change to: <br><textarea name="purpose" rows="10" cols="100" value=""></textarea>
        <br>Max 1500 characters.
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion"
							href="#collapseThree"> Location </a>
					</h4>
				</div>
				<div id="collapseThree" class="panel-collapse collapse">
					<div class="panel-body">
<!-- LOCATION INFO -->
<div class="input-group">
  <span class="input-group-addon">location</span>
  <input name="location" type="text" class="form-control" value="" placeholder="<?php echo $location; ?>" />
</div>

					</div>
				</div>
			</div>
<!-- LOCATION ACCORDIAN END -->

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion"
							href="#collapseFour"> Type </a>
					</h4>
				</div>
				<div id="collapseFour" class="panel-collapse collapse">
					<div class="panel-body">
<!-- TYPE INFO -->
<div class="input-group">
  <span class="input-group-addon">type</span>
  <input name="type" type="text" class="form-control"  value="" placeholder="<?php echo $type; ?>">
</div>
<!-- TYPE ACCORDIAN END -->	

					</div>
				</div>
			</div>


<!--  begining of visability  -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion"
							href="#collapseFive"> Visability </a>
					</h4>
				</div>
				<div id="collapseFive" class="panel-collapse collapse">
					<div class="panel-body">

						<?php 

if (($visability_ops[$visability] == 0)||($visability_ops[$visability]==null)) {
$change_to = <<< EOD
This task is currently available <span class="badge">for all to see.</span>
<br> Change to:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="visability" value="1"> <span class="badge">hide</span>
EOD;
}
else{
$change_to = <<< EOD
The task is hidden make it visable?
<br> Change to:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="visability" value="0">show
EOD;
}
echo $change_to;
                ?>



					</div>
				</div>
			</div>
<p>
</d>
<div class="col-lg-12">
<input type="submit" name="submit" value="Make up dates" class="btn btn-success"></p>
</div>
</form>
			<!--  # for breakage clarity -->

		</div>
	</div>

</div>
	<?php 
require_once '/var/www/at_werk/home/boots_feet.php';
?>
