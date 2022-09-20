<?php
$result = GetQuery("select a.*, 
                           b.nama_level, 
                           b.no_level,
                           c.workexp_name 
                      from m_grade a 
                 left join m_level b ON a.kode_level = b.kode_level
                 left join m_workexperience c ON a.workexp_code = c.workexp_code")
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-external-link-alt"></i> Master Grade</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-external-link-alt"></i> Grade</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mgrade == 1)
{
?>
    <div class="row">
        <div class="col-lg-12">
                <a href="tambah_grade" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Grade</a>
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
                <h3 class="panel-title">Grade List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th style="white-space:nowrap">Option</th>
                        <th style="white-space:nowrap">Grade Code</th>
                        <th style="white-space:nowrap">Grade Name</th>
                        <th style="white-space:nowrap">Grade Remark</th>
                        <th style="white-space:nowrap">Level Category</th>
                        <th style="white-space:nowrap">Work Experience Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($read_mgrade == 1)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td align="center" style="white-space:nowrap">
                                    <?php
                                    if($update_mgrade == 1)
                                    {
                                    ?>
                                        <a href="edit_grade?KODE=<?php echo $row["kode_grade"]; ?>" class="btn btn-teal"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="left" title="Edit"></i></a>
                                    <?php 
                                    } 
                                    if($delete_mgrade == 1)
                                    {
                                    ?>
                                        <a href="hapus_grade?KODE=<?php echo $row["kode_grade"]; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete" onclick="return confirm('Confirm delete <?php echo " : ".$row["nama_grade"]; ?> ?')"><i class="fa fa-trash fa-lg"></i></a>
                                    <?php 
                                    } 
                                    ?>
                                </td>
                                <td style="white-space:nowrap"><?php echo $row["kode_grade"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["nama_grade"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["ket_grade"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["no_level"]." | ".$row["nama_level"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["workexp_name"]; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Grade Code"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Grade Name"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Grade Remark"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Level Category"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Work Experience Category"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
