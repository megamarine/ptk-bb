<?php
include "module/controller/config/t_config.php";
?>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-cog"></i> Config</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-cog"></i> Config</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>             
            <div id="DATA_INFO"></div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="LASTMONTH">Last PTK View (months) <span class="text-danger">*</span></label>
                        <input type="number" autocomplete="off" required="" autofocus="" class="form-control" id="LASTMONTH" name="LASTMONTH" value="<?php echo $LASTMONTH; ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="REMINDER">Approval Reminder (days) <span class="text-danger">*</span></label>
                        <input type="number" autocomplete="off" required="" autofocus="" class="form-control" id="REMINDER" name="REMINDER" value="<?php echo $REMINDER; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save fa-lg"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_perusahaan" type="button" class="btn btn-danger"><i class="fa fa-times fa-lg"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
