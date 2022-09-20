<?php
include "module/controller/master/user/t_user.php";
?>

<style type="text/css">
th, td 
{
padding: 4px;
}
</style>

<script type="text/javascript">
function getUSER(val) {
  $.ajax({
  type: "POST",
  url: "cek_user.php",
  data:'KODE_USER='+val,
  success: function(data){
    $("#DATA_USER").html(data);
  }
  });
}

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

function getMASTER_DIVISI(val) {
  $.ajax({
  type: "POST",
  url: "cek_m_divisi.php",
  data:'DIVISI='+val,
  success: function(data){
    $("#DATA_INFO").html(data);
  }
  });
}
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-user"></i> Edit User</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_user"><i class="fas fa-user"></i> User</a></li>
                <li class="active"><i class="ico-pencil"></i> Edit User</li>
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
                        <label for="USERNAME">Username <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" autofocus="" oninput="getUSER(this.value);" onkeypress="return event.keyCode!=13" class="form-control" id="USERNAME" name="USERNAME" value="<?php echo $USERNAME; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="NAMA">Employees Name <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" class="form-control" id="NAMA" name="NAMA" value="<?php echo $NAMA; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="AKSES">Departement <span class="text-danger">*</span></label>
                        <select name="DEPARTEMENT" id="DEPARTEMENT" required="" class="form-control" onchange="getKODE_DIVISI(this.value);"  data-parsley-required>
                            <option value="">Choose Department</option>
                            <?php
                            $stmj = GetQuery("select * from m_departement order by nama_departement asc");
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
                        <label for="AKSES">Access <span class="text-danger">*</span></label>
                        <select name="AKSES" id="AKSES" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Access</option>                            
                            <?php
                                $results = getQuery("select * from param where akses != '' order by akses asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["akses"]; ?>"
                                            <?php 
                                                if($AKSES == $rowz["akses"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["akses"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>    
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="EMAIL">Email <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" class="form-control" id="EMAIL" name="EMAIL" value="<?php echo $EMAIL; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="PTK_VIEW">PTK View Access<span class="text-danger">*</span></label>
                        <select name="PTK_VIEW" id="PTK_VIEW" required="" class="form-control" data-parsley-required>
                            <option value="">Choose View Access</option>                            
                            <?php
                                $results = getQuery("select * from param where ptk_view != ''");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["ptk_view"]; ?>"
                                            <?php 
                                                if($PTK_VIEW == $rowz["ptk_view"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["ptk_view"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>         
                        </select>
                    </div>
                </div>
                <?php
                if(isset($_GET["KODE"]))
                {
                ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="STATUS">Status<span class="text-danger">*</span></label>
                        <select name="STATUS" id="STATUS" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Status</option>                            
                            <?php
                                $results = getQuery("select * from param where status != ''");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["status"]; ?>"
                                            <?php 
                                                if($STATUS == $rowz["status"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["status"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>         
                        </select>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="MODULE">Module User <span class="text-danger">*</span></label>
                        <table border="1" style="border:1px solid #bfc1c0;width:100%; height: 100%;padding: auto;">
                            <tr align="center" style="background-color:#86C3D0;font-weight: bold;margin-left: auto;">
                                <td style="width:60%">Module</td>
                                <td style="width:10%">Create</td>
                                <td style="width:10%">Read</td>
                                <td style="width:10%">Update</td>
                                <td style="width:10%">Delete</td>
                            </tr>
                            <tr>
                                <td align="left">Master User</td>
                                <td align="center"><input type="checkbox" id="mod_muser_c" name="mod_muser_c" <?php if($mod_muser_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_muser_r" name="mod_muser_r" <?php if($mod_muser_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_muser_u" name="mod_muser_u" <?php if($mod_muser_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_muser_d" name="mod_muser_d" <?php if($mod_muser_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Company</td>
                                <td align="center"><input type="checkbox" id="mod_mperusahaan_c" name="mod_mperusahaan_c" <?php if($mod_mperusahaan_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mperusahaan_r" name="mod_mperusahaan_r" <?php if($mod_mperusahaan_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mperusahaan_u" name="mod_mperusahaan_u" <?php if($mod_mperusahaan_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mperusahaan_d" name="mod_mperusahaan_d" <?php if($mod_mperusahaan_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Department</td>
                                <td align="center"><input type="checkbox" id="mod_mdept_c" name="mod_mdept_c" <?php if($mod_mdept_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mdept_r" name="mod_mdept_r" <?php if($mod_mdept_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mdept_u" name="mod_mdept_u" <?php if($mod_mdept_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mdept_d" name="mod_mdept_d" <?php if($mod_mdept_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Division</td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_c" name="mod_mdiv_c" <?php if($mod_mdiv_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_r" name="mod_mdiv_r" <?php if($mod_mdiv_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_u" name="mod_mdiv_u" <?php if($mod_mdiv_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_d" name="mod_mdiv_d" <?php if($mod_mdiv_d==1){echo "checked";} ?>></td>
                            </tr>
                            <!-- <tr>
                                <td align="left">Master Sub Divisi</td>
                                <td align="center"><input type="checkbox" id="mod_msubdiv_c" name="mod_msubdiv_c" <?php if($mod_msubdiv_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_msubdiv_r" name="mod_msubdiv_r" <?php if($mod_msubdiv_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_msubdiv_u" name="mod_msubdiv_u" <?php if($mod_msubdiv_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_msubdiv_d" name="mod_msubdiv_d" <?php if($mod_msubdiv_d==1){echo "checked";} ?>></td>
                            </tr> -->
                            <tr>
                                <td align="left">Master Section</td>
                                <td align="center"><input type="checkbox" id="mod_msec_c" name="mod_msec_c" <?php if($mod_msec_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_msec_r" name="mod_msec_r" <?php if($mod_msec_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_msec_u" name="mod_msec_u" <?php if($mod_msec_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_msec_d" name="mod_msec_d" <?php if($mod_msec_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Sub Section</td>
                                <td align="center"><input type="checkbox" id="mod_msubsec_c" name="mod_msubsec_c" <?php if($mod_msubsec_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_msubsec_r" name="mod_msubsec_r" <?php if($mod_msubsec_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_msubsec_u" name="mod_msubsec_u" <?php if($mod_msubsec_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_msubsec_d" name="mod_msubsec_d" <?php if($mod_msubsec_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Team</td>
                                <td align="center"><input type="checkbox" id="mod_mteam_c" name="mod_mteam_c" <?php if($mod_mteam_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mteam_r" name="mod_mteam_r" <?php if($mod_mteam_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mteam_u" name="mod_mteam_u" <?php if($mod_mteam_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mteam_d" name="mod_mteam_d" <?php if($mod_mteam_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Unit</td>
                                <td align="center"><input type="checkbox" id="mod_munit_c" name="mod_munit_c" <?php if($mod_munit_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_munit_r" name="mod_munit_r" <?php if($mod_munit_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_munit_u" name="mod_munit_u" <?php if($mod_munit_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_munit_d" name="mod_munit_d" <?php if($mod_munit_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Grade</td>
                                <td align="center"><input type="checkbox" id="mod_mgrade_c" name="mod_mgrade_c" <?php if($mod_mgrade_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mgrade_r" name="mod_mgrade_r" <?php if($mod_mgrade_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mgrade_u" name="mod_mgrade_u" <?php if($mod_mgrade_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mgrade_d" name="mod_mgrade_d" <?php if($mod_mgrade_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Level</td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_c" name="mod_mlevel_c" <?php if($mod_mlevel_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_r" name="mod_mlevel_r" <?php if($mod_mlevel_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_u" name="mod_mlevel_u" <?php if($mod_mlevel_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_d" name="mod_mlevel_d" <?php if($mod_mlevel_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Work Location</td>
                                <td align="center"><input type="checkbox" id="mod_mworklocation_c" name="mod_mworklocation_c" <?php if($mod_mworklocation_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mworklocation_r" name="mod_mworklocation_r" <?php if($mod_mworklocation_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mworklocation_u" name="mod_mworklocation_u" <?php if($mod_mworklocation_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mworklocation_d" name="mod_mworklocation_d" <?php if($mod_mworklocation_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Work Experience</td>
                                <td align="center"><input type="checkbox" id="mod_mworkexp_c" name="mod_mworkexp_c" <?php if($mod_mworkexp_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mworkexp_r" name="mod_mworkexp_r" <?php if($mod_mworkexp_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mworkexp_u" name="mod_mworkexp_u" <?php if($mod_mworkexp_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mworkexp_d" name="mod_mworkexp_d" <?php if($mod_mworkexp_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Shift</td>
                                <td align="center"><input type="checkbox" id="mod_mshift_c" name="mod_mshift_c" <?php if($mod_mshift_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mshift_r" name="mod_mshift_r" <?php if($mod_mshift_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mshift_u" name="mod_mshift_u" <?php if($mod_mshift_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mshift_d" name="mod_mshift_d" <?php if($mod_mshift_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Jam Kerja</td>
                                <td align="center"><input type="checkbox" id="mod_mjamkerja_c" name="mod_mjamkerja_c" <?php if($mod_mjamkerja_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mjamkerja_r" name="mod_mjamkerja_r" <?php if($mod_mjamkerja_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mjamkerja_u" name="mod_mjamkerja_u" <?php if($mod_mjamkerja_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mjamkerja_d" name="mod_mjamkerja_d" <?php if($mod_mjamkerja_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Placement</td>
                                <td align="center"><input type="checkbox" id="mod_mplacement_c" name="mod_mplacement_c" <?php if($mod_mplacement_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mplacement_r" name="mod_mplacement_r" <?php if($mod_mplacement_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mplacement_u" name="mod_mplacement_u" <?php if($mod_mplacement_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mplacement_d" name="mod_mplacement_d" <?php if($mod_mplacement_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Master Type Salary</td>
                                <td align="center"><input type="checkbox" id="mod_mtypesalary_c" name="mod_mtypesalary_c" <?php if($mod_mtypesalary_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mtypesalary_r" name="mod_mtypesalary_r" <?php if($mod_mtypesalary_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mtypesalary_u" name="mod_mtypesalary_u" <?php if($mod_mtypesalary_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_mtypesalary_d" name="mod_mtypesalary_d" <?php if($mod_mtypesalary_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="5" style="background-color:#C9DEE6;"></td>                                
                            </tr>
                            <tr>
                                <td align="left">PTK</td>
                                <td align="center"><input type="checkbox" id="mod_ptk_c" name="mod_ptk_c" <?php if($mod_ptk_c==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_ptk_r" name="mod_ptk_r" <?php if($mod_ptk_r==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_ptk_u" name="mod_ptk_u" <?php if($mod_ptk_u==1){echo "checked";} ?>></td>
                                <td align="center"><input type="checkbox" id="mod_ptk_d" name="mod_ptk_d" <?php if($mod_ptk_d==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Approval Manager</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_appmgr" name="mod_appmgr" <?php if($mod_appmgr==1){echo "checked";} ?>></td>                                
                            </tr>
                            <tr>
                                <td align="left">Approval Director</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_appdir" name="mod_appdir" <?php if($mod_appdir==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Approval HRD</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_apphrd" name="mod_apphrd" <?php if($mod_apphrd==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Approval Managing Director</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_appmd" name="mod_appmd" <?php if($mod_appmd==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Pemenuhan PTK</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_pemenuhanptk" name="mod_pemenuhanptk" <?php if($mod_pemenuhanptk==1){echo "checked";} ?>></td>
                            </tr>
                            <tr>
                                <td align="left">Report PTK</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_laporanptk" name="mod_laporanptk" <?php if($mod_laporanptk==1){echo "checked";} ?>></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fas fa-save fa-lg"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="m_user" type="button" class="btn btn-danger"><i class="fas fa-times fa-lg"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
