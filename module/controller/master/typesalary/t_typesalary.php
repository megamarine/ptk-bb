<?php
$options = [
    'cost' => 12,
];

$DINO            = date('Y-m-d H:i:s');
$ID_USER1        = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS      = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME         = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER       = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];

$TYPESALARY_CODE = "";
$TYPESALARY_NAME = "";
$PLACEMENT_CODE  = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];
    $result = GetQuery("select * from m_typesalary where typesalary_code='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $TYPESALARY_CODE = $row["typesalary_code"];
        $TYPESALARY_NAME = $row["typesalary_name"];
        $PLACEMENT_CODE  = $row["placement_code"];
    }

    if(isset($_POST["simpan"]))
    {
        $TYPESALARY_CODE = $_POST["TYPESALARY_CODE"];
        $TYPESALARY_NAME = $_POST["TYPESALARY_NAME"];
        $PLACEMENT_CODE  = $_POST["PLACEMENT_CODE"];

        UpdateData(
        "m_typesalary",
        "typesalary_code = '$TYPESALARY_CODE', typesalary_name = '$TYPESALARY_NAME', placement_code = '$PLACEMENT_CODE'", 
        "typesalary_code = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Type Salary - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master Type Salary has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_typesalary.php';</script><?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $TYPESALARY_CODE = $_POST["TYPESALARY_CODE"];
    $TYPESALARY_NAME = $_POST["TYPESALARY_NAME"];
    $PLACEMENT_CODE  = $_POST["PLACEMENT_CODE"];

    //INSERT TO TABLE M_TYPESALARY
    $result1 = GetQuery(
        "insert into m_typesalary (typesalary_code,typesalary_name,placement_code) 
                    values ('$TYPESALARY_CODE','$TYPESALARY_NAME','$PLACEMENT_CODE')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Type Salary - $TYPESALARY_CODE', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Type Salary has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_typesalary';</script><?php
    die(0);
}
?>
