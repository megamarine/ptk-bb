<?php
$DINO = date('Y-m-d H:i:s');

if(isset($_POST["login"]))
{
    $USERNAME  = $_POST["username"];
    $PASSWORD  = $_POST["password"];
    $stmt      = GetQuery("select * FROM  m_user WHERE kode_user = '$USERNAME'");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $USER_PASSWORD   = $row["password"];
        $STATUS          = $row["status"];
        $IP_ADDRESS      = getIp();
        $PC_NAME         = gethostbyaddr($IP_ADDRESS);
        $ai_users_log    = kodeAuto("users_log","log_id");

        if ($STATUS == "Aktif" and password_verify($PASSWORD, $USER_PASSWORD))
        { 
            $_SESSION["IP_ADDRESS_PERSONALIA_BB"]   = $IP_ADDRESS;
            $_SESSION["PC_NAME_PERSONALIA_BB"]      = $PC_NAME;
            $_SESSION["LOGINIDUS_PERSONALIA_BB"]    = $row["kode_user"];
            $_SESSION["LOGINNAMAUS_PERSONALIA_BB"]  = $row["nama_user"];
            $_SESSION["LOGINAKS_PERSONALIA_BB"]     = $row["akses"];
            $_SESSION["LOGINDEP_PERSONALIA_BB"]     = $row["kode_departement"];
            $_SESSION["LOGINDIV_PERSONALIA_BB"]     = $row["kode_divisi"];
            $_SESSION["LOGINPTKVIEW_PERSONALIA_BB"] = $row["ptk_view"];
            $NAMA_USER                              = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];
            $ID_USER1                               = $_SESSION["LOGINIDUS_PERSONALIA_BB"];

            InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'$ai_users_log', 'User login', '$IP_ADDRESS', '$ID_USER1', '$DINO', '$ID_USER1', 'Login', 'Login'");
           
            ?><script>document.location.href='menuutama';</script><?php
            die(0);
        }
        else 
        {
            ?><script>alert('Incorrect Password / Access Denied!');</script><?php
            ?><script>document.location.href='.';</script><?php
            die(0);
        } 
    }
    ?><script>alert('User Not Found!');</script><?php
    ?><script>document.location.href='.';</script><?php
    die(0);
}
?>