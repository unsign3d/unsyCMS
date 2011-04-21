<?php
class Pages extends Core{
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

public function getPages($name){
     $name= preg_replace('/[^A-Za-z0-9]+/i', '',  $name);
     $query = mysql_query('SELECT * FROM '.parent::$prefix_table."pages WHERE name = '$name' LIMIT 1") or die(mysql_error());
     if(mysql_num_rows($query) > 0) {
        $row = mysql_fetch_array($query);
        $keyword = $row['keyword'];
        $title = $row['title'];
        $text = stripslashes($row['content']);
        $title_link=parent::stripLink($title);
		$this->page['title'] = $row['title'];
		$this->page['description'] = $row['description'];
        //print article's title
        $this->page['content'] .= "
		<article>
            		<section class='description'>
						<p>Share on<br />
                            <a target='_blank' href='http://www.facebook.com/share.php?u=".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."'><img src='./img/facebook.png' alt='facebook logo' /></a>
            <a href='http://twitter.com/home?status=RT".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."'
              alt=\"twitter logo\"><img src='./img/twitter.gif' /></a></p>
            	</section>
            	<section class='entry-content'>
                    <header>
                        <h1 class='entry-title'>$title</h1>
                    </header>
					<div>$text</div>
		    	</section>
        		
        		</div><br />";
    }else {
        $this->page['content'] .= "404 Pagina non trovata";
    }//if

}//function

}


?>