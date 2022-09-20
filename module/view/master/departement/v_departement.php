<?php
$result = GetQuery("select a.*, 
                           b.nama_perusahaan,
                           c.nama_user 
                      from m_departement a 
                      join m_perusahaan b ON a.kode_perusahaan = b.kode_perusahaan 
                      left join m_user c ON a.head = c.kode_user
                  order by a.kode_departement asc")
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-sitemap"></i> Master Department</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-sitemap"></i> Department</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mdept == 1)
{
?>
    <div class="row">
        <div class="col-lg-12">
                <a href="tambah_departement" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Department</a>
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
                <h3 class="panel-title">Department List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th style="white-space:nowrap">Option</th>
                        <th style="white-space:nowrap">Company</th>
                        <th style="white-space:nowrap">Department Code</th>
                        <th style="white-space:nowrap">Department Name</th>
                        <th style="white-space:nowrap">Director</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($read_mdept == 1)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td align="center" style="white-space:nowrap">
                                    <?php
                                    if($update_mdept == 1)
                                    {
                                    ?>
                                        <a href="edit_departement?KODE=<?php echo $row["kode_departement"]; ?>" class="btn btn-teal"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="left" title="Edit"></i></a>
                                    <?php 
                                    } 
                                    if($delete_mdept == 1)
                                    {
                                    ?>
                                        <a href="hapus_departement?KODE=<?php echo $row["kode_departement"]; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete" onclick="return confirm('Confirm delete <?php echo " : ".$row["nama_departement"]; ?> ?')"><i class="fa fa-trash fa-lg"></i></a>
                                    <?php 
                                    } 
                                    ?>
                                </td>
                                <td style="white-space:nowrap"><?php echo $row["nama_perusahaan"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["kode_departement"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_departement"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_user"]; ?></td>
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
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Department Code"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Department Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Director"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
