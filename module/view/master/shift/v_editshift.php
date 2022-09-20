<?php
include "module/controller/master/shift/t_shift.php";
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-exchange-alt"></i> Edit Shift</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_shift"><i class="fas fa-exchange-alt"></i> Shift</a></li>
                <li class="active"><i class="ico-pencil"></i> Edit Shift</li>
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
                        <label for="SHIFT_CODE">Shift Code <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" autofocus="" class="form-control" id="SHIFT_CODE" name="SHIFT_CODE" value="<?php echo $SHIFT_CODE; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="SHIFT_NAME">Shift <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" autofocus="" class="form-control" id="SHIFT_NAME" name="SHIFT_NAME" value="<?php echo $SHIFT_NAME; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save fa-lg"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_shift" type="button" class="btn btn-danger"><i class="fa fa-times fa-lg"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
