<?php

if (!isset($_COOKIE['loged_in'])){
require_once '/var/www/at_werk/home/require_all/require_logged_out.php';}
else{
	require_once '/var/www/at_werk/home/require_all/require_all.php';
}

?>
#http://localhost/at_werk/home/landing.php
   <!-- row 1 -->

    <div class="row">
    	<article class="col-lg-8 thumbnail">
            			<h2><span class="label label-primary">Welcome to Project Darling,</span></h2><b>a software planing, devlopement
				and comunication system.</b><br>
            <p class="bg-info">
            			You can get a hold of me @ <a href="mailto:squiddarling@yahoo.com">SquidDarling@yahoo.com</a>. 
       </p>  
        </article>  
         <aside class="col-lg-4">    
        	<h4><span class="label label-info">Project Darling, the Darling of all your projects.</span></h4>
            <p>

            
            This website is 100% free to use how ever everything being done right now is out of pocket for me
			and at no profit. So I will try to address concerns as quickly as posible.
            
            </p>   
            <hr>      
            <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
              <li class="active"><a href="contact.php">&nbsp;&gt;&gt;&gt;&nbsp;Contact</a></li>
            </ol>  
         </aside> 
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
