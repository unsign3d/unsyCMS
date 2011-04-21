<?php
ob_start('ob_gzhandler');
session_start();
($_SESSION['login'] == 'ok') ? '' : header('Location: login.php');
session_regenerate_id();

include_once realpath(dirname(__FILE__).'/../core/core.include.php');
include_once dirname(__FILE__).'/ajax.include.php';

$page = new Admin();

switch($_GET['pag']){
    case 'insert_articles':
        $page->provide_article_interface();
        break;
    case 'mod_articles':
        $page->provide_article_mod($_GET['id']);
        break;
    case 'del_articles':
        $page->del_articles($_GET['id']);
        echo 'Articolo eliminato';
        break;
    case 'write_art';
        //is_null($_POST['cat_new']) ? : $_POST['categoria'] = $_POST['cat_new'];
        $page->insertArticle($_POST['titolo'], $_SESSION['username'], $_POST['categoria'], $_POST['text'],$_POST['preview']);
        break;
    case 'mod_art':
        //is_null($_POST['cat_new']) ? : $_POST['categoria'] = $_POST['cat_new'];
        $page->modArticle($_POST['id'], $_POST['titolo'],  $_SESSION['username'] , $_POST['categoria'], $_POST['text'],$_POST['preview']);
        break;
    case 'insert_page':
        $page->provide_page_interface();
        break;
    case 'write_page':
        $page->writePage($_POST['name'], $_POST['title'], $_POST['description'],$_POST['keyword'], $_POST['content']);
        break;
    case 'mod_page':
        $page->modPage($_POST['id'], $_POST['name'], $_POST['title'], $_POST['description'],$_POST['keyword'], $_POST['content']);
        break;
    case 'mod_pages':
        $page->provide_page_mod($_GET['id']);
        break;
    case 'del_page':
        $page->del_page($_GET['id']);
        break;
    case 'make_backup';
        $page->makeBackup();
        break;
    case 'upload_file';
        $page->uploadFile();
        break;
    default:
        echo 'not use directly';
}
?>