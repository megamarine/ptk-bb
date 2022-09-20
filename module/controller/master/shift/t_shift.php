<?php
$options = [
    'cost' => 12,
];

$DINO          = date('Y-m-d H:i:s');
$ID_USER1      = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS    = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME       = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER     = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];

$SHIFT_CODE    = "";
$SHIFT_NAME    = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];
    $result = GetQuery("select * from m_shift where shift_code='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $SHIFT_CODE = $row["shift_code"];
        $SHIFT_NAME = $row["shift_name"];
    }

    if(isset($_POST["simpan"]))
    {
        $SHIFT_CODE = $_POST["SHIFT_CODE"];
        $SHIFT_NAME = $_POST["SHIFT_NAME"];

        UpdateData(
        "m_shift",
        "shift_code = '$SHIFT_CODE', shift_name = '$SHIFT_NAME'", 
        "shift_code = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Shift - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master Shift has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_shift.php';</script><?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $SHIFT_CODE = $_POST["SHIFT_CODE"];
    $SHIFT_NAME = $_POST["SHIFT_NAME"];

    //INSERT TO TABLE M_SHIFT
    $result1 = GetQuery(
        "insert into m_shift (shift_code,shift_name) 
                    values ('$SHIFT_CODE','$SHIFT_NAME')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Shift - $SHIFT_CODE', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Shift has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_shift.php';</script><?php
    die(0);
}
?>
