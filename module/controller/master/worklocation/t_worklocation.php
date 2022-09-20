<?php
$options = [
    'cost' => 12,
];

$DINO         = date('Y-m-d H:i:s');
$ID_USER1     = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS   = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME      = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER    = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];

$WORKLOCATION = "";
$CATEGORY     = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE    = $_GET["KODE"];
    $result = GetQuery("select * from m_worklocation where seq='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $WORKLOCATION = $row["nama"];
        $CATEGORY     = $row["worktype_code"];
    }

    if(isset($_POST["simpan"]))
    {
        $WORKLOCATION = $_POST["WORKLOCATION"];
        $CATEGORY     = $_POST["CATEGORY"];

        UpdateData(
        "m_worklocation",
        "nama = '$WORKLOCATION', worktype_code = '$CATEGORY'", 
        "seq = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Work Location - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?><script>alert('Master Work Location has been updated! Thank you! ');</script><?php
        ?><script>document.location.href='m_worklocation.php';</script><?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $WORKLOCATION = $_POST["WORKLOCATION"];
    $CATEGORY     = $_POST["CATEGORY"];

    //INSERT TO TABLE M_WORKLOCATION
    $result1 = GetQuery(
        "insert into m_worklocation (seq,nama,worktype_code) 
                    values ('','$WORKLOCATION','$CATEGORY')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Work Location - $WORKLOCATION', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?><script>alert('Master Work Location has been added! Thank you! ');</script><?php
    ?><script>document.location.href='m_worklocation';</script><?php
    die(0);
}
?>
