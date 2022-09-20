<?php
require_once ("module/model/koneksi/koneksi.php");
$DINO           = date('Y-m-d H:i:s');
$ID_USER        = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$NAMA_USER      = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME        = $_SESSION["PC_NAME_PERSONALIA_BB"];

InsertData(
    "users_log",
    "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'', 'User logout', '$IP_ADDRESS', '$ID_USER', '$DINO', '$ID_USER', 'Logout', 'Logout'");

unset($_SESSION["PC_NAME_PERSONALIA_BB"]);
unset($_SESSION["IP_ADDRESS_PERSONALIA_BB"]);
unset($_SESSION["LOGINIDUS_PERSONALIA_BB"]);
unset($_SESSION["LOGINNAMAUS_PERSONALIA_BB"]);
unset($_SESSION["LOGINAKS_PERSONALIA_BB"]);
unset($_SESSION["LOGINDEP_PERSONALIA_BB"]);
unset($_SESSION["LOGINDIV_PERSONALIA_BB"]);
unset($_SESSION["LOGINPTKVIEW_PERSONALIA_BB"]);
?><script>alert('Succesfully Logout!')</script><?php
?><script>document.location.href='index';</script><?php
?>
