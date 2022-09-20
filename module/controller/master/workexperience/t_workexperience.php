<?php
$options = [
    'cost' => 12,
];

$DINO         = date('Y-m-d H:i:s');
$ID_USER1     = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS   = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME      = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER    = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];

$WORKEXP_CODE = "";
$WORKEXP_NAME = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];
    $result = GetQuery("select * from m_workexperience where workexp_code='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $WORKEXP_CODE = $row["workexp_code"];
        $WORKEXP_NAME = $row["workexp_name"];
    }

    if(isset($_POST["simpan"]))
    {
        $WORKEXP_CODE = $_POST["WORKEXP_CODE"];
        $WORKEXP_NAME     = $_POST["WORKEXP_NAME"];

        UpdateData(
        "m_workexperience",
        "workexp_code = '$WORKEXP_CODE', workexp_name = '$WORKEXP_NAME'", 
        "workexp_code = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Work Experience - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master Work Experience has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_workexperience.php';</script><?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $WORKEXP_CODE = $_POST["WORKEXP_CODE"];
    $WORKEXP_NAME = $_POST["WORKEXP_NAME"];

    //INSERT TO TABLE M_WORKEXPERIENCE
    $result1 = GetQuery(
        "insert into m_workexperience (workexp_code,workexp_name) 
                    values ('$WORKEXP_CODE','$WORKEXP_NAME')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Work Experience - $WORKEXP_CODE', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Work Experience has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_workexperience';</script><?php
    die(0);
}
?>
