<?php
$result = GetQuery("select a.*,
                           b.nama_departement,
                           c.nama_divisi,
                           e.nama_section,
                           f.nama_perusahaan
                      from m_subsection a
                      join m_departement b ON a.kode_departement = b.kode_departement
                      join m_divisi c ON a.kode_divisi = c.kode_divisi
                      join m_section e ON a.kode_section = e.kode_section
                      join m_perusahaan f ON a.kode_perusahaan = f.kode_perusahaan");
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-pizza-slice"></i> Master Sub Section</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-pizza-slice"></i> </i> Sub Section</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_msubsec == 1)
{
?>
    <div class="row">
        <div class="col-lg-12">
                <a href="tambah_subsection" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Sub Section</a>
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
                <h3 class="panel-title">Sub Section List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th style="white-space:nowrap">Option&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th style="white-space:nowrap">Company</th>
                        <th style="white-space:nowrap">Department</th>
                        <th style="white-space:nowrap">Division</th>
                        <th style="white-space:nowrap">Section</th>
                        <th style="white-space:nowrap">Sub Section Code</th>
                        <th style="white-space:nowrap">Sub Section Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($read_msubsec == 1)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td align="center" style="white-space:nowrap">
                                <?php
                                    if($update_msubsec == 1)
                                    {
                                    ?>
                                        <a href="edit_subsection?KODE=<?php echo $row["kode_subsection"]; ?>" class="btn btn-teal"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="left" title="Edit"></i></a>
                                    <?php 
                                    } 
                                    if($delete_msubsec == 1)
                                    {
                                    ?>
                                        <a href="hapus_subsection?KODE=<?php echo $row["kode_subsection"]; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete" onclick="return confirm('Confirm delete <?php echo " : ".$row["nama_subsection"]; ?> ?')"><i class="fa fa-trash fa-lg"></i></a>
                                    <?php 
                                    } 
                                    ?>
                                </td>
                                <td style="white-space:nowrap"><?php echo $row["nama_perusahaan"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_departement"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_divisi"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_section"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["kode_subsection"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_subsection"]; ?></span></td>
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
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Section"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Sub Section Code"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Sub Section Name"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
