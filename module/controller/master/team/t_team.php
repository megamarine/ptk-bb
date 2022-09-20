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
$NAMATEAM    = "";


//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];
    $result = GetQuery("select * from m_team where kode_team='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $PERUSAHAAN  = $row["kode_perusahaan"];
        $DEPARTEMENT = $row["kode_departement"];
        $DIVISI      = $row["kode_divisi"];
        $SECTION     = $row["kode_section"];
        $SUBSECTION  = $row["kode_subsection"];
        $TEAM        = $row["kode_team"];
        $NAMATEAM    = $row["nama_team"];
    }

    if(isset($_POST["simpan"]))
    {
        $PERUSAHAAN  = $_POST["PERUSAHAAN"];
        $DEPARTEMENT = $_POST["DEPARTEMENT"];
        $DIVISI      = $_POST["DIVISI"];
        $SECTION     = $_POST["SECTION"];
        $SUBSECTION  = $_POST["SUBSECTION"];
        $TEAM        = $_POST["TEAM"];
        $NAMATEAM    = $_POST["NAMATEAM"];

        UpdateData(
        "m_team",
        "kode_perusahaan = '$PERUSAHAAN', kode_departement='$DEPARTEMENT', kode_divisi='$DIVISI', kode_section='$SECTION', kode_subsection='$SUBSECTION', kode_team='$TEAM', nama_team = '$NAMATEAM', modified_date='$DINO', modified_by='$ID_USER1'", 
        "kode_team = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Team - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master Team has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_team.php';</script><?php
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
    $NAMATEAM    = $_POST["NAMATEAM"];

    //INSERT TO TABLE M_USER
    $result1 = GetQuery(
        "insert into m_team (kode_perusahaan, kode_departement, kode_divisi, kode_section, kode_subsection, kode_team, nama_team, created_date, created_by) 
                    values ('$PERUSAHAAN','$DEPARTEMENT','$DIVISI','$SECTION','$SUBSECTION','$TEAM','$NAMATEAM', '$DINO','$ID_USER1')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Team - $TEAM', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Team has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_team';</script><?php
    die(0);
}
?>
