<?php
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_PERSONALIA"]))
{   
    session_destroy();
    header("Location: index.php");
    die(0);
}

$DINO = date('Y-m-d H:i:s');

if(isset($_POST["seq"]))
{
    $DATE          = date("Y-m-d");
    $seq           = $_POST["seq"];
    $date_accepted = $_POST["date_accepted"];
    $id_accepted   = $_POST["id_accepted"];
    $name_accepted = $_POST["name_accepted"];
    $gender        = $_POST["gender"];
    $ID_USER1      = $_SESSION["LOGINIDUS_PERSONALIA"];
    $NAMA_USER     = $_SESSION["LOGINNAMAUS_PERSONALIA"];
    $IP_ADDRESS    = $_SESSION["IP_ADDRESS_PERSONALIA"];

    $result = $db1->prepare("select qty_submition, qty_accepted from t_ptk where seq = '$seq'");
    $result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $qty_minta  = $row["qty_submition"];
        $qty_terima = $row["qty_accepted"];
    }
    $qty_kekurangan = $qty_minta - $qty_terima;

    if($qty_kekurangan > 0)
    {
        $insert = InsertData("t_fulfillment",
                             "seq,date,id_accepted,name_accepted,jenis_kelamin,created_date,created_by",
                             "'$seq','$date_accepted','$id_accepted','$name_accepted','$gender','$DINO','$ID_USER1'");
        if($insert)
        {
            $update = UpdateData("t_ptk",
                                 "qty_accepted = qty_accepted + 1, qty_left = qty_left - 1",
                                 "seq = '$seq'");
        }
        
        if($update)
        {
            InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Pemenuhan $seq - $id_accepted', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Pemenuhan PTK','Tambah'");
        }
        echo json_encode(array("success" => true, "message" => "Data Has Been Update", "seq" => $seq));
    }
    else
    {
        echo json_encode(array("success" => false, "message" => "PTK Sudah Terpenuhi", "seq" => false));
    }
}    
?>
