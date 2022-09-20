<?php
$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME    = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER  = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];

$result = GetQuery("select lastmonth_ptkview, reminder from param where lastmonth_ptkview != '' and reminder != ''");
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $LASTMONTH = $row["lastmonth_ptkview"];
    $REMINDER  = $row["reminder"];
}

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{
    $LASTMONTH     = $_POST["LASTMONTH"];
    $REMINDER      = $_POST["REMINDER"];

    UpdateData(
    "param",
    "lastmonth_ptkview = '$LASTMONTH', reminder = '$REMINDER'", 
    "lastmonth_ptkview IS NOT NULL and reminder IS NOT NULL");

    InsertData(
    "users_log",
    "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'', 'Edit Lastmonth PTK view : $LASTMONTH, Reminder : $REMINDER', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Config','Edit'");

    ?><script>alert('Config has been updated! Thank you! ');</script><?php
    ?><script>document.location.href='ptk.php';</script><?php
    die(0);
}

?>
