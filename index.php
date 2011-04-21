<?php
//start compression
ob_start('ob_gzhandler');
//declaration of the blog
include dirname(__FILE__).'/core/core.include.php';
include dirname(__FILE__).'/core/articles.include.php';

$page = new Articles();
$page->getLastArticles($_GET['pg']);

include dirname(__FILE__).'/core/genera_header.include.php';
?>
    <?php
		echo $page->page['content'];	
	?>
</ol>
</div>
<?php
    include dirname(__FILE__).'/core/genera_footer.include.php';
?>