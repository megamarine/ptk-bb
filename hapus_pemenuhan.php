<?php
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_PERSONALIA_BB"]))
{
    header("Location: index.php");
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

            echo json_encode(array("success" => true, "message" => "Data Has Been Delete"));
        }
        else
        {
            echo json_encode(array("success" => false, "message" => "Error! Gagal update Qty PTK, hubungi IT"));
        }
    }
    else
    {
        echo json_encode(array("success" => false, "message" => "Error! Gagal Coba Lagi"));
    }
}
?>
