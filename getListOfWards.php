<?php
include("connect.php");
$nurseName = $_GET["nurseName"];

    try 
    {

        $sqlSelect = "SELECT nurse.name, ward.name, department, shift FROM nurse, ward, nurse_ward 
        WHERE nurse.name =:nurseName AND id_nurse=fid_nurse AND id_ward=fid_ward";
       
        $sth = $dbh->prepare($sqlSelect);
        $sth->bindValue(":nurseName",$nurseName);
        $sth->execute();
        $res = $sth->fetchAll(PDO::FETCH_NUM);
        
        foreach($res as $row)
        {
            echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
        }

    }
    catch(PDOException $ex)
    {
        echo $ex->GetMessage();
    }
    $dbh = null;
?>