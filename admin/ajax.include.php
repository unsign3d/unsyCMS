<?php
class Admin extends Core{

    public function __construct(){ 
        parent::__construct() ;                      
    } 
    
    public function __destruct(){ 
        parent::__destruct() ;                       
    }
    
    public function provide_article_interface(){
    ?>
                <form id='form' action='ajax.php?pag=write_art' method='post'> 
                <table>
                <thead><h1>Aggiungi articolo</h1></thead>
                <tr><td>Titolo</td><td><input type='text' name='titolo' value='' /><input type='hidden' name='autore' value='unsy' /></td></tr>
                <tr><td>Categoria</td><td>
                <select name='categoria'>
                <?php
                $res = mysql_query('SELECT DISTINCT category
                        FROM '.parent::$prefix_table.'post;') or die(mysql_error()) ;
                if(mysql_num_rows($res) > 0){
                    while ($row = mysql_fetch_array($res)){
                        echo "<option value='$row[0]'>$row[0]</option>";
                    }
                }
                
                ?>
                </select>
                <td></tr>
                <tr><td>Per aggiungere una categoria</td>
                <td><input type='text' name='cat_new' /></td>
                </tr>
                <tr><td colspan='2'>Prevew</td></tr>
                <tr><td colspan='2'><textarea name='preview' class='tinymce'></textarea></td></tr>
                <tr><td colspan='2'>Testo</td></tr>
                <tr><td colspan='2'><textarea name='text' class='tinymce'></textarea></td></tr>
                <tr><td><button>Scrivi</button></td></tr>
                </table>
            </form>
            <?php
        }
    public function provide_article_mod($id){
             $id = intval($id);
             $id < 1 ? $id = 1 : '';
             $res = mysql_query('SELECT *
                            FROM '.parent::$prefix_table.'post
                            WHERE '.parent::$prefix_table.'post.id = '.$id.';') or die(mysql_error()) ;
     
            if(mysql_num_rows($res) > 0) {
                $row = mysql_fetch_array($res);
                $title = $row['title'];
                $category = $row['category'];
                $text = stripslashes($row['testo']);
                $preview = stripslashes($row['preview']);
    
                echo "
                    <form id='form' action='ajax.php?pag=mod_art' method='post'> 
                    <table>
                    <thead><h1>Modifica articolo</h1></thead>
                    <tr><td>Titolo</td><td><input type='text' name='titolo' value='$title' /><input type='hidden' name='autore' value='unsy' /></td></tr>
                    <tr><td>Categoria</td><td>
                    <select name='categoria'>
                    <option value='$category'>$category</option>
                    ";
                    
                    $res2 = mysql_query('SELECT DISTINCT category
                        FROM '.parent::$prefix_table.'post;') or die(mysql_error()) ;
                    if(mysql_num_rows($res2) > 0){
                        while ($row2 = mysql_fetch_array($res2)){
                            echo "<option value='$row2[0]'>$row2[0]</option>";
                        }
                    }
                    echo"
                    </select>
                    <td></tr>
                    <tr><td>
                    Per aggiungere una categoria</td>
                    <td><input type='text' name='cat_new' /></td>
                    </tr>
                    <tr><td colspan='2'>Prevew</td></tr>
                    <tr><td colspan='2'><textarea name='preview' class='tinymce'>$preview</textarea></td></tr>
                    <tr><td colspan='2'>Testo</td></tr>
                    <tr><td colspan='2'><textarea name='text' class='tinymce'>$text</textarea></td></tr>
                    </table>
                    <tr><td><button>Scrivi</button></td><input type='hidden' name='id' value='$id' /></tr>
                </form>
                ";
			    
            } else {
                echo 'Something bad happened';
            }
    }
    public function del_articles($id){
        $id = intval($id);
        $id < 0 ? die('Id sbagliato') : '';
        
        mysql_query('DELETE FROM '.parent::$prefix_table."post WHERE id=$id LIMIT 1;") or die(mysql_error());
         $this->clean_cache();
         return 0;
    } //del_articles
    public function insertArticle($title = '', $author = '', $category = '', $text = '', $preview=''){
           
            $author       = preg_replace('/[^A-Za-z0-9 ]+/i', '',  $author);
            $title            = preg_replace('/[^A-Za-z0-9 ]+/i', '',  $title);
            $category    = preg_replace('/[^A-Za-z0-9 ]+/i', '',  $category);
        	$text            = parent::removeXss(mysql_real_escape_string($text));
            $preview     = parent::removeXss(mysql_real_escape_string($preview));
             //var_dump($author, $title, $category, $preview);
            mysql_query('INSERT INTO '.parent::$prefix_table."post (author, title, category,
            testo, preview, datetime) VALUES ('$author', '$title', '$category',
            '$text', '$preview', now() ); ") or die(mysql_error());
			
			
			 $this->clean_cache();
			
	}//insertArticle
	public function modArticle($id = '' ,  $title, $author, $category, $text, $preview){
           
            $id               = intval($id);
            $author       = preg_replace('/[^A-Za-z0-9 ]+/i', '',  $author);
            $title            = preg_replace('/[^A-Za-z0-9 ]+/i', '',  $title);
            $category    = preg_replace('/[^A-Za-z0-9 ]+/i', '',  $category);
        	$text            = mysql_real_escape_string($text);
        	$text            = parent::removeXss($text);
            $preview     = mysql_real_escape_string($preview);
        	$preview     = parent::removeXss($preview);

            mysql_query('UPDATE '.parent::$prefix_table."post SET title = '$title', category = '$category', testo = '$text', preview = '$preview', datetime = now() WHERE id = '$id'; ") or die(mysql_error());
			
			 $this->clean_cache();
	}//insertArticle
    public function writePage($name, $title, $description, $keyword, $content){
        $name             = preg_replace('/[^A-Za-z0-9 ]+/i', '',  $name);
        $title                = preg_replace('/[^A-Za-z0-9 ]+/i', '',  $title);
        $description   = preg_replace('/[^A-Za-z0-9 ]+/i', '',  $description);
        $keyword       = preg_replace('/[^A-Za-z0-9, ]+/i', '',  $keyword);
        $content        = parent::removeXss(mysql_real_escape_string($content));
        
        mysql_query('INSERT INTO '.parent::$prefix_table."pages (name, title, description, keyword, content) VALUES ('$name', '$title', '$description', '$keyword', '$content');") or die (mysql_error());
         $this->clean_cache();
    }//writePage
    public function modPage($id, $name, $title, $description, $keyword, $content){
        $id=intval($id);
        $name             = preg_replace('/[^A-Za-z0-9_]+/i', '',  $name);
        $title                = preg_replace('/[^A-Za-z0-9 ]+/i', '',  $title);
        $description   = preg_replace('/[^A-Za-z0-9 ]+/i', '',  $description);
        $keyword       = preg_replace('/[^A-Za-z0-9, ]+/i', '',  $keyword);
        $content        = parent::removeXss(mysql_real_escape_string($content));
        
        mysql_query('UPDATE '.parent::$prefix_table."pages SET name='$name', title='$title', description='$description', keyword='$keyword', content='$content' WHERE id=$id ;") or die (mysql_error());
        
        $this->clean_cache();
    }//modPage
    public function provide_page_interface(){
    ?>
        <form id='form' action='ajax.php?pag=write_page' method='post'> 
                <table>
                <thead><h1>Crea una nuova pagina</h1></thead>
                <tr><td>Nome</td><td><input type='text' name='name' value='' /></td></tr>
                <tr><td>Titolo</td><td><input type='text' name='title' value='' /></td></tr>
                <tr><td>Descrizione</td>
                <td><input type='text' name='description' /></td>
                </tr>
                <tr><td>Keyword</td>
                <td><input type='text' name='keyword' /></td>
                </tr>
                <tr><td colspan='2'>Testo</td></tr>
                <tr><td colspan='2'><textarea name='content' class='tinymce'></textarea></td></tr>
                <tr><td><button>Scrivi</button></td></tr>
                </table>
            </form>
    <?php
    }
    public function provide_page_mod($name){
        $name = preg_replace('/[^A-Za-z0-9_]+/i', '',  $name);
        $res = mysql_query('SELECT *
                        FROM '.parent::$prefix_table.'pages
                        WHERE name = "'.$name.'";') or die(mysql_error()) ;
 
        if(mysql_num_rows($res) > 0) {
            $row = mysql_fetch_array($res);
            $id = $row['id'];
            $title = $row['title'];
            $name = $row['name'];
            $description = stripslashes($row['description']);
            $keyword = $row['keyword'];
            $content = stripslashes($row['content']);
    
    
        echo "
        <form id='form' action='ajax.php?pag=mod_page' method='post'> 
                <table>
                <thead><h1>Crea una nuova pagina</h1></thead>
                <tr><td>Nome</td><td><input type='text' name='name' value='$name' /></td></tr>
                <tr><td>Titolo</td><td><input type='text' name='title' value='$title' /></td></tr>
                <tr><td>Descrizione</td>
                <td><input type='text' name='description' value='$description'/></td>
                </tr>
                <tr><td>Keyword</td>
                <td><input type='text' name='keyword' value='keyword' /></td>
                </tr>
                <tr><td colspan='2'>Testo</td></tr>
                <tr><td colspan='2'><textarea name='content' class='tinymce'>$content</textarea></td></tr>
                <tr><input type='hidden' name='id' value='$id' /><td><button>Scrivi</button></td></tr>
                </table>
            </form>
    ";
    }
  } //provide_page_mod
    public function del_page($id){
        $name = preg_replace('/[^A-Za-z0-9_]+/i', '',  $name);
        mysql_query('DELETE FROM '.parent::$prefix_table."page WHERE name='$name' LIMIT 1;") or die(mysql_error());
        $this->clean_cache();
    }
    public function makeBackup(){
        ob_start('ob_gzhandler');
        header('Content-type: text/sql');
        $res = mysql_query('SELECT * FROM '.parent::$prefix_table.'post;');
        mysql_num_rows($res) < 1 ? die('empty table 1') : '';
        while ($row = mysql_fetch_object($res)){
            echo 'INSERT INTO '.parent::$prefix_table."post (author, title, category,
            testo, preview, datetime) VALUES ('$row->author', '$row->title', '$row->category',
            '$row->testo', '$row->preview', $row->datetime ); \r\n";
        }
        mysql_free_result();
        $res = mysql_query('SELECT * FROM '.parent::$prefix_table.'pages;');
        mysql_num_rows($res) < 1 ? die('empty table 2') : '';
        while ($row = mysql_fetch_object($res)){
            echo 'INSERT INTO '.parent::$prefix_table."pages (name, title, description, keyword, content) 
            VALUES ('$row->name', '$row->title', '$row->description', '$row->keyword', '$row->content');\r\n";
        }
        mysql_free_result();
        $res = mysql_query('SELECT * FROM '.parent::$prefix_table.'users;');
        mysql_num_rows($res) < 1 ? die('empty table 3') : '';
        while ($row = mysql_fetch_object($res)){
            echo 'INSERT INTO '.parent::$prefix_table."users (id, name, passwd, grade, email, ip, last_visit) 
            VALUES ('$row->id', '$row->name', '$row->passwd', '$row->grade', '$row->email', '$row->ip', '$row->last_visit');\r\n";
        }
        
    
    }   
    public function clean_cache(){
        $cache=  realpath(dirname(__FILE__).'/../cache/category.txt') or die('impossible set up cache (menu)');
        unlink($cache);
		$manifest = file_get_contents(dirname(__FILE__).'/../cache.manifest') or die('impossible set up cache (manifest)');
		$data = date('d/m/Y H:m:s');
		$manifest = preg_replace('/(\d+)\/(\d+)\/(\d+) (\d+):(\d+):(\d+)/i', $data , $manifest);
		file_put_contents(dirname(__FILE__).'/../cache.manifest', $manifest) or die('impossible set up cache (update manifest)');
    }
    
    public function uploadFile(){
        if($_GET['step'] == 2){
            if(!($_FILES['upload_file']['tmp_name'] > '') or ($_FILES['upload_file']['size'] == 0)){
			die('<h1>No file uploaded</h1>');
		}
		$name=htmlentities(strtolower($_FILES['upload_file']['name']));
		//replace some shit
		$name = str_replace(' ', '_', $name);
		$pos=strrpos($name, '.');
		$ext=substr($name, $pos , strlen($name)-$pos);
		unset($pos);
		if(!in_array($ext, parent::$allowed_ext)){
			unset($_FILES);
			die('estensione non permessa');
		}
		$upped_dir='../upped/';
		$uri=$upped_dir.$name;
		if(!file_exists($upped_dir)){
			die('la cartella di destinazione non esiste, contatta l\'amministratore');
		}
		if(!file_exists($uri)){
			move_uploaded_file($_FILES['upload_file']['tmp_name'], $uri) or die('error');
		}else{
			$name=substr($name, 0 , (strlen($name)-strlen($ext)));
			$uri=$upped_dir.mt_rand().$ext;
			move_uploaded_file($_FILES['upload_file']['tmp_name'], $uri) or die('error');
		}
		chmod($uri,0644) or die('I can\'t change permission -.-\'');
		//log file
		$sq = sqlite_open("file.sqlite") or die(sqlite_error_string(sqlite_last_error($sq)).'1');
		/*
		sqlite_query($sq, "CREATE TABLE file (id INTEGER PRIMARY KEY, uri varchar(200), ip varchar(30), data varchar(50));") or 
		die(sqlite_error_string(sqlite_last_error($sq)).' 2');
		*/
		//prepare for sqlite
		$uri_2=htmlentities(sqlite_escape_string($uri));
		//echo '- htmlentities done <br />';
		sqlite_query($sq, "INSERT INTO file (uri, ip, data) VALUES ('$uri_2', '".$_SERVER['REMOTE_ADDR'].'\', \''.date("d-m-y, g:i:s").'\');') or 
		die(sqlite_error_string(sqlite_last_error($sq)).' 3');
		//echo '- query done <br />';
		echo'<p>Upload eseguito con successo</p><a href="'.$uri.'">'.$name.'</a>';
        } else {
        ?><form enctype="multipart/form-data" action="ajax.php?pag=upload_file&step=2" method="post">
	        Choose a file to upload <input name="upload_file" type="file" /><br />
	        <input type="submit" value="Upload File" />
	        </form>
	        <?php
        }
    }
}
?>
