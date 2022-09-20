<?php
$options = [
    'cost' => 12,
];

$DINO        = date('Y-m-d H:i:s');
$ID_USER1    = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS  = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME     = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER   = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];

$PERUSAHAAN  = "";
$DEPARTEMENT = "";
$DIVISI      = "";
$NAMADIVISI  = "";
$HEAD        = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];
    $result = GetQuery("select * from m_divisi where kode_divisi='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $PERUSAHAAN  = $row["kode_perusahaan"];
        $DEPARTEMENT = $row["kode_departement"];
        $DIVISI      = $row["kode_divisi"];
        $NAMADIVISI  = $row["nama_divisi"];
        $HEAD        = $row["head"];
    }

    if(isset($_POST["simpan"]))
    {
        $PERUSAHAAN  = $_POST["PERUSAHAAN"];
        $DEPARTEMENT = $_POST["DEPARTEMENT"];
        $DIVISI      = $_POST["DIVISI"];
        $NAMADIVISI  = $_POST["NAMADIVISI"];
        $HEAD            = $_POST["HEAD"];

        UpdateData(
        "m_divisi",
        "kode_perusahaan = '$PERUSAHAAN', kode_departement='$DEPARTEMENT', kode_divisi='$DIVISI', nama_divisi = '$NAMADIVISI', head = '$HEAD', modified_date='$DINO', modified_by='$ID_USER1'", 
        "kode_divisi = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Divisi - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master Divisi has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_divisi.php';</script><?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $PERUSAHAAN  = $_POST["PERUSAHAAN"];
    $DEPARTEMENT = $_POST["DEPARTEMENT"];
    $DIVISI      = $_POST["DIVISI"];
    $NAMADIVISI  = $_POST["NAMADIVISI"];
    $HEAD        = $_POST["HEAD"];

    //INSERT TO TABLE M_USER
    $result1 = GetQuery(
        "insert into m_divisi (kode_perusahaan,kode_departement,kode_divisi,nama_divisi,head,created_date,created_by) 
                    values ('$PERUSAHAAN','$DEPARTEMENT','$DIVISI','$NAMADIVISI','$HEAD','$DINO','$ID_USER1')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Divisi - $DIVISI', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Divisi has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_divisi';</script><?php
    die(0);
}
?>
