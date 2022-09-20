<?php
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_PERSONALIA_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

$KODE_USER  = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$query      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '13' and xdelete = '1'");
$cek = $query->rowCount();
if($cek == 0)
{
    ?> 
        <script>alert("Access Denied");window.history.back();</script>
    <?php
    die(0);
}

if(isset($_GET["seq"]))
    {
        $seq        = $_GET["seq"];
        $ID_USER1   = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
        $NAMA_USER  = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];
        $IP_ADDRESS = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
        $PC_NAME    = $_SESSION["PC_NAME_PERSONALIA_BB"];
        $DINO       = date('Y-m-d H:i:s');

        //SET DATA = 1
        UpdateData(
        "t_ptk",
        "status_hapus = '1', deleted_date = '$DINO', deleted_by = '$ID_USER1'",
        "seq = '$seq'");

        //INSERT TO TABLE USERS_LOG
        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Hapus - $seq', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','PTK','Hapus'");

        ?><script>alert('Data has been deleted! Thank you! ');</script><?php
        ?><script>document.location.href='ptk';</script><?php
        die(0);
    }
?>
