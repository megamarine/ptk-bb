<?php
$result = GetQuery("select a.*, b.placement_name from m_typesalary a join m_placement b ON a.placement_code = b.placement_code")
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-file-invoice-dollar"></i> Master Type Salary</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-file-invoice-dollar"></i> Type Salary</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mtypesalary == 1)
{
?>
    <div class="row">
        <div class="col-lg-12">
                <a href="tambah_typesalary" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Type Salary</a>
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
                <h3 class="panel-title">Type Salary List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th style="white-space:nowrap">Option</th>
                        <th style="white-space:nowrap">Type Salary Code</th>
                        <th style="white-space:nowrap">Type Salary</th>
                        <th style="white-space:nowrap">Placement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($read_mtypesalary == 1)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td align="center" style="white-space:nowrap">
                                    <?php
                                    if($update_mtypesalary == 1)
                                    {
                                    ?>
                                        <a href="edit_typesalary?KODE=<?php echo $row["typesalary_code"]; ?>" class="btn btn-teal"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="left" title="Edit"></i></a>
                                    <?php 
                                    } 
                                    if($delete_mtypesalary == 1)
                                    {
                                    ?>
                                        <a href="hapus_typesalary?KODE=<?php echo $row["typesalary_code"]; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete" onclick="return confirm('Confirm delete <?php echo " : ".$row["typesalary_name"]; ?> ?')"><i class="fa fa-trash fa-lg"></i></a>
                                    <?php 
                                    } 
                                    ?>
                                </td>
                                <td style="white-space:nowrap"><?php echo $row["typesalary_code"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["typesalary_name"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["placement_name"]; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Type Salary Code"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Type Salary"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Placement"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
