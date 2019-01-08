<?php
/**
 * Created by PhpStorm.
 * User: Entireno
 * Date: 15.04.2018
 * Time: 18:43
**/
 try {

    $db= new PDO('mysql:host=localhost;dbname=apt','root','root');
    $db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
 }
 catch (PDOException $e){

  echo $e->getMessage();
 }
?>

