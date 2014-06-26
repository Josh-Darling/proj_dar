<?php
/**
 * this page is for the cotinual adding of big picture page elements to a project.
 */

if (!isset($_SESSION)) {session_start();}											// starts a session if none detected already

require_once '/var/www/at_werk/home/require_all/require_all.php';
require_once '/var/www/at_werk/home/thumbnail_grid/thumbnail_grid.php';
require_once '/var/www/at_werk/home/progress_bar/progress_bar.php';

# $project_name = "project_darling";
$project_name = $_COOKIE['proj'];
$user_is = $_COOKIE['loged_in'];
$cat_name =$_POST['cat_name'];
$cat_purrr = $_POST['cat_purrr'];
$phase_is = $_POST['phase'];
$sel_phase = $_GET['f_phase'];

if($cat_name !=null){
$db->exec("INSERT INTO catagory_$project_name (id,cat_name,cat_purrr,frontorback,created_by,phase_id,status,visability) " .
		"VALUES ('','$cat_name','$cat_purrr','3','$user_is','$phase_is','0','0')");
}

$break_count = 0; //maters only in the last "count out" of col count
$row_count=1;
$n4ray =0;

$cat_id = array();
$catagory = array();
$cat_des = array();
$stat = array();
$you = array();
$phase_id_out = array();

$val = $db->query("select id from `catagory_$project_name` where id='1';");
foreach ($val->fetchAll() as $row){
$row_is = $row['id'];
}

if(($row_is == "1")&&($_GET['f_phase']==NULL)){
	$statement = "SELECT id, cat_name, cat_purrr, created_by, phase_id, status, time_stamp FROM catagory_$project_name ORDER BY time_stamp DESC, status;";
	$st = $db->query($statement);
	foreach ($st->fetchAll() as $row){
		++$break_count;
		$cat_id[$n4ray]=$row['id'];
		$catagory[$n4ray] = $row['cat_name'];
		$cat_des[$n4ray] = $row['cat_purrr'];
		$phase_id_out[$n4ray] = $row['phase_id'];
		$you[$n4ray] = $row['created_by'];
		$stat[$n4ray] = $row['status'];
		$n4ray++;
		if($break_count<4){
			continue;
		}
		elseif ($break_count==4){
			$break_count=0;
			++$row_count;
		}
	}
}
elseif(($row_is == "1")&&($_GET['f_phase']!=NULL)){
	$statement = "SELECT id, cat_name, cat_purrr, created_by, phase_id, status, time_stamp FROM catagory_$project_name WHERE phase_id='$sel_phase' ORDER BY time_stamp DESC, status;";
	$st = $db->query($statement);
	foreach ($st->fetchAll() as $row) {
		++$break_count;
		$cat_id[$n4ray]=$row['id'];
		$catagory[$n4ray] = $row['cat_name'];
		$cat_des[$n4ray] = $row['cat_purrr'];
		$phase_id_out[$n4ray] = $row['phase_id'];
		$you[$n4ray] = $row['created_by'];
		$stat[$n4ray] = $row['status'];
		$n4ray++;
		if($break_count<4){
			continue;
		}
		elseif ($break_count==4){
			$break_count=0;
			++$row_count;
		}
	}
	$phase_name = array();
	$define_phase = "SELECT phase_name, phase_id  FROM phase_$project_name;";
	$st = $db->query($define_phase);
	foreach ($st->fetchAll() as $row) {
		$num = $row['phase_id'];
		$phase_name[$num]=$row['phase_name'];
	}
}
elseif($row_is != "1"){
	contiune;
}


require_once '/var/www/at_werk/home/nav_bar/nav_bar.php';

if(($_COOKIE['loged_in']==null)&&($_COOKIE['user_name']==null)){
	Nav_Bar::nav_bar_comp_out();
}
elseif(($_COOKIE['loged_in']!=null)&&($_COOKIE['user_name']!=null)){
	Nav_Bar::nav_bar_comp();
}
?>
<script type="text/javascript">
$('.selectpicker').selectpicker();
</script>
    <!-- row 1 -->
    <div class="row">
    	<article class="col-lg-8 thumbnail">
            <h2><span class="label label-primary">Welcome to Project Darling,</span></h2><b>a software planing, devlopement
				and comunication system.</b><br>
			<p>
	           FILLER FILLER FILLER FIX THE BREAD CRUMBS TOO!
<?php

$val = $db->query("select id from `catagory_$project_name` where id='1';");
foreach ($val->fetchAll() as $row){
	echo "<p>in query ".$row_is = $row['id'];
}

if($row_is == "1"){
	echo "<p>$row_is table exsist! ".$project_name."<p>";
}
else{
	echo "<p>$row_is not showing ".$project_name."<p>";
}

?>

	Also the new colum in the code was never added that needs to
	be added it's important but this is starting to look nice. <p>
	<div class="well">

<?php



$c_stat = " SELECT count(*)as total FROM catagory_$project_name;";
$st = $db->query($c_stat);
foreach ($st->fetchAll() as $row) {
	$total = $row['total'];
}

Progress_Bar::bar($stat,$total);

?>
	</p></div>
 	</article>
        <aside class="col-lg-4">
        	<h4><span class="label label-info">Project Darling, the Darling of all your projects.</span></h4>
            <p>
            	FILLER FILLER FILLER FIX THE BREAD CRUMBS TOO!<p>
            	<?php
            	foreach ($_POST as $foo => $bar){
				echo "# is $foo => $bar<br>";
            	}
            	?>
            </p>
            <hr>
            <ol class="breadcrumb">
	            <li>Home</a></li>
	            <li>&nbsp;&gt;&gt;&gt;&nbsp;Grand Scheme</li>
	            <li class="active">&nbsp;&gt;&gt;&gt;&nbsp;The Big Picture</li>
            </ol>
         </aside>
</div>
<?php
if($phase_name[1]!=NULL){
?>
<div class="row">
<div class="col-md-12 thumbnail">
<h3>Phase Selection:</h3>
<div class="btn-group btn-group-xs">
  <button type="button" class="btn btn-default">
  <a href="add_big_picture.php?f_phase=NULL">Un-phaseable (All)</a></button>
  <?php



  foreach ($phase_name as $pname => $pval){
	if ($pname!="NULL"){
		echo '<button type="button" class="btn btn-default">';
		echo "<a href=\"add_big_picture.php?f_phase=$pname\">";
		echo "$pval</a></button>";
	}
  }
?>
</div>
</div>
<?php
}
?>
 <div class="row">
	<div class="col-md-12">
		<?php echo "<h1>Big Picture Pieces ($total):</h1>"; ?>
	</div>
</div>
<div class="container-fluid">
	<?php
	$r = ($n4ray % 4);
	Thumbnail_Grid::thumbnail_output($row_count,$n4ray, $r, $catagory, $phase_name, $phase_id_out, $cat_des,$cat_id, $you, $stat);
	?>
</div>
<div class="row">
	<div class="col-sm-12 thumbnail">
	<!-- BE SURE TO UP DATE ALL STATIC VALUE I PUT IN HERE!!!
	ALSO THIS FORM IS JUST A TEMP NEEDS TO BE FIXXED! THIS WILL NOT WORK FOR REAL STUFF -->
		<form action="" method="post" role="form">
				<div class="form-group thumbnail">
				<div class="input-group">
				<span class="input-group-addon">Name:</span>
				<input name="cat_name" type="text" class="form-control" value=""
				placeholder="Name of Work that needs to be done."/>
				</div>
				<textarea rows="10" cols="80" class="form-control" name="cat_purrr"
				id="work_pur" value="" placeholder="Description of work that needs to be done."></textarea>
				</div>
				<select name="phase" class="form-control"  data-style="btn-inverse">
			    <option value="NULL">No Phase Selected --will show in all phases</option>
			    <?php


			    $ph_there = $db->query("select id from `phase_$project_name` where id=1");
	/*		    foreach ($val->fetchAll() as $row){
			    @	$ph_there = $row['id'];
			    }	*/
				$err = $db->errorinfo();
			    # print_r($err = $db->errorinfo());
			    if($err[1] != 1146){
				    $statement = "SELECT phase_name, phase_id FROM phase_$project_name;";
				    $st = $db->query($statement);
				    foreach ($st->fetchAll() as $row) {
				    	echo "<option value=\"{$row['phase_id']}\">{$row['phase_name']}</option>\n";
				    }

			    }
				elseif($err[1] == 1146){
					echo "";

				}

			    ?>
				</select>
				<div class="btn-group">
				<button type="submit" class="btn btn-success" name="submit" value="Add More Big Picture Pieces">Add More Big Picture Pieces</button>
		</form>
		</div>
	</div> <!-- class="col-md-12 thumbnail"> -->
</div><!--div class="row">      -->
</div><!-- container      -->
<?php
require_once '/var/www/at_werk/home/boots_feet.php';
