<?php
$result = GetQuery("select a.*, 
                           b.nama from m_jamkerja a join m_worklocation b ON a.work_location = b.seq")
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-clock"></i> Master Jam Kerja</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-clock"></i> Jam Kerja</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mjamkerja == 1)
{
?>
    <div class="row">
        <div class="col-lg-12">
                <a href="tambah_jamkerja" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Jam Kerja</a>
        </div>
    </div>
    <br/>
<?php
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Jam Kerja List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th style="white-space:nowrap">Option</th>
                        <th style="white-space:nowrap">Jam Kerja Code</th>
                        <th style="white-space:nowrap">Jam Kerja</th>
                        <th style="white-space:nowrap">Work Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($read_mjamkerja == 1)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td align="center" style="white-space:nowrap">
                                    <?php
                                    if($update_mjamkerja == 1)
                                    {
                                    ?>
                                        <a href="edit_jamkerja?KODE=<?php echo $row["jamkerja_code"]; ?>" class="btn btn-teal"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="left" title="Edit"></i></a>
                                    <?php 
                                    } 
                                    if($delete_mjamkerja == 1)
                                    {
                                    ?>
                                        <a href="hapus_jamkerja?KODE=<?php echo $row["jamkerja_code"]; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete" onclick="return confirm('Confirm delete <?php echo " : ".$row["jamkerja_name"]; ?> ?')"><i class="fa fa-trash fa-lg"></i></a>
                                    <?php 
                                    } 
                                    ?>
                                </td>
                                <td style="white-space:nowrap"><?php echo $row["jamkerja_code"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["jamkerja_name"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama"]; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Jam Kerja Code"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Jam Kerja"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Work Location"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
