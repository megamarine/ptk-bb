<?php
$result = GetQuery("select a.*, 
                           b.worktype_name 
                      from m_worklocation a 
                      join m_typeworker b ON a.worktype_code = b.worktype_code")
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-map-marked-alt"></i> Master Work Location</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-map-marked-alt"></i> Work Location</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mworklocation == 1)
{
?>
    <div class="row">
        <div class="col-lg-12">
                <a href="tambah_worklocation" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Work Location</a>
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
                <h3 class="panel-title">Work Location List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th style="white-space:nowrap">Option</th>
                        <th style="white-space:nowrap">Work Location</th>
                        <th style="white-space:nowrap">Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($read_mworklocation == 1)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td align="center" style="white-space:nowrap">
                                    <?php
                                    if($update_mworklocation == 1)
                                    {
                                    ?>
                                        <a href="edit_worklocation?KODE=<?php echo $row["seq"]; ?>" class="btn btn-teal"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="left" title="Edit"></i></a>
                                    <?php 
                                    } 
                                    if($delete_mworklocation == 1)
                                    {
                                    ?>
                                        <a href="hapus_worklocation?KODE=<?php echo $row["seq"]; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete" onclick="return confirm('Confirm delete <?php echo " : ".$row["nama"]; ?> ?')"><i class="fa fa-trash fa-lg"></i></a>
                                    <?php 
                                    } 
                                    ?>
                                </td>
                                <td style="white-space:nowrap"><?php echo $row["nama"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["worktype_name"]; ?></span></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Work Location"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Category"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
