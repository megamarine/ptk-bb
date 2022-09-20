<?php
$options = [
    'cost' => 12,
];

$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME    = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER  = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];

$KODELEVEL  = "";
$NAMALEVEL  = "";
$LEVELNUM   = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];
    $result = GetQuery("select * from m_level where kode_level='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $KODELEVEL = $row["kode_level"];
        $NAMALEVEL = $row["nama_level"];
        $LEVELNUM  = $row["no_level"];
    }

    if(isset($_POST["simpan"]))
    {
        $KODELEVEL = $_POST["KODELEVEL"];
        $NAMALEVEL = $_POST["NAMALEVEL"];
        $LEVELNUM  = $_POST["LEVELNUM"];

        UpdateData(
        "m_level",
        "kode_level = '$KODELEVEL', nama_level = '$NAMALEVEL', no_level = '$LEVELNUM'", 
        "kode_level = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Level - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master Level has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_level.php';</script><?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $KODELEVEL = $_POST["KODELEVEL"];
    $NAMALEVEL = $_POST["NAMALEVEL"];
    $LEVELNUM  = $_POST["LEVELNUM"];

    //INSERT TO TABLE M_LEVEL
    $result1 = GetQuery(
        "insert into m_level (kode_level,nama_level,no_level) 
                    values ('$KODELEVEL','$NAMALEVEL','$LEVELNUM')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Level - $KODELEVEL', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Level has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_level';</script><?php
    die(0);
}
?>
