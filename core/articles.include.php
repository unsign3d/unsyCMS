<?php
class Articles extends Core{
	var $page = 
	    array('content' => '', 
	    'title' => 'UnsyPress',
	    'description' => 'UnsyPress');
	
    public function __construct(){ 
        parent::__construct() ;                      
    } 
    
    public function __destruct(){ 
        parent::__destruct() ;                       
    }
    
    public function getLastArticles($p=1){
       $p <= 0 ? $p = 1 : '';
       $p = intval($p);
       $npp = parent::$npp;
       $f_line=($p - 1) * $npp;
       $res = mysql_query('SELECT * FROM '.parent::$prefix_table."post order by id DESC LIMIT $f_line, $npp;") or die(mysql_error());
       unset($f_line);
       $this->page['title'] = parent::$site_title;
       $this->page['description'] = parent::$home_description;
            if(mysql_num_rows($res) > 0){
                while ($row = mysql_fetch_array($res)){
                    $id= $row['id'];
                    $author = $row['author'];
                    $title = $row['title'];
                    $cats = $row['category'];
                    $preview = stripslashes($row['preview']);
                    //$this->page['title'] = $row['title'];
                    $datetime = $row['datetime'];
                    $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $datetime);
                    $title_link=parent::stripLink($title);
                    
                    //build the page's content
                    $this->page['content'] .= 
                    "<li>
                    <article>
                        <section class='description'>
                            <abbr title='$datetime'>
                                $data
                            </abbr>
                            <address class='vcard author'> 
                                    By <span class='url fn'>$author</span>
                        </address>
                    </section>
                    <section class='entry-content'>
                        <header>
                            <h2 class='entry-title'><a href='./$id-$title_link.html' rel='bookmark' title='$title'>$title</a></h2>
                        </header>
                        <p>$preview</p>
                    </section>
                    </article>
                    </li>
                     <div class='separee'><br /></div>";
                    }//while
                    $pp = $p-1;
                    $pf = $p+1;
                    $this->page['content'] .= "<p><a href='".$_SERVER['PHP_SELF']."?pg=$pp'>Articoli seguenti</a>-
                    <a href='".$_SERVER['PHP_SELF']."?pg=$pf'>Articoli precedenti</a></p>";
                } else {
                    $this->page['content'] .= "No more pages, I'm so sorry ='( So you can go back to the <a href='$php_self?pg=0'>first page</a>";
                }
    }
    
    public function printRSS($number=10){
                
                $number = intval($number);
                $query = mysql_query('SELECT * FROM '.parent::$prefix_table.'post order by id DESC LIMIT 0, '.intval($number).';') or die(mysql_error());

                if(mysql_num_rows($query) > 0){
                    while ($row = mysql_fetch_object($query)){
                        echo "<item>
                                    <title>$row->title</title>
                                    <description>
                                    <![CDATA[<h1><a href=\"".$_SERVER['SERVER_NAME']."$row->id-$row->title.html\">$row->title</a></h1>
                                    $row->description</description>
                                    <author>$row->author</author>
                                    <pubDate>$row->datetime</pubDate>
                                    </item>  
                        ";
                    }//while
                }//if
    }//printArticlePreview
    
    public function printArticleById($id = 1){
        $id <= 0 ? $id = 1 : '';
        $id = intval($id);
        $res = mysql_query('SELECT *
                                FROM '.parent::$prefix_table.'post
                                WHERE '.parent::$prefix_table.'post.id = '.$id.';') or die(mysql_error()) ;
         
         if(mysql_num_rows($res) > 0) {
            $row = mysql_fetch_array($res);
            $author = $row['author'];
            $title = $row['title'];
            $category = $row['category'];
            $text = stripslashes($row['testo']);
            $datetime = $row['datetime'];
            $title_link=parent::stripLink($title);
            $this->page['title'] = $title;
            $this->page['description'] = strip_tags($row['preview']);
            $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $datetime);
            //print article's title
            $this->page['content'] .= "
            <article>
                        <section class='description'>
                            <abbr title='$datetime'>
                                $data
                            </abbr>
                            <address class='vcard author'> 
                                    By <span class='url fn'>$author</span>
                            </address>
                            <p>Share on<br />
                            <a target='_blank' href='http://www.facebook.com/share.php?u=http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."'><img src='./img/facebook.png' alt='facebook logo' /></a>
            <a href='http://twitter.com/home?status=RT%20http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."'
              alt=\"twitter logo\"><img src='./img/twitter.gif' /></a></p>
                    </section>
                    <section class='entry-content'>
                        <header>
                            <h1 class='entry-title'>$title</h1>
                        </header>
                        <div><a href='./index.php'>Home Page</a> -> <a href='./$category'>$category</a> -> <a href='.".$_SERVER['REQUEST_URI']."'>$title</a>
                        <div>$text</div>
                        <hr />
                    </section>
                    <div id='comment_container'>
                    <div id=\"disqus_thread\"></div>
<script type=\"text/javascript\">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = '".Core::$disquis_name."'; // required: replace example with your forum shortname

    // The following are highly recommended additional parameters. Remove the slashes in front to use.
    // var disqus_identifier = 'unique_dynamic_id_1234';
    // var disqus_url = 'http://example.com/permalink-to-page.html';

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href=\"http://disqus.com/?ref_noscript\">comments powered by Disqus.</a></noscript>
<a href=\"http://disqus.com\" class=\"dsq-brlink\">blog comments powered by <span class=\"logo-disqus\">Disqus</span></a>
                    </div>
                    </article></div>
                    ";
        }//if
    }
    
    public function printArticleByCat($cat = ''){
                //sanitize cat
                $cat= preg_replace('/[^A-Za-z0-9 ]+/i', '',  $cat);
                //search in tags cat
               $query = mysql_query('SELECT id, author, title, preview, datetime FROM '.parent::$prefix_table.'post 
                                                    WHERE category=\''.$cat.'\'
                                                    ORDER BY id DESC');
                
                $this->page['content'] .= '<ol>';
                if(mysql_num_rows($query) > 0){
                    while ($row = mysql_fetch_array($query)){
                            $id = $row['id'];
                            $author = $row['author'];
                            $title = $row['title'];
                            $preview = $row['preview'];
                            $datetime = $row['datetime'];
                            $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $datetime);
                            $title_link= parent::stripLink($title);
                            $this->page['content'] .= 
                                "<li>
                                <article>
                                    <section class='description'>
                                        <abbr title='$datetime'>
                                            $data
                                        </abbr>
                                        <address class='vcard author'> 
                                                By <span class='url fn'>$author</span>
                                    </address>
                                </section>
                                <section class='entry-content'>
                                    <header>
                                        <h2 class='entry-title'><a href='./$id-$title_link.html' rel='bookmark' title='$title'>$title</a></h2>
                                    </header>
                                    <p>$preview</p>
                                </section>
                                </li>
                                </article>
                                 <div class='separee'><br />
                                 </div>";
                    }//while
                    $this->page['content'] .= '</ol><div class=\'separee\'><br />
                                 </div></div>';
                } 
    }//funct
    
    public function writeComment($id, $name, $comment, $email, $url=''){
        if (empty($name) || empty($comment) || empty($email)){
                return false;
            }
            $id=intval($id);
            $name= preg_replace('/[^A-Za-z0-9 ]+/i', '', $name);
            $comment = htmlentities(mysql_real_escape_string($comment));
            //check if email is written in the right way
            if (!preg_match('/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i', $email)){
                echo 'bad email';
                return false;
            }
            //check if url is written in the right way
           if($url != ''){
                if (!preg_match('/^(http|https|ftp)://([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?/?/i', $url)) {
                    echo 'bad url';
                    return false;
                }
            }
            $ip = $_SERVER['REMOTE_ADDR'];
            mysql_query("INSERT INTO ".parent::$prefix_table."comments (name, ip, comment, datetime, npost, email, website) 
                VALUES ('$name', '$ip', '$comment',now(), '$id', '$email', '$url'); ") or die('Query failed');
            return true;
        }
        
    public function rankComment($id, $rank){
        $id = intval($id);
        $rank = intval($rank);
        $rank >= 1 ? $rank = 1 : '';
        $rank <= -1 ? $rank = -1 : '';
        
        mysql_query('UPDATE '.parent::$prefix_table."comments SET rank= rank+$rank where id=$id LIMIT 1;") or die(false);
        return 0;
    
    }
    
}

?>
