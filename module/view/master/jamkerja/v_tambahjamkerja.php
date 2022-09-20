<?php
include "module/controller/master/jamkerja/t_jamkerja.php";
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-clock"></i> Add Jam Kerja</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_workexperience"><i class="fas fa-clock"></i> Jam Kerja</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Jam Kerja</li>
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
                        <label for="JAMKERJA_CODE">Jam Kerja Code <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" autofocus="" class="form-control" id="JAMKERJA_CODE" name="JAMKERJA_CODE" value="<?php echo $JAMKERJA_CODE; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="JAMKERJA_NAME">Jam Kerja <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" autofocus="" class="form-control" id="JAMKERJA_NAME" name="JAMKERJA_NAME" value="<?php echo $JAMKERJA_NAME; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="WORK_LOCATION">Work Location <span class="text-danger">*</span></label>
                        <select name="WORK_LOCATION" id="WORK_LOCATION" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Work Location</option>                            
                            <?php
                                $results = getQuery("select * from m_worklocation order by nama asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["seq"]; ?>"
                                            <?php 
                                                if($WORK_LOCATION == $rowz["seq"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["nama"]; ?>
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
                    <a href="m_jamkerja" type="button" class="btn btn-danger"><i class="fa fa-times fa-lg"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
