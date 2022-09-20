<?php
$KODE_USER   = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$ptk_view    = $_SESSION["LOGINPTKVIEW_PERSONALIA_BB"];
$dept        = $_SESSION["LOGINDEP_PERSONALIA_BB"];
$div         = $_SESSION["LOGINDIV_PERSONALIA_BB"];
$akses       = $_SESSION["LOGINAKS_PERSONALIA_BB"];

//last month PTK view
$query_LM = getQuery("select lastmonth_ptkview from param where lastmonth_ptkview != ''");
while ($row_LM = $query_LM->fetch(PDO::FETCH_ASSOC)) 
{
    $LM = $row_LM["lastmonth_ptkview"];
}

//MODULE------------------------------------------------------------------------------------------------------------------
$query1      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '1' and xread = '1'");
$cek_muser   = $query1->rowCount();

$query2      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '2' and xread = '1'");
$cek_mgrade  = $query2->rowCount();

$query3      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '3' and xread = '1'");
$cek_mper    = $query3->rowCount();

$query4      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '4' and xread = '1'");
$cek_mdep    = $query4->rowCount();

$query5      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '5' and xread = '1'");
$cek_mdiv    = $query5->rowCount();

// $query6      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '6' and xread = '1'");
// $cek_msubdiv = $query6->rowCount();

$query7      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '7' and xread = '1'");
$cek_msec    = $query7->rowCount();

$query8      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '8' and xread = '1'");
$cek_msubsec = $query8->rowCount();

$query9      = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '9' and xread = '1'");
$cek_mteam   = $query9->rowCount();

$query10     = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '10' and xread = '1'");
$cek_munit   = $query10->rowCount();

$query12     = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '12' and xread = '1'");
$cek_mlev    = $query12->rowCount();

$query13     = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '13' and xread = '1'");
$cek_ptk     = $query13->rowCount();

$query19     = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '19' and xcreate = '1'");
$cek_lap     = $query19->rowCount();

$query20     = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '20' and xread = '1'");
$cek_mwl     = $query20->rowCount();

$query21     = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '21' and xread = '1'");
$cek_mwe     = $query21->rowCount();

$query22     = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '22' and xread = '1'");
$cek_mjk     = $query22->rowCount();

$query23     = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '23' and xread = '1'");
$cek_plc     = $query23->rowCount();

$query24     = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '24' and xread = '1'");
$cek_ts      = $query24->rowCount();

$query25     = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '25' and xread = '1'");
$cek_shf     = $query25->rowCount();
// --------------------------------------------------------------------------------------------------------------------------

if($ptk_view == "All")
{
    $where_clause = "";
}
else if($ptk_view == "Departement")
{
    $where_clause = "and a.kode_departement = '$dept'";
}
else
{
    $where_clause = "and a.kode_divisi = '$div'";   
}

//filter akses approval MGR
$query_mgr       = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '14' and xcreate = '1'");
$akses_app_mgr   = $query_mgr->rowCount();

//filter akses approval DIR
$query_dir       = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '15' and xcreate = '1'");
$akses_app_dir   = $query_dir->rowCount();

//filter akses approval HRD
$query_hrd       = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '16' and xcreate = '1'");
$akses_app_hrd   = $query_hrd->rowCount();

//filter akses approval MD
$query_md        = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '17' and xcreate = '1'");
$akses_app_md    = $query_md->rowCount();

//filter akses pemenuhan PTK
$query_pemenuhan = getQuery("select * from m_usermodule where kode_user = '$KODE_USER' and id_module = '18' and xcreate = '1'");
$akses_pemenuhan = $query_pemenuhan->rowCount();

//count ptk yang harus diapprove
$count  = 0;
$result = getQuery("select  a.*,
                            b.head as head_dept,
                            c.head as head_div
                       from t_ptk a
                  LEFT JOIN m_departement b ON a.kode_departement = b.kode_departement
                  LEFT JOIN m_divisi c ON a.kode_divisi = c.kode_divisi
                  where status_hapus = '0' and
                  TIMESTAMPDIFF(MONTH, a.date_ptk, NOW()) <= '$LM'
                  $where_clause
                  order by a.created_date desc");

while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
    if($row["app_mgr"] == 0 and $row["status_approval"] == 0 and (($akses_app_mgr == 1 and $row["head_div"] == $KODE_USER) or $akses == "Administrator"))
    {
        $count++;
    }    
// 
    if($row["app_mgr"] == 1 and $row["app_dir"] == 0 and $row["status_approval"] == 0 and (($akses_app_dir == 1 and $row["head_dept"] == $KODE_USER) or $akses == "Administrator"))
    {
        $count++;
    }
//
    if($row["app_dir"] == 1 and $row["app_hrd"] == 0 and $row["status_approval"] == 0 and ($akses_app_hrd == 1 or $akses == "Administrator"))
    {
        $count++;
    }    
// 
    if($row["app_hrd"] == 1 and $row["app_md"] == 0 and $row["status_approval"] == 0 and ($akses_app_md== 1 or $akses == "Administrator"))
    {
        $count++;
    }
//
    if( $row["status_approval"] == 1 and ($row["qty_accepted"]<$row["qty_submition"]) and ($akses_pemenuhan==1 or $akses == "Administrator")) 
    {
        $count++;
    }
}
// --------------------------------------------------------------------------------------------------------------------------
?>

<aside class="sidebar sidebar-left sidebar-menu">
    <section class="content slimscroll">
        <ul class="topmenu topmenu-responsive" data-toggle="menu">

            <!-- DASHBOARD -->
            <li>
                <a href="menuutama" data-target="#dashboard" data-parent=".topmenu">
                    <span class="figure"><i class="ico-home fa-lg"></i></span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            
            <!-- MASTER -->
            <?php
            if($cek_muser==1 || $cek_mper==1 || $cek_mdep==1 || $cek_mdiv==1 || $cek_msec==1 || $cek_msubsec==1 || $cek_mteam==1 || $cek_munit==1 || $cek_mlev==1 || $cek_mwl==1 || $cek_mwe==1 || $cek_mjk==1 || $cek_plc==1 || $cek_ts==1)
            { ?>

                <li>
                    <a href="javascript:void(0);" data-toggle="submenu" data-target="#layout" data-parent=".topmenu">
                        <span class="figure"><i class="ico-grid"></i></span>
                        <span class="text">Master</span>
                        <span class="arrow"></span>
                    </a>
                    <ul id="layout" class="submenu collapse ">
                        <li class="submenu-header ellipsis">Master</li>

                        <?php
                        if($cek_muser == 1)
                        { ?>
                        <li>
                            <a href="m_user">
                                <span class="text"><i class="fas fa-user"></i> User</span>
                            </a>
                        </li>
                        <?php } ?>

                        <!-- <li>
                            <a href="m_jeniskaryawan">
                                <span class="text"><i class="fas fa-user-tie"></i> Jenis Karyawan</span>
                            </a>
                        </li> -->

                        <?php
                        if($cek_mper == 1)
                        { ?>
                        <li>
                            <a href="m_perusahaan">
                                <span class="text"><i class="fas fa-building"></i> Company</span>
                            </a>
                        </li>
                        <?php } ?>

                        <?php
                        if($cek_mdep == 1)
                        { ?>
                        <li>
                            <a href="m_departement">
                                <span class="text"><i class="fas fa-sitemap"></i> Department</span>
                            </a>
                        </li>
                        <?php } ?>

                        <?php
                        if($cek_mdiv == 1)
                        { ?>
                        <li>
                            <a href="m_divisi">
                                <span class="text"><i class="fas fa-landmark"></i> Division</span>
                            </a>
                        </li>
                        <?php } ?>

                        <!-- <?php
                        if($cek_msubdiv == 1)
                        { ?>
                        <li>
                            <a href="m_subdivisi">
                                <span class="text"><i class="fas fa-university"></i> Sub Divisi</span>
                            </a>
                        </li>
                        <?php } ?> -->

                        <?php
                        if($cek_msec == 1)
                        { ?>
                        <li>
                            <a href="m_section">
                                <span class="text"><i class="fas fa-chart-pie"></i> Section</span>
                            </a>
                        </li>
                        <?php } ?>

                        <?php
                        if($cek_msubsec == 1)
                        { ?>
                        <li>
                            <a href="m_subsection">
                                <span class="text"><i class="fas fa-pizza-slice"></i> Sub Section</span>
                            </a>
                        </li>
                        <?php } ?>

                        <?php
                        if($cek_mteam == 1)
                        { ?>
                        <li>
                            <a href="m_team">
                                <span class="text"><i class="fas fa-users"></i> Team</span>
                            </a>
                        </li>
                        <?php } ?>

                        <?php
                        if($cek_munit == 1)
                        { ?>
                        <li>
                            <a href="m_unit">
                                <span class="text"><i class="fas fa-user-circle"></i> Unit</span>
                            </a>
                        </li>
                        <?php } ?>

                        <?php
                        if($cek_mlev == 1)
                        { ?>
                        <li>
                            <a href="m_level">
                                <span class="text"><i class="fas fa-chart-line"></i> Level</span>
                            </a>
                        </li>
                        <?php } ?>
                        
                        <?php
                        if($cek_mgrade == 1)
                        { ?>
                        <li>
                            <a href="m_grade">
                                <span class="text"><i class="fas fa-external-link-alt"></i> Grade</span>
                            </a>
                        </li>
                        <?php } ?>


                        <?php
                        if($cek_mwl == 1)
                        { ?>
                        <li>
                            <a href="m_worklocation">
                                <span class="text"><i class="fas fa-map-marked-alt"></i> Work Location</span>
                            </a>
                        </li>
                        <?php } ?>

                        <?php
                        if($cek_mwe == 1)
                        { ?>
                        <li>
                            <a href="m_workexperience">
                                <span class="text"><i class="fas fa-briefcase"></i> Work Experience</span>
                            </a>
                        </li>
                        <?php } ?>

                        <!-- <?php
                        if($cek_shf == 1)
                        { ?>
                        <li>
                            <a href="m_shift">
                                <span class="text"><i class="fas fa-exchange-alt"></i> Shift</span>
                            </a>
                        </li>
                        <?php } ?> -->

                        <?php
                        if($cek_mjk == 1)
                        { ?>
                        <li>
                            <a href="m_jamkerja">
                                <span class="text"><i class="fas fa-clock"></i> Jam Kerja</span>
                            </a>
                        </li>
                        <?php } ?>

                        <?php
                        if($cek_plc == 1)
                        { ?>
                        <li>
                            <a href="m_placement">
                                <span class="text"><i class="fas fa-thumbtack"></i> Placement</span>
                            </a>
                        </li>
                        <?php } ?>

                        <?php
                        if($cek_ts == 1)
                        { ?>
                        <li>
                            <a href="m_typesalary">
                                <span class="text"><i class="fas fa-file-invoice-dollar"></i> Type Salary</span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php 
            } ?>

            <!-- PTK -->
            <?php
            if($cek_ptk == 1)
            { ?>
                <li>
                    <a href="ptk" data-target="#chart" data-parent=".topmenu">
                        <span class="figure"><i class="fas fa-hand-holding-medical fa-lg"></i></span>
                        <span class="text">PTK</span>
                        <span class="number"><span class="label label-danger"><?=$count; ?></span></span>
                    </a>
                </li>
            <?php } ?>

            <!-- LAPORAN -->
            <?php
            if($cek_lap == 1)
            { ?>
                <li>
                    <a href="javascript:void(0);" data-target="#laporan" data-toggle="submenu" data-parent=".topmenu">
                        <span class="figure"><i class="fas fa-book fa-lg"></i></span>
                        <span class="text">Report</span>
                        <span class="arrow"></span>
                    </a>
                    <ul id="laporan" class="submenu collapse ">
                        <li class="submenu-header ellipsis">Report</li>
                        <?php
                        if($cek_lap == 1)
                        { ?>
                            <li>
                                <a href="laporan_ptk">
                                    <span class="text">Report PTK</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
		</ul>
    </section>
</aside>