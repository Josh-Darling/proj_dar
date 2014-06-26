<?php

if (!isset($_COOKIE['loged_in'])){
	require_once '/var/www/at_werk/home/require_all/require_logged_out.php';}
	else{
		require_once '/var/www/at_werk/home/require_all/require_all.php';
	}

echo "this is where the site DOC will go";
		

?>



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
