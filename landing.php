<?php
require_once '/var/www/at_werk/home/require_all/require_all.php';

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
            <p class="bg-info">
            
<?php 
    foreach ($_COOKIE as $cookie_name => $cookie_value) {
		
		print "$cookie_name = $cookie_value <br/>";
		
	}

	$log_in_cookie = md5('The Grand Architect ',"Josh");
	echo "<p>";
	$login_name = md5($login_name);
	echo $login_name;
	echo "<p>";
	$cookie_name = "login";
	$cookie_name = md5($cookie_name);
	echo $cookie_name;
            
 ?>
            </p>            
            <?php 
            
            $st = $db->query("SELECT id, login, pass_word FROM people WHERE login='$login'");
            foreach ($st->fetchAll() as $row) {
            	$uid=$row['id'];
            	$login_name = $row['login'];
            	$pass_word = $row['pass_word'];
            }
            
            if ($login_name==null){
            	echo "That log in is not in the data base.";
            }
            
            
            ?>

 </article>  
         <aside class="col-lg-4">    
        	<h4><span class="label label-info">Project Darling, the Darling of all your projects.</span></h4>
            <p>Option to be remembered goes here.
            </p><p>
            <?php 
            echo "Hello ".$_COOKIE['user_name']. " you are logged in as " . $_COOKIE['loged_in'].".";

            ?>
            </p>   
            <hr>      
            <ol class="breadcrumb">
              <li class="active"><a href="landing.php">Log In Home</a></li>
            </ol>  
         </aside> 
 
    
    </div>
<div class="row">    
    <div class="col-lg-12 table responsive">
<!--  	<div class="table responsive">-->	
              <table class="table table-striped table-condensed">
                  <thead>
                  <tr>
                    <th>visability</th>
                    <th>big picture</th>
                    <th>status</th>
                    <th>purpose</th>
                    <th># of Jobs</th>
                  </tr>
                </thead>
    
<?php       
// ^needs a div container, needs a table ~>    
    

$statement = "SELECT id, cat_name, cat_purrr, created_by, status, visability, time_stamp FROM catagory_project_darling ORDER BY time_stamp;";
$st = $db->query($statement);
foreach ($st->fetchAll() as $row) {

$visability = $row['visability'];
$status_of_work = $row['status'];

if (($visability==1)||($status_of_work>1)) {
	continue;
}
else{
echo '<tr><td>';
if (($visability==null)||($visability==0)){echo " show ";}
#echo $link_id = ;
echo "</td><td>";
echo "<a href ='edit_big_picture.php?cat_id=".$row['id']."'>";
echo $row['cat_name']."</a></td><td>"; 

	if ($status_of_work==1){
	echo '<span class="glyphicon glyphicon-ok"></span>';
	}
	else{
	echo '<span class="glyphicon glyphicon-hand-left"></span>';
	} 
# SELECT COUNT(*) AS jobcount FROM project_darling where catagory_id=7;
echo "</td><td>".
	"{$row['cat_purrr']}</td><td>";

$get_count = "SELECT COUNT(*) AS jobcount FROM project_darling where catagory_id={$row['id']};";
$st = $db->query($get_count);
foreach ($st->fetchAll() as $row) {
echo "{$row['jobcount']}</td><td>"; 
}
echo "{$row['status']}</td></tr>\n";
}
}
?>   

    		</table>
    	</div>
    	</div>
<!--    	</div> -->	
<!-- ######################## -->
    	<div class="row">   
    <div class="col-lg-12">
		<div class="table responsive">
              <table class="table table-striped table-condensed">
                  <thead>
                  <tr>
                    <th>visability</th>
                    <th>task</th>
                    <th>status</th>
                    <th>purpose</th>
                    <th>belongs to</th>
                  </tr>
                </thead>
    
<?php       
// ^needs a div container, needs a table ~>    
    

$statement = "SELECT id, task, status, purpose, location, type, catagory_id, visability, time_stamp FROM project_darling ACS;";
$st = $db->query($statement);
foreach ($st->fetchAll() as $row) {

$visability = $row['visability'];
$status_of_work = $row['status'];

if (($visability==1)||($status_of_work>1)) {
	continue;
}
else{
echo '<tr><td>';
if (($visability==null)||($visability==0)){echo " show ";}
$link_id = $row['id'];
echo "</td><td>";
echo "<a href ='edit_jobs.php?work_id=$link_id'>";
echo $row['task']."</a></td><td>"; 

	if ($status_of_work==1){
	echo '<span class="glyphicon glyphicon-ok"></span>';
	}
	else{
	echo '<span class="glyphicon glyphicon-hand-left"></span>';
	} 

echo "</td><td>".
	"{$row['purpose']}</td><td> ";
$cat_id = $row['catagory_id'];

$get_cat = "SELECT cat_name FROM catagory_project_darling where id=$cat_id;";
$st = $db->query($get_cat);
foreach ($st->fetchAll() as $rows) {
echo "<a href ='add_work_picture.php?cat_id=$cat_id'>";
	echo "{$rows['cat_name']}</a></td><td>";
}
	
}
}
?>   
    		</table>
    	</div>    	    	
<!-- ######################## -->    	
    </div>
</div>    <!-- row 4 -->
    <footer class="row">
         <p>(c) Josh Darling 
         <?php 
@ $a = getdate();
printf('%d',$a['year']);
         ?>
         </p>
    </footer>

</div> <!-- end container -->

<?php 
require_once '/var/www/at_werk/home/boots_feet.php';
?>
