<?php
include "module/controller/master/worklocation/t_worklocation.php";
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-map-marked-alt"></i> Add Work Location</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_worklocation"><i class="fas fa-map-marked-alt"></i> Work Location</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Work Location</li>
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
                        <label for="WORKLOCATION">Work Location Name <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" autofocus="" class="form-control" id="WORKLOCATION" name="WORKLOCATION" value="<?php echo $WORKLOCATION; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="CATEGORY">Category <span class="text-danger">*</span></label>
                        <select name="CATEGORY" id="CATEGORY" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Category</option>
                            <?php
                                $results = getQuery("select * from m_typeworker order by worktype_code asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["worktype_code"]; ?>"
                                            <?php 
                                                if($CATEGORY == $rowz["worktype_code"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["worktype_name"]; ?>
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
                    <a href="m_worklocation" type="button" class="btn btn-danger"><i class="fa fa-times fa-lg"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
