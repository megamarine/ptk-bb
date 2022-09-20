<?php
$options = [
    'cost' => 12,
];

$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME    = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER  = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];

$PERUSAHAAN   = "";
$NAMAPERUSAHAAN   = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];
    $result = GetQuery("select * from m_perusahaan where kode_perusahaan='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $PERUSAHAAN     = $row["kode_perusahaan"];
        $NAMAPERUSAHAAN = $row["nama_perusahaan"];
    }

    if(isset($_POST["simpan"]))
    {
        $PERUSAHAAN     = $_POST["SPERUSAHAAN"];
        $NAMAPERUSAHAAN = $_POST["NAMAPERUSAHAAN"];

        UpdateData(
        "m_perusahaan",
        "kode_perusahaan = '$PERUSAHAAN', nama_perusahaan = '$NAMAPERUSAHAAN', modified_date='$DINO', modified_by='$ID_USER1'", 
        "kode_perusahaan = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Perusahaan - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master Perusahaan has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_perusahaan.php';</script><?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $PERUSAHAAN     = $_POST["PERUSAHAAN"];
    $NAMAPERUSAHAAN = $_POST["NAMAPERUSAHAAN"];

    //INSERT TO TABLE M_USER
    $result1 = GetQuery(
        "insert into m_perusahaan (kode_perusahaan,nama_perusahaan,created_date,created_by) 
                    values ('$PERUSAHAAN','$NAMAPERUSAHAAN','$DINO','$ID_USER1')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Perusahaan - $PERUSAHAAN', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Perusahaan has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_perusahaan';</script><?php
    die(0);
}
?>
