<?php
$options = [
    'cost' => 12,
];

$DINO            = date('Y-m-d H:i:s');
$ID_USER1        = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS      = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME         = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER       = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];

$PERUSAHAAN      = "";
$DEPARTEMENT     = "";
$NAMADEPARTEMENT = "";
$HEAD            = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];
    $result = GetQuery("select * from m_departement where kode_departement='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $PERUSAHAAN      = $row["kode_perusahaan"];
        $DEPARTEMENT     = $row["kode_departement"];
        $NAMADEPARTEMENT = $row["nama_departement"];
        $HEAD            = $row["head"];
    }

    if(isset($_POST["simpan"]))
    {
        $PERUSAHAAN      = $_POST["PERUSAHAAN"];
        $DEPARTEMENT     = $_POST["DEPARTEMENT"];
        $NAMADEPARTEMENT = $_POST["NAMADEPARTEMENT"];
        $HEAD            = $_POST["HEAD"];

        UpdateData(
        "m_departement",
        "kode_perusahaan = '$PERUSAHAAN', kode_departement='$DEPARTEMENT', nama_departement = '$NAMADEPARTEMENT', head = '$HEAD', modified_date='$DINO', modified_by='$NAMA_USER'", 
        "kode_departement = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Departement - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master Departement has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_departement.php';</script><?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $PERUSAHAAN      = $_POST["PERUSAHAAN"];
    $DEPARTEMENT     = $_POST["DEPARTEMENT"];
    $NAMADEPARTEMENT = $_POST["NAMADEPARTEMENT"];
    $HEAD            = $_POST["HEAD"];

    //INSERT TO TABLE M_USER
    $result1 = GetQuery(
        "insert into m_departement (kode_perusahaan,kode_departement,nama_departement,head,created_date,created_by) 
                    values ('$PERUSAHAAN','$DEPARTEMENT','$NAMADEPARTEMENT','$HEAD','$DINO','$ID_USER1')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Departement - $DEPARTEMENT', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Departement has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_departement';</script><?php
    die(0);
}
?>
