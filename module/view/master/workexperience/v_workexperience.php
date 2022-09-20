<?php
$result = GetQuery("select * from m_workexperience")
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-briefcase"></i> Master Work Experience</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-briefcase"></i> Work Experience</li>
            </ol>
        </div>
    </div>
</div>
<?php 
if($create_mworkexp == 1)
{
?>
    <div class="row">
        <div class="col-lg-12">
                <a href="tambah_workexperience" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add Work Experience</a>
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
                <h3 class="panel-title">Work Experience List</h3>
            </div>
            <table class="table table-striped table-bordered" id="column-filtering">
                <thead>
                    <tr>
                        <th style="white-space:nowrap">Option</th>
                        <th style="white-space:nowrap">Work Experience Code</th>
                        <th style="white-space:nowrap">Work Experience</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($read_mworkexp == 1)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
                        { 
                            ?>
                            <tr>
                                <td align="center" style="white-space:nowrap">
                                    <?php
                                    if($update_mworkexp == 1)
                                    {
                                    ?>
                                        <a href="edit_workexperience?KODE=<?php echo $row["workexp_code"]; ?>" class="btn btn-teal"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="left" title="Edit"></i></a>
                                    <?php 
                                    } 
                                    if($delete_mworkexp == 1)
                                    {
                                    ?>
                                        <a href="hapus_workexperience?KODE=<?php echo $row["workexp_code"]; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Delete" onclick="return confirm('Confirm delete <?php echo " : ".$row["workexp_name"]; ?> ?')"><i class="fa fa-trash fa-lg"></i></a>
                                    <?php 
                                    } 
                                    ?>
                                </td>
                                <td style="white-space:nowrap"><?php echo $row["workexp_code"]; ?></td>
                                <td style="white-space:nowrap"><?php echo $row["workexp_name"]; ?></span></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input type="search" class="form-control hidden" name="search_engine" disabled=""></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Work Experience Code"></th>
                        <th><input type="search" class="form-control" name="search_engine" placeholder="Work Experience"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
