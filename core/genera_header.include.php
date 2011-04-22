<!DOCTYPE html> 
<html lang="en" manifest="cache.manifest"> 
<head> 
<meta charset="UTF-8" /> 
<base href="" />
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
    <nav>
    <?php Core::printMenu(); ?>
   </nav>
</header>
<div class="separee"><br /></div>
<div id="main_container">
<!-- Prova di visualizzazione della lista di articoli in html5 -->
<ol id="articles">
