<?php
include "module/controller/master/perusahaan/t_perusahaan.php";
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

function getMASTER_PERUSAHAAN(val) {
  $.ajax({
  type: "POST",
  url: "cek_m_perusahaan.php",
  data:'PERUSAHAAN='+val,
  success: function(data){
    $("#DATA_INFO").html(data);
  }
  });
}
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-building"></i> Edit Company</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_perusahaan"><i class="fas fa-building"></i> Company</a></li>
                <li class="active"><i class="ico-pencil"></i> Edit Company</li>
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
                        <label for="PERUSAHAAN">Company Code <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" autofocus="" oninput="getMASTER_PERUSAHAAN(this.value);" onkeypress="return event.keyCode!=13" class="form-control" id="PERUSAHAAN" name="PERUSAHAAN" value="<?php echo $PERUSAHAAN; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="NAMAPERUSAHAAN">Company Name <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" class="form-control" id="NAMAPERUSAHAAN" name="NAMAPERUSAHAAN" value="<?php echo $NAMAPERUSAHAAN; ?>">
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
