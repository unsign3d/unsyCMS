<?php
class Users extends Core{

    public function __construct(){ 
        parent::__construct() ;                      
    } 
    
    public function __destruct(){ 
        parent::__destruct() ;                       
    }
    
    private function chklogin($name, $password){
        
        $name = preg_replace('/[^A-Za-z0-9_]+/i', '',  $name);
        $password = sha1(parent::$salt.md5($password));
        
        $res = mysql_query('SELECT passwd FROM '.parent::$prefix_table."users WHERE name = '$name' AND passwd='$password' LIMIT 1;") or die(mysql_error()) ;
        if(mysql_num_rows($res) > 0) {
            $row = mysql_fetch_array($res);
            if($password==$row['passwd']){
                session_start();
                session_regenerate_id();
                
                $_SESSION['login'] = "ok";
                $_SESSION['username'] = $name;
                
                $cookie_exp = (isset($_POST['cookies']) and $_POST['cookies'] == 1) ? time() + 604800 : time()+ 3600;
                $content = array($name,$password);
                setcookie('cookie', serialize($content), $cookie_exp);
                
            }
            return TRUE;
        } else {
            return FALSE;
        }
        
    }//chklogin
    
    public function logout(){
        session_start();
        $_SESSION = array();
        session_unset();
        session_destroy();
        session_regenerate_id();
        setcookie('cookie', '', time()-31536000);
        header('Location: ../index.php');
    }//logout
    
    public function login(){
        if ($_SESSION['login'] == "ok") return true;
        
        if(isset($_COOKIE['cookie'])){
            $content = unserialize($_COOKIE['cookie']);
            if($this->chklogin($content[0], $content[1])) return true;
        } else {
            if ($this->chklogin($_POST['username'], $_POST['password'])) return true;
        }
        return false;
    }//login
    
}