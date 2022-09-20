<?php
include "module/controller/master/grade/t_grade.php";
?>
<script type="text/javascript">
    function getMASTER_GRADE(val) {
      $.ajax({
      type: "POST",
      url: "cek_m_grade.php",
      data:'KODEGRADE='+val,
      success: function(data){
        $("#DATA_USER").html(data);
      }
      });
    }
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-chart-line"></i> Add Grade</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_grade"><i class="fas fa-external-link-alt"></i> Grade</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Grade</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>             
            <div id="DATA_USER"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="KODEGRADE">Grade Code <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" autofocus="" oninput="getMASTER_GRADE(this.value);" onkeypress="return event.keyCode!=13" class="form-control" id="KODEGRADE" name="KODEGRADE" value="<?php echo $KODEGRADE; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="NAMAGRADE">Grade Name <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" class="form-control" id="NAMAGRADE" name="NAMAGRADE" value="<?php echo $NAMAGRADE; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="GRADEREMARK">Grade Remark </label>
                        <input type="text" autocomplete="off" class="form-control" id="GRADEREMARK" name="GRADEREMARK" value="<?php echo $GRADEREMARK; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="LEVELCATEGORY">Level Category <span class="text-danger">*</span></label>
                        <select name="LEVELCATEGORY" id="LEVELCATEGORY" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Level Category</option>                            
                            <?php
                                $results = getQuery("select * from m_level");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["kode_level"]; ?>"
                                            <?php 
                                                if($LEVELCATEGORY == $rowz["kode_level"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["no_level"]." | ".$rowz["nama_level"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>    
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="WORKEXPCATEGORY">Work Experience Category <span class="text-danger">*</span></label>
                        <select name="WORKEXPCATEGORY" id="WORKEXPCATEGORY" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Level Category</option>                            
                            <?php
                                $results = getQuery("select * from m_workexperience");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["workexp_code"]; ?>"
                                            <?php 
                                                if($WORKEXPCATEGORY == $rowz["workexp_code"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["workexp_name"]; ?>
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
                    <a href="m_grade" type="button" class="btn btn-danger"><i class="fa fa-times fa-lg"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
