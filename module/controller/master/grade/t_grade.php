<?php
$options = [
    'cost' => 12,
];

$DINO            = date('Y-m-d H:i:s');
$ID_USER1        = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS      = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME         = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER       = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];

$KODEGRADE       = "";
$NAMAGRADE       = "";
$GRADEREMARK     = "";
$LEVELCATEGORY   = "";
$WORKEXPCATEGORY = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE   = $_GET["KODE"];
    $result = GetQuery("select * from m_grade where kode_grade='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $KODEGRADE       = $row["kode_grade"];
        $NAMAGRADE       = $row["nama_grade"];
        $GRADEREMARK     = $row["ket_grade"];
        $LEVELCATEGORY   = $row["kode_level"];
        $WORKEXPCATEGORY = $row["workexp_code"];
    }

    if(isset($_POST["simpan"]))
    {
        $KODEGRADE       = $_POST["KODEGRADE"];
        $NAMAGRADE       = $_POST["NAMAGRADE"];
        $GRADEREMARK     = $_POST["GRADEREMARK"];
        $LEVELCATEGORY   = $_POST["LEVELCATEGORY"];
        $WORKEXPCATEGORY = $_POST["WORKEXPCATEGORY"];

        UpdateData(
        "m_grade",
        "kode_grade = '$KODEGRADE', nama_grade = '$NAMAGRADE', ket_grade = '$GRADEREMARK', kode_level = '$LEVELCATEGORY', worktype_code = '$WORKEXPCATEGORY' ", 
        "kode_grade = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit grade - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master grade has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_grade.php';</script><?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $KODEGRADE       = $_POST["KODEGRADE"];
    $NAMAGRADE       = $_POST["NAMAGRADE"];
    $GRADEREMARK     = $_POST["GRADEREMARK"];
    $LEVELCATEGORY   = $_POST["LEVELCATEGORY"];
    $WORKEXPCATEGORY = $_POST["WORKEXPCATEGORY"];

    //INSERT TO TABLE M_GRADE
    $result1 = GetQuery(
        "insert into m_grade (kode_grade,nama_grade,ket_grade,kode_level,workexp_code) 
                    values ('$KODEGRADE','$NAMAGRADE','$GRADEREMARK','$LEVELCATEGORY','$WORKEXPCATEGORY')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Grade - $KODEGRADE', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Grade has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_grade';</script><?php
    die(0);
}
?>
