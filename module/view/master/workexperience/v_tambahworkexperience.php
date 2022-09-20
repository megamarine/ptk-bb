<?php
include "module/controller/master/workexperience/t_workexperience.php";
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-briefcase"></i> Add Work Experience</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_workexperience"><i class="fas fa-briefcase"></i> Work Experience</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Work Experience</li>
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
                        <label for="WORKEXP_CODE">Work Experience Code <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" autofocus="" class="form-control" id="WORKEXP_CODE" name="WORKEXP_CODE" value="<?php echo $WORKEXP_CODE; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="WORKEXP_NAME">Work Experience Code <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" autofocus="" class="form-control" id="WORKEXP_NAME" name="WORKEXP_NAME" value="<?php echo $WORKEXP_NAME; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save fa-lg"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_workexperience" type="button" class="btn btn-danger"><i class="fa fa-times fa-lg"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
