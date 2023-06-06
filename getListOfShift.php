<?php
include("connect.php");
$shiftWard = $_GET["shiftWard"];

try 
{
    $sqlSelect = "SELECT shift ,  name , department , date FROM nurse
                  WHERE shift = :shiftWard";

    $sth = $dbh->prepare($sqlSelect);
    $sth->bindValue(":shiftWard", $shiftWard);
    $sth->execute();
    $res = $sth->fetchAll(PDO::FETCH_NUM);

    header('Content-Type: text/xml');

    echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
    echo '<response>';
    echo '<shiftWard>';

    foreach ($res as $row) {
        echo '<shiftWard>' . $row[0] . " " . $row[1] . " " . $row[2] . " " . $row[3] . '</shiftWard>';
    }

    echo '</shiftWard>';
    echo '</response>';

} catch (PDOException $ex) {
    echo $ex->getMessage();
}

$dbh = null;
?>
