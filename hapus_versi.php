<?php
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_PERSONALIA_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

if(isset($_GET["seq"]))
    {
        $KODE       = $_GET["seq"];
        $ID_USER1   = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
        $NAMA_USER  = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];
        $IP_ADDRESS = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
        $PC_NAME    = $_SESSION["PC_NAME_PERSONALIA_BB"];
        $DINO       = date('Y-m-d H:i:s');

        //DELETE DATA
        DeleteData(
        "version",
        "seq = '$KODE' ");

        //INSERT TO TABLE USERS_LOG
        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Hapus Versi - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Versi','Hapus'");

        ?><script>alert('Data has been deleted! Thank you! ');</script><?php
        ?><script>document.location.href='menuutama';</script><?php
        die(0);
    }
?>
