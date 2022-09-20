<?php
$options = [
    'cost' => 12,
];

$DINO           = date('Y-m-d H:i:s');
$ID_USER1       = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS     = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME        = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER      = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];

$PERUSAHAAN     = "";
$DEPARTEMENT    = "";
$DIVISI         = "";
$SECTION        = "";
$SUBSECTION     = "";
$NAMASUBSECTION = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];
    $result = GetQuery("select * from m_subsection where kode_subsection='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $PERUSAHAAN     = $row["kode_perusahaan"];
        $DEPARTEMENT    = $row["kode_departement"];
        $DIVISI         = $row["kode_divisi"];
        $SECTION        = $row["kode_section"];
        $SUBSECTION     = $row["kode_subsection"];
        $NAMASUBSECTION = $row["nama_subsection"];
    }

    if(isset($_POST["simpan"]))
    {
        $PERUSAHAAN     = $_POST["PERUSAHAAN"];
        $DEPARTEMENT    = $_POST["DEPARTEMENT"];
        $DIVISI         = $_POST["DIVISI"];
        $SECTION        = $_POST["SECTION"];
        $SUBSECTION     = $_POST["SUBSECTION"];
        $NAMASUBSECTION = $_POST["NAMASUBSECTION"];

        UpdateData(
        "m_subsection",
        "kode_perusahaan = '$PERUSAHAAN', kode_departement='$DEPARTEMENT', kode_divisi='$DIVISI', kode_section='$SECTION', kode_subsection='$SUBSECTION', nama_subsection = '$NAMASUBSECTION', modified_date='$DINO', modified_by='$ID_USER1'", 
        "kode_subsection = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Sub Section - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master Sub Section has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_subsection.php';</script><?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $PERUSAHAAN     = $_POST["PERUSAHAAN"];
    $DEPARTEMENT    = $_POST["DEPARTEMENT"];
    $DIVISI         = $_POST["DIVISI"];
    $SECTION        = $_POST["SECTION"];
    $SUBSECTION     = $_POST["SUBSECTION"];
    $NAMASUBSECTION = $_POST["NAMASUBSECTION"];

    //INSERT TO TABLE M_SUBSECTION
    $result1 = GetQuery(
        "insert into m_subsection (kode_perusahaan, kode_departement, kode_divisi, kode_section, kode_subsection, nama_subsection, created_date, created_by) 
                    values ('$PERUSAHAAN','$DEPARTEMENT','$DIVISI','$SECTION','$SUBSECTION','$NAMASUBSECTION','$DINO', '$ID_USER1')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Sub Section - $SUBSECTION', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Sub Section has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_subsection';</script><?php
    die(0);
}
?>
