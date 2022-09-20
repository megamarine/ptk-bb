<?php
include "module/controller/master/typesalary/t_typesalary.php";
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-file-invoice-dollar"></i> Edit Type Salary</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_typesalary"><i class="fas fa-file-invoice-dollar"></i> Type Salary</a></li>
                <li class="active"><i class="ico-pencil"></i> Edit Type Salary</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="TYPESALARY_CODE">Type Salary Code <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" autofocus="" class="form-control" id="TYPESALARY_CODE" name="TYPESALARY_CODE" value="<?php echo $TYPESALARY_CODE; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="TYPESALARY_NAME">Type Salary Name <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" autofocus="" class="form-control" id="TYPESALARY_NAME" name="TYPESALARY_NAME" value="<?php echo $TYPESALARY_NAME; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="PLACEMENT_CODE">For Placement <span class="text-danger">*</span></label>
                        <select name="PLACEMENT_CODE" id="PLACEMENT_CODE" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Placement</option>
                            <?php
                                $results = getQuery("select * from m_placement order by placement_code asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["placement_code"]; ?>"
                                            <?php 
                                                if($PLACEMENT_CODE == $rowz["placement_code"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["placement_name"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>    
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save fa-lg"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_typesalary" type="button" class="btn btn-danger"><i class="fa fa-times fa-lg"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
