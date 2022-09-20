<?php
require_once("module/model/koneksi/koneksi.php");
require 'assets/phpmailer/PHPMailerAutoload.php';


if(isset($_GET["seq"])) {
    // Fetch Row DB
    $seq = $_GET["seq"];
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

    $mail->setFrom('no-reply@megamarinepride.com','PTK Closed');
    
    $mail->Subject = "PTK ".$seq." Closed";
    $message = file_get_contents("mail_template.html");
    if (isset($row['nama_user'])){
        $message = str_replace('%username%', $row['nama_user'], $message);
        $mail->addAddress("emhusni77@gmail.com");
    }
    $message = str_replace('%ptk_name%', $seq, $message);
    $link = "http://192.168.10.167/mmp/personalia/edit_ptk?seq=".$seq;
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
?>