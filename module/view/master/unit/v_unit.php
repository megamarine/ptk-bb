<?php
$result = GetQuery("select a.*,
                           b.nama_departement,
                           c.nama_divisi,
                           e.nama_section,
                           f.nama_subsection,
                           g.nama_team,
                           h.nama_perusahaan
                      from m_unit a
                      join m_departement b ON a.kode_departement = b.kode_departement
                      join m_divisi c ON a.kode_divisi = c.kode_divisi
                      join m_section e ON a.kode_section = e.kode_section
                      join m_subsection f ON a.kode_subsection = f.kode_subsection
                      join m_team g ON a.kode_team = g.kode_team
                      join m_perusahaan h ON a.kode_perusahaan = h.kode_perusahaan");
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-user-circle"></i> Master Unit</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-user-circle"></i> Unit</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_munit == 1)
{
?>
    <div class="row">
        <div class="col-lg-12">
                <a href="tambah_unit" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Unit</a>
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
                <h3 class="panel-title">Unit List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th style="white-space:nowrap">Option&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th style="white-space:nowrap">Company</th>
                        <th style="white-space:nowrap">Department</th>
                        <th style="white-space:nowrap">Division</th>
                        <th style="white-space:nowrap">Section</th>
                        <th style="white-space:nowrap">Sub Section</th>
                        <th style="white-space:nowrap">Team</th>
                        <th style="white-space:nowrap">Unit Code</th>
                        <th style="white-space:nowrap">Unit Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($read_munit == 1)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td align="center" style="white-space:nowrap">
                                    <?php
                                    if($update_munit == 1)
                                    {
                                    ?>
                                        <a href="edit_unit?KODE=<?php echo $row["kode_unit"]; ?>" class="btn btn-teal"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="left" title="Edit"></i></a>
                                    <?php 
                                    } 
                                    if($delete_munit == 1)
                                    {
                                    ?>
                                        <a href="hapus_unit?KODE=<?php echo $row["kode_unit"]; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete" onclick="return confirm('Confirm delete <?php echo " : ".$row["nama_unit"]; ?> ?')"><i class="fa fa-trash fa-lg"></i></a>
                                    <?php 
                                    } 
                                    ?>
                                </td>
                                <td style="white-space:nowrap"><?php echo $row["nama_perusahaan"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_departement"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_divisi"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_section"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_subsection"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_team"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["kode_unit"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_unit"]; ?></span></td>
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
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Sub Section"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Team"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Unit Code"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Unit Name"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
