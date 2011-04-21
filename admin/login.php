<?php
include realpath(dirname(__FILE__).'/../core/core.include.php');
include realpath(dirname(__FILE__).'/../core/users.include.php');
    
$u = new Users();
var_dump($cookie);

if (isset($_GET['logout'])) {
    ($u->logout()) ? die('Logged out') : '';
}
$cookie = unserialize($_COOKIE['cookie']);
if(isset($_POST['username']) or isset($_COOKIE['name']) and !isset($_GET['logout'])){
    if($res = $u->login()){
       header('Location: index.php');
    } else {
        var_dump($res);
        die('Something gone wrong');
    }
}

?>
<html>
<head>
</head>
<body>
<form name="form" method="post" action="./login.php" >
                     <table>
                     <tr><td>Nome: </td><td><input name="username" maxlenght="60"></td></tr>
                     <tr><td>Password: </td><td><input type="password" name="password" maxlenght="60"></td></tr>
                     <tr><td><input type="checkbox" name="cookies" value="1" />Ricordami</td></tr>
                     <tr><td><button type="submit" width="50px" height="20px">Invia</button></td></tr>
                     </form>
</body>
</html>