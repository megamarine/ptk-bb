<?php
$result = GetQuery("select a.*,
                           b.nama_departement,
                           c.nama_divisi,
                           e.nama_section,
                           f.nama_subsection,
                           g.nama_perusahaan
                      from m_team a
                      join m_departement b ON a.kode_departement = b.kode_departement
                      join m_divisi c ON a.kode_divisi = c.kode_divisi
                      join m_section e ON a.kode_section = e.kode_section
                      join m_subsection f ON a.kode_subsection = f.kode_subsection
                      join m_perusahaan g ON a.kode_perusahaan = g.kode_perusahaan");
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-users"></i> Master Team</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-users"></i>Team</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mteam == 1)
{
?>
    <div class="row">
        <div class="col-lg-12">
                <a href="tambah_team" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Team</a>
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
                <h3 class="panel-title">Team List</h3>
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
                        <th style="white-space:nowrap">Team Code</th>
                        <th style="white-space:nowrap">Team Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($read_mteam == 1)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td align="center" style="white-space:nowrap">
                                    <?php
                                    if($update_mteam == 1)
                                    {
                                    ?>
                                        <a href="edit_team?KODE=<?php echo $row["kode_team"]; ?>" class="btn btn-teal"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="left" title="Edit"></i></a>
                                    <?php 
                                    } 
                                    if($delete_mteam == 1)
                                    {
                                    ?>
                                        <a href="hapus_team?KODE=<?php echo $row["kode_team"]; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete" onclick="return confirm('Confirm delete <?php echo " : ".$row["nama_team"]; ?> ?')"><i class="fa fa-trash fa-lg"></i></a>
                                    <?php 
                                    } 
                                    ?>
                                </td>
                                <td style="white-space:nowrap"><?php echo $row["nama_perusahaan"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_departement"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_divisi"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_section"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_subsection"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["kode_team"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_team"]; ?></span></td>
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
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Team Code"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Team Name"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
