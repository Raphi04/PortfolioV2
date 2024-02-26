<?php
try{
    $db = new PDO(
        'mysql:host=localhost;dbname=gustave;charset=utf8',
        'root'
    );
    $db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
    die(print_r($e));
}
?>