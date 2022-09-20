<?php
$PERIODE      = date("Y-m-01");
$PERIODE2     = date("Y-m-d");
$ID_USER1     = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$dept         = $_SESSION["LOGINDEP_PERSONALIA_BB"];
$div          = $_SESSION["LOGINDIV_PERSONALIA_BB"];
$akses        = $_SESSION["LOGINAKS_PERSONALIA_BB"];
$ptk_view     = $_SESSION["LOGINPTKVIEW_PERSONALIA_BB"];
$where_clause = "";

//filter akses ptk view
if($ptk_view == "All")
{
    $where_clause = "";
}
else if($ptk_view == "Departement")
{
    $where_clause = "and b.kode_departement = '$dept'";
}
else
{
    $where_clause = "and b.kode_divisi = '$div'";
}
// ----------------------------------------------------------------------------------------------------------

if (isset($_POST["cari"]))
{
    $PERIODE    = $_POST["PERIODE"];
    $PERIODE2   = $_POST["PERIODE2"];
}
?>
<!-- FILTER ----------------------------------------------------------------------------------->

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="ico-book3"></i> Report PTK</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="ico-book3"></i> Report PTK</li>
            </ol>
        </div>
    </div>
</div>

<form role="form" action="" method="post">
    <div class="row" align="left">
        <div class="col-md-2">
        </div>
        <div class="col-md-10">
            <label for="PERIODE">Input Period PTK :</label>
        </div>
    </div>
    <div class="row" align="center">
        <div class="col-md-2">
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="date" class="form-control" name="PERIODE" id="PERIODE" value="<?php echo $PERIODE; ?>" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="date" class="form-control" name="PERIODE2" id="PERIODE2" value="<?php echo $PERIODE2; ?>" />
            </div>
        </div>
        <div class="col-md-3" align="left">
            <div class="form-group">
                <div class="btn-group" style="margin-bottom:5px;">
                    <button type="submit" name="cari" class="btn btn-primary"><i class="fa fa-search-plus fa-lg"></i> Search</button>
                </div>
                <div class="btn-group" style="margin-bottom:5px;">
                    <a href="laporan_ptk" type="button" class="btn btn-danger"><i class="fas fa-sync"></i> Clear</a>
                </div>
                <div class="btn-group" style="margin-bottom:px;">
                    <button type="button" class="btn btn-warning mb5 dropdown-toggle" data-toggle="dropdown" style="color: black;"><i class="fa fa-print fa-lg"></i> Export <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="excel_laporanptk?PERIODE=<?php echo $PERIODE; ?>&PERIODE2=<?php echo $PERIODE2; ?>" type="button" style="color: black;" target="_blank">Excel</a></li>
                            <li><a href="pdf_laporanptk?PERIODE=<?php echo $PERIODE; ?>&PERIODE2=<?php echo $PERIODE2; ?>" type="button" style="color: black;" target="_blank">PDF</a></li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row" align="center">
        <div class="btn-group" style="margin-bottom:5px;">
            <a href="laporan_pemenuhan" type="button" class="btn btn-primary">Report Pemenuhan <i class="fas fa-share"></i> </a>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-md-12">
        <div class="panel-heading">
            <!-- <h3 class="panel-title">Laporan PKWT</h3> -->
        </div>
        <table class="table table-striped table-bordered" id="table-tools">
        <thead>
            <tr>
                <th>#</th>
                <th style="white-space:nowrap">File</th>
                <th style="white-space:nowrap">PTK Code</th>
                <th style="white-space:nowrap">PTK Date</th>
                <th style="white-space:nowrap">Department</th>
                <th style="white-space:nowrap">Division</th>
                <th style="white-space:nowrap">Section</th>
                <th style="white-space:nowrap">Sub Section</th>
                <th style="white-space:nowrap">Team</th>
                <th style="white-space:nowrap">Unit</th>
                <th style="white-space:nowrap">Level</th>
                <th style="white-space:nowrap">Grade</th>
                <th style="white-space:nowrap">Qty Submit</th>
                <th style="white-space:nowrap">Qty Accepted</th>
                <th style="white-space:nowrap">Qty Left</th>
                <th style="white-space:nowrap">Status</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $result = GetQuery(
                            "select b.*,
                                    date_format(b.date_ptk, '%d %b %Y') as date_ptk,
                                    date_format(b.date_needed, '%d %b %Y') as date_needed,
                                    date_format(b.created_date, '%d %b %Y - %H:%i:%s') as created_date,
                                    date_format(b.app_mgr_date, '%d %b %Y') as app_mgr_date,
                                    date_format(b.app_dir_date, '%d %b %Y') as app_dir_date,
                                    date_format(b.app_hrd_date, '%d %b %Y') as app_hrd_date,
                                    date_format(b.app_md_date, '%d %b %Y') as app_md_date,
                                    CASE 
                                        WHEN b.status_approval = 0 THEN 'Waiting'
                                        WHEN b.status_approval = 1 THEN 'Approved'
                                        ELSE 'Rejected'
                                    END AS status_approval,
                                    c.nama_departement,
                                    d.nama_divisi,
                                    f.nama_section,
                                    g.nama_subsection,
                                    h.nama_team,
                                    i.nama_unit,
                                    j.nama_level,
                                    k.nama_grade,
                                    k.ket_grade,
                                    l.nama_user
                               from t_ptk b
                          left join m_departement c ON b.kode_departement = c.kode_departement
                          left join m_divisi d ON b.kode_divisi = d.kode_divisi
                          left join m_section f ON b.kode_section = f.kode_section
                          left join m_subsection g ON b.kode_subsection = g.kode_subsection
                          left join m_team h ON b.kode_team = h.kode_team
                          left join m_unit i ON b.kode_unit = i.kode_unit
                          left join m_level j ON b.kode_level = j.kode_level
                          left join m_grade k ON b.kode_grade = k.kode_grade
                          left join m_user l ON b.created_by = l.kode_user
                          where status_hapus = '0' and 
                                date_ptk between '$PERIODE' and '$PERIODE2'
                                $where_clause
                          order by b.seq desc");

            $no = 0;
            while ($row = $result->fetch(PDO::FETCH_ASSOC))
            {
                $no++;
                if($row["qty_left"] == 0)
                {
                    $row["status_approval"] = "Complete";
                }
                ?>
                <tr>
                    <td align="left" style="white-space:nowrap"><?= $no."."; ?></td>
                    <td align="center" style="white-space:nowrap">
                        <a href="print_ptk?seq=<?= $row['seq']; ?>" target="_blank"><i class="far fa-file-pdf fa-2x" style="color:#ED5466"></i></a>
                    </td>
                    <td align="left" style="white-space:nowrap"><strong><?= $row["seq"]; ?></strong></td>
                    <td align="left" style="white-space:nowrap"><?= $row["date_ptk"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_departement"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_divisi"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_section"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_subsection"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_team"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_unit"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_level"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_grade"]." ".$row["ket_grade"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["qty_submition"]." orang"; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["qty_accepted"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["qty_left"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["status_approval"]; ?></td>
                <?php
            }
            ?>
        </tbody>
    </table>
    </div>
</div>