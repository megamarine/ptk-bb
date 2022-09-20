<?php

$DINO       = date('Y-m-d H:i:s');
$ID_USER1   = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$IP_ADDRESS = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
$PC_NAME    = $_SESSION["PC_NAME_PERSONALIA_BB"];
$NAMA_USER  = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];
$KODE       = createKode("m_jeniskaryawan","kode_jenis","KJK",2);

$NAMA_JENIS = "";

//EDIT /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET["KODE"]))
{
    $KODE   = $_GET["KODE"];
    $result = GetQuery("select * from m_jeniskaryawan where kode_jenis='$KODE'");

    while ($row = $result->fetch(PDO::FETCH_ASSOC))  
    {
        $NAMA_JENIS  = $row["nama_jenis"];
    }

    if(isset($_POST["simpan"]))
    {
        $NAMA_JENIS = $_POST["NAMA_JENIS"];

        UpdateData(
        "m_jeniskaryawan",
        "nama_jenis='$NAMA_JENIS'", 
        "kode_jenis = '$KODE'");

        InsertData(
        "users_log",
        "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
        "'', 'Edit Jenis Karyawan - $KODE', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','Master','Edit'");

        ?>
        <script>alert('Data has been updated! Thank you! ');</script>
        <script>document.location.href='m_jeniskaryawan.php';</script>
        <?php
        die(0);
    }
}

//TAMBAH /////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST["simpan"]))
{    
    $NAMA_JENIS = $_POST["NAMA_JENIS"];

    //INSERT TO TABLE
    $result1 = GetQuery(
        "insert into m_jeniskaryawan (kode_jenis,nama_jenis) 
                    values ('$KODE','$NAMA_JENIS')");

    // INSERT TO TABLE USERS_LOG
    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Tambah Master Jenis Karyawan - $KODE', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Master', 'Tambah'");

    ?>
    <script>alert('Data has been added! Thank you! ');</script>
    <script>document.location.href='m_jeniskaryawan';</script>
    <?php
    die(0);
}
?>
