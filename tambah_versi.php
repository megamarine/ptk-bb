<?php
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_PERSONALIA_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

$DINO           = date('Y-m-d H:i:s');
$DATE           = date("Y-m-d");
$ID_USER1       = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$NAMA_USER      = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];

$VERSION        = $_POST["VERSION"];
$VERSION_DATE   = $_POST["VERSION_DATE"];
$REQ_BY         = $_POST["REQ_BY"];
$VERSION_REMARK = $_POST["VERSION_REMARK"];

//EDIT
if(isset($_POST["SEQ"]))
{
    $SEQ = $_POST["SEQ"];

    $query = $db1->prepare("update version set version='$VERSION', date='$VERSION_DATE', change_log='$VERSION_REMARK', req_by='$REQ_BY', modified_date='$DINO' where seq='$SEQ' ");
    $query->execute();

    if($query)
    {
        ?><script>alert('Data Version has been updated! Thank you! ');</script><?php

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Versi - $VERSION', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Versi','Edit'");
    }
    else
    {
        ?><script>alert('Error! Failed to update data, try again! ');</script><?php        
    }

    ?><script>document.location.href='menuutama';</script><?php
    die(0);
}

//BARU
else
{
    $query = $db1->prepare("insert into version (version,date,change_log,req_by,created_date) values ('$VERSION','$VERSION_DATE','$VERSION_REMARK','$REQ_BY','$DINO')");
    $query->execute();

    if($query)
    {
        ?><script>alert('Data Version has been saved! Thank you! ');</script><?php

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Tambah Versi - $VERSION', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Versi','Tambah'");
    }
    else
    {
        ?><script>alert('Error! Failed to save data, try again! ');</script><?php        
    }

    ?><script>document.location.href='menuutama';</script><?php
    die(0); 
}
?>
