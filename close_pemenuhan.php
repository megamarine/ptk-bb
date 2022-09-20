<?php
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_PERSONALIA_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

$DINO = date('Y-m-d H:i:s');

if(isset($_GET["seq"]))
{
    $DINO          = date('Y-m-d H:i:s');
    $ID_USER1      = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
    $IP_ADDRESS    = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];
    $seq           = $_GET["seq"];
    
    $result = $db1->prepare("select qty_left from t_ptk where seq = '$seq'");
    $result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        $qty_left  = $row["qty_left"];
    }

    //jika ptk belum complete
    if($qty_left != 0)
    {
        echo "<script type='text/javascript'>alert('PTK Belum Complete! Silahkan melakukan pemenuhan terlebih dahulu');</script>";
        ?><script>document.location.href='ptk';</script><?php
        die(0);
    }
    //jika sudah complete
    else
    {
        $query = UpdateData("t_ptk","complete_date='$DINO',complete_by='$ID_USER1'","seq='$seq'");

        //jika berhasil update
        if($query)
        {
            InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', 'Complete PTK - $seq', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','PTK','Close PTK'");
            
            echo "<script type='text/javascript'>alert('PTK Has been closed! Thank you!');</script>";
            ?><script>document.location.href='ptk';</script><?php
            die(0);
        }
        //jika gagal
        else
        {
            echo "<script type='text/javascript'>alert('Error! Try again!');</script>";
            ?><script>document.location.href='ptk';</script><?php
            die(0);
        }

        // Fetch Row DB
        $querymd = $db1->prepare("
        select 
            mu.nama_user,
            mu.email 
            from t_ptk_history tph
            inner join m_user mu on mu.kode_user  = tph.created_by 
        where 
            tph.seq = '$seq'
        order by 
            tph.created_date 
        limit 1");
        $querymd->execute();
        $row = $querymd->fetch();

        // send Mail
        $mail = new PHPMailer;
        $mail->isSendmail();
        set_time_limit(120);
        
        $mail->setFrom('no-reply@baramudabahari.com','PTK Closed');
        $mail->addAddress("generalhrm@baramudabahari.com");
        $mail->addCC("recruitment@baramudabahari.com");
        $mail->Subject = "PTK ".$seq." Closed";
        $message = file_get_contents("mail_template.html");
        if (isset($row['nama_user'])){
            $message = str_replace('%username%', "Username", $message);
            $mail->addAddress($row['email']);
            $mail->addCC("generalhrm@baramudabahari.com");
            $mail->addCC("recruitment@baramudabahari.com");
        }
        $message = str_replace('%ptk_name%', $seq, $message);
        $link = "http://192.168.10.167/bb/personalia/edit_ptk?seq=".$seq;
        $message = str_replace('%link%', $link, $message);
        $mail->MsgHTML($message);

        if($mail->send())
        {
            echo "Message has been";
            ?><script>document.location.href='ptk';</script><?php
        }
        else
        {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }
}
?>
