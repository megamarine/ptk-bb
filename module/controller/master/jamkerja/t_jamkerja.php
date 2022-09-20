<?php
$options = [
    'cost' => 12,
];

$DINO          = date('Y-m-d H:i:s');
$ID_USER1      = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS    = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME       = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER     = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];

$JAMKERJA_CODE = "";
$JAMKERJA_NAME = "";
$WORK_LOCATION = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];
    $result = GetQuery("select * from m_jamkerja where jamkerja_code='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $JAMKERJA_CODE = $row["jamkerja_code"];
        $JAMKERJA_NAME = $row["jamkerja_name"];
        $WORK_LOCATION = $row["work_location"];
    }

    if(isset($_POST["simpan"]))
    {
        $JAMKERJA_CODE = $_POST["JAMKERJA_CODE"];
        $JAMKERJA_NAME = $_POST["JAMKERJA_NAME"];
        $WORK_LOCATION = $_POST["WORK_LOCATION"];

        UpdateData(
        "m_jamkerja",
        "jamkerja_code = '$JAMKERJA_CODE', jamkerja_name = '$JAMKERJA_NAME', work_location = '$WORK_LOCATION'", 
        "jamkerja_code = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Jam Kerja - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master Jam Kerja has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_jamkerja.php';</script><?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $JAMKERJA_CODE = $_POST["JAMKERJA_CODE"];
    $JAMKERJA_NAME = $_POST["JAMKERJA_NAME"];
    $WORK_LOCATION = $_POST["WORK_LOCATION"];

    //INSERT TO TABLE M_JAMKERJA
    $result1 = GetQuery(
        "insert into m_jamkerja (jamkerja_code,jamkerja_name,work_location) 
                    values ('$JAMKERJA_CODE','$JAMKERJA_NAME','$WORK_LOCATION')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Jam Kerja - $JAMKERJA_CODE', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Jam Kerja has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_jamkerja';</script><?php
    die(0);
}
?>
