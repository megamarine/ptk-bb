<?php
include "module/controller/master/unit/t_unit.php";
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

function getMASTER_UNIT(val) {
  $.ajax({
  type: "POST",
  url: "cek_m_unit.php",
  data:'UNIT='+val,
  success: function(data){
    $("#DATA_INFO").html(data);
  }
  });
}
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-user-circle"></i> Add Unit</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_unit"><i class="fas fa-user-circle"></i> Unit</a></li>
                <li class="active"><i class="ico-plus2"></i> Add Unit</li>
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
                        <select name="PERUSAHAAN" id="PERUSAHAAN" required="" onchange="getKODE_DEPARTEMENT(this.value);" class="form-control"  data-parsley-required>
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
                        <select name="DIVISI" id="DIVISI" required="" class="form-control" onchange="getKODE_SECTION(this.value);" data-parsley-required>
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
                        <label for="SECTION">Section <span class="text-danger">*</span></label>
                        <select name="SECTION" id="SECTION" required="" class="form-control" onchange="getKODE_SUBSECTION(this.value);" data-parsley-required>
                            <option value="">Choose Section</option>
                            <?php
                            $stmj = GetQuery("select * from m_section where kode_divisi = '$DIVISI'");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $rowz["kode_section"]; ?>"
                                    <?php 
                                        if($SECTION == $rowz["kode_section"]) 
                                        { 
                                            echo "selected"; 
                                        } 
                                    ?>>
                                    <?php 
                                        echo $rowz["nama_section"]; 
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
                        <label for="SUBSECTION">Sub Section <span class="text-danger">*</span></label>
                        <select name="SUBSECTION" id="SUBSECTION" required="" class="form-control" onchange="getKODE_TEAM(this.value);" data-parsley-required>
                            <option value="">Choose Sub Section</option>
                            <?php
                            $stmj = GetQuery("select * from m_subsection where kode_section = '$SECTION'");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $rowz["kode_subsection"]; ?>"
                                    <?php 
                                        if($SUBSECTION == $rowz["kode_subsection"]) 
                                        { 
                                            echo "selected"; 
                                        } 
                                    ?>>
                                    <?php 
                                        echo $rowz["nama_subsection"]; 
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
                        <label for="TEAM">Team <span class="text-danger">*</span></label>
                        <select name="TEAM" id="TEAM" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Team</option>
                            <?php
                            $stmj = GetQuery("select * from m_team where kode_subsection = '$SUBSECTION'");
                            while ($rowz = $stmj->fetch(PDO::FETCH_ASSOC)) 
                            {
                                ?>
                                <option value="<?php echo $rowz["kode_team"]; ?>"
                                    <?php 
                                        if($TEAM == $rowz["kode_team"]) 
                                        { 
                                            echo "selected"; 
                                        } 
                                    ?>>
                                    <?php 
                                        echo $rowz["nama_team"]; 
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
                        <label for="UNIT">Unit Code <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" oninput="getMASTER_UNIT(this.value);" onkeypress="return event.keyCode!=13" class="form-control" id="UNIT" name="UNIT" value="<?php echo $UNIT; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="NAMAUNIT">Unit Name <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" class="form-control" id="NAMAUNIT" name="NAMAUNIT" value="<?php echo $NAMAUNIT; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save fa-lg"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_unit" type="button" class="btn btn-danger"><i class="fa fa-times fa-lg"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
