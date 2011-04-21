<?php
error_reporting(E_ALL);
//start compression
//declaration of the blog
include dirname(__FILE__).'/core/core.include.php';
include dirname(__FILE__).'/core/articles.include.php';

?>
 <rss version="2.0">
 <channel>
 <title><?php echo Core::$site_title; ?></title>

<?php

$page = new Articles();
$page->printRSS(10);

?>

</channel>
 </rss>