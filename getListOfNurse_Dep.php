<?php
include("connect.php");

$departmentName = $_GET["departmentName"];

    try 
    {

        $sqlSelect = "SELECT name, department, shift, date FROM nurse WHERE department =:departmentName";
       
        $sth = $dbh->prepare($sqlSelect);
        $sth->bindValue(":departmentName",$departmentName);
        $sth->execute();
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        

        $data = array();

    
        foreach($res as $row)
        {
           array_push($data,$row['name']);
           
        }
        $json_data = json_encode($data);
        echo $json_data;

    }
    catch(PDOException $ex)
    {
        echo $ex->GetMessage();
    }
    $dbh = null;
?>