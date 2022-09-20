<script type="text/javascript">
$(document).ready(function(){
    $('button[type=submit]').on("click", function(){
        setTimeout(function () {
            $('button[type=submit]').prop('disabled', true);
            }, 0);
        setTimeout(function () {
            $('button[type=submit]').prop('disabled', false);
            }, 3000);
    });
});
</script>
<script>
$(document).ready(function () {
    $(".select2").select2({
        placeholder: " Choose Jam Kerja"
    });
});
</script>
<?php 
include "module/controller/ptk/t_ptk.php"; 
$munculin = "";
$dept     = $_SESSION["LOGINDEP_PERSONALIA_BB"];
$akses    = $_SESSION["LOGINAKS_PERSONALIA_BB"];
?>
<style>
hr { 
  display: block;
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  margin-left: auto;
  margin-right: auto;
  border-style: inset;
  border-width: 1px;
  color:black;
  background-color:black; 
}

.form-check{
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 13px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
} 

.form-check input{
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  border-style: solid;
  border-width: 1px;
  background-color: #eee;
}

.form-check:hover input ~ .checkmark {
  background-color: #53b6fc;
}

.form-check input:checked ~ .checkmark {
  background-color: #53b6fc;
}

.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

.form-check input:checked ~ .checkmark:after {
  display: block;
}

.form-check .checkmark:after {
  left: 8px;
  top: 2px;
  width: 8px;
  height: 13px;
  border: solid black;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
/*style table fas it*/
table.d {
  table-layout: fixed;
  width: 100%;  
}

.d .tesinput{
    display: block;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
         -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.d .tesinput:focus{
    border-color: #66afe9;
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
}
</style>

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

function getKODE_GRADE(val)
{
  $.ajax({
  type: "POST",
  url: "cek_level.php",
  data:'LEVEL='+val,
  success: function(data){
    $("#GRADE").html(data);
  }
  });
}

function CekTypePTK(TYPE_PTK)
{
    var noso = "";
    switch(TYPE_PTK)
    {
        case "Menambah Karyawan Baru" : 
        {
            noso = "<div class='col-md-4'> <div class='form-group'><label for='SO_NUMBER'>Nomer Usulan SO <span class='text-danger'>*</span></label><input  type='text' class='form-control' autocomplete='off' required='' id='SO_NUMBER' name='SO_NUMBER' value='<?php echo $SO_NUMBER; ?>' data-parsley-required> </div></div> <div class='col-md-4' id='UPLOAD'><div class='form-group'><label for='FILE'>Upload Scan Form Usulan SO <span class='text-danger'>*</span></label><br><input type='file' required='' id='FILE' name='FILE' data-parsley-required /> </div></div>";
        }
        break;
        default :noso = "";
    }
    document.getElementById('noso').innerHTML = noso;
}

function CekJumlah(GRADE)
{
    var QTY_SUBMITION = "";
    switch(GRADE)
    {
        case "grd-23" : 
        {
            document.getElementById('QTY_SUBMITION').readOnly = false;
        }
        break;
        default : document.getElementById('QTY_SUBMITION').readOnly = true;document.getElementById('QTY_SUBMITION').value = 1;
    }
    
}

function hitungJumlah() {
  var w    = 0;
  var text = '';
  var x = document.getElementById("QTY_SUBMITION").value;
  for(let i =0; i<x; i++){
    w = w+1;
    text += w+'. \n';
  }
  document.getElementById("EMPLOYEE_REMARK").value = text;
}

function getTYPE_WORKER(val)
{
  $.ajax({
  type: "POST",
  url: "cek_typeworker.php",
  data:'TYPE_WORKER='+val,
  success: function(data){
    $("#TYPE_APD").html(data);
  }
  });
}

function getWORK_LOCATION(val)
{
  $.ajax({
  type: "POST",
  url: "cek_worklocation.php",
  data:'TYPE_WORKER='+val,
  success: function(data){
    $("#WORK_LOCATION").html(data);
  }
  });
}

function getJAM_KERJA(val)
{
  $.ajax({
  type: "POST",
  url: "cek_jamkerja.php",
  data:'WORK_LOCATION='+val,
  success: function(data){
    $("#JAM_KERJA").html(data);
  }
  });
}

function getTYPE_PENGGAJIAN(val)
{
  $.ajax({
  type: "POST",
  url: "cek_typepenggajian.php",
  data:'PLACEMENT='+val,
  success: function(data){
    $("#TYPE_SALARY").html(data);
  }
  });
}

function getTYPE_MCU(val)
{
  $.ajax({
  type: "POST",
  url: "cek_typemcu.php",
  data:'BASED_SALARY='+val,
  success: function(data){
    $("#TYPE_MCU").html(data);
  }
  });
}

function getWORK_EXPERIENCE(val)
{
  $.ajax({
  type: "POST",
  url: "cek_workexperience.php",
  data:'GRADE='+val,
  success: function(data){
    $("#WORK_EXPERIENCE").html(data);
  }
  });
}

function getSHIFT(val)
{
  $.ajax({
  type: "POST",
  url: "cek_shift.php",
  data:'SHIFT='+val,
  success: function(data){
    $("#JAM_KERJA").html(data);
  }
  });
}

function itFas_komputer(val)
{
  var chkITFAC_PC = document.getElementById("ITFAC_PC"); 
  var inpITFAC_PC = document.getElementById("inpITFAC_PC");
  if(chkITFAC_PC.checked == true){inpITFAC_PC.style.display = "block";}else{inpITFAC_PC.style.display = "none";}
  
  var chkITFAC_LAPTOP = document.getElementById("ITFAC_LAPTOP"); 
  var inpITFAC_LAPTOP = document.getElementById("inpITFAC_LAPTOP");
  if(chkITFAC_LAPTOP.checked == true){inpITFAC_LAPTOP.style.display = "block";}else{inpITFAC_LAPTOP.style.display = "none";}

  var chkITFAC_EXTDISK = document.getElementById("ITFAC_EXTDISK"); 
  var inpITFAC_EXTDISK = document.getElementById("inpITFAC_EXTDISK");
  if(chkITFAC_EXTDISK.checked == true){inpITFAC_EXTDISK.style.display = "block";}else{inpITFAC_EXTDISK.style.display = "none";}

  var chkITFAC_MOBILEPHONE = document.getElementById("ITFAC_MOBILEPHONE"); 
  var inpITFAC_MOBILEPHONE = document.getElementById("inpITFAC_MOBILEPHONE");
  if(chkITFAC_MOBILEPHONE.checked == true){inpITFAC_MOBILEPHONE.style.display = "block";}else{inpITFAC_MOBILEPHONE.style.display = "none";}

  var chkITFAC_EMAIL = document.getElementById("ITFAC_EMAIL"); 
  var inpITFAC_EMAIL = document.getElementById("inpITFAC_EMAIL");
  if(chkITFAC_EMAIL.checked == true){inpITFAC_EMAIL.style.display = "block";}else{inpITFAC_EMAIL.style.display = "none";}

  var chkITFAC_FINGER_ACCESS = document.getElementById("ITFAC_FINGER_ACCESS"); 
  var inpITFAC_FINGER_ACCESS = document.getElementById("inpITFAC_FINGER_ACCESS");
  if(chkITFAC_FINGER_ACCESS.checked == true){inpITFAC_FINGER_ACCESS.style.display = "block";}else{inpITFAC_FINGER_ACCESS.style.display = "none";}

  var chkITFAC_FACEREC_ACCESS = document.getElementById("ITFAC_FACEREC_ACCESS"); 
  var inpITFAC_FACEREC_ACCESS = document.getElementById("inpITFAC_FACEREC_ACCESS");
  if(chkITFAC_FACEREC_ACCESS.checked == true){inpITFAC_FACEREC_ACCESS.style.display = "block";}else{inpITFAC_FACEREC_ACCESS.style.display = "none";}

  var chkITFAC_CCTV_ACCESS = document.getElementById("ITFAC_CCTV_ACCESS"); 
  var inpITFAC_CCTV_ACCESS = document.getElementById("inpITFAC_CCTV_ACCESS");
  if(chkITFAC_CCTV_ACCESS.checked == true){inpITFAC_CCTV_ACCESS.style.display = "block";}else{inpITFAC_CCTV_ACCESS.style.display = "none";}

  var chkITFAC_GPS_ACCESS = document.getElementById("ITFAC_GPS_ACCESS"); 
  var inpITFAC_GPS_ACCESS = document.getElementById("inpITFAC_GPS_ACCESS");
  if(chkITFAC_GPS_ACCESS.checked == true){inpITFAC_GPS_ACCESS.style.display = "block";}else{inpITFAC_GPS_ACCESS.style.display = "none";}

  var chkITFAC_VPN = document.getElementById("ITFAC_VPN"); 
  var inpITFAC_VPN = document.getElementById("inpITFAC_VPN");
  if(chkITFAC_VPN.checked == true){inpITFAC_VPN.style.display = "block";}else{inpITFAC_VPN.style.display = "none";}

  var chkITFAC_WIFI = document.getElementById("ITFAC_WIFI"); 
  var inpITFAC_WIFI = document.getElementById("inpITFAC_WIFI");
  if(chkITFAC_WIFI.checked == true){inpITFAC_WIFI.style.display = "block";}else{inpITFAC_WIFI.style.display = "none";}

  var chkITFAC_FILESERV = document.getElementById("ITFAC_FILESERV"); 
  var inpITFAC_FILESERV = document.getElementById("inpITFAC_FILESERV");
  if(chkITFAC_FILESERV.checked == true){inpITFAC_FILESERV.style.display = "block";}else{inpITFAC_FILESERV.style.display = "none";}

  var chkITFAC_ACTS = document.getElementById("ITFAC_ACTS"); 
  var inpITFAC_ACTS = document.getElementById("inpITFAC_ACTS");
  if(chkITFAC_ACTS.checked == true){inpITFAC_ACTS.style.display = "block";}else{inpITFAC_ACTS.style.display = "none";}

  var chkITFAC_HRMS = document.getElementById("ITFAC_HRMS"); 
  var inpITFAC_HRMS = document.getElementById("inpITFAC_HRMS");
  if(chkITFAC_HRMS.checked == true){inpITFAC_HRMS.style.display = "block";}else{inpITFAC_HRMS.style.display = "none";}

  var chkITFAC_CAS = document.getElementById("ITFAC_CAS"); 
  var inpITFAC_CAS = document.getElementById("inpITFAC_CAS");
  if(chkITFAC_CAS.checked == true){inpITFAC_CAS.style.display = "block";}else{inpITFAC_CAS.style.display = "none";}

  var chkITFAC_WEBBC = document.getElementById("ITFAC_WEBBC"); 
  var inpITFAC_WEBBC = document.getElementById("inpITFAC_WEBBC");
  if(chkITFAC_WEBBC.checked == true){inpITFAC_WEBBC.style.display = "block";}else{inpITFAC_WEBBC.style.display = "none";}

  var chkITFAC_TPB = document.getElementById("ITFAC_TPB"); 
  var inpITFAC_TPB = document.getElementById("inpITFAC_TPB");
  if(chkITFAC_TPB.checked == true){inpITFAC_TPB.style.display = "block";}else{inpITFAC_TPB.style.display = "none";}

  var chkITFAC_TICKETING = document.getElementById("ITFAC_TICKETING"); 
  var inpITFAC_TICKETING = document.getElementById("inpITFAC_TICKETING");
  if(chkITFAC_TICKETING.checked == true){inpITFAC_TICKETING.style.display = "block";}else{inpITFAC_TICKETING.style.display = "none";}

  var chkITFAC_PTK = document.getElementById("ITFAC_PTK"); 
  var inpITFAC_PTK = document.getElementById("inpITFAC_PTK");
  if(chkITFAC_PTK.checked == true){inpITFAC_PTK.style.display = "block";}else{inpITFAC_PTK.style.display = "none";}

  var chkITFAC_SHIPMENT = document.getElementById("ITFAC_SHIPMENT"); 
  var inpITFAC_SHIPMENT = document.getElementById("inpITFAC_SHIPMENT");
  if(chkITFAC_SHIPMENT.checked == true){inpITFAC_SHIPMENT.style.display = "block";}else{inpITFAC_SHIPMENT.style.display = "none";}

  var chkITFAC_SPEC = document.getElementById("ITFAC_SPEC"); 
  var inpITFAC_SPEC = document.getElementById("inpITFAC_SPEC");
  if(chkITFAC_SPEC.checked == true){inpITFAC_SPEC.style.display = "block";}else{inpITFAC_SPEC.style.display = "none";}

  var chkITFAC_RECRUITMENT = document.getElementById("ITFAC_RECRUITMENT"); 
  var inpITFAC_RECRUITMENT = document.getElementById("inpITFAC_RECRUITMENT");
  if(chkITFAC_RECRUITMENT.checked == true){inpITFAC_RECRUITMENT.style.display = "block";}else{inpITFAC_RECRUITMENT.style.display = "none";}

  var chkITFAC_VMS = document.getElementById("ITFAC_VMS"); 
  var inpITFAC_VMS = document.getElementById("inpITFAC_VMS");
  if(chkITFAC_VMS.checked == true){inpITFAC_VMS.style.display = "block";}else{inpITFAC_VMS.style.display = "none";}
}
</script>
<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-hand-holding-medical fa-lg"></i> Add New PTK</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li><a href="ptk"><i class="fas fa-hand-holding-medical"></i> PTK</a></li>
                <li class="active"><i class="ico-plus2"></i> Add PTK</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <form role="form" id="form" action="" method="post" enctype="multipart/form-data" data-parsley-validate>
            <div class="row">
                <div class="col-md-6" id="TR-DEPARTEMENT">
                    <div class="form-group">
                        <label for="DEPARTEMENT">Department <span class="text-danger">*</span></label>
                        <select name="DEPARTEMENT" id="DEPARTEMENT" required="" class="form-control" onchange="getKODE_DIVISI(this.value);"  data-parsley-required>
                            <option value="">Choose Department</option>
                            <?php
                            if($akses == "Administrator" or $akses == "MD")
                            {
                                $stmj = GetQuery("select * from m_departement order by nama_departement asc");
                            }
                            else //sesuai dept masing-masing user
                            {
                                $stmj = GetQuery("select * from m_departement where kode_departement = $dept order by nama_departement asc");
                            }
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
                                    <?php echo $rowz["nama_departement"]; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6" id="TR-DIVISI">
                    <div class="form-group">
                        <label for="DIVISI">Division <span class="text-danger">*</span> </label>
                        <select name="DIVISI" id="DIVISI" required="" class="form-control" onchange="getKODE_SECTION(this.value);" data-parsley-required title="Bergantung pada Department yang dipilih">
                            <option value="">Choose Division</option>
                            <?php
                                $results = getQuery("select * from m_divisi where kode_departement = '$DEPARTEMENT' order by nama_divisi asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["kode_divisi"]; ?>"
                                            <?php 
                                                if($DIVISI == $rowz["kode_divisi"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["nama_divisi"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"  id="TR-SECTION">
                    <div class="form-group">
                        <label for="SECTION">Section</label>
                        <select name="SECTION" id="SECTION" class="form-control" onchange="getKODE_SUBSECTION(this.value);" title="Bergantung pada Divisi yang dipilih">
                            <option value="-">Choose Section</option>
                            <?php
                                $results = getQuery("select * from m_section where kode_divisi = '$DIVISI' order by nama_section asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC))
                                {
                                    ?>
                                        <option value="<?php echo $rowz["kode_section"]; ?>"
                                            <?php 
                                                if($SECTION == $rowz["kode_section"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["nama_section"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6" id="TR-SUBSECTION">
                    <div class="form-group">
                        <label for="SUBSECTION">Sub Section</label>
                        <select name="SUBSECTION" id="SUBSECTION" class="form-control" onchange="getKODE_TEAM(this.value);" title="Bergantung pada Section yang dipilih">
                            <option value="-">Choose Sub Section</option>
                            <?php
                                $results = getQuery("select * from m_subsection where kode_section = '$SECTION' order by nama_subsection asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC))
                                {
                                    ?>
                                        <option value="<?php echo $rowz["kode_subsection"]; ?>"
                                            <?php 
                                                if($SUBSECTION == $rowz["kode_subsection"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["nama_subsection"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" id="TR-TEAM">
                    <div class="form-group">
                        <label for="TEAM">Team</label>
                        <select name="TEAM" id="TEAM" class="form-control" onchange="getKODE_UNIT(this.value);" title="Bergantung pada Sub Section yang dipilih">
                            <option value="-">Choose Team</option>
                            <?php
                                $results = getQuery("select * from m_team where kode_section = '$SECTION' order by nama_team asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["kode_team"]; ?>"
                                            <?php 
                                                if($TEAM == $rowz["kode_team"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["nama_team"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6" id="TR-UNIT">
                    <div class="form-group">
                        <label for="UNIT">Unit</label>
                        <select name="UNIT" id="UNIT" class="form-control" title="Bergantung pada Team yang dipilih">
                            <option value="-">Choose Unit</option>
                            <?php
                                $results = getQuery("select * from m_unit where kode_team = '$TEAM' order by nama_unit asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["kode_unit"]; ?>"
                                            <?php 
                                                if($UNIT == $rowz["kode_unit"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["nama_unit"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" id="TR-LEVEL">
                    <div class="form-group">
                        <label for="LEVEL">Level <span class="text-danger">*</span></label>
                        <select name="LEVEL" id="LEVEL" required="" class="form-control" onchange="getKODE_GRADE(this.value);" data-parsley-required>
                            <option value="">Choose Level</option>
                            <?php
                                $results = GetQuery("select * from m_level order by kode_level asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["kode_level"]; ?>" readonly
                                            <?php 
                                                if($LEVEL == $rowz["kode_level"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["nama_level"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6" id="TR-GRADE">
                    <div class="form-group">
                        <label for="GRADE">Grade <span class="text-danger">*</span></label>
                        <select name="GRADE" id="GRADE" required="" class="form-control" onchange="CekJumlah(this.value);getWORK_EXPERIENCE(this.value)" data-parsley-required title="Bergantung pada Level yang dipilih">
                            <option value="">Choose Grade</option>
                            <?php
                                $results = GetQuery("select * from m_grade where kode_level = '$LEVEL' order by kode_grade asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["kode_grade"]; ?>"
                                            <?php 
                                                if($GRADE == $rowz["kode_grade"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["nama_grade"]." ".$rowz["ket_grade"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <hr>  
            <br>
<!-- SPESIFIKASI PEKERJAAN -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="TYPE_PTK">Type PTK <span class="text-danger">*</span></label>
                        <select name="TYPE_PTK" id="TYPE_PTK" required="" class="form-control" data-parsley-required onchange="CekTypePTK(this.value)">
                            <option value="">Choose Type PTK</option>
                            <?php
                                $results = getQuery("select type_ptk from param where type_ptk != '' order by type_ptk asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    if  ($TYPE_PTK == "Menambah Karyawan Baru")
                                    {
                                        $munculin = "1";
                                    }
                                ?>
                                        <option value="<?php echo $rowz["type_ptk"]; ?>"
                                            <?php 
                                                if($TYPE_PTK == $rowz["type_ptk"]) 
                                                { 
                                                    echo "selected";
                                                } 
                                            ?>>
                                            <?php echo $rowz["type_ptk"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>    
                        </select>
                    </div>
                </div>

                <!-- MUNCUL PAS EDIT -->
                <div id="noso">
                     <?php
                        if ($munculin == "1")
                        { ?>
                           <div class= "col-md-4"> 
                             <div class="form-group">
                               <label for="SO_NUMBER">Nomer Usulan SO <span class="text-danger">*</span></label>
                               <input  type="text" class="form-control" autocomplete="off" required="" id="SO_NUMBER" name="SO_NUMBER" value="<?php echo $SO_NUMBER; ?>" data-parsley-required> 
                            </div> 
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                               <label for="FILE">Upload Scan Form Usulan SO <span class="text-danger">*</span></label>
                               <input type="file" required="" id="FILE" name="FILE" data-parsley-required/> 
                            </div>
                          </div>
                       <?php }
                    ?> 
                </div>
                <!-- MUNCUL PAS EDIT -->

            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="EDUCATION">Pendidikan <span class="text-danger">*</span></label>
                        <select name="EDUCATION" id="JENISPERUBAHAN" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Pendidikan</option>
                            <?php
                                $results = getQuery("select education from param where education != ''");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["education"]; ?>"
                                            <?php 
                                                if($EDUCATION == $rowz["education"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["education"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>    
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="MAJOR">Kualifikasi Jurusan <span class="text-danger">*</span></label>
                        <input type="input" autocomplete="off" required="" class="form-control" id="MAJOR" name="MAJOR" value="<?php echo $MAJOR; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="WORK_EXPERIENCE">Pengalaman Kerja (tahun) <span class="text-danger">*</span></label>
                        <select name="WORK_EXPERIENCE" id="WORK_EXPERIENCE" required="" class="form-control" data-parsley-required title="Bergantung pada Grade yang dipilih">
                            <option value="">Choose Work Experience</option>
                            <?php
                                $results = getQuery("select a.workexp_code,
                                                            a.workexp_name,
                                                            b.kode_grade
                                                       from m_workexperience a
                                                  left join m_grade b ON a.workexp_code = b.workexp_code
                                                      where b.kode_grade = '$GRADE'
                                                   order by a.workexp_code asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["workexp_code"]; ?>"
                                            <?php 
                                                if($WORK_EXPERIENCE == $rowz["workexp_code"]) 
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="QTY_SUBMITION">Jumlah Pengajuan <span class="text-danger">*</span></label>
                        <input type="number" min="0" autocomplete="off" required="" readonly oninput="hitungJumlah(this.value)" class="form-control" id="QTY_SUBMITION" name="QTY_SUBMITION" value="1" title="Hanya Level Operator Grade 8B2 yang bisa mengajukan lebih dari 1 orang">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="DATE_NEEDED">Tanggal Dibutuhkan <span class="text-danger">*</span></label>
                        <input type="date" autocomplete="off" required="" class="form-control" id="DATE_NEEDED" name="DATE_NEEDED" value="<?php echo $DATE_NEEDED; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="PLACEMENT">Penempatan Karyawan <span class="text-danger">*</span></label>
                        <select name="PLACEMENT" id="PLACEMENT" required="" onchange="getTYPE_PENGGAJIAN(this.value)" class="form-control" data-parsley-required>
                            <option value="">Choose Penempatan</option>
                            <?php
                                $results = getQuery("select * from m_placement order by placement_code asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["placement_code"]; ?>"
                                            <?php 
                                                if($PLACEMENT == $rowz["placement_code"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["placement_name"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>    
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="BASED_SALARY">Basis Penggajian <span class="text-danger">*</span></label>
                        <select name="BASED_SALARY" id="BASED_SALARY" required="" onchange="getTYPE_MCU(this.value)" class="form-control" data-parsley-required>
                            <option value="">Choose Basis Penggajian</option>
                            <?php
                                $results = getQuery("select * from m_basedsalary order by basedsalary_code asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["basedsalary_code"]; ?>"
                                            <?php 
                                                if($BASED_SALARY == $rowz["basedsalary_code"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["basedsalary_name"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>    
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="TYPE_SALARY">Type Penggajian <span class="text-danger">*</span></label>
                        <select name="TYPE_SALARY" id="TYPE_SALARY" required="" class="form-control" data-parsley-required title="Bergantung pada Penempatan Karyawan yang dipilih">
                            <option value="">Choose Type Penggajian</option>
                            <?php
                                $results = getQuery("select * from m_typesalary where placement_code = '$PLACEMENT' order by typesalary_code asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["typesalary_code"]; ?>"
                                            <?php 
                                                if($TYPE_SALARY == $rowz["typesalary_code"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["typesalary_name"]; ?>
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
                        <label for="TYPE_WORKER">Type Pekerja <span class="text-danger">*</span></label>
                        <select name="TYPE_WORKER" id="TYPE_WORKER" required="" class="form-control" onchange="getTYPE_WORKER(this.value);getWORK_LOCATION(this.value);" data-parsley-required>
                            <option value="">Choose Type Pekerja</option>
                            <?php
                                $results = getQuery("select * from m_typeworker order by worktype_code asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["worktype_code"]; ?>"
                                            <?php 
                                                if($TYPE_WORKER == $rowz["worktype_code"]) 
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="TYPE_APD">Type APD <span class="text-danger">*</span></label>
                        <select name="TYPE_APD" id="TYPE_APD" required="" readonly="" class="form-control" data-parsley-required title="Bergantung pada Type Pekerja yang dipilih"></select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="WORK_LOCATION">Lokasi Kerja <span class="text-danger">*</span></label>
                        <select name="WORK_LOCATION" id="WORK_LOCATION" required="" onchange="getJAM_KERJA(this.value)" class="form-control" data-parsley-required title="Bergantung pada Type Pekerja yang dipilih">
                            <option value="">Choose Lokasi Kerja</option>    
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <!-- <div class="col-md-4">
                    <div class="form-group">
                        <label for="TYPE_CONTRACT">Type Kontrak <span class="text-danger">*</span></label>
                        <select name="TYPE_CONTRACT" id="TYPE_CONTRACT" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Type Kontrak</option>
                            <?php
                                $results = getQuery("select type_contract from param where type_contract != '' order by type_contract asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["type_contract"]; ?>"
                                            <?php 
                                                if($TYPE_CONTRACT == $rowz["type_contract"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["type_contract"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>    
                        </select>
                    </div>
                </div> -->
                
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="TYPE_MCU">Type MCU <span class="text-danger">*</span></label>
                        <select name="TYPE_MCU" id="TYPE_MCU" required="" class="form-control" data-parsley-required title="Bergantung pada Basis Penggajian yang dipilih">
                        <option value="">Choose Type MCU</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="HARI_KERJA">Hari Kerja <span class="text-danger">*</span></label>
                        <select name="HARI_KERJA" id="HARI_KERJA" required="" class="form-control" data-parsley-required>
                            <option value="">Choose Hari Kerja</option>
                            <?php
                                $results = getQuery("select hari_kerja from param where hari_kerja != '' order by hari_kerja asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["hari_kerja"]; ?>"
                                            <?php 
                                                if($HARI_KERJA == $rowz["hari_kerja"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["hari_kerja"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>    
                        </select>
                    </div>
                </div>
                <!-- <div class="col-md-4">
                    <div class="form-group">
                        <label for="SHIFT">Shift <span class="text-danger">*</span></label>
                        <select name="SHIFT" id="SHIFT" required="" class="form-control" data-parsley-required style="height:3.5em">
                            <option value="">Choose Shift</option>
                            <?php
                                $results = getQuery("select * from m_shift order by shift_code asc");
                                while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    ?>
                                        <option value="<?php echo $rowz["shift_code"]; ?>"
                                            <?php 
                                                if($SHIFT == $rowz["shift_code"]) 
                                                { 
                                                    echo "selected"; 
                                                } 
                                            ?>>
                                            <?php echo $rowz["shift_name"]; ?>
                                        </option>
                                    <?php
                                }
                            ?>    
                        </select>
                    </div>
                </div> -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="JAM_KERJA">Jam Kerja <span class="text-danger">*</span> <i>(Bisa pilih lebih dari 1)</i></label>
                        <select class="form-control select2" multiple="multiple" id="JAM_KERJA" name="JAM_KERJA[]" title="Bergantung pada Lokasi Kerja yang dipilih">
                            <option value="">Choose Jam Kerja</option> 
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="ITFAC">Fasilitas IT ( centang kotak yang diperlukan ) <span class="text-danger">*</span></label>
                        <div class="container" style="border:1px solid #ced6d4;border-radius: 5px; width:100%; height: 15em; overflow-y: auto;">
                            <table class="d">
                                <tr>
                                    <td colspan="2">
                                        <b><i>&bull; Perangkat Keras / Hardware &bull;</i></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_PC" name="ITFAC_PC" <?php if($ITFAC_PC==1){echo "checked";} ?> /> PC / Komputer
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_PC" name="inpITFAC_PC" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas Komputer" style="width:100%;height: 50%;display: none;">
                                    </td>
                                <tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_LAPTOP" name="ITFAC_LAPTOP" <?php if($ITFAC_LAPTOP==1){echo "checked";} ?> /> Laptop
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_LAPTOP" name="inpITFAC_LAPTOP" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas Laptop" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_EXTDISK" name="ITFAC_EXTDISK" <?php if($ITFAC_EXTDISK==1){echo "checked";} ?> /> External Disk
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_EXTDISK" name="inpITFAC_EXTDISK" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas External Disk" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_MOBILEPHONE" name="ITFAC_MOBILEPHONE" <?php if($ITFAC_MOBILEPHONE==1){echo "checked";} ?> /> Mobile Phone
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_MOBILEPHONE" name="inpITFAC_MOBILEPHONE" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas Mobile Phone" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <hr>
                                <tr>
                                    <td colspan="2">
                                        <b><i>&bull; Perangkat Lunak / Software &bull;</i></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_EMAIL" name="ITFAC_EMAIL" <?php if($ITFAC_EMAIL==1){echo "checked";} ?> /> Email <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_EMAIL" name="inpITFAC_EMAIL" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas Email" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_FINGER_ACCESS" name="ITFAC_FINGER_ACCESS" <?php if($ITFAC_FINGER_ACCESS==1){echo "checked";} ?> /> Finger Access <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_FINGER_ACCESS" name="inpITFAC_FINGER_ACCESS" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas Finger Access" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_FACEREC_ACCESS" name="ITFAC_FACEREC_ACCESS" <?php if($ITFAC_FACEREC_ACCESS==1){echo "checked";} ?> /> Face Recognition Access <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_FACEREC_ACCESS" name="inpITFAC_FACEREC_ACCESS" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas Face Recognition Access" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_CCTV_ACCESS" name="ITFAC_CCTV_ACCESS" <?php if($ITFAC_CCTV_ACCESS==1){echo "checked";} ?> /> CCTV Access <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_CCTV_ACCESS" name="inpITFAC_CCTV_ACCESS" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas CCTV Access" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_GPS_ACCESS" name="ITFAC_GPS_ACCESS" <?php if($ITFAC_GPS_ACCESS==1){echo "checked";} ?> /> GPS Access <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_GPS_ACCESS" name="inpITFAC_GPS_ACCESS" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas GPS Access" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_VPN" name="ITFAC_VPN" <?php if($ITFAC_VPN==1){echo "checked";} ?> /> VPN <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_VPN" name="inpITFAC_VPN" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas VPN" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_WIFI" name="ITFAC_WIFI" <?php if($ITFAC_WIFI==1){echo "checked";} ?> /> Wifi <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_WIFI" name="inpITFAC_WIFI" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas Wifi" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_FILESERV" name="ITFAC_FILESERV" <?php if($ITFAC_FILESERV==1){echo "checked";} ?> /> File Server <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_FILESERV" name="inpITFAC_FILESERV" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas File Server" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_ACTS" name="ITFAC_ACTS" <?php if($ITFAC_ACTS==1){echo "checked";} ?> /> ACTS <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_ACTS" name="inpITFAC_ACTS" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas ACTS" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_HRMS" name="ITFAC_HRMS" <?php if($ITFAC_HRMS==1){echo "checked";} ?> /> HRMS <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_HRMS" name="inpITFAC_HRMS" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas HRMS" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_CAS" name="ITFAC_CAS" <?php if($ITFAC_CAS==1){echo "checked";} ?> /> CAS <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_CAS" name="inpITFAC_CAS" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas CAS" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_WEBBC" name="ITFAC_WEBBC" <?php if($ITFAC_WEBBC==1){echo "checked";} ?> /> Web BC <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_WEBBC" name="inpITFAC_WEBBC" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas Web BC" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_TPB" name="ITFAC_TPB" <?php if($ITFAC_TPB==1){echo "checked";} ?> /> TPB <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_TPB" name="inpITFAC_TPB" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas TPB" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_TICKETING" name="ITFAC_TICKETING" <?php if($ITFAC_TICKETING==1){echo "checked";} ?> /> Ticketing System / Maintenance Online <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_TICKETING" name="inpITFAC_TICKETING" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas Ticketing System / Maintenance Online" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_PTK" name="ITFAC_PTK" <?php if($ITFAC_PTK==1){echo "checked";} ?> /> PTK Online <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_PTK" name="inpITFAC_PTK" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas PTK Online" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_SHIPMENT" name="ITFAC_SHIPMENT" <?php if($ITFAC_SHIPMENT==1){echo "checked";} ?> /> Shipment Online <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_SHIPMENT" name="inpITFAC_SHIPMENT" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas Shipment Online" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_SPEC" name="ITFAC_SPEC" <?php if($ITFAC_SPEC==1){echo "checked";} ?> /> Spec Online <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_SPEC" name="inpITFAC_SPEC" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas Spec Online" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_RECRUITMENT" name="ITFAC_RECRUITMENT" <?php if($ITFAC_RECRUITMENT==1){echo "checked";} ?> /> Recruitment Online <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_RECRUITMENT" name="inpITFAC_RECRUITMENT" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas Recruitment Online" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" onclick="itFas_komputer()" id="ITFAC_VMS" name="ITFAC_VMS" <?php if($ITFAC_VMS==1){echo "checked";} ?> /> Visitor Management System <br />
                                    </td>
                                    <td>
                                        <input type="text" id="inpITFAC_VMS" name="inpITFAC_VMS" class="tesinput" autocomplete="off" placeholder="Keterangan Fasilitas Visitor Management System" style="width:100%;height: 50%;display: none;">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-4">
                    <div class="form-group">
                        <label for="ITFAC_REMARK">Keterangan Untuk Fasilitas IT</label><br>
                        <textarea class="form-control" id="ITFAC_REMARK" name="ITFAC_REMARK" placeholder="Contoh : 
                        Email : blablabla@megamarinepride.com
                        File Server : Folder Umum 0.1, Folder Umum 10.175" style="width:100%; height: 15em;"><?=$ITFAC_REMARK;?></textarea>
                    </div>
                </div> -->
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="EMPLOYEE_REMARK">List Karyawan Yang Resign / Mutasi / Demosi </label><br>
                        <textarea class="form-control" id="EMPLOYEE_REMARK" name="EMPLOYEE_REMARK" placeholder="Isikan ID dan Nama Karyawan Sejumlah Pengajuan Yang Dibuat" style="width:100%; height: 12em;"><?=$EMPLOYEE_REMARK;?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="KRITERIA">Kriteria <span class="text-danger">*</span></label><br>
                        <textarea class="form-control" required id="KRITERIA" name="KRITERIA" placeholder="Kriteria Yang Dibutuhkan" style="width:100%; height: 12em;"><?=$KRITERIA;?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="JOBDESC">Jobdesc <span class="text-danger">*</span></label><br>
                        <textarea class="form-control" required id="JOBDESC" name="JOBDESC" placeholder="Tugas Pokok" style="width:100%; height: 12em;"><?=$JOBDESC;?></textarea>
                    </div>
                </div>
            </div>
            <br><br>                   
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><i class="fas fa-info-circle fa-lg"></i> Information</div>
                        <div class="panel-body">
                             &bull; <b>Lapangan A</b> : Orang yang bekerja di area produksi . Operator yg bekerja di area ini adalah QC (QC line-Mgr), WHS Chemical Dalam, CS, All Admin Produksi, Asst.SPV - Mgr Produksi, Sanitasi Produksi.  <br>
                             &bull; <b>Lapangan B</b> : Orang yang bekerja di area luar produksi seperti Mekanik, Civil enginering, GA Sanitasi Luar, GA Pest Control, Lab Mikro, Lab Chemical, Lab RND, Limbah WTP. <br> 
                        </div>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" align="center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>&nbsp&nbsp&nbsp
                    <a href="ptk" type="button" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>