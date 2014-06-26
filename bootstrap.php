<?php

/**
 * This file handels the bootstrap and html headers 
 * posibly rewrite a "break" from php, drop the var
 * and just have it all in html.
 * 
 */



$html_header = <<< EOD
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Project Darling</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap  -->
<link href ="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="bootstrap/css/custom.css" rel="stylesheet">
\t		<script src="/bootstrap/js/respond.js"></script>
\t		</head>
\t		<body>
EOD;

	
echo $html_header;
