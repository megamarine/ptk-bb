<?php
require_once ("module/model/koneksi/koneksi.php");

if(!isset($_SESSION["LOGINIDUS_PERSONALIA_BB"]))
{
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

$KODE_USER  = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$query      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '24' and xcreate = '1'");
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
    </head>
    <body>
        <header id="header" class="navbar">
            <?php include "module/model/header/header.php"; ?>
        </header>
        <?php include "module/model/sidebar/sidebar.php"; ?>
        <section id="main" role="main">
            <div class="container-fluid">
                <?php include "module/view/master/typesalary/v_tambahtypesalary.php"; ?>
            </div>
            <a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
        </section>
        <?php include "module/model/footer/footer.php"; ?>
        <script type="text/javascript" src="assets/javascript/vendor.js"></script>
        <script type="text/javascript" src="assets/javascript/core.js"></script>
        <script type="text/javascript" src="assets/javascript/backend/app.js"></script>
        <script type="text/javascript" src="assets/javascript/pace.min.js"></script>
        <script type="text/javascript" src="assets/plugins/datatables/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="assets/plugins/datatables/tabletools/js/dataTables.tableTools.js"></script>
        <script type="text/javascript" src="assets/plugins/datatables/js/datatables-bs3.js"></script>
        <script type="text/javascript" src="assets/javascript/backend/tables/datatable.js"></script>
    </body>
</html>
