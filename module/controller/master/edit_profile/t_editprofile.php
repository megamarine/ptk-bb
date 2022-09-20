<?php
$ID_USER1       = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME        = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER      = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];
$DINO           = date('Y-m-d H:i:s');
$PASSWORD       = "";

$options        = ['cost' => 12,];

if(isset($_POST["simpan"]))
{
    $NAMA_USER  = $_POST["NAMA_USER"];
    $PASS       = $_POST["PASSWORD"];
    $PASSWORD   = password_hash($_POST['PASSWORD'], PASSWORD_BCRYPT, $options);

    UpdateData(
    "m_user",
    "nama_user = '$NAMA_USER',password='$PASSWORD'",
    "kode_user = '$ID_USER1'");

    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Edit Profile - $ID_USER1', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Edit'");

    ?>
    <script>alert('Edit Profile Successfully!');</script>
    <script>document.location.href='menuutama.php';</script>
    <?php
    die(0);
}
?>