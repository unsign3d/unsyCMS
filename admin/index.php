<?php
    ob_start('ob_gzhandler');
    session_start();
    ($_SESSION['login'] == 'ok') ? '' : header('Location: login.php');
    session_regenerate_id();
?>

<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="UTF-8" /> 
<meta name="author" content="Luca Unsigned Bruzzone" /> 
<meta name="copyright" content="Luca Unsigned Bruzzone" /> 
<meta name="description" content="Admin Zone, only r00t can access" /> 
<meta name="robots" content="index,follow" /> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<link rel="stylesheet" type="text/css" href="../css/backend.css" />
<link rel="stylesheet" type="text/css" href="../js/ui-lightness/jquery-ui-1.8.11.custom.css" /> 
<link type="text/css" rel="stylesheet" href="../js/tiny_mce/plugin/syntaxhl/styles/shCoreDefault.css"/> 
<!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--> 
<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
<![endif]--> 
<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]--> 
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery-ui.js"></script>
<script type="text/javascript" src="../js/jquery.form.js"></script>
<script type="text/javascript" src="../js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="../js/tiny_mce/plugin/syntaxhl/scripts/shCore.js"></script> 
<script type="text/javascript" src="../js/tiny_mce/plugin/syntaxhl/scripts/shBrushJScript.js"></script> 
<script type="text/javascript" src="../js/backend.js"></script> 

<title>Admin Zone</title> 
</head> 
<body> 
<header>
    <p id="banner">Admin Zone</p>
</header>
<div id="tabs">
    <ul> 
    	<li><a href="#articles">Articoli</a></li> 
    	<li><a href="#pages">Pagine</a></li> 
    	<li><a href="#sys">Sistema</a></li> 
    </ul> 
    <div id="articles"> 
    	<nav class="left_panel">
    	    <ul>
    	        <li><a href="javascript:change('pag=insert_articles');">Aggiungi articolo</a></li> 
    	        <li><a href="javascript:var id = prompt('Inserire il numero dell\'articolo da cambiare', ''); change('pag=mod_articles&id='+id);">Modifica articolo</a></li> 
    	        <li><a href="javascript:var id = prompt('Inserire il numero dell\'articolo da eliminare', ''); change('pag=del_articles&id='+id);">Elimina articolo</a></li> 
            </ul> 
    	</nav>
    	<div class="right_panel">
    	   Scegliere un opzione
    	   <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
    	</div>
    </div>
    <div id="pages"> 
   	 <nav class="left_panel">
    	    <ul>
    	        <li><a href="javascript:change('pag=insert_page');">Aggiungi pagina</a></li> 
    	        <li><a href="javascript:var id = prompt('Inserire il nome della pagina da cambiare', ''); change('pag=mod_pages&id='+id);">Modifica pagina</a></li> 
    	        <li><a href="javascript:var id = prompt('Inserire il numero della pagina da eliminare', ''); change('pag=del_pages&id='+id);">Elimina pagina</a></li> 
            </ul> 
    	</nav>
    	<div class="right_panel">
    	   Scegliere un opzione
    	   <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
    	</div>
    </div> 
    <div id="sys"> 
    	<nav class="left_panel">
    	    <ul>
    	        <li><a href="login.php?logout=1">Logout</a></li> 
    	        <li><a href="./ajax.php?pag=make_backup" target="_blank">Backup</a></li>
    	        <li><a href="javascript:change('pag=upload_file');">File Uploader</a></li>
            </ul> 
    	</nav>
    	<div class="right_panel">
    	   Scegliere un opzione
    	   <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
    	</div>
    </div> 
</div> 


</body>
</html>
