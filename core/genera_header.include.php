<!DOCTYPE html> 
<html lang="en" manifest="cache.manifest"> 
<head> 
<meta charset="UTF-8" /> 
<base href="http://www.unsigned.it/" />
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta name="author" content="Luca Unsigned Bruzzone" /> 
<meta name="copyright" content="Luca Unsigned Bruzzone" />
<meta name="description" content="<?php echo $page->page['description']; ?>" />
<meta name="robots" content="index,follow" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="./css/frontend.css" /> 
<link type="text/css" rel="stylesheet" href="./js/tiny_mce/plugins/syntaxhl/styles/shCoreDefault.css"/>
<link type="text/css" rel="stylesheet" href="./js/tiny_mce/plugins/syntaxhl/styles/shThemeDefault.css"/>
<script type="text/javascript" src="./js/tiny_mce/plugins/syntaxhl/scripts/shCore.js"></script> 
<script type="text/javascript" src="./js/tiny_mce/plugins/syntaxhl/scripts/shAutoloader.js"></script>
<script type="text/javascript" src="./js/tiny_mce/plugins/syntaxhl/scripts/shBrushPhp.js"></script>
<script type="text/javascript" src="./js/tiny_mce/plugins/syntaxhl/scripts/shBrushPlain.js"></script>
<script type="text/javascript" src="./js/tiny_mce/plugins/syntaxhl/scripts/shBrushSql.js"></script>

<script type="text/javascript" src="./js/frontend.js"></script>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-10764685-2");
pageTracker._trackPageview();
} catch(err) {}</script>
<!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
<![endif]-->
<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->
<title><?php echo $page->page['title']; ?></title>
</head>
<body>
<header>
    <p id="banner"></p>
    <a href="http://github.com/unsign3d"  target="_blank"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://d3nwyuy0nl342s.cloudfront.net/img/71eeaab9d563c2b3c590319b398dd35683265e85/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f677261795f3664366436642e706e67" alt="Fork me on GitHub"></a>
    <nav>
    <?php Core::printMenu(); ?>
   </nav>
</header>
<div class="separee"><br /></div>
<div id="main_container">
<!-- Prova di visualizzazione della lista di articoli in html5 -->
<ol id="articles">
