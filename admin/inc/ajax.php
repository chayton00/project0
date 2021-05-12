<?php include "functions.php";?>
<?php 

if (isset($_GET["checkupdate"])) 
{
    $cversion = $_GET['cversion'];
    $parsed = getupdate($cversion);
    echo $parsed;
}

if (isset($_GET["downloadupdate"])) 
{
    $cversion = $_GET['nurl'];
    $newversion = $_GET['newversion'];
    $parsed = downloadupdate($cversion,$newversion);
    echo $parsed;
}

if (isset($_GET["activeinactive"])) 
{
    $id = $_GET['id'];
    $status = $_GET['status'];
    $parsed = updatePageStatua($id,$status);
    echo $parsed;
}

?>