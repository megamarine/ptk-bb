<?php
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_PERSONALIA_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

$KODE_USER  = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$query      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '1' and xdelete = '1'");
$cek = $query->rowCount();
if($cek == 0)
{
    ?> 
        <script>alert("Access Denied");window.history.back();</script>
    <?php
    die(0);
}

if(isset($_GET["KODE"]))
    {
        $KODE       = $_GET["KODE"];
        $ID_USER1   = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
        $NAMA_USER  = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];
        $IP_ADDRESS = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
        $PC_NAME    = $_SESSION["PC_NAME_PERSONALIA_BB"];
        $DINO       = date('Y-m-d H:i:s');

        $result = GetQuery("select * from m_user where kode_user = '$KODE'");
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
        {
            $USERNAME = $row["kode_user"];
        }

        //INSERT TO TABLE USERS_LOG
        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Hapus User - $USERNAME', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Hapus'");

        //DELETE DATA FROM TABLE M_USER_PLANT
        DeleteData(
        "m_user",
        "kode_user = '$KODE' ");

        ?><script>alert('User has been deleted! Thank you! ');</script><?php
        ?><script>document.location.href='m_user';</script><?php
        die(0);
    }
?>
