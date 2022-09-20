<?php
include "module/controller/master/level/t_level.php";
?>
<script type="text/javascript">
    function getMASTER_LEVEL(val) {
      $.ajax({
      type: "POST",
      url: "cek_m_level.php",
      data:'KODELEVEL='+val,
      success: function(data){
        $("#DATA_USER").html(data);
      }
      });
    }
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-chart-line"></i> Add Level</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_level"><i class="fas fa-chart-line"></i> Level</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Level</li>
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
                        <label for="KODELEVEL">Level Code <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" autofocus="" oninput="getMASTER_LEVEL(this.value);" onkeypress="return event.keyCode!=13" class="form-control" id="KODELEVEL" name="KODELEVEL" value="<?php echo $KODELEVEL; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="NAMALEVEL">Level Name <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" class="form-control" id="NAMALEVEL" name="NAMALEVEL" value="<?php echo $NAMALEVEL; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="LEVELNUM">Level Number <span class="text-danger">*</span></label>
                        <select name="LEVELNUM" id="LEVELNUM" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Level Number</option>                            
                            <?php
                                $results = getQuery("select levelnum from param where levelnum != '' ");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["levelnum"]; ?>"
                                            <?php 
                                                if($LEVELNUM == $rowz["levelnum"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["levelnum"]; ?>
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
                    <a href="m_level" type="button" class="btn btn-danger"><i class="fa fa-times fa-lg"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
