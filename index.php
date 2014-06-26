<?php

require_once '/var/www/at_werk/home/require_all/require_logged_out.php';

if(($_COOKIE['loged_in']==null)&&($_COOKIE['user_name']==null)){
	Nav_Bar::nav_bar_comp_out();
}
elseif(($_COOKIE['loged_in']!=null)&&($_COOKIE['user_name']!=null)){
	Nav_Bar::nav_bar_comp();
}
?>
    <!-- row 1 
    <header class="row">
    	<div class="col-lg-6">	
        </div>
        <div class="col-lg-6">
        <img src="/at_werk/home/img/proj_dar_logo.gif" alt="gear heart logo" class="img-responsive" />       
        </div>
    </header>   
    <!-- row 2 -->
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
              <li class="active"><a href="index.php">Home</a></li>
            </ol>  
         </aside> 
 
    
    </div>
<div class="row">    
    <article class="col-md-12 thumbnail"><p>
	<header>
	    <h2>Welcome</h2>
    </header></p><p>
    Currently this site only has access granted to the devlopers of the site, however you can in fact search registered users,
    and view their porjects. Currently this web site is active but in a pre-launch state. 
	<!-- 
    <h2>What it's All About.(add screen shoots)</h2>
    </header></p><p>
            Sometimes people are "befuddled" by simplicity and this program is super simple <strong>it just helps organize what you
            need to do and what you've got done, then it can tell other people about it.</strong> However, if that is to simple of an 
            explantion here is a begger one, and I am fan of back story rather than give you a technical explanation, let me 
            give you human one. <small><a href ="doc_site.php"> Click here if you just want to skip to the nuts and bolts of how to use this 
            site.</a></small>
            </p><p>
            A long time ago when I fist started lerning about programing I asked someone what a "CMS" 
            was and their ansewer was "Oh that would be a content management system." I knew what the anacronym
            already meant but so I asked futher "but like what is that?" to my frustration this "master programer"
            answered with "That would be a system for managing content."
            </p><p>
            While this ansewer is correct it is also not helpful. So let me explain what Project Darling does.
            </p><p>         
            The main purpose of Project Darling is to take a big idea such as "Create a Content Management System"
            and allow for the user to to then map out <strong>the big picture</strong> under that: A home Page, user log in, admin logins,
            content storage, security, etc. 
            </p><p>
            Once those ideas are mapped then taking a look at the "medium sized" ideas as the work that will have to be done.
            So on your content management system you have a user log in, well that would need a log in page, a redirect,
            a database of current users... So now the ideas are getting smaller.
            </p><p>
            Finally you have the real "to do" of you project, such as write a class/object that redirects a user to such and
            such a page pending on cookie/sesion status. So you now can build a check list of all those things, create urls to them,
            and if a client/boss/lead programer wants to know how far you've come in the big picture, they can log in here and 
            see you work and where you are with it. (click here to read the flip side onclick='' show the idea of what an employer can do.)
            </p><p>
            So above you have a basic description of what Project Darling is about. Can it do more? Sure, but rather than get into
            the extras lets get started with the easy bits: <a href ="new_project.php">Click here to create a new project &gt;&gt;&gt;</a>
            </p><p>
            <a href ="doc_site.php">Complete site documentation &gt;&gt;&gt;</a>
    		</p>
     -->
    
    
    </article>
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
