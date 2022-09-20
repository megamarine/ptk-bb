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
$SECTION     = "";
$SUBSECTION  = "";
$TEAM        = "";
$UNIT        = "";
$NAMAUNIT    = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];
    $result = GetQuery("select * from m_unit where kode_unit='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $PERUSAHAAN  = $row["kode_perusahaan"];
        $DEPARTEMENT = $row["kode_departement"];
        $DIVISI      = $row["kode_divisi"];
        $SECTION     = $row["kode_section"];
        $SUBSECTION  = $row["kode_subsection"];
        $TEAM        = $row["kode_team"];
        $UNIT        = $row["kode_unit"];
        $NAMAUNIT    = $row["nama_unit"];
    }

    if(isset($_POST["simpan"]))
    {
        $PERUSAHAAN  = $_POST["PERUSAHAAN"];
        $DEPARTEMENT = $_POST["DEPARTEMENT"];
        $DIVISI      = $_POST["DIVISI"];
        $SECTION     = $_POST["SECTION"];
        $SUBSECTION  = $_POST["SUBSECTION"];
        $TEAM        = $_POST["TEAM"];
        $UNIT        = $_POST["UNIT"];
        $NAMAUNIT    = $_POST["NAMAUNIT"];

        UpdateData(
        "m_unit",
        "kode_perusahaan = '$PERUSAHAAN', kode_departement='$DEPARTEMENT', kode_divisi='$DIVISI', kode_section='$SECTION', kode_subsection='$SUBSECTION', kode_team='$TEAM', kode_unit='$UNIT', nama_unit = '$NAMAUNIT', modified_date='$DINO', modified_by='$ID_USER1'", 
        "kode_unit = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Unit - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master Unit has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_unit.php';</script><?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $PERUSAHAAN  = $_POST["PERUSAHAAN"];
    $DEPARTEMENT = $_POST["DEPARTEMENT"];
    $DIVISI      = $_POST["DIVISI"];
    $SECTION     = $_POST["SECTION"];
    $SUBSECTION  = $_POST["SUBSECTION"];
    $TEAM        = $_POST["TEAM"];
    $UNIT        = $_POST["UNIT"];
    $NAMAUNIT    = $_POST["NAMAUNIT"];

    //INSERT TO TABLE M_USER
    $result1 = GetQuery(
        "insert into m_unit (kode_perusahaan,kode_departement,kode_divisi,kode_section,kode_subsection,kode_team,kode_unit,nama_unit, created_date, created_by) 
                    values ('$PERUSAHAAN','$DEPARTEMENT','$DIVISI','$SECTION','$SUBSECTION','$TEAM','$UNIT','$NAMAUNIT','$DINO','$ID_USER1')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Unit - $UNIT', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Unit has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_unit';</script><?php
    die(0);
}
?>
