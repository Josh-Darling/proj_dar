<?php
require_once '/var/www/at_werk/home/require_all/require_all.php';
require_once '/var/www/at_werk/home/log_status/log_check.php';				// checks log in includes redirect_objects.php
require_once '/var/www/at_werk/pdo/pdo.php';
require_once '/var/www/at_werk/home/header/redirect_objects.php';
$id = $_POST['id'];
$phase_name = $_POST['phase_name'];
$project_name = $_COOKIE['proj'];

$tphase = $db->query("SELECT * FROM phase_$project_name;");
	if (($tphase == null)&&($phase_name!=null)){
	# create table if don't exsist.
		require_once '/var/www/at_werk/home/mysql/sql_create_phase.php'; 	//mysql/sql_creat_proj.php
		$db->exec($cre_phase_table);
		$phase_id = 1;
	}
	elseif($tphase != null){
		$ph_id = "SELECT phase_id FROM phase_$project_name order by phase_id DESC LIMIT 1;";
		$st = $db->query($ph_id);
		foreach ($st->fetchAll() as $row) {
			$phase_id = $row['phase_id'];
		}
	$phase_id = ($phase_id + 1);
	}
if ($phase_name!=null){
	$description = $_POST['description'];
	$db->exec("INSERT INTO phase_$project_name (id,phase_name,description,phase_id,status,time_stamp) " .
			"VALUES ('','$phase_name','$description','$phase_id','0','');");
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
				and comunication system.</b><br>
			<p>This area is for creating "Phases" of a project, there maybe some aspects of what you may need to do down the
			road that are large in scope but not quite ready to tackle. Such as building a GUI, or writing the companion App 
			for the site.<p>
	           <div class="well">
				How to use.
	           </div>
            </p>   
 		</article>
        <aside class="col-md-4">    
        	<h4><span class="label label-info">Project Darling, the Darling of all your projects.</span></h4>
            <p>
            	PHASE ID = <?php echo "next ". $phase_id; ?>
            </p>   
            <hr>      
            <ol class="breadcrumb">
	            <li><a href="landing.php">Home</a></li>
	            <li class="active"><a href="add_phase.php">&nbsp;&gt;&gt;&gt;&nbsp;Add Phase</a></li>    
            </ol>  
         </aside> 
<div class="row">     
	<div class="col-md-6 thumbnail">
		<form action="" method="post" role="form">
			<div class="input-group">
			<span class="input-group-addon">Phase Name</span>
			<input type="text" name="phase_name" value="" placeholder="Phase name."></div>
			<textarea rows="10" cols="90" class="form-control" name="description" id="work_pur" value="" placeholder="Describe this phase?"></textarea>
			<button type="submit" class="btn btn-success" name="add phase" value="add phase">Add a phase</button>
		</form>
			</div>
		<div class="col-md-6 thumbnail">
<?php 
$tphases = $db->query("SELECT * FROM phase_$project_name;");
if ($tphase == "Null"){
echo "Currently this project has yet to go through any phases.";
}
else{	
	foreach ($tphases->fetchAll() as $row) {
	echo "<b>";
	echo $phase = $row['phase_name'];
	echo "</b><br>";
	echo $des = $row['description'];
	echo "<hr>";
	}
}
?>	
			</div>
		</div>
	</div> <!-- class="col-md-12 thumbnail"> -->
</div><!--div class="row">      -->

</div><!-- container      -->
<?php 
require_once '/var/www/at_werk/home/boots_feet.php';
