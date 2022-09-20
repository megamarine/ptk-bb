<?php
require_once ("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_PERSONALIA_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

$KODE_USER  = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$query      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '13' and xupdate = '1'");
$cek = $query->rowCount();
if($cek == 0)
{
    ?> 
        <script>alert("Access Denied");window.history.back();</script>
    <?php
}

?>

<!DOCTYPE html>
<html class="backend">
    <head>
        <?php include "module/model/head/head.php"; ?>
        <link rel="stylesheet" href="assets/stylesheet/bootstrap.min.css">
    </head>
    <body onload="itFas_komputer();cekJumlah()">
        <header id="header" class="navbar">
            <?php include "module/model/header/header.php"; ?>
        </header>
        <?php include "module/model/sidebar/sidebar.php"; ?>
        <section id="main" role="main">
            <div class="container-fluid">
                <?php include "module/view/ptk/v_editptk.php"; ?>
            </div>
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
        </section>
        <?php include "module/model/footer/footer.php"; ?>
        
        <script type="text/javascript" src="assets/javascript/vendor.js"></script>
        <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
        <script type="text/javascript" src="assets/plugins/select2/js/select2.min.js"></script>
        <script type="text/javascript" src="assets/javascript/core.js"></script>
        <script type="text/javascript" src="assets/javascript/backend/app.js"></script>
		<script type="text/javascript" src="assets/javascript/pace.min.js"></script>
        <script type="text/javascript" src="assets/plugins/selectize/js/selectize.js"></script>
        <script type="text/javascript" src="assets/plugins/jquery-ui/js/jquery-ui.js"></script>
        <script type="text/javascript" src="assets/plugins/jquery-ui/js/addon/timepicker/jquery-ui-timepicker.js"></script>
        <script type="text/javascript" src="assets/javascript/pace.min.js"></script>
        <script type="text/javascript" src="assets/plugins/selectize/js/selectize.js"></script>
        <script type="text/javascript" src="assets/plugins/parsley/js/parsley.js"></script>
    </body>
</html>
