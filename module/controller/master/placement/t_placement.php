<?php
$options = [
    'cost' => 12,
];

$DINO           = date('Y-m-d H:i:s');
$ID_USER1       = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME        = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER      = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];

$PLACEMENT_CODE = "";
$PLACEMENT_NAME = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];
    $result = GetQuery("select * from m_placement where placement_code='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $PLACEMENT_CODE = $row["placement_code"];
        $PLACEMENT_NAME = $row["placement_name"];
    }

    if(isset($_POST["simpan"]))
    {
        $PLACEMENT_CODE = $_POST["PLACEMENT_CODE"];
        $PLACEMENT_NAME = $_POST["PLACEMENT_NAME"];

        UpdateData(
        "m_placement",
        "placement_code = '$PLACEMENT_CODE', placement_name = '$PLACEMENT_NAME'", 
        "placement_code = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Placement - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master Placement has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_placement.php';</script><?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $PLACEMENT_CODE = $_POST["PLACEMENT_CODE"];
    $PLACEMENT_NAME = $_POST["PLACEMENT_NAME"];

    //INSERT TO TABLE M_PLACEMENT
    $result1 = GetQuery(
        "insert into m_placement (placement_code,placement_name) 
                    values ('$PLACEMENT_CODE','$PLACEMENT_NAME')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Placement - $PLACEMENT_CODE', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Placement has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_placement';</script><?php
    die(0);
}
?>
