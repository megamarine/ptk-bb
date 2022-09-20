<?php
$result = GetQuery("select a.*,
                           b.nama_departement,
                           c.nama_divisi,
                           e.nama_perusahaan
                      from m_section a
                      join m_departement b ON a.kode_departement = b.kode_departement
                      join m_divisi c ON a.kode_divisi = c.kode_divisi
                      join m_perusahaan e ON a.kode_perusahaan = e.kode_perusahaan");
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-chart-pie"></i> Master Section</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-chart-pie"></i> Section</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_msec == 1)
{
?>
    <div class="row">
        <div class="col-lg-12">
                <a href="tambah_section" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Section</a>
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
                <h3 class="panel-title">Section List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th style="white-space:nowrap">Option&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th style="white-space:nowrap">Company</th>
                        <th style="white-space:nowrap">Department</th>
                        <th style="white-space:nowrap">Division</th>
                        <th style="white-space:nowrap">Section Code</th>
                        <th style="white-space:nowrap">Section Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($read_msec == 1)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td align="center" style="white-space:nowrap">
                                    <?php
                                    if($update_msec == 1)
                                    {
                                    ?>
                                        <a href="edit_section?KODE=<?php echo $row["kode_section"]; ?>" class="btn btn-teal"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="left" title="Edit"></i></a>
                                    <?php 
                                    } 
                                    if($delete_msec == 1)
                                    {
                                    ?>
                                        <a href="hapus_section?KODE=<?php echo $row["kode_section"]; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete" onclick="return confirm('Confirm delete <?php echo " : ".$row["nama_section"]; ?> ?')"><i class="fa fa-trash fa-lg"></i></a>
                                    <?php 
                                    } 
                                    ?>
                                </td>
                                <td style="white-space:nowrap"><?php echo $row["nama_perusahaan"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_departement"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_divisi"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["kode_section"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_section"]; ?></span></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Company"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Department"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Division"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Section Code"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Section Name"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
