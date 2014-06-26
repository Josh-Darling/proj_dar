<?php 
if (!isset($_COOKIE['loged_in'])){
	require_once '/var/www/at_werk/home/require_all/require_logged_out.php';}
	else{
		require_once '/var/www/at_werk/home/require_all/require_all.php';
	}

	if(($_COOKIE['loged_in']==null)&&($_COOKIE['user_name']==null)){
		Nav_Bar::nav_bar_comp_out();
	}
	elseif(($_COOKIE['loged_in']!=null)&&($_COOKIE['user_name']!=null)){
		Nav_Bar::nav_bar_comp();
	}


?>
   <div class="row">
    	<article class="col-lg-8 thumbnail">
            			<h2><span class="label label-primary">Welcome to Project Darling,</span></h2><b>a software planing, devlopement
				and comunication system.</b><br>
            <p class="bg-info">This is a web project that I'm devloping for the purpose of increasing comunication between 
            software project managers and devlopers. To help monitor work but also to allow for more "aglie" 
            like devlopment and allowing for a programer to turn on a dime (and hopefully pick it up).</p>
            
            <!-- add a more link: -->
 </article>  
         <aside class="col-lg-4">    
        	<h4><span class="label label-info">Project Darling, the Darling of all your projects.</span></h4>
            <p>It works as a road map for comunication between project managers and software devlopers. 
            It hepls with seeing the big picture and the small details.</p>   
            <hr>      
            <ol class="breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li class="active"><a href="doc_faq.php">Site Documentation</a></li>
            </ol>  
         </aside> 
 
    
    </div>
<div class="row">    
    <article class="col-md-12 thumbnail"><p>
	<header>
	    <h2>Welcome Got Questions get ansewers:</h2>
    </header></p><p>
    If you have NO idea what this web site is about and were told to go here
    <a href="#"> click here for an explanation of a project management system with nice pictures</a>.
     All the simple "How do I ____fill in the blank___" are ansewered first. Next are the structual questions
     and finally are the micelanyus. If a question is not ansewered here please email me (see the contact link)
     and I will personally address it and posibly add it here.</p>
	<p><span class="label label-danger">READ THIS FIRST</span></p><p>At the top of this page, 
	you'll see a black nav bar (unless you're using a hand held device.) All pictures of how to get to
	things are "snippets" from that bar. For example if you're wondering where that link to create an account is
	just look to the top of the page and you are all set. Also square brackets [] are used to describe something you do.
	This "style" is taken from old Commadore 64 instruction booklets.</p>
     
     <p><span class="label label-info">How do I create an Account</span></p><p><ol><li>Click <strong>[Log In/Create New]</strong> this 
     will give you a drop down menu.</li><li>From the drop down menu Click <strong>[Create New]</strong> this will take you to account
     creation page.</li><li> Here there are form fields, fill all of them out and click <strong>[Create Account]</strong> at the bottom of the
     page.
		</li>
		</ol>
		<ul>
	
		<li>click here to go to create new account page.</li>
		<li>click here to open this in a new window for referance.</li>
		</ul>
     </p>
  
  
     <p><span class="label label-info">How do I create a new Project</span></p><p>If not logged in/first time here:<ul><li>Click 
     <strong>[Start Project]</strong></li></ul>
     <p>If you've already created an account or are logged in:<ol><li>Click <strong>[Projects]</strong></li>
     <li>Click <strong>[Start New]</strong></li>

		</ol>
		<ul>
		<li>click here to see what "projects" are about.</li>
		<li>click here to to create a new project.</li>
		<li>click here to open this in a new window for referance.</li>
		</ul>
     </p>
  	
  	
  	
  	<p><span class="label label-info">Creating "A Big Picture" & Work</span></p><p>	</p>
  	
  	
  	
  	
  			<ul>
		<li>click here to see what "the big picture" is about .</li>
		<li>click here to to create a new project.</li> <!-- only available if logged in like like there will be a pop over stating so. -->
		<li>click here to open this in a new window for referance.</li>
		</ul>
  	
     <p><span class="label label-info">Info</span></p><p>	</p>
  
  
  	<p><span class="label label-info">Info</span></p><p>	</p>
  	
  	
<hr>  	
  	<p><span class="label label-info">Projects</span></p><p>
  	A <strong>Project</strong> is the bigest idea of the software that you are devloping. This should be a
  	very broad idea. For example:<ul>
  	<li>Yahoo: A News and Email service.</li>
  	<li>Google: A search Engine. </li>
  	<li>Bootstrap: A Web Designe frame work.</li>
  	</ul>
  	Granted not everything is simple, or it doesn't seems so but below is a bit more "in depth" example if you need one.<br>
  	Facebook: A socail networking website that collects user data for resale. Can also be used to purchase add space, 
  	comuncate via e-mail, up load pictures and cross referance bloging with add space for sale based upon user likes.
  	
  		</p>
  		<p>
  		A few things about the Projects:<ul>
  		
  		<li>You have the option to have <strong> the project attached to your portfolio, this means it's description will show too</strong></li>
		<li>You have the option to include a link and screen shots later</li>
  		<li>You can change the project desciption later, --project admins only.</li>
  		</ul>
  		</p>
  	
  	
     <p><span class="label label-info">The Big Picture </span></p><p>IF you think about your project as a gaint painting this would be all the things
     that are going to go into your masterpiece. For example if you're makeing a web site you might have something like this:</p>
     <ul>
     <li>index page</li>
     <li>user data base</li>
     <li>storage for user media</li>
     <li>user log in page</li>
     <li>user log in validation</li>
     <li>headers/redirects</li>
     <li>error cookies</li>
     <li>user home page</li>
     </ul>
     
  And of course you're going to want to know a bit about it so for index page you might have somehting like "page that
   visitors will see first, blog info and new products will be listed here."
  
  	<p><span class="label label-info">Info</span></p><p>	</p>
  	
<hr>	
  	
  	<p><span class="label label-info">Over explaining things here</span></p><p>If it doesn't seem like that then great!
  	Likewise if it does, I'd rather there be tons of easy understanding over not enough explanation. Video tutorials will 
  	be up soon.</p>
  	
  	
  	<p><span class="label label-info">Only 1 picture allowed for my personal profile!</span></p><p>Well, this isn't a socail networking site.
  	 And while the site can be used to "network" it's more for people that are concentrating on getting work done and not what your new shoes
  	 look like. The purpose of the streamlining is for no nonsense work. If you want to put thumbnails of your work on here you can do from 
  	 project page... Or add pictures of your shoes there.</p>
  
  
  
    
    </article>
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
