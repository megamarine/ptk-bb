<?php
require_once("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_PERSONALIA_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

$DINO = date('Y-m-d H:i:s');

if(isset($_POST["seq"]))
{
    $DATE          = date("Y-m-d");
    $seq           = $_POST["seq"];
    $app_reject    = $_POST["app_reject"];
    $reject_remark = $_POST["reject_remark"];
    $ID_USER1      = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
    $NAMA_USER     = $_SESSION["LOGINNAMAUS_PERSONALIA_BB"];
    $IP_ADDRESS    = $_SESSION["IP_ADDRESS_PERSONALIA_BB"];

    if ($app_reject == "mgr")
    {
        $result = $db1->prepare("update t_ptk set app_mgr = '2', app_mgr_date = '$DATE', reject_remark = '$reject_remark', status_approval = '2'
                                 where seq = '$seq'");
        $result->execute();
        $mail_subject = "PTK Online - Manager Rejection for " . $seq;
        $app_status   = "Rejected";
        $ket          = "Approval Manager";
    }
    else if($app_reject == "dir")
    {
        $result = $db1->prepare("update t_ptk set app_dir = '2', app_dir_date = '$DATE', reject_remark = '$reject_remark', status_approval = '2'
                                 where seq = '$seq'");
        $result->execute();
        $mail_subject = "PTK Online - Director Rejection for " . $seq;
        $app_status   = "Rejected";
        $ket          = "Approval Director";        
    }
    else if($app_reject == "hrd")
    {
        $result = $db1->prepare("update t_ptk set app_hrd = '2', app_hrd_date = '$DATE', reject_remark = '$reject_remark', status_approval = '2'
                                 where seq = '$seq'");
        $result->execute();
        $mail_subject = "PTK Online - HRD Manager Rejection for " . $seq;
        $app_status   = "Rejected";
        $ket          = "Approval HRD";
    }
    else if($app_reject == "md")
    {
        $result = $db1->prepare("update t_ptk set app_md = '2', app_md_date = '$DATE', reject_remark = '$reject_remark', status_approval = '2'
                                 where seq = '$seq'");
        $result->execute();
        $mail_subject = "PTK Online - Managing Director Rejection for " . $seq;
        $app_status   = "Rejected";
        $ket          = "Approval MD";
    }

    InsertData(
            "users_log",
            "log_id, description, ip_adress, user_id, created_date, created_by, module, trans_type",
            "'', '$app_status - $seq', '$IP_ADDRESS','$ID_USER1','$DINO','$ID_USER1','PTK','$ket'");

    ?><script>document.location.href='ptk';</script><?php
    die(0);
}
?>