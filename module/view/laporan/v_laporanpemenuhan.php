<?php
$PERIODE      = date("Y-m-01");
$PERIODE2     = date("Y-m-d");
$ID_USER1     = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$dept         = $_SESSION["LOGINDEP_PERSONALIA_BB"];
$div          = $_SESSION["LOGINDIV_PERSONALIA_BB"];
$akses        = $_SESSION["LOGINAKS_PERSONALIA_BB"];
$ptk_view     = $_SESSION["LOGINPTKVIEW_PERSONALIA_BB"];
$where_clause = "";
$where_sec    = "";
$where_lev    = "";
$SEC          = "";
$LEV          = "";

//filter akses ptk view
if($ptk_view == "All")
{
    $where_clause = "";
}
else if($ptk_view == "Departement")
{
    $where_clause = "and b.kode_departement = '$dept' ";
}
else
{
    $where_clause = "and b.kode_divisi = '$div' ";
}
// ----------------------------------------------------------------------------------------------------------

if (isset($_POST["cari"]))
{
    $PERIODE    = $_POST["PERIODE"];
    $PERIODE2   = $_POST["PERIODE2"];
    if($_POST["SEC"] != "")
    {
        $SEC = $_POST["SEC"];
        $where_sec = "and b.kode_section = '$SEC'";
    }

    if($_POST["LEV"] != "")
    {
        $LEV       = $_POST["LEV"];
        $where_lev = "and b.kode_level = '$LEV'";
    }
}
?>
<!-- FILTER ----------------------------------------------------------------------------------->

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-id-card"></i> Report Pemenuhan / Fulfillment</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="laporan_ptk"><i class="ico-book3"></i> Report PTK</a></li>
                <li class="active"><i class="fas fa-id-card"></i> Report Pemenuhan</li>
            </ol>
        </div>
    </div>
</div>

<form role="form" action="" method="post">
    <div class="row" align="center">
        <div class="col-md-2">
            <div class="form-group" align="left">
                <label>Fulfillment Period PTK :</label>
                <input type="date" class="form-control" name="PERIODE" id="PERIODE" value="<?php echo $PERIODE; ?>" />
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group" align="left">
            <label style="color:transparent">.</label>
                <input type="date" class="form-control" name="PERIODE2" id="PERIODE2" value="<?php echo $PERIODE2; ?>" />
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group" align="left">
                <label>Section Name :</label>
                <select class="form-control" id="SEC" name="SEC">
                    <option value="" style="background-color:lightgrey">Choose Section</option>
                    <?php
                    $result = GetQuery("select z.seq,
                                            b.kode_section,
                                            f.nama_section
                                        from t_fulfillment z 
                                    left join t_ptk b ON z.seq = b.seq
                                    left join m_section f ON b.kode_section = f.kode_section
                                        WHERE (z.date BETWEEN '$PERIODE' AND '$PERIODE2') $where_clause
                                        group by b.kode_section
                                    order by f.nama_section asc");
                    while ($row = $result->fetch(PDO::FETCH_ASSOC))
                    {
                        ?>
                            <option value="<?=$row['kode_section'];?>"><?=$row["nama_section"];?></option>
                        <?php
                    }
                    ?>                
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group" align="left">
                <label>Level :</label>
                <select class="form-control" id="LEV" name="LEV">
                    <option value="" style="background-color:lightgrey">Choose Level</option>
                    <?php
                    $result = GetQuery("select z.seq,
                                               b.kode_level,
                                               f.nama_level
                                          from t_fulfillment z 
                                     left join t_ptk b ON z.seq = b.seq
                                     left join m_level f ON b.kode_level = f.kode_level
                                         WHERE (z.date BETWEEN '$PERIODE' AND '$PERIODE2') $where_clause
                                      group by b.kode_level
                                      order by f.nama_level asc");
                    while ($row = $result->fetch(PDO::FETCH_ASSOC))
                    {
                        ?>
                            <option value="<?=$row['kode_level'];?>"> <?=$row["nama_level"];?> </option>
                        <?php
                    }
                    ?>                
                </select>
            </div>
        </div>
        <div class="col-md-3" align="left">
            <label style="color:transparent">.</label>
            <div class="form-group">
                <div class="btn-group" style="margin-bottom:5px;">
                    <button type="submit" name="cari" class="btn btn-primary"><i class="fa fa-search-plus fa-lg"></i> Search</button>
                </div>
                <div class="btn-group" style="margin-bottom:5px;">
                    <a href="laporan_pemenuhan" type="button" class="btn btn-danger"><i class="fas fa-sync"></i> Clear</a>
                </div>
                <div class="btn-group" style="margin-bottom:px;">
                    <button type="button" class="btn btn-warning mb5 dropdown-toggle" data-toggle="dropdown" style="color: black;"><i class="fa fa-print fa-lg"></i> Export <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="excel_laporanpemenuhan?PERIODE=<?= $PERIODE; ?>&PERIODE2=<?= $PERIODE2; ?>&SEC=<?= $SEC; ?>&LEV=<?= $LEV; ?>" type="button" style="color: black;" target="_blank">Excel</a></li>
                        <li><a href="pdf_laporanpemenuhan?PERIODE=<?= $PERIODE; ?>&PERIODE2=<?= $PERIODE2; ?>&SEC=<?= $SEC; ?>&LEV=<?= $LEV; ?>" type="button" style="color: black;" target="_blank">PDF</a></li>
                    </ul>
                </div>
            </div>
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
                <th style="white-space:nowrap;background-color:lightgray">#</th>
                <th style="white-space:nowrap;background-color:lightgray">File</th>
                <th style="white-space:nowrap;background-color:lightgray">PTK Code</th>
                <th style="white-space:nowrap;background-color:lightgray">PTK Date</th>
                <th style="white-space:nowrap;background-color:lightgray">Fulfillment Date</th>
                <th style="white-space:nowrap;background-color:lightgray">Fulfillment By</th>
                <th style="white-space:nowrap;background-color:#c9d4d6">ID Kary</th>
                <th style="white-space:nowrap;background-color:#c9d4d6">Name</th>
                <th style="white-space:nowrap;background-color:#c9d4d6">Gender</th>
                <th style="white-space:nowrap;background-color:#c9d4d6">Department</th>
                <th style="white-space:nowrap;background-color:#c9d4d6">Division</th>
                <th style="white-space:nowrap;background-color:#c9d4d6">Section</th>
                <th style="white-space:nowrap;background-color:#c9d4d6">Sub Section</th>
                <th style="white-space:nowrap;background-color:#c9d4d6">Team</th>
                <th style="white-space:nowrap;background-color:#c9d4d6">Unit</th>
                <th style="white-space:nowrap;background-color:#c9d4d6">Level</th>
                <th style="white-space:nowrap;background-color:#c9d4d6">Grade</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $result = GetQuery("select  z.*,
                                        date_format(z.date, '%d %b %Y') as date_pemenuhan,
                                        date_format(b.date_ptk, '%d %b %Y') as date_ptk,
                                        c.nama_departement,
                                        d.nama_divisi,
                                        f.nama_section,
                                        g.nama_subsection,
                                        h.nama_team,
                                        i.nama_unit,
                                        j.nama_level,
                                        k.nama_grade,
                                        k.ket_grade,
                                        m.nama_user as nama_user_pemenuhan
                                   from t_fulfillment z 
                              left join t_ptk b ON z.seq = b.seq
                              left join m_departement c ON b.kode_departement = c.kode_departement
                              left join m_divisi d ON b.kode_divisi = d.kode_divisi
                              left join m_section f ON b.kode_section = f.kode_section
                              left join m_subsection g ON b.kode_subsection = g.kode_subsection
                              left join m_team h ON b.kode_team = h.kode_team
                              left join m_unit i ON b.kode_unit = i.kode_unit
                              left join m_level j ON b.kode_level = j.kode_level
                              left join m_grade k ON b.kode_grade = k.kode_grade
                              left join m_user m ON z.created_by = m.kode_user
                             WHERE (z.date BETWEEN '$PERIODE' AND '$PERIODE2') $where_clause $where_sec $where_lev
                               order by z.seq desc");

            $no = 0;
            while ($row = $result->fetch(PDO::FETCH_ASSOC))
            {
                $no++;
                ?>
                <tr>
                    <td align="left" style="white-space:nowrap"><?= $no."."; ?></td>
                    <td align="center" style="white-space:nowrap">
                        <a href="print_ptk?seq=<?= $row['seq']; ?>" target="_blank"><i class="far fa-file-pdf fa-2x" style="color:#ED5466"></i></a>
                    </td>
                    <td align="left" style="white-space:nowrap"><strong><?= $row["seq"]; ?></strong></td>
                    <td align="left" style="white-space:nowrap"><?= $row["date_ptk"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["date_pemenuhan"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_user_pemenuhan"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["id_accepted"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["name_accepted"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["jenis_kelamin"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_departement"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_divisi"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_section"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_subsection"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_team"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_unit"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_level"]; ?></td>
                    <td align="left" style="white-space:nowrap"><?= $row["nama_grade"]." ".$row["ket_grade"]; ?></td>
                <?php
            }
            ?>
        </tbody>
    </table>
    </div>
</div>