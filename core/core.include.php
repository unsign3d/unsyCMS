<?php
error_reporting(0);
ini_set('display_errors',0);
abstract class Core {
    //this variables must be changed for work
    static $db_user = '';
	static $db_pass = '';
	static $db_host = '';
	static $db_name = '' ;
	static $admin_mail ='';
	static $prefix_table = '';
	static $site_title = '';
	static $disquis_name = '';
	static $home_description = '';
	static $npp = 7;
	static $salt = '';
	static $allowed_ext = array('.txt','.pdf','.jpg','.jpeg','.gif','.png', '.zip', '.rar'); 
	static $browser_whitelist = array('Mozilla', 'KHTML', 'MSIE', 'AppleWebKit', 'Chrome', 'Chromium', 'Safari', 'Presto', 'Googlebot-Mobile');
    
	//don't touch after this please :P
	protected static $db;
	
	public function stripLink($link){
		$link= str_replace(" ","_", $link);
		$link= str_replace("&nbsp;","_", $link);
		$link= str_replace("&#91;","", $link);
		$link= str_replace("&#93;","", $link);
		$link= str_replace(".","", $link);
		return $link;
	}
	
	
	public function printMenu(){
		$menu_f = dirname(__FILE__).'/../cache/category.txt';
		
    	if(file_exists($menu_f)){
        	$menu = file_get_contents($menu_f, true);
    	} else {
        	$res = mysql_query('SELECT title, name FROM '.self::$prefix_table.'pages;') or die(mysql_error());
        	$f=fopen($menu_f, 'w');
			if(mysql_num_rows($res)){
				$menu = '<ul id="menu_a_2livelli">
				<li><a href="./index.php">Articoli</a>
					<ul>
				';
				$res2 = mysql_query('SELECT DISTINCT category FROM '.self::$prefix_table.'post;') or die('Error receiving cats');
				(mysql_num_rows($res2) < 0) ? die ('no category') : ''; 
				while($line2 = mysql_fetch_array($res2, MYSQL_BOTH)){
				        $line2['category'] = urlencode($line2['category']);
						 $menu .= '<li><a href="./'.$line2['category'].'">'.$line2['category']."</a></li>\n";
				}
				$menu .= '</ul></li>';
				while($line = mysql_fetch_array($res, MYSQL_BOTH)){
					$menu .= '<li><a href="./'.$line['name'].'.htm">'.$line['title']."</a></li>\n";
				}
				$menu .= '</ul>';
			} else {
				die('Query failed');	
			}
        fwrite($f, $menu, strlen($menu));
        fclose($f);
    }
    echo $menu;
}
	function removeXss($val) {
	
   //if input is an integer number it couldn't be dangerous 
   if (is_int($val)) return $val;
   
   // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
   // this prevents some character re-spacing such as <java\0script>
   // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
   $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);
   
   // straight replacements, the user should never need these since they're normal characters
   // this prevents like <IMG SRC=&#X40&#X61&#X76&#X61&#X73&#X63&#X72&#X69&#X70&#X74&#X3A &#X61&#X6C&#X65&#X72&#X74&#X28&#X27&#X58&#X53&#X53&#X27&#X29>
   $search = 'abcdefghijklmnopqrstuvwxyz';
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $search .= '1234567890!@#$%^&*()';
   $search .= '~`;?+={}[]_|\\';
   for ($i = 0; $i < strlen($search); $i++) {
      // ;? matches the ;, which is optional
      // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
   
      // &#x0040 @ search for the hex values
      $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
      // &#00064 @ 0{0,7} matches '0' zero to seven times
      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
   }
   
   return $val;
}


    public function sentinel(){
        $var= array_merge ($_GET, $_POST, $_COOKIE);
        array_push($var, $_SERVER['HTTP_USER_AGENT']);
        if (count($var) == 0) { return 0; }
        $i= 0;
        //check browser 
	    foreach (Core::$browser_whitelist as $value){
		    (preg_match("/$value/msi", $_SERVER['HTTP_USER_AGENT'])) ? $i++ : '';
	    }
	    ($i == 0) ? die('Your browser is not supported, get a standard browser') : '';
	    
	    include 'rules.include.php';
	    foreach($var as $value){
	        if (!is_int($value)){ //integer value can't be dangerous
		        foreach($rules as $rule){
			        //I'll check in rule if input can be dangerouse 
			        if( preg_match( "/{$rule['regexp']}/msi", $value)){
			            echo $rule['comment'];
			            die('Lamering attempt');
			        }
		        }
	        }
	    }
        unset($var);
        unset($rule);
    }
    

	public function __construct() {
		$this->db = mysql_connect(Core::$db_host, Core::$db_user, Core::$db_pass) or die(mysql_error());
		mysql_select_db(Core::$db_name, $this->db) or die(mysql_error());
		preg_match('|/admin/([^\">]+)|i', $_SERVER['PHP_SELF']) ? '' : Core::sentinel();
		$_SERVER['PHP_SELF'] = htmlentities($_SERVER['PHP_SELF']);
		$_SERVER['REQUEST_URI'] = htmlentities($_SERVER['REQUEST_URI']);
	}
	
	public function __destruct() {
		mysql_close($this->db);
	}

}

?>
