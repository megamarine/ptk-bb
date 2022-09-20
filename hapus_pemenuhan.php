<?php
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_PERSONALIA_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

$DINO = date('Y-m-d H:i:s');

if(isset($_GET["seq"]) && isset($_GET["urut"]))
{
    $DINO          = date('Y-m-d H:i:s');
    $ID_USER1      = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
    $IP_ADDRESS    = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
    $seq           = $_GET["seq"];
    $urut          = $_GET["urut"];

    $query = DeleteData("t_fulfillment","seq='$seq' and urut='$urut'");
    if($query)
    {
        $update = UpdateData("t_ptk","qty_accepted = qty_accepted - 1, qty_left = qty_left + 1","seq = '$seq'");
        if($update)
        {
            InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Hapus pemenuhan $seq', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Pemenuhan PTK','Hapus'");

            echo "<script type='text/javascript'>alert('Data has been deleted! Thank you! ');</script>";
            echo "<script>document.location.href='ptk';</script>";
            die(0);
        }
        else
        {
            echo "<script type='text/javascript'>alert('Error! Gagal update Qty PTK, hubungi IT ');</script>";
            echo "<script>document.location.href='ptk';</script>";
            die(0);
        }
    }
    else
    {
        echo "<script type='text/javascript'>alert('Error! Please try again ');</script>";
        echo "<script>document.location.href='ptk';</script>";
        die(0);
    }
}
?>
