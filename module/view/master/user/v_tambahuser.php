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
        <h4 class="title semibold"><i class="fas fa-user"></i> Add User</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="m_user"><i class="fas fa-user"></i> User</a></li>
                <li class="active"><i class="ico-plus2"></i> Add User</li>
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
                        <input type="text" autocomplete="off" required="" oninput="getUSER(this.value);" onkeypress="return event.keyCode!=13" class="form-control" id="USERNAME" name="USERNAME" value="<?php echo $USERNAME; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="PASSWORD">Password <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" required="" class="form-control" id="PASSWORD" name="PASSWORD" value="<?php echo $PASSWORD; ?>">
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
                        <label for="AKSES">Department <span class="text-danger">*</span></label>
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
            </div>
            <br>
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
                                <td align="center"><input type="checkbox" id="mod_muser_c" name="mod_muser_c"></td>
                                <td align="center"><input type="checkbox" id="mod_muser_r" name="mod_muser_r"></td>
                                <td align="center"><input type="checkbox" id="mod_muser_u" name="mod_muser_u"></td>
                                <td align="center"><input type="checkbox" id="mod_muser_d" name="mod_muser_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Company</td>
                                <td align="center"><input type="checkbox" id="mod_mperusahaan_c" name="mod_mperusahaan_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mperusahaan_r" name="mod_mperusahaan_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mperusahaan_u" name="mod_mperusahaan_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mperusahaan_d" name="mod_mperusahaan_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Department</td>
                                <td align="center"><input type="checkbox" id="mod_mdept_c" name="mod_mdept_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mdept_r" name="mod_mdept_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mdept_u" name="mod_mdept_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mdept_d" name="mod_mdept_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Division</td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_c" name="mod_mdiv_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_r" name="mod_mdiv_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_u" name="mod_mdiv_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mdiv_d" name="mod_mdiv_d"></td>
                            </tr>
                            <!-- <tr>
                                <td align="left">Master Sub Divisi</td>
                                <td align="center"><input type="checkbox" id="mod_msubdiv_c" name="mod_msubdiv_c"></td>
                                <td align="center"><input type="checkbox" id="mod_msubdiv_r" name="mod_msubdiv_r"></td>
                                <td align="center"><input type="checkbox" id="mod_msubdiv_u" name="mod_msubdiv_u"></td>
                                <td align="center"><input type="checkbox" id="mod_msubdiv_d" name="mod_msubdiv_d"></td>
                            </tr> -->
                            <tr>
                                <td align="left">Master Section</td>
                                <td align="center"><input type="checkbox" id="mod_msec_c" name="mod_msec_c"></td>
                                <td align="center"><input type="checkbox" id="mod_msec_r" name="mod_msec_r"></td>
                                <td align="center"><input type="checkbox" id="mod_msec_u" name="mod_msec_u"></td>
                                <td align="center"><input type="checkbox" id="mod_msec_d" name="mod_msec_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Sub Section</td>
                                <td align="center"><input type="checkbox" id="mod_msubsec_c" name="mod_msubsec_c"></td>
                                <td align="center"><input type="checkbox" id="mod_msubsec_r" name="mod_msubsec_r"></td>
                                <td align="center"><input type="checkbox" id="mod_msubsec_u" name="mod_msubsec_u"></td>
                                <td align="center"><input type="checkbox" id="mod_msubsec_d" name="mod_msubsec_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Team</td>
                                <td align="center"><input type="checkbox" id="mod_mteam_c" name="mod_mteam_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mteam_r" name="mod_mteam_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mteam_u" name="mod_mteam_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mteam_d" name="mod_mteam_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Unit</td>
                                <td align="center"><input type="checkbox" id="mod_munit_c" name="mod_munit_c"></td>
                                <td align="center"><input type="checkbox" id="mod_munit_r" name="mod_munit_r"></td>
                                <td align="center"><input type="checkbox" id="mod_munit_u" name="mod_munit_u"></td>
                                <td align="center"><input type="checkbox" id="mod_munit_d" name="mod_munit_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Grade</td>
                                <td align="center"><input type="checkbox" id="mod_mgrade_c" name="mod_mgrade_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mgrade_r" name="mod_mgrade_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mgrade_u" name="mod_mgrade_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mgrade_d" name="mod_mgrade_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Level</td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_c" name="mod_mlevel_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_r" name="mod_mlevel_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_u" name="mod_mlevel_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mlevel_d" name="mod_mlevel_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Work Location</td>
                                <td align="center"><input type="checkbox" id="mod_mworklocation_c" name="mod_mworklocation_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mworklocation_r" name="mod_mworklocation_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mworklocation_u" name="mod_mworklocation_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mworklocation_d" name="mod_mworklocation_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Work Experience</td>
                                <td align="center"><input type="checkbox" id="mod_mworkexp_c" name="mod_mworkexp_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mworkexp_r" name="mod_mworkexp_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mworkexp_u" name="mod_mworkexp_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mworkexp_d" name="mod_mworkexp_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Shift</td>
                                <td align="center"><input type="checkbox" id="mod_mshift_c" name="mod_mshift_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mshift_r" name="mod_mshift_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mshift_u" name="mod_mshift_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mshift_d" name="mod_mshift_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Jam Kerja</td>
                                <td align="center"><input type="checkbox" id="mod_mjamkerja_c" name="mod_mjamkerja_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mjamkerja_r" name="mod_mjamkerja_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mjamkerja_u" name="mod_mjamkerja_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mjamkerja_d" name="mod_mjamkerja_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Placement</td>
                                <td align="center"><input type="checkbox" id="mod_mplacement_c" name="mod_mplacement_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mplacement_r" name="mod_mplacement_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mplacement_u" name="mod_mplacement_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mplacement_d" name="mod_mplacement_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Master Type Salary</td>
                                <td align="center"><input type="checkbox" id="mod_mtypesalary_c" name="mod_mtypesalary_c"></td>
                                <td align="center"><input type="checkbox" id="mod_mtypesalary_r" name="mod_mtypesalary_r"></td>
                                <td align="center"><input type="checkbox" id="mod_mtypesalary_u" name="mod_mtypesalary_u"></td>
                                <td align="center"><input type="checkbox" id="mod_mtypesalary_d" name="mod_mtypesalary_d"></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="5" style="background-color:#C9DEE6;"></td>                                
                            </tr>
                            <tr>
                                <td align="left">PTK</td>
                                <td align="center"><input type="checkbox" id="mod_ptk_c" name="mod_ptk_c"></td>
                                <td align="center"><input type="checkbox" id="mod_ptk_r" name="mod_ptk_r"></td>
                                <td align="center"><input type="checkbox" id="mod_ptk_u" name="mod_ptk_u"></td>
                                <td align="center"><input type="checkbox" id="mod_ptk_d" name="mod_ptk_d"></td>
                            </tr>
                            <tr>
                                <td align="left">Approval Manager</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_appmgr" name="mod_appmgr"></td>                                
                            </tr>
                            <tr>
                                <td align="left">Approval Director</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_appdir" name="mod_appdir"></td>
                            </tr>
                            <tr>
                                <td align="left">Approval HRD</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_apphrd" name="mod_apphrd"></td>
                            </tr>
                            <tr>
                                <td align="left">Approval Managing Director</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_appmd" name="mod_appmd"></td>
                            </tr>
                            <tr>
                                <td align="left">Pemenuhan PTK</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_pemenuhanptk" name="mod_pemenuhanptk"></td>
                            </tr>
                            <tr>
                                <td align="left">Report PTK</td>
                                <td align="center" colspan="4"><input type="checkbox" id="mod_laporanptk" name="mod_laporanptk"></td>
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
