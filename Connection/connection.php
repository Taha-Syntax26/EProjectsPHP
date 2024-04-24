<?php
define('server','mysql:host=localhost;dbname=eproject');
define('user','root');
define('password','');

try{
    $connection = new PDO (server,user,password);
   
}

catch(PdoException $e){
    echo $e->getmessage();


}


?>