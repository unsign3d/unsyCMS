<?php
//start compression
ob_start('ob_gzhandler');
//declaration of the blog
include dirname(__FILE__).'/core/core.include.php';
include dirname(__FILE__).'/core/articles.include.php';


$page = new Articles();

if (isset($_GET['pg']) and !isset($_GET['cat'])){
    $page->printArticleById($_GET['pg']);
} else if(isset($_GET['cat'])){
    $page->printArticleByCat($_GET['cat']);
} else {
    header('Location: index.php');
}

include dirname(__FILE__).'/core/genera_header.include.php';

?>
    <?php
		echo $page->page['content'];	
	?>
<?php
    include dirname(__FILE__).'/core/genera_footer.include.php';
?>