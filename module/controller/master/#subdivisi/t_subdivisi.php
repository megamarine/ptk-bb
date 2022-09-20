<?php
$options = [
    'cost' => 12,
];

$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_PERSONALIA"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_PERSONALIA"];
$PC_NAME    = $_SESSION["PC_NAME_PERSONALIA"];
$NAMA_USER  = $_SESSION["LOGINNAMAUS_PERSONALIA"];

$PERUSAHAAN    = "";
$DEPARTEMENT   = "";
$DIVISI        = "";
$SUBDIVISI     = "";
$NAMASUBDIVISI = "";
$HEAD          = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];
    $result = GetQuery("select * from m_subdivisi where kode_subdivisi='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $PERUSAHAAN    = $row["kode_perusahaan"];
        $DEPARTEMENT   = $row["kode_departement"];
        $DIVISI        = $row["kode_divisi"];
        $SUBDIVISI     = $row["kode_subdivisi"];
        $NAMASUBDIVISI = $row["nama_subdivisi"];
        $HEAD          = $row["head"];
    }

    if(isset($_POST["simpan"]))
    {
        $PERUSAHAAN    = $_POST["PERUSAHAAN"];
        $DEPARTEMENT   = $_POST["DEPARTEMENT"];
        $DIVISI        = $_POST["DIVISI"];
        $SUBDIVISI     = $_POST["SUBDIVISI"];
        $NAMASUBDIVISI = $_POST["NAMASUBDIVISI"];
        $HEAD          = $_POST["HEAD"];

        UpdateData(
        "m_subdivisi",
        "kode_perusahaan = '$PERUSAHAAN', kode_departement='$DEPARTEMENT', kode_divisi='$DIVISI', kode_subdivisi='$SUBDIVISI', nama_subdivisi = '$NAMASUBDIVISI', head = '$HEAD', modified_date='$DINO', modified_by='$ID_USER1'", 
        "kode_subdivisi = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Sub Divisi - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master Sub Divisi has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_subdivisi.php';</script><?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $PERUSAHAAN    = $_POST["PERUSAHAAN"];
    $DEPARTEMENT   = $_POST["DEPARTEMENT"];
    $DIVISI        = $_POST["DIVISI"];
    $SUBDIVISI     = $_POST["SUBDIVISI"];
    $NAMASUBDIVISI = $_POST["NAMASUBDIVISI"];
    $HEAD          = $_POST["HEAD"];

    //INSERT TO TABLE M_USER
    $result1 = GetQuery(
        "insert into m_subdivisi (kode_perusahaan,kode_departement,kode_divisi,kode_subdivisi, nama_subdivisi, head, created_date, created_by) 
                    values ('$PERUSAHAAN','$DEPARTEMENT','$DIVISI','$SUBDIVISI','$NAMASUBDIVISI','$HEAD', '$DINO', '$ID_USER1')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
    "users_log",
    "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
    "'', 'Tambah Master Sub Divisi - $SUBDIVISI', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Sub Divisi has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_subdivisi';</script><?php
    die(0);
}
?>
