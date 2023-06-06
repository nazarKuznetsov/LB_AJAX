<?php
try 
{
    $dsn = "mysql:host=localhost;dbname=iteh2lb1var4";
    $user = 'root';
    $pass = '';
    $dbh = new PDO($dsn, $user, $pass);
}
    catch(PDOException $ex)
    {
        echo $ex->GetMessage();
    }
