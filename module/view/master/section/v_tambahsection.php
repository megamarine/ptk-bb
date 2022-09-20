<?php
include "module/controller/master/section/t_section.php";
?>
<script type="text/javascript">
function getKODE_DEPARTEMENT(val)
{
  $.ajax({
  type: "POST",
  url: "cek_departemen.php",
  data:'PERUSAHAAN='+val,
  success: function(data){
    $("#DEPARTEMENT").html(data);
  }
  });
}

function getKODE_DIVISI(val)
{
  $.ajax({
  type: "POST",
  url: "cek_divisi.php",
  data:'DEPARTEMENT='+val,
  success: function(data){
    $("#DIVISI").html(data);
  }
  });
}

function getKODE_SECTION(val)
{
  $.ajax({
  type: "POST",
  url: "cek_section.php",
  data:'DIVISI='+val,
  success: function(data){
    $("#SECTION").html(data);
  }
  });
}

function getKODE_SUBSECTION(val)
{
  $.ajax({
  type: "POST",
  url: "cek_subsection.php",
  data:'SECTION='+val,
  success: function(data){
    $("#SUBSECTION").html(data);
  }
  });
}

function getKODE_TEAM(val)
{
  $.ajax({
  type: "POST",
  url: "cek_team.php",
  data:'SUBSECTION='+val,
  success: function(data){
    $("#TEAM").html(data);
  }
  });
}

function getKODE_UNIT(val)
{
  $.ajax({
  type: "POST",
  url: "cek_unit.php",
  data:'TEAM='+val,
  success: function(data){
    $("#UNIT").html(data);
  }
  });
}

function getKODE_JABATAN(val)
{
  $.ajax({
  type: "POST",
  url: "cek_jabatan.php",
  data:'SECTION='+val,
  success: function(data){
    $("#JABATAN").html(data);
  }
  });
}

function getKARYAWAN(val) {
  $.ajax({
  type: "POST",
  url: "cek_karyawan_masuk.php",
  data:'IDKARYAWAN='+val,
  success: function(data){
    $("#INFO_KARYAWAN").html(data);
  }
  });
}

function getMASTERKARYAWAN(val) {
  $.ajax({
  type: "POST",
  url: "cek_masterkaryawan.php",
  data:'IDKARYAWAN='+val,
  success: function(data){
    $("#NAMAKARYAWAN").val(data);
  }
  });
}

function getMASTER_SECTION(val) {
  $.ajax({
  type: "POST",
  url: "cek_m_section.php",
  data:'SECTION='+val,
  success: function(data){
    $("#DATA_INFO").html(data);
  }
  });
}
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-chart-pie"></i> Add Section</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_section"><i class="fas fa-chart-pie"></i> Section</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Section</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <form role="form" action="" method="post" data-parsley-validate>             
            <div id="DATA_INFO"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="PERUSAHAAN">Company <span class="text-danger">*</span></label>
                        <select name="PERUSAHAAN" id="PERUSAHAAN" required="" class="form-control" onchange="getKODE_DEPARTEMENT(this.value);" data-parsley-required>
                            <option value="">Choose Company</option>
                            <?php
                            $stmj = GetQuery("select * from m_perusahaan order by nama_perusahaan asc");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $rowz["kode_perusahaan"]; ?>"
                                    <?php 
                                        if($PERUSAHAAN == $rowz["kode_perusahaan"]) 
                                        { 
                                            echo "selected"; 
                                        } 
                                    ?>>
                                    <?php 
                                        echo $rowz["nama_perusahaan"]; 
                                    ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="DEPARTEMENT">Department <span class="text-danger">*</span></label>
                        <select name="DEPARTEMENT" id="DEPARTEMENT" required="" class="form-control" onchange="getKODE_DIVISI(this.value);"  data-parsley-required>
                            <option value="">Choose Department</option>
                            <?php
                            $stmj = GetQuery("select * from m_departement where kode_perusahaan = '$PERUSAHAAN' order by nama_departement asc");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $rowz["kode_departement"]; ?>"
                                    <?php 
                                        if($DEPARTEMENT == $rowz["kode_departement"]) 
                                        { 
                                            echo "selected"; 
                                        } 
                                    ?>>
                                    <?php 
                                        echo $rowz["nama_departement"]; 
                                    ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="DIVISI">Division <span class="text-danger">*</span></label>
                        <select name="DIVISI" id="DIVISI" required="" class="form-control" onchange="getKODE_SECTION(this.value);"  data-parsley-required>
                            <option value="">Choose Division</option>
                            <?php
                            $stmj = GetQuery("select * from m_divisi where kode_departement = '$DEPARTEMENT' order by nama_divisi asc");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $rowz["kode_divisi"]; ?>"
                                    <?php 
                                        if($DIVISI == $rowz["kode_divisi"]) 
                                        { 
                                            echo "selected"; 
                                        } 
                                    ?>>
                                    <?php 
                                        echo $rowz["nama_divisi"]; 
                                    ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="SECTION">Section Code <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" oninput="getMASTER_SECTION(this.value);" onkeypress="return event.keyCode!=13" class="form-control" id="SECTION" name="SECTION" value="<?php echo $SECTION; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="NAMASECTION">Section Name <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" class="form-control" id="NAMASECTION" name="NAMASECTION" value="<?php echo $NAMASECTION; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save fa-lg"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_section" type="button" class="btn btn-danger"><i class="fa fa-times fa-lg"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
