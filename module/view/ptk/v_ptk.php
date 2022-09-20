<style>
    #bergaris tr:nth-child(even) 
    {
        background-color: #ebeff2;
    }
</style>

<script type="text/javascript">
// order data dari query
$(document).ready(function() {
    $('#tes').DataTable( {
        "order": [[ 2, "desc" ]]
    });
    //Modal Form Pemenuhan
    $("#form-pemenuhan").submit(function (event) {
        var formData = {
            seq: $("#seq-ptk").val(),
            date_accepted: $("#date_accepted").val(),
            id_accepted: $("#id_accepted").val(),
            name_accepted: $("#name_accepted").val(),
            gender: $("#gender").val(),
        };

        $.ajax({
            type: "POST",
            url: "pemenuhan.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (data.success == true && data.seq != false) {
                $.ajax({
                    type: "POST",
                    url: "cek_pemenuhan.php",
                    data:'seq='+data.seq,
                    success: function(data){
                        $("#PEMENUHAN").html(data);
                    }
                }).done(function (res){
                  $.ajax({
                    type: "POST",
                    url: "sendEmail.php",
                    data: "seq="+data.seq,
                    encode: true
                  }).done(function (res){
                    if (res.success){
                        console.log(res.message);
                    }
                  }).fail(function(xhr, status, error){
                    console.log(error);
                  })
                });
            } else {
                alert(data.message);
            }
        }).fail(function(xhr, status, error) {
            alert("Save Failed Server Error");
        });

    event.preventDefault();
  });
});


function getPEMENUHAN(val)
    {
    $.ajax({
    type: "POST",
    url: "cek_pemenuhan.php",
    data:'seq='+val,
    success: function(data){
        $("#PEMENUHAN").html(data);
    }
    });
}


</script>

<?php
$ID_USER1     = $_SESSION["LOGINIDUS_PERSONALIA"];
$dept         = $_SESSION["LOGINDEP_PERSONALIA"];
$div          = $_SESSION["LOGINDIV_PERSONALIA"]; 
$akses        = $_SESSION["LOGINAKS_PERSONALIA"];
$ptk_view     = $_SESSION["LOGINPTKVIEW_PERSONALIA"];
$where_clause = "";
$where_clause_deleted = "";

// -------------------------------------------------------------------------------------------------------------------------------

//last month PTK view
$query_LM = getQuery("select lastmonth_ptkview from param where lastmonth_ptkview != ''");
while ($row_LM = $query_LM->fetch(PDO::FETCH_ASSOC)) 
{
    $LM = $row_LM["lastmonth_ptkview"];
}

// -------------------------------------------------------------------------------------------------------------------------------

//filter akses ptk view and deleted ptk
if($ptk_view == "All")
{
    $where_clause = "";
}
else if($ptk_view == "Departement")
{
    $where_clause = "and b.kode_departement = '$dept' OR c.head = '$ID_USER1'";
    $where_clause_deleted = "and (a.kode_departement = '$dept' OR b.head = '$ID_USER1')";
}
else
{
    $where_clause = "and b.kode_divisi = '$div' OR d.head = '$ID_USER1'";
    $where_clause_deleted = "and (a.kode_divisi = '$div' OR c.head = '$ID_USER1')";
}

// -------------------------------------------------------------------------------------------------------------------------------

//filter akses approval MGR
$query_mgr       = getQuery("select * from m_usermodule where kode_user = '$ID_USER1' and id_module = '14' and xcreate = '1'");
$akses_app_mgr   = $query_mgr->rowCount();

//filter akses approval DIR
$query_dir       = getQuery("select * from m_usermodule where kode_user = '$ID_USER1' and id_module = '15' and xcreate = '1'");
$akses_app_dir   = $query_dir->rowCount();

//filter akses approval HRD
$query_hrd       = getQuery("select * from m_usermodule where kode_user = '$ID_USER1' and id_module = '16' and xcreate = '1'");
$akses_app_hrd   = $query_hrd->rowCount();

//filter akses approval MD
$query_md        = getQuery("select * from m_usermodule where kode_user = '$ID_USER1' and id_module = '17' and xcreate = '1'");
$akses_app_md    = $query_md->rowCount();

//filter akses pemenuhan PTK
$query_pemenuhan = getQuery("select * from m_usermodule where kode_user = '$ID_USER1' and id_module = '18' and xcreate = '1'");
$akses_pemenuhan = $query_pemenuhan->rowCount();
// -------------------------------------------------------------------------------------------------------------------------------

// CEK APAKAH USER APPROVAL DIR == USER APPROVAL MD -> BU HISAKO & PAK RACHMAT
$querymd = $db1->prepare("select count(kode_user) as betul from m_user where akses = 'MD' and status='aktif' and kode_user = '$ID_USER1'");
$querymd->execute();
while ($row_querymd = $querymd->fetch(PDO::FETCH_ASSOC))
{
    $BETUL = $row_querymd["betul"];
}
// -------------------------------------------------------------------------------------------------------------------------------
?>

<div class="page-header page-header-block">
    <div class="page-header-section">
        <h4 class="title semibold"><i class="fas fa-hand-holding-medical fa-lg"></i> Permintaan Tenaga Kerja (PTK)</h4>
    </div>
    <div class="page-header-section">
        <div class="toolbar">
            <ol class="breadcrumb breadcrumb-transparent nm">
                <li><a href="menuutama"><i class="ico-home2"></i> Dashboard</a></li>
                <li class="active"><i class="fas fa-hand-holding-medical"></i> PTK</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12" align="center">
        <?php
        if($create_ptk == 1)
        {
        ?>
        <a href="tambah_ptk" type="button" class="btn btn-success"><i class="ico-plus2"></i> Add New PTK</a>
        <?php
        }
        ?>
        <button accesskey="d" data-toggle="modal" data-target="#modalDeleted" type="button" class="btn btn-danger"><i class="fas fa-exclamation-triangle"></i> <u>D</u>eleted PTK</button>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">PTK List</h3>
            </div>
            <!-- <table class="table table-striped table-bordered" id="table-tools"> -->
            <table class="table table-striped table-bordered" id="tes">
                <thead>
                    <tr>
                        <th style="white-space:nowrap">Option</th>
                        <th style="white-space:nowrap">PTK Code</th>
                        <th style="white-space:nowrap">Input Date</th>
                        <th style="white-space:nowrap">Dept</th>
                        <th style="white-space:nowrap">Div</th>
                        <th style="white-space:nowrap">Sec</th>
                        <th style="white-space:nowrap">SubSec</th>
                        <th style="white-space:nowrap">Level</th>
                        <th style="white-space:nowrap">Grade</th>
                        <th style="white-space:nowrap">Qty</th>
                        <th style="white-space:nowrap">App Manager</th>
                        <th style="white-space:nowrap">App Director</th>
                        <th style="white-space:nowrap">App HRD</th>
                        <th style="white-space:nowrap">App MD</th>
                        <th style="white-space:nowrap">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $result = getQuery("select  b.*,
                                            date_format(b.date_ptk, '%d %b %Y') as date_ptk,
                                            date_format(b.date_needed, '%d %b %Y') as date_needed,
                                            date_format(b.created_date, '%d %b %Y - %H:%i:%s') as created_date,
                                            date_format(b.app_mgr_date, '%d %b %Y') as app_mgr_date,
                                            date_format(b.app_dir_date, '%d %b %Y') as app_dir_date,
                                            date_format(b.app_hrd_date, '%d %b %Y') as app_hrd_date,
                                            date_format(b.app_md_date, '%d %b %Y') as app_md_date,
                                            c.nama_departement,
                                            c.head as head_dept,
                                            d.nama_divisi,
                                            d.head as head_div,
                                            f.nama_section,
                                            g.nama_subsection,
                                            h.nama_team,
                                            i.nama_unit,
                                            j.nama_level,
                                            k.nama_grade,
                                            k.ket_grade,
                                            l.nama_user,
                                            m.worktype_name as type_worker,
                                            n.worktype_name as type_apd,
                                            o.nama as work_location,
                                            p.workexp_name as work_experience,
                                            GROUP_CONCAT(q.jamkerja_name) AS jam_kerja,
                                            r.placement_name as placement,
                                            s.typesalary_name as type_salary,
                                            t.basedsalary_name as based_salary,
                                            u.mcu_name as type_mcu
                                       from t_ptk b
                                  LEFT JOIN m_departement c ON b.kode_departement = c.kode_departement
                                  LEFT JOIN m_divisi d ON b.kode_divisi = d.kode_divisi
                                  LEFT JOIN m_section f ON b.kode_section = f.kode_section
                                  LEFT JOIN m_subsection g ON b.kode_subsection = g.kode_subsection
                                  LEFT JOIN m_team h ON b.kode_team = h.kode_team
                                  LEFT JOIN m_unit i ON b.kode_unit = i.kode_unit
                                  LEFT JOIN m_level j ON b.kode_level = j.kode_level
                                  LEFT JOIN m_grade k ON b.kode_grade = k.kode_grade
                                  LEFT JOIN m_user l ON b.created_by = l.kode_user
                                  LEFT JOIN m_typeworker m ON b.type_worker = m.worktype_code
                                  LEFT JOIN m_typeworker n ON b.type_apd = n.worktype_code
                                  LEFT JOIN m_worklocation o ON b.work_location = o.seq
                                  LEFT JOIN m_workexperience p ON b.work_experience = p.workexp_code
                                  LEFT JOIN m_jamkerja q ON b.jam_kerja LIKE CONCAT('%',q.jamkerja_code,'%')
                                  LEFT JOIN m_placement r ON b.placement = r.placement_code
                                  LEFT JOIN m_typesalary s ON b.type_salary = s.typesalary_code
                                  LEFT JOIN m_basedsalary t ON b.based_salary = t.basedsalary_code
                                  LEFT JOIN m_typemcu u ON b.type_mcu = u.mcu_code
                                  where b.status_hapus = '0' and
                                        b.complete_date is null and
                                        TIMESTAMPDIFF(MONTH, b.date_ptk, NOW()) <= '$LM'
                                        $where_clause
                               group by b.seq, b.jam_kerja
                               order by b.created_date desc");

                    //jika user memiliki akses ke module read ptk
                    if($read_ptk == 1)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC))
                        {
                            ?>
                            <tr>
                                <?php
                                if ($akses == "Administrator" or $row["created_by"] == $ID_USER1 or $_SESSION["LOGINAKS_PERSONALIA"] == "MD")
                                {
                                ?>
                                <td align="center" style="white-space:nowrap">
                                    <?php
                                    if($update_ptk == 1)
                                    {
                                    ?>
                                        <a href="edit_ptk?seq=<?php echo $row["seq"]; ?>" class="btn btn-teal" title="Edit"><i class="fas fa-pencil-alt"></i></i></a>
                                    <?php 
                                    } 
                                    if($delete_ptk == 1)
                                    {
                                    ?>
                                        <a href="hapus_ptk?seq=<?php echo $row["seq"]; ?>" class="btn btn-danger" title="Delete" onclick="return confirm('Delete this PTK ?')"><i class="fas fa-trash"></i></a>
                                    <?php 
                                    } 
                                    ?>
                                        <button data-toggle="modal" data-target="#modalDetail" class="btn btn-success open-detail" title="Detail"
                                        data-seq="<?=$row['seq'];?>" data-created_by="<?=$row['nama_user'];?>" data-created_date="<?=$row['created_date'];?>"
                                        data-nama_department="<?=$row['nama_departement'];?>" data-nama_divisi="<?=$row['nama_divisi'];?>" data-nama_section="<?=$row['nama_section'];?>" data-nama_subsection="<?=$row['nama_subsection'];?>" data-nama_team="<?=$row['nama_team'];?>" data-nama_unit="<?=$row['nama_unit'];?>" data-nama_grade="<?=$row['nama_grade'].' '.$row['ket_grade'];?>" data-nama_level="<?=$row['nama_level'];?>"

                                        data-type_ptk="<?=$row['type_ptk'];?>" data-so_number ="<?=$row['so_number'];?>" data-file ="<?=$row['file'];?>" data-education="<?=$row['education'];?>" data-major="<?=$row['major'];?>" data-work_experience ="<?=$row['work_experience'];?>" data-qty_submition="<?=$row['qty_submition'];?>" data-date_needed="<?=$row['date_needed'];?>" data-placement="<?=$row['placement'];?>" data-based_salary="<?=$row['based_salary'];?>" data-type_salary="<?=$row['type_salary'];?>" data-type_contract="<?=$row['type_contract'];?>" data-type_worker="<?=$row['type_worker'];?>" data-work_location="<?=$row['work_location'];?>" data-type_apd="<?=$row['type_apd'];?>" data-type_mcu="<?=$row['type_mcu'];?>"  data-hari_kerja="<?=$row['hari_kerja'];?>"  data-jam_kerja="<?=$row['jam_kerja'];?>" data-employee_remark="<?=$row['employee_remark'];?>" data-kriteria="<?=$row['kriteria'];?>" data-jobdesc="<?=$row['jobdesc'];?>"
                                        data-itfac_pc="<?=$row['itfac_pc'];?>" data-inpitfac_pc="<?=$row['inpitfac_pc'];?>" data-itfac_laptop="<?=$row['itfac_laptop'];?>" data-inpitfac_laptop="<?=$row['inpitfac_laptop'];?>" data-itfac_email="<?=$row['itfac_email'];?>" data-inpitfac_email="<?=$row['inpitfac_email'];?>" data-itfac_extdisk="<?=$row['itfac_extdisk'];?>" data-inpitfac_extdisk="<?=$row['inpitfac_extdisk'];?>" data-itfac_cctv_access="<?=$row['itfac_cctv_access'];?>" data-inpitfac_cctv_access="<?=$row['inpitfac_cctv_access'];?>" data-itfac_finger_access="<?=$row['itfac_finger_access'];?>" data-inpitfac_finger_access="<?=$row['inpitfac_finger_access'];?>" data-itfac_gps_access="<?=$row['itfac_gps_access'];?>" data-inpitfac_gps_access="<?=$row['inpitfac_gps_access'];?>" data-itfac_facerec_access="<?=$row['itfac_facerec_access'];?>" data-inpitfac_facerec_access="<?=$row['inpitfac_facerec_access'];?>" data-itfac_vpn="<?=$row['itfac_vpn'];?>" data-inpitfac_vpn="<?=$row['inpitfac_vpn'];?>" data-itfac_wifi="<?=$row['itfac_wifi'];?>" data-inpitfac_wifi="<?=$row['inpitfac_wifi'];?>" data-itfac_fileserv="<?=$row['itfac_fileserv'];?>" data-inpitfac_fileserv="<?=$row['inpitfac_fileserv'];?>" data-itfac_mobilephone="<?=$row['itfac_mobilephone'];?>" data-inpitfac_mobilephone="<?=$row['inpitfac_mobilephone'];?>" data-itfac_acts="<?=$row['itfac_acts'];?>" data-inpitfac_acts="<?=$row['inpitfac_acts'];?>" data-itfac_hrms="<?=$row['itfac_hrms'];?>" data-inpitfac_hrms="<?=$row['inpitfac_hrms'];?>" data-itfac_cas="<?=$row['itfac_cas'];?>" data-inpitfac_cas="<?=$row['inpitfac_cas'];?>" data-itfac_webbc="<?=$row['itfac_webbc'];?>" data-inpitfac_webbc="<?=$row['inpitfac_webbc'];?>" data-itfac_tpb="<?=$row['itfac_tpb'];?>" data-inpitfac_tpb="<?=$row['inpitfac_tpb'];?>" data-itfac_ticketing="<?=$row['itfac_ticketing'];?>" data-inpitfac_ticketing="<?=$row['inpitfac_ticketing'];?>" data-itfac_ptk="<?=$row['itfac_ptk'];?>" data-inpitfac_ptk="<?=$row['inpitfac_ptk'];?>" data-itfac_shipment="<?=$row['itfac_shipment'];?>" data-inpitfac_shipment="<?=$row['inpitfac_shipment'];?>" data-itfac_spec="<?=$row['itfac_spec'];?>" data-inpitfac_spec="<?=$row['inpitfac_spec'];?>" data-itfac_recruitment="<?=$row['itfac_recruitment'];?>" data-inpitfac_recruitment="<?=$row['inpitfac_recruitment'];?>" data-itfac_vms="<?=$row['itfac_vms'];?>" data-inpitfac_vms="<?=$row['inpitfac_vms'];?>"><i class="fas fa-search"></i></button>
                                </td>
                                
                                <?php
                                }
                                else
                                {
                                ?>
                                <td align="center" style="white-space:nowrap">
                                    <button data-toggle="modal" data-target="#modalDetail" class="btn btn-success open-detail" title="Detail"
                                        data-seq="<?=$row['seq'];?>" data-created_by="<?=$row['nama_user'];?>" data-created_date="<?=$row['created_date'];?>"
                                        data-nama_department="<?=$row['nama_departement'];?>" data-nama_divisi="<?=$row['nama_divisi'];?>" data-nama_section="<?=$row['nama_section'];?>" data-nama_subsection="<?=$row['nama_subsection'];?>" data-nama_team="<?=$row['nama_team'];?>" data-nama_unit="<?=$row['nama_unit'];?>" data-nama_grade="<?=$row['nama_grade'].' '.$row['ket_grade'];?>" data-nama_level="<?=$row['nama_level'];?>"

                                        data-type_ptk="<?=$row['type_ptk'];?>" data-so_number ="<?=$row['so_number'];?>" data-file ="<?=$row['file'];?>" data-education="<?=$row['education'];?>" data-major="<?=$row['major'];?>" data-work_experience ="<?=$row['work_experience'];?>" data-qty_submition="<?=$row['qty_submition'];?>" data-date_needed="<?=$row['date_needed'];?>" data-placement="<?=$row['placement'];?>" data-based_salary="<?=$row['based_salary'];?>" data-type_salary="<?=$row['type_salary'];?>" data-type_contract="<?=$row['type_contract'];?>" data-type_worker="<?=$row['type_worker'];?>" data-work_location="<?=$row['work_location'];?>" data-type_apd="<?=$row['type_apd'];?>" data-type_mcu="<?=$row['type_mcu'];?>"  data-hari_kerja="<?=$row['hari_kerja'];?>"  data-jam_kerja="<?=$row['jam_kerja'].' Jam';?>" data-employee_remark="<?=$row['employee_remark'];?>" data-kriteria="<?=$row['kriteria'];?>" data-jobdesc="<?=$row['jobdesc'];?>"
                                        data-itfac_pc="<?=$row['itfac_pc'];?>" data-inpitfac_pc="<?=$row['inpitfac_pc'];?>" data-itfac_laptop="<?=$row['itfac_laptop'];?>" data-inpitfac_laptop="<?=$row['inpitfac_laptop'];?>" data-itfac_email="<?=$row['itfac_email'];?>" data-inpitfac_email="<?=$row['inpitfac_email'];?>" data-itfac_extdisk="<?=$row['itfac_extdisk'];?>" data-inpitfac_extdisk="<?=$row['inpitfac_extdisk'];?>" data-itfac_cctv_access="<?=$row['itfac_cctv_access'];?>" data-inpitfac_cctv_access="<?=$row['inpitfac_cctv_access'];?>" data-itfac_finger_access="<?=$row['itfac_finger_access'];?>" data-inpitfac_finger_access="<?=$row['inpitfac_finger_access'];?>" data-itfac_gps_access="<?=$row['itfac_gps_access'];?>" data-inpitfac_gps_access="<?=$row['inpitfac_gps_access'];?>" data-itfac_facerec_access="<?=$row['itfac_facerec_access'];?>" data-inpitfac_facerec_access="<?=$row['inpitfac_facerec_access'];?>" data-itfac_vpn="<?=$row['itfac_vpn'];?>" data-inpitfac_vpn="<?=$row['inpitfac_vpn'];?>" data-itfac_wifi="<?=$row['itfac_wifi'];?>" data-inpitfac_wifi="<?=$row['inpitfac_wifi'];?>" data-itfac_fileserv="<?=$row['itfac_fileserv'];?>" data-inpitfac_fileserv="<?=$row['inpitfac_fileserv'];?>" data-itfac_mobilephone="<?=$row['itfac_mobilephone'];?>" data-inpitfac_mobilephone="<?=$row['inpitfac_mobilephone'];?>" data-itfac_acts="<?=$row['itfac_acts'];?>" data-inpitfac_acts="<?=$row['inpitfac_acts'];?>" data-itfac_hrms="<?=$row['itfac_hrms'];?>" data-inpitfac_hrms="<?=$row['inpitfac_hrms'];?>" data-itfac_cas="<?=$row['itfac_cas'];?>" data-inpitfac_cas="<?=$row['inpitfac_cas'];?>" data-itfac_webbc="<?=$row['itfac_webbc'];?>" data-inpitfac_webbc="<?=$row['inpitfac_webbc'];?>" data-itfac_tpb="<?=$row['itfac_tpb'];?>" data-inpitfac_tpb="<?=$row['inpitfac_tpb'];?>" data-itfac_ticketing="<?=$row['itfac_ticketing'];?>" data-inpitfac_ticketing="<?=$row['inpitfac_ticketing'];?>" data-itfac_ptk="<?=$row['itfac_ptk'];?>" data-inpitfac_ptk="<?=$row['inpitfac_ptk'];?>" data-itfac_shipment="<?=$row['itfac_shipment'];?>" data-inpitfac_shipment="<?=$row['inpitfac_shipment'];?>" data-itfac_spec="<?=$row['itfac_spec'];?>" data-inpitfac_spec="<?=$row['inpitfac_spec'];?>" data-itfac_recruitment="<?=$row['itfac_recruitment'];?>" data-inpitfac_recruitment="<?=$row['inpitfac_recruitment'];?>" data-itfac_vms="<?=$row['itfac_vms'];?>" data-inpitfac_vms="<?=$row['inpitfac_vms'];?>"><i class="fas fa-search"></i></button>
                                </td>
                                <?php
                                }
                                ?>
                                <td align="left" style="white-space:nowrap">
                                    <button style="border:2px solid #bfbfbf;border-radius: 25px;background-color: lightgrey;" onMouseOver="this.style.backgroundColor='#bfbfbf'" onMouseOut="this.style.backgroundColor='lightgrey'" title="Lihat History" id="buttonHistory" data-toggle="modal" data-target="#modalHistory" class="open-history" data-seq="<?=$row['seq'];?>"><strong><?php echo $row["seq"]; ?></strong></button>
                                </td>
                                <td align="left" style="white-space:nowrap"><?php echo $row["date_ptk"]; ?>
                                <td align="left" style="white-space:nowrap"><?php echo $row["nama_departement"]; ?>
                                <td align="left" style="white-space:nowrap"><?php echo $row["nama_divisi"]; ?>
                                <td align="left" style="white-space:nowrap"><?php echo $row["nama_section"]; ?>
                                <td align="left" style="white-space:nowrap"><?php echo $row["nama_subsection"]; ?>
                                <td align="left" style="white-space:nowrap"><?php echo $row["nama_level"]; ?>
                                <td align="left" style="white-space:nowrap"><?php echo $row["nama_grade"]." ".$row["ket_grade"]; ?>
                                <td align="left" style="white-space:nowrap"><?php echo $row["qty_submition"]; ?>

                            <!-- MANAGER APPROVAL----------------------------------------------------------------------------------->
                                <?php
                                // jika akses = manager / administrator
                                if($row["app_mgr"] == 0 and $row["status_approval"] == 0 and (($akses_app_mgr == "1" and $row["head_div"] == $ID_USER1) or $akses == "Administrator"))
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        
                                        <?php 
                                        if($BETUL > 0)
                                        {
                                        ?>
                                            <button data-toggle="modal" data-target="#modalAppmgrByMD" class="btn btn-success open-appmgrbymd" title="Approve" data-app="1" data-seq="<?=$row['seq'];?>"><i class="fas fa-check"></i></button>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <a class="btn btn-success" title="Approve" href="app_mgr?seq=<?=$row['seq'];?>  " onclick="return confirm('Manager Approval : Yakin untuk menyetujui ?')"><i class="fas fa-check"></i></a>
                                        <?php
                                        }
                                        ?>
                                       <button data-toggle="modal" data-target="#modalTolak" class="btn btn-danger open-rejection" title="Lihat Detail" data-app="mgr" data-seq="<?=$row['seq'];?>"><i class="fas fa-times"></i></button>
                                    </td>
                                <?php
                                }
                                else if($row["app_mgr"] == 1)
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        <i class="fa fa-check fa-lg fa-2x" style="color: green;"></i><br>
                                        <?php echo $row["app_mgr_date"]; ?>
                                    </td>
                                <?php
                                }
                                else if($row["app_mgr"] == 2)
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        <i class="fa fa-times fa-lg fa-2x" style="color: red;"></i><br>
                                        <?php echo $row["app_mgr_date"]; ?>
                                    </td>
                                <?php }
                                else
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        <i class="far fa-clock fa-lg fa-2x"></i><br>
                                    </td>
                                <?php }
                                ?>

                            <!-- DIRECTOR APPROVAL---------------------------------------------------------------------------------->
                                <?php
                                if($row["app_mgr"] == 1 and $row["app_dir"] == 0 and $row["status_approval"] == 0 and (($akses_app_dir == "1" and $row["head_dept"] == $ID_USER1) or $akses == "Administrator" ))
                                { ?>
                                <td align="center" style="white-space:nowrap">
                                    <?php 
                                    if($BETUL > 0)
                                    {
                                    ?>
                                        <button data-toggle="modal" data-target="#modalAppdirByMD" class="btn btn-success open-appdirbymd" title="Approve" data-app="1" data-seq="<?=$row['seq'];?>"><i class="fas fa-check"></i></button>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <a class="btn btn-success" title="Approve" href="app_dir?seq=<?=$row['seq'];?>&&app=1" onclick="return confirm('Director Approval : Yakin untuk menyetujui ?')"><i class="fas fa-check"></i></a>
                                    <?php
                                    }
                                    ?>
                                    <button data-toggle="modal" data-target="#modalTolak" class="btn btn-danger open-rejection" title="Reject" data-app="dir" data-seq="<?=$row['seq'];?>"><i class="fas fa-times"></i></button>
                                </td>
                                <?php
                                }
                                else if($row["app_dir"] == 1)
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        <i class="fa fa-check fa-lg fa-2x" style="color: green;"></i><br>
                                        <?php echo $row["app_dir_date"]; ?>
                                    </td>
                                <?php
                                }
                                else if($row["app_dir"] == 2)
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        <i class="fa fa-times fa-lg fa-2x" style="color: red;"></i><br>
                                        <?php echo $row["app_dir_date"]; ?>
                                    </td>
                                <?php }
                                else if($row["status_approval"] == 2)
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        -
                                    </td>
                                <?php }
                                else
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        <i class="far fa-clock fa-lg fa-2x"></i><br>
                                    </td>
                                <?php }
                                ?>

                            <!-- HRD APPROVAL------------------------------------------------------------------------------------->
                                <?php
                                if($row["app_dir"] == 1 and $row["app_hrd"] == 0 and $row["status_approval"] == 0 and ($akses_app_hrd == "1" or $akses == "Administrator"))
                                { ?>
                                <td align="center" style="white-space:nowrap">
                                    <a class="btn btn-success" title="Approve" href="app_hrd?seq=<?=$row['seq'];?>&&app=1" onclick="return confirm('HRD Approval : Yakin untuk menyetujui ?')"><i class="fas fa-check"></i></a>
                                    <button data-toggle="modal" data-target="#modalTolak" class="btn btn-danger open-rejection" title="Reject" data-app="hrd" data-seq="<?=$row['seq'];?>"><i class="fas fa-times"></i></button>
                                </td>
                                <?php
                                }
                                else if($row["app_hrd"] == 1)
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        <i class="fa fa-check fa-lg fa-2x" style="color: green;"></i><br>
                                        <?php echo $row["app_hrd_date"]; ?>
                                    </td>
                                <?php
                                }
                                else if($row["app_hrd"] == 2)
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        <i class="fa fa-times fa-lg fa-2x" style="color: red;"></i><br>
                                        <?php echo $row["app_hrd_date"]; ?>
                                    </td>
                                <?php }
                                else if($row["status_approval"] == 2)
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        -
                                    </td>
                                <?php }
                                else
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        <i class="far fa-clock fa-lg fa-2x"></i><br>
                                    </td>
                                <?php }
                                ?>

                            <!-- MD APPROVAL--------------------------------------------------------------------------------------->
                                <?php
                                if($row["app_hrd"] == 1 and $row["app_md"] == 0 and $row["status_approval"] == 0 and ($akses_app_md== "1" or $akses == "Administrator"))
                                { ?>
                                <td align="center" style="white-space:nowrap">
                                    <button data-toggle="modal" data-target="#modalAppmd" class="btn btn-success open-appmd" title="Approve" data-app="1" data-seq="<?=$row['seq'];?>"><i class="fas fa-check"></i></button>
                                    <button data-toggle="modal" data-target="#modalTolak" class="btn btn-danger open-rejection" title="Reject" data-app="md" data-seq="<?=$row['seq'];?>"><i class="fas fa-times"></i></button>
                                </td>
                                <?php
                                }
                                else if($row["app_md"] == 1)
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        <i class="fa fa-check fa-lg fa-2x" style="color: green;"></i><br>
                                        <?php echo $row["app_md_date"]; ?>
                                    </td>
                                <?php
                                }
                                else if($row["app_md"] == 2)
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        <i class="fa fa-times fa-lg fa-2x" style="color: red;"></i><br>
                                        <?php echo $row["app_md_date"]; ?>
                                    </td>
                                <?php }
                                else if($row["status_approval"] == 2)
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        -
                                    </td>
                                <?php }
                                else
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        <i class="far fa-clock fa-lg fa-2x"></i><br>
                                    </td>
                                <?php }
                                ?>

                            <!-- STATUS --------------------------------------------------------------------------------------------------------->
                                <?php
                                //jika proses approval belum selesai
                                if($row["status_approval"] == 0)
                                { ?>
                                    <td align="center" style="white-space:nowrap">
                                        <i title="Tunggu Proses Approval" class="fas fa-spinner fa-pulse fa-2x fa-fw" style="color: black;"></i>
                                    </td>
                                <?php
                                }

                                //jika proses pemenuhan belum complete
                                else if ($row["status_approval"] == 1 and ($row["qty_accepted"] < $row["qty_submition"]))
                                { 
                                    if($akses_pemenuhan== "1")
                                    {
                                    ?>
                                    <td align="center" style="white-space:nowrap">
                                        <button title="Proses Pemenuhan" style="border-width: 0;background-color: transparent;" data-toggle="modal" data-target="#modalPemenuhan" id="open-pemenuhan" value="<?=$row['seq'];?>" onclick="getPEMENUHAN(this.value)" data-seq="<?=$row['seq'];?>">
                                            <i class="fas fa-plus-circle fa-lg fa-2x" style="color:#337AB7;"></i><br>
                                            <b>Pemenuhan<b>
                                        </button>
                                    </td>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <td align="center" style="white-space:nowrap">
                                        <i title="Tunggu Proses Pemenuhan" class="fas fa-thumbs-up fa-lg fa-2x" style="color: green;"></i><br>
                                    </td>
                                    <?php
                                    }
                                }
                                //jika proses pemenuhan sudah complete
                                else if ($row["status_approval"] == 1 and ($row["qty_accepted"] = $row["qty_submition"]))
                                { 
                                    if($akses_pemenuhan== "1")
                                    { ?>
                                    <td align="center" style="white-space:nowrap">
                                        <button title="Complete" style="border-width: 0;background-color: transparent;" data-toggle="modal" data-target="#modalPemenuhan" id="open-pemenuhan" value="<?=$row['seq'];?>" onclick="getPEMENUHAN(this.value)" data-seq="<?=$row['seq'];?>">
                                            <i class="fas fa-check-circle fa-lg fa-2x" style="color:green;"></i><br>
                                            <b>Complete<b>
                                        </button>
                                    </td>
                                    <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <td align="center" style="white-space:nowrap">
                                            <i title="Complete" class="fas fa-check-circle fa-lg fa-2x" style="color: green;"></i><br><b>Complete</b>
                                        </td>
                                        <?php
                                    }
                                }

                                //jika ptk direject
                                else
                                { ?>
                                <td align="center" style="white-space:nowrap">
                                    <button title="Lihat Alasan Penolakan" style="border-width: 0;background-color:transparent;" data-toggle="modal" data-target="#modalAlasan" id="open-alasan" data-seq="<?=$row['seq'];?>" data-reject_remark="<?=$row['reject_remark'];?>">
                                        <i class="fas fa-thumbs-down fa-lg fa-2x" style="color: #ED5466;"></i><br>
                                    </button>
                                </td>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header text-center" style="background-color:lightblue;">
        <h4 class="semibold modal-title"><b id="seq"></b></h4>
        <h5 class="text-center" style="color:black;">Submited By : <a style="color:black;" id="created_by"></a> || <a style="color:black;" id="created_date"></a> </h5>
      </div>
      <div class="modal-body table-responsive">
        <h5 style="color: lightcoral;"><b>Struktur :</b></h5>
        <table class="table table-bordered table-responsive" style="font-size: 11px;">
            <tr>
                <td><b>Departement</b></td>
                <td id="nama_department"><a></a></td>
                <td><b>Divisi</b></td>
                <td id="nama_divisi"></td>
            </tr>
            <tr>
                <td><b>Section</b></td>
                <td id="nama_section"></td>
                <td><b>Sub Section</b></td>
                <td id="nama_subsection"></td>
            </tr>
            <tr>
                <td><b>Team</b></td>
                <td id="nama_team"></td>
                <td><b>Unit</b></td>
                <td id="nama_unit"></td>
            </tr>
            <tr>
                <td><b>Level</b></td>
                <td id="nama_level"></td>
                <td><b>Grade</b></td>
                <td id="nama_grade"></td>
            </tr>
        </tablle>
        <table class="table table-bordered" id="bergaris" style="font-size: 11px;">
            <h5 style="color: lightcoral;"><b>Spesifikasi Pekerjaan :</b></h5>
            <tr>
                <td><b>Type PTK</b></td><td id="type_ptk"></td>
            </tr>
            <tr>
                <td><b>Nomor Usulan SO</b></td><td><data id="so_number"></data>&nbsp;&nbsp;<a href="" target="_blank" id="file"><i id="file_icon" class=""></i></a></td>
            </tr>
            <tr>
                <td><b>Pendidikan</b></td><td id="education"></td>
            </tr>
            <tr>
                <td><b>Kualifikasi Jurusan</b></td><td id="major"></td>
            </tr>
            <tr>
                <td><b>Pengalaman Kerja (tahun)</b></td><td id="work_experience"></td>
            </tr>
            <tr>
                <td><b>Jumlah Pengajuan</b></td><td id="qty_submition"></td>
            </tr>
            <tr>
                <td><b>Tanggal Dibutuhkan</b></td><td id="date_needed"></td>
            </tr>
            <tr>
                <td><b>Penempatan Karyawan</b></td><td id="placement"></td>
            </tr>
            <tr>
                <td><b>Basis Penggajian</b></td><td id="based_salary"></td>
            </tr>
            <tr>
                <td><b>Type Penggajian</b></td><td id="type_salary"></td>
            </tr>
            <!-- <tr>
                <td><b>Type Kontrak</b></td><td id="type_contract"></td>
            </tr> -->
            <tr>
                <td><b>Type Pekerja</b></td><td id="type_worker"></td>
            </tr>
            <tr>
                <td><b>Lokasi Kerja</b></td><td id="work_location"></td>
            </tr>
            <tr>
                <td><b>Type APD</b></td><td id="type_apd"></td>
            </tr>
            <tr>
                <td><b>Type MCU</b></td><td id="type_mcu"></td>
            </tr>
            <tr>
                <td><b>Hari Kerja</b></td><td id="hari_kerja"></td>
            </tr>
            <tr>
                <td><b>Jam Kerja</b></td><td id="jam_kerja"></td>
            </tr>
            <tr>
                <td colspan="2"><h5 style="color: lightcoral;"><b>Fasilitas IT :</b></h5></td>
            </tr>
            <tr>
                <td><b>PC / Komputer</b></td><td><i id="itfac_pc" class=""></i>&nbsp;<data id="inpitfac_pc"></data></td>
            </tr>
            <tr>
                <td><b>Laptop</b></td><td><i id="itfac_laptop" class=""></i>&nbsp;<data id="inpitfac_laptop"></data></td>
            </tr>
            <tr>
                <td><b>External Disk</b></td><td><i id="itfac_extdisk" class=""></i>&nbsp;<data id="inpitfac_extdisk"></data></td>
            </tr>
            <tr>
                <td><b>Mobile Phone</b></td><td><i id="itfac_mobilephone" class=""></i>&nbsp;<data id="inpitfac_mobilephone"></data></td>
            </tr>
            <tr>
                <td><b>Email</b></td><td><i id="itfac_email" class=""></i>&nbsp;<data id="inpitfac_email"></data></td>
            </tr>
            <tr>
                <td><b>Finger Access</b></td><td><i id="itfac_finger_access" class=""></i>&nbsp;<data id="inpitfac_finger_access"></data></td>
            </tr>
            <tr>
                <td><b>Face Recognition Access</b></td><td><i id="itfac_facerec_access" class=""></i>&nbsp;<data id="inpitfac_facerec_access"></data></td>
            </tr>
            <tr>
                <td><b>CCTV Access</b></td><td><i id="itfac_cctv_access" class=""></i>&nbsp;<data id="inpitfac_cctv_access"></data></td>
            </tr>
            <tr>
                <td><b>GPS Access</b></td><td><i id="itfac_gps_access" class=""></i>&nbsp;<data id="inpitfac_gps_access"></data></td>
            </tr>
            <tr>
                <td><b>VPN</b></td><td><i id="itfac_vpn" class=""></i>&nbsp;<data id="inpitfac_vpn"></data></td>
            </tr>
            <tr>
                <td><b>Wifi</b></td><td><i id="itfac_wifi" class=""></i>&nbsp;<data id="inpitfac_wifi"></data></td>
            </tr>
            <tr>
                <td><b>File Server</b></td><td><i id="itfac_fileserv" class=""></i>&nbsp;<data id="inpitfac_fileserv"></data></td>
            </tr>
            <tr>
                <td><b>ACTS</b></td><td><i id="itfac_acts" class=""></i>&nbsp;<data id="inpitfac_acts"></data></td>
            </tr>
            <tr>
                <td><b>HRMS</b></td><td><i id="itfac_hrms" class=""></i>&nbsp;<data id="inpitfac_hrms"></data></td>
            </tr>
            <tr>
                <td><b>CAS</b></td><td><i id="itfac_cas" class=""></i>&nbsp;<data id="inpitfac_cas"></data></td>
            </tr>
            <tr>
                <td><b>Web BC</b></td><td><i id="itfac_webbc" class=""></i>&nbsp;<data id="inpitfac_webbc"></data></td>
            </tr>
            <tr>
                <td><b>TPB</b></td><td><i id="itfac_tpb" class=""></i>&nbsp;<data id="inpitfac_tpb"></data></td>
            </tr>
            <tr>
                <td><b>Ticketing System / Maintenance Online</b></td><td><i id="itfac_ticketing" class=""></i>&nbsp;<data id="inpitfac_ticketing"></data></td>
            </tr>
            <tr>
                <td><b>PTK Online</b></td><td><i id="itfac_ptk" class=""></i>&nbsp;<data id="inpitfac_ptk"></data></td>
            </tr>
            <tr>
                <td><b>Shipment Online</b></td><td><i id="itfac_shipment" class=""></i>&nbsp;<data id="inpitfac_shipment"></data></td>
            </tr>
            <tr>
                <td><b>Spec Online</b></td><td><i id="itfac_spec" class=""></i>&nbsp;<data id="inpitfac_spec"></data></td>
            </tr>
            <tr>
                <td><b>Recruitment Online</b></td><td><i id="itfac_recruitment" class=""></i>&nbsp;<data id="inpitfac_recruitment"></data></td>
            </tr>
            <tr>
                <td><b>Visitor Management System</b></td><td><i id="itfac_vms" class=""></i>&nbsp;<data id="inpitfac_vms"></data></td>
            </tr>
            <tr>
                <td><b>Karyawan Resign / Mutasi / Demosi</b></td><td><textarea style="width: 500px;height: 200px;" disabled id="employee_remark"></textarea></td>
            </tr>
            <tr>
                <td><b>Kriteria</b></td><td><textarea style="width: 500px;height: 200px;" disabled id="kriteria"></textarea></td>
            </tr>
            <tr>
                <td><b>Jobdesc</b></td><td><textarea style="width: 500px;height: 200px;" disabled id="jobdesc"></textarea></td>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Deleted PTK -->
<div class="modal fade" id="modalDeleted" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header text-center" style="background-color:#ED5466;">
            <h4 class="semibold modal-title" style="color:white"><i class="fas fa-exclamation-triangle"></i> Deleted PTK </h4>
        </div>
        <div class="modal-body table-responsive">
            <table class="table table-bordered" id="bergaris" style="font-size: 11px;">
                <tr>
                    <th style="background-color:lightgrey;text-align: center;">#</th>
                    <th style="background-color:lightgrey;text-align: center;">PTK Code</th>
                    <th style="background-color:lightgrey;text-align: center;">Input Date</th>
                    <th style="background-color:lightgrey;text-align: center;">Department</th>
                    <th style="background-color:lightgrey;text-align: center;">Division</th>
                    <th style="background-color:lightgrey;text-align: center;">Grade</th>
                    <th style="background-color:lightgrey;text-align: center;">Level</th>
                    <th style="background-color:lightgrey;text-align: center;">Deleted By</th>
                    <th style="background-color:lightgrey;text-align: center;">Deleted Date</th>
                </tr>
                <?php
                $no = 1;
                $result_deleted = getQuery("select  a.seq,
                                                    date_format(a.date_ptk, '%d %b %Y') as date_ptk,
                                                    date_format(a.deleted_date, '%d %b %Y / %H:%i:%s') as deleted_date,
                                                    b.nama_departement,
                                                    c.nama_divisi,
                                                    d.nama_level,
                                                    e.nama_user,
                                                    f.nama_grade,
                                                    f.ket_grade
                                               from t_ptk a
                                          LEFT JOIN m_departement b ON a.kode_departement = b.kode_departement
                                          LEFT JOIN m_divisi c ON a.kode_divisi = c.kode_divisi
                                          LEFT JOIN m_level d ON a.kode_level = d.kode_level
                                          LEFT JOIN m_user e ON a.deleted_by = e.kode_user
                                          LEFT JOIN m_grade f ON a.kode_grade = f.kode_grade
                                          where a.status_hapus = '1' $where_clause_deleted
                                          order by a.seq desc");
                while ($rowd = $result_deleted->fetch(PDO::FETCH_ASSOC))
                {
                ?>
                    <tr>
                        <td style="white-space:nowrap"><?=$no++.".";?></td>
                        <td style="white-space:nowrap"><?=$rowd["seq"];?></td>
                        <td style="white-space:nowrap"><?=$rowd["date_ptk"];?></td>
                        <td style="white-space:nowrap"><?=$rowd["nama_departement"];?></td>
                        <td style="white-space:nowrap"><?=$rowd["nama_divisi"];?></td>
                        <td style="white-space:nowrap"><?=$rowd["nama_grade"]." ".$rowd["ket_grade"];?></td>
                        <td style="white-space:nowrap"><?=$rowd["nama_level"];?></td>
                        <td style="white-space:nowrap"><?=$rowd["nama_user"];?></td>
                        <td style="white-space:nowrap"><?=$rowd["deleted_date"];?></td>
                    </tr>
                <?php
                } 
                ?>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
          </div>
    </div>
  </div>
</div>

<!-- Modal History -->
<div class="modal fade" id="modalHistory" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header text-center" style="background-color:grey;">
            <h4 class="semibold modal-title" style="color:white"><i class="fas fa-history"></i> History <span id="seq"></span> </h4>
        </div>
        <div class="container"></div>
        <div>
            <div id="HASIL_HISTORY"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
        </div>
    </div>
  </div>
</div>

<!-- Modal Detail History -->
<div class="modal fade" id="modalDetailHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center" style="background-color:grey;">
        <h4 class="semibold modal-title" style="color:white"><i class="fas fa-history"></i> History - <b id="seq2"></b></h4>
        <h5 class="text-center" style="color:white;">Submited By : <a style="color:white;" id="created_by2"></a> || <a style="color:white;" id="created_date2"></a> </h5>
      </div>
      <div class="modal-body table-responsive">
        <h5 style="color: lightcoral;"><b>Struktur :</b></h5>
        <table class="table table-bordered table-responsive" style="font-size: 11px;">
            <tr>
                <td><b>Departement</b></td>
                <td id="nama_department2"><a></a></td>
                <td><b>Divisi</b></td>
                <td id="nama_divisi2"></td>
            </tr>
            <tr>
                <td><b>Section</b></td>
                <td id="nama_section2"></td>
                <td><b>Sub Section</b></td>
                <td id="nama_subsection2"></td>
            </tr>
            <tr>
                <td><b>Team</b></td>
                <td id="nama_team2"></td>
                <td><b>Unit</b></td>
                <td id="nama_unit2"></td>
            </tr>
            <tr>
                <td><b>Level</b></td>
                <td id="nama_level2"></td>
                <td><b>Grade</b></td>
                <td id="nama_grade2"></td>
            </tr>
        </tablle>
        <table class="table table-bordered" id="bergaris" style="font-size: 11px;">
            <h5 style="color: lightcoral;"><b>Spesifikasi Pekerjaan :</b></h5>
            <tr>
                <td><b>Type PTK</b></td><td id="type_ptk2"></td>
            </tr>
            <tr>
            <td><b>Nomor Usulan SO</b></td><td><data id="so_number2"></data>&nbsp;&nbsp;<a href="" target="_blank" id="file2"><i id="file_icon2" class=""></i></a></td>
            </tr>
            <tr>
                <td><b>Pendidikan</b></td><td id="education2"></td>
            </tr>
            <tr>
                <td><b>Kualifikasi Jurusan</b></td><td id="major2"></td>
            </tr>
            <tr>
                <td><b>Pengalaman Kerja (tahun)</b></td><td id="work_experience2"></td>
            </tr>
            <tr>
                <td><b>Jumlah Pengajuan</b></td><td id="qty_submition2"></td>
            </tr>
            <tr>
                <td><b>Tanggal Dibutuhkan</b></td><td id="date_needed2"></td>
            </tr>
            <tr>
                <td><b>Penempatan Karyawan</b></td><td id="placement2"></td>
            </tr>
            <tr>
                <td><b>Basis Penggajian</b></td><td id="based_salary2"></td>
            </tr>
            <tr>
                <td><b>Type Penggajian</b></td><td id="type_salary2"></td>
            </tr>
            <!-- <tr>
                <td><b>Type Kontrak</b></td><td id="type_contract2"></td>
            </tr> -->
            <tr>
                <td><b>Type Pekerja</b></td><td id="type_worker2"></td>
            </tr>
            <tr>
                <td><b>Lokasi Kerja</b></td><td id="work_location2"></td>
            </tr>
            <tr>
                <td><b>Type APD</b></td><td id="type_apd2"></td>
            </tr>
            <tr>
                <td><b>Type MCU</b></td><td id="type_mcu2"></td>
            </tr>
            <tr>
                <td><b>Hari Kerja</b></td><td id="hari_kerja2"></td>
            </tr>
            <tr>
                <td><b>Jam Kerja</b></td><td id="jam_kerja2"></td>
            </tr>
            <tr>
                <td colspan="2"><h5 style="color: lightcoral;"><b>Fasilitas IT :</b></h5></td>
            </tr>
            <tr>
                <td><b>PC / Komputer</b></td><td><i id="itfac_pc2" class=""></i>&nbsp;<data id="inpitfac_pc2"></data></td>
            </tr>
            <tr>
                <td><b>Laptop</b></td><td><i id="itfac_laptop2" class=""></i>&nbsp;<data id="inpitfac_laptop2"></data></td>
            </tr>
            <tr>
                <td><b>External Disk</b></td><td><i id="itfac_extdisk2" class=""></i>&nbsp;<data id="inpitfac_extdisk2"></data></td>
            </tr>
            <tr>
                <td><b>Mobile Phone</b></td><td><i id="itfac_mobilephone2" class=""></i>&nbsp;<data id="inpitfac_mobilephone2"></data></td>
            </tr>
            <tr>
                <td><b>Email</b></td><td><i id="itfac_email2" class=""></i>&nbsp;<data id="inpitfac_email2"></data></td>
            </tr>
            <tr>
                <td><b>Finger Access</b></td><td><i id="itfac_finger_access2" class=""></i>&nbsp;<data id="inpitfac_finger_access2"></data></td>
            </tr>
            <tr>
                <td><b>Face Recognition Access</b></td><td><i id="itfac_facerec_access2" class=""></i>&nbsp;<data id="inpitfac_facerec_access2"></data></td>
            </tr>
            <tr>
                <td><b>CCTV Access</b></td><td><i id="itfac_cctv_access2" class=""></i>&nbsp;<data id="inpitfac_cctv_access2"></data></td>
            </tr>
            <tr>
                <td><b>GPS Access</b></td><td><i id="itfac_gps_access2" class=""></i>&nbsp;<data id="inpitfac_gps_access2"></data></td>
            </tr>
            <tr>
                <td><b>VPN</b></td><td><i id="itfac_vpn2" class=""></i>&nbsp;<data id="inpitfac_vpn2"></data></td>
            </tr>
            <tr>
                <td><b>Wifi</b></td><td><i id="itfac_wifi2" class=""></i>&nbsp;<data id="inpitfac_wifi2"></data></td>
            </tr>
            <tr>
                <td><b>File Server</b></td><td><i id="itfac_fileserv2" class=""></i>&nbsp;<data id="inpitfac_fileserv2"></data></td>
            </tr>
            <tr>
                <td><b>ACTS</b></td><td><i id="itfac_acts2" class=""></i>&nbsp;<data id="inpitfac_acts2"></data></td>
            </tr>
            <tr>
                <td><b>HRMS</b></td><td><i id="itfac_hrms2" class=""></i>&nbsp;<data id="inpitfac_hrms2"></data></td>
            </tr>
            <tr>
                <td><b>CAS</b></td><td><i id="itfac_cas2" class=""></i>&nbsp;<data id="inpitfac_cas2"></data></td>
            </tr>
            <tr>
                <td><b>Web BC</b></td><td><i id="itfac_webbc2" class=""></i>&nbsp;<data id="inpitfac_webbc2"></data></td>
            </tr>
            <tr>
                <td><b>TPB</b></td><td><i id="itfac_tpb2" class=""></i>&nbsp;<data id="inpitfac_tpb2"></data></td>
            </tr>
            <tr>
                <td><b>Ticketing System / Maintenance Online</b></td><td><i id="itfac_ticketing2" class=""></i>&nbsp;<data id="inpitfac_ticketing2"></data></td>
            </tr>
            <tr>
                <td><b>PTK Online</b></td><td><i id="itfac_ptk2" class=""></i>&nbsp;<data id="inpitfac_ptk2"></data></td>
            </tr>
            <tr>
                <td><b>Shipment Online</b></td><td><i id="itfac_shipment2" class=""></i>&nbsp;<data id="inpitfac_shipment2"></data></td>
            </tr>
            <tr>
                <td><b>Spec Online</b></td><td><i id="itfac_spec2" class=""></i>&nbsp;<data id="inpitfac_spec2"></data></td>
            </tr>
            <tr>
                <td><b>Recruitment Online</b></td><td><i id="itfac_recruitment2" class=""></i>&nbsp;<data id="inpitfac_recruitment2"></data></td>
            </tr>
            <tr>
                <td><b>Visitor Mangement System</b></td><td><i id="itfac_vms2" class=""></i>&nbsp;<data id="inpitfac_vms2"></data></td>
            </tr>
            <tr>
                <td><b>Karyawan Resign / Mutasi / Demosi</b></td><td><textarea style="width: 500px;height: 200px;" disabled id="employee_remark2"></textarea></td>
            </tr>
            <tr>
                <td><b>Kriteria</b></td><td><textarea style="width: 500px;height: 200px;" disabled id="kriteria2"></textarea></td>
            </tr>
            <tr>
                <td><b>Jobdesc</b></td><td><textarea style="width: 500px;height: 200px;" disabled id="jobdesc2"></textarea></td>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tolak -->
<div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header text-center" style="background-color:#ED5466;">
        <h4 class="semibold modal-title" style="color:white"><span class="fa fa-times-circle fa-lg"></span> Rejection</h4>
      </div>
      <form role="form" action="reject_ptk" method="post" data-parsley-validate>
          <div class="modal-body">
            <div class="form-group">
                <label for="REJECT_REMARK">Alasan Penolakan <span class="text-danger">*</span></label>
                <textarea class="form-control" required="" id="reject_remark" name="reject_remark" placeholder="Input alasan penolakan" style="width:100%; height: 15em;"></textarea>
                <input type="hidden" required="" class="form-control" id="app_reject" name="app_reject">
                <input type="hidden" required="" class="form-control" id="seq" name="seq">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="simpan" class="btn" style="background-color:#337AB7;color: white;"><i class="fa fa-save"></i> Save</button>&nbsp&nbsp&nbsp
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Approval MGR BY MD -->
<div class="modal fade" id="modalAppmgrByMD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header text-center" style="background-color:#198754;">
        <h4 class="semibold modal-title" style="color:white"><span class="fa fa-check"></span> Manager Approval for : <b id="seq"></b></h4>
      </div>
      <form role="form" action="app_mgr" method="post" data-parsley-validate>
          <div class="modal-body">
            <div class="form-group">
                <label for="TYPE_CONTRACT">Choose Type Kontrak <span class="text-danger">*</span></label>
                <select name="TYPE_CONTRACT" id="TYPE_CONTRACT" required="" class="form-control" data-parsley-required>
                    <?php
                        $results = getQuery("select type_contract from param where type_contract != '' order by type_contract asc");
                        while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                        {
                            ?>
                                <option value="<?php echo $rowz["type_contract"]; ?>">
                                    <?php echo $rowz["type_contract"]; ?>
                                </option>
                            <?php
                        }
                    ?>    
                </select>
                <input type="hidden" required="" class="form-control" id="seq" name="seq">
            </div>
            <span class="text-danger"><i>By pressing <b>Save</b> button below, I do approval for this employee request.</i></span><br>
          </div>
          <div class="modal-footer">
            <button type="submit" name="simpan" class="btn" style="background-color:#337AB7;color: white;"><i class="fa fa-save"></i> Save</button>&nbsp&nbsp&nbsp
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Approval DIR BY MD -->
<div class="modal fade" id="modalAppdirByMD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header text-center" style="background-color:#198754;">
        <h4 class="semibold modal-title" style="color:white"><span class="fa fa-check"></span> Director Approval for : <b id="seq"></b></h4>
      </div>
      <form role="form" action="app_dir" method="post" data-parsley-validate>
          <div class="modal-body">
            <div class="form-group">
                <label for="TYPE_CONTRACT">Choose Type Kontrak <span class="text-danger">*</span></label>
                <select name="TYPE_CONTRACT" id="TYPE_CONTRACT" required="" class="form-control" data-parsley-required>
                    <?php
                        $results = getQuery("select type_contract from param where type_contract != '' order by type_contract asc");
                        while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                        {
                            ?>
                                <option value="<?php echo $rowz["type_contract"]; ?>">
                                    <?php echo $rowz["type_contract"]; ?>
                                </option>
                            <?php
                        }
                    ?>    
                </select>
                <input type="hidden" required="" class="form-control" id="seq" name="seq">
            </div>
            <span class="text-danger"><i>By pressing <b>Save</b> button below, I do approval for this employee request.</i></span><br>
          </div>
          <div class="modal-footer">
            <button type="submit" name="simpan" class="btn" style="background-color:#337AB7;color: white;"><i class="fa fa-save"></i> Save</button>&nbsp&nbsp&nbsp
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Approval MD -->
<div class="modal fade" id="modalAppmd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header text-center" style="background-color:#198754;">
        <h4 class="semibold modal-title" style="color:white"><span class="fa fa-check"></span> Managing Director Approval for : <b id="seq"></b></h4>
      </div>
      <form role="form" action="app_md" method="post" data-parsley-validate>
          <div class="modal-body">
            <div class="form-group">
                <label for="TYPE_CONTRACT">Choose Type Kontrak <span class="text-danger">*</span></label>
                <select name="TYPE_CONTRACT" id="TYPE_CONTRACT" required="" class="form-control" data-parsley-required>
                    <?php
                        $results = getQuery("select type_contract from param where type_contract != '' order by type_contract asc");
                        while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
                        {
                            ?>
                                <option value="<?php echo $rowz["type_contract"]; ?>">
                                    <?php echo $rowz["type_contract"]; ?>
                                </option>
                            <?php
                        }
                    ?>    
                </select>
                <input type="hidden" required="" class="form-control" id="seq" name="seq">
            </div>
            <span class="text-danger"><i>By pressing <b>Save</b> button below, I do approval for this employee request.</i></span><br>
          </div>
          <div class="modal-footer">
            <button type="submit" name="simpan" class="btn" style="background-color:#337AB7;color: white;"><i class="fa fa-save"></i> Save</button>&nbsp&nbsp&nbsp
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
          </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Alasan -->
<div class="modal fade" id="modalAlasan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header text-center" style="background-color:#ED5466;">
        <h4 class="semibold modal-title" style="color:white"><span class="fa fa-thumbs-down fa-lg"></span> Alasan Penolakan <b id="seq"></b></h4>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <textarea class="form-control" disabled id="reject_remark2" style="width:100%; height: 15em;"></textarea>
            </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Pemenuhan -->
<div class="modal fade" id="modalPemenuhan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header text-center" style="background-color:#337AB7;">
        <h4 class="semibold modal-title" style="color:white">Pemenuhan <b id="seq"></b></h4>
      </div>
      <form id="form-pemenuhan" role="form" action="pemenuhan.php" method="post" data-parsley-validate>
          <div class="modal-body" id="PEMENUHAN"></div>
          <div class="modal-footer">
            <button type="submit"  class="btn btn-primary"><i class="fa fa-save"></i> Save</button>&nbsp&nbsp&nbsp
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
          </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">

//open-detail
$(document).on("click", ".open-detail", function ()
{
    $(".modal-header #seq").html( $(this).data('seq'));
    $(".modal-header #created_by").html( $(this).data('created_by'));
    $(".modal-header #created_date").html( $(this).data('created_date'));
    $(".modal-body #nama_department").html( $(this).data('nama_department'));
    $(".modal-body #nama_divisi").html( $(this).data('nama_divisi'));
    $(".modal-body #nama_section").html( $(this).data('nama_section'));
    $(".modal-body #nama_subsection").html( $(this).data('nama_subsection'));
    $(".modal-body #nama_team").html( $(this).data('nama_team'));
    $(".modal-body #nama_unit").html( $(this).data('nama_unit'));
    $(".modal-body #nama_grade").html( $(this).data('nama_grade'));
    $(".modal-body #nama_level").html( $(this).data('nama_level'));
    $(".modal-body #type_ptk").html( $(this).data('type_ptk'));
    $(".modal-body #so_number").html( $(this).data('so_number'));
    $(".modal-body #education").html( $(this).data('education'));
    $(".modal-body #major").html( $(this).data('major'));
    $(".modal-body #work_experience").html( $(this).data('work_experience'));
    $(".modal-body #qty_submition").html( $(this).data('qty_submition'));
    $(".modal-body #date_needed").html( $(this).data('date_needed'));
    $(".modal-body #placement").html( $(this).data('placement'));
    $(".modal-body #based_salary").html( $(this).data('based_salary'));
    $(".modal-body #type_salary").html( $(this).data('type_salary'));
    $(".modal-body #type_contract").html( $(this).data('type_contract'));
    $(".modal-body #type_worker").html( $(this).data('type_worker'));
    $(".modal-body #work_location").html( $(this).data('work_location'));
    $(".modal-body #type_apd").html( $(this).data('type_apd'));
    $(".modal-body #type_mcu").html( $(this).data('type_mcu'));
    $(".modal-body #hari_kerja").html( $(this).data('hari_kerja'));
    $(".modal-body #jam_kerja").html( $(this).data('jam_kerja'));
    $(".modal-body #employee_remark").html( $(this).data('employee_remark'));
    $(".modal-body #kriteria").html( $(this).data('kriteria'));
    $(".modal-body #jobdesc").html( $(this).data('jobdesc'));
    $(".modal-body #inpitfac_pc").html( $(this).data('inpitfac_pc'));
    $(".modal-body #inpitfac_laptop").html( $(this).data('inpitfac_laptop'));
    $(".modal-body #inpitfac_extdisk").html( $(this).data('inpitfac_extdisk'));
    $(".modal-body #inpitfac_mobilephone").html( $(this).data('inpitfac_mobilephone'));
    $(".modal-body #inpitfac_email").html( $(this).data('inpitfac_email'));
    $(".modal-body #inpitfac_finger_access").html( $(this).data('inpitfac_finger_access'));
    $(".modal-body #inpitfac_facerec_access").html( $(this).data('inpitfac_facerec_access'));
    $(".modal-body #inpitfac_cctv_access").html( $(this).data('inpitfac_cctv_access'));
    $(".modal-body #inpitfac_gps_access").html( $(this).data('inpitfac_gps_access'));
    $(".modal-body #inpitfac_vpn").html( $(this).data('inpitfac_vpn'));
    $(".modal-body #inpitfac_wifi").html( $(this).data('inpitfac_wifi'));
    $(".modal-body #inpitfac_fileserv").html( $(this).data('inpitfac_fileserv'));
    $(".modal-body #inpitfac_acts").html( $(this).data('inpitfac_acts'));
    $(".modal-body #inpitfac_hrms").html( $(this).data('inpitfac_hrms'));
    $(".modal-body #inpitfac_cas").html( $(this).data('inpitfac_cas'));
    $(".modal-body #inpitfac_webbc").html( $(this).data('inpitfac_webbc'));
    $(".modal-body #inpitfac_tpb").html( $(this).data('inpitfac_tpb'));
    $(".modal-body #inpitfac_ticketing").html( $(this).data('inpitfac_ticketing'));
    $(".modal-body #inpitfac_ptk").html( $(this).data('inpitfac_ptk'));
    $(".modal-body #inpitfac_shipment").html( $(this).data('inpitfac_shipment'));
    $(".modal-body #inpitfac_spec").html( $(this).data('inpitfac_spec'));
    $(".modal-body #inpitfac_recruitment").html( $(this).data('inpitfac_recruitment'));
    $(".modal-body #inpitfac_vms").html( $(this).data('inpitfac_vms'));

    let file = $(this).data('file');let valfile;
    if(file !=''){ valfile = "fas fa-paperclip fa-lg" }
    else{ valfile = "" }
    document.getElementById("file_icon").className = valfile;
    document.getElementById("file").href = file;

    let itfac_pc = $(this).data('itfac_pc');let val;
    if(itfac_pc == 1){ val = "fas fa-check" }
    else{ val = "" }
    document.getElementById("itfac_pc").className = val;

    let itfac_laptop = $(this).data('itfac_laptop');let val2;
    if(itfac_laptop == 1){ val2 = "fas fa-check" }
    else{ val2 = "" }
    document.getElementById("itfac_laptop").className = val2;

    let itfac_extdisk = $(this).data('itfac_extdisk');let val3;
    if(itfac_extdisk == 1){ val3 = "fas fa-check" }
    else{ val3 = "" }
    document.getElementById("itfac_extdisk").className = val3;

    let itfac_mobilephone = $(this).data('itfac_mobilephone');let val4;
    if(itfac_mobilephone == 1){ val4 = "fas fa-check" }
    else{ val4 = "" }
    document.getElementById("itfac_mobilephone").className = val4;

    let itfac_email = $(this).data('itfac_email');let val5;
    if(itfac_email == 1){ val5 = "fas fa-check" }
    else{ val5 = "" }
    document.getElementById("itfac_email").className = val5;

    let itfac_finger_access = $(this).data('itfac_finger_access');let val6;
    if(itfac_finger_access == 1){ val6 = "fas fa-check" }
    else{ val6 = "" }
    document.getElementById("itfac_finger_access").className = val6;

    let itfac_facerec_access = $(this).data('itfac_facerec_access');let val7;
    if(itfac_facerec_access == 1){ val7 = "fas fa-check" }
    else{ val7 = "" }
    document.getElementById("itfac_facerec_access").className = val7;

    let itfac_cctv_access = $(this).data('itfac_cctv_access');let val8;
    if(itfac_cctv_access == 1){ val8 = "fas fa-check" }
    else{ val8 = "" }
    document.getElementById("itfac_cctv_access").className = val8;

    let itfac_gps_access = $(this).data('itfac_gps_access');let val9;
    if(itfac_gps_access == 1){ val9 = "fas fa-check" }
    else{ val9 = "" }
    document.getElementById("itfac_gps_access").className = val9;

    let itfac_vpn = $(this).data('itfac_vpn');let val10;
    if(itfac_vpn == 1){ val10 = "fas fa-check" }
    else{ val10 = "" }
    document.getElementById("itfac_vpn").className = val10;

    let itfac_wifi = $(this).data('itfac_wifi');let val11;
    if(itfac_wifi == 1){ val11 = "fas fa-check" }
    else{ val11 = "" }
    document.getElementById("itfac_wifi").className = val11;

    let itfac_fileserv = $(this).data('itfac_fileserv');let val12;
    if(itfac_fileserv == 1){ val12 = "fas fa-check" }
    else{ val12 = "" }
    document.getElementById("itfac_fileserv").className = val12;

    let itfac_acts = $(this).data('itfac_acts');let val13;
    if(itfac_acts == 1){ val13 = "fas fa-check" }
    else{ val13 = "" }
    document.getElementById("itfac_acts").className = val13;

    let itfac_hrms = $(this).data('itfac_hrms');let val14;
    if(itfac_hrms == 1){ val14 = "fas fa-check" }
    else{ val14 = "" }
    document.getElementById("itfac_hrms").className = val14;

    let itfac_cas = $(this).data('itfac_cas');let val15;
    if(itfac_cas == 1){ val15 = "fas fa-check" }
    else{ val15 = "" }
    document.getElementById("itfac_cas").className = val15;

    let itfac_webbc = $(this).data('itfac_webbc');let val16;
    if(itfac_webbc == 1){ val16 = "fas fa-check" }
    else{ val16 = "" }
    document.getElementById("itfac_webbc").className = val16;

    let itfac_tpb = $(this).data('itfac_tpb');let val17;
    if(itfac_tpb == 1){ val17 = "fas fa-check" }
    else{ val17 = "" }
    document.getElementById("itfac_tpb").className = val17;

    let itfac_ticketing = $(this).data('itfac_ticketing');let val18;
    if(itfac_ticketing == 1){ val18 = "fas fa-check" }
    else{ val18 = "" }
    document.getElementById("itfac_ticketing").className = val18;

    let itfac_ptk = $(this).data('itfac_ptk');let val19;
    if(itfac_ptk == 1){ val19 = "fas fa-check" }
    else{ val19 = "" }
    document.getElementById("itfac_ptk").className = val19;

    let itfac_shipment = $(this).data('itfac_shipment');let val20;
    if(itfac_shipment == 1){ val20 = "fas fa-check" }
    else{ val20 = "" }
    document.getElementById("itfac_shipment").className = val20;

    let itfac_spec = $(this).data('itfac_spec');let val21;
    if(itfac_spec == 1){ val21 = "fas fa-check" }
    else{ val21 = "" }
    document.getElementById("itfac_spec").className = val21;

    let itfac_recruitment = $(this).data('itfac_recruitment');let val22;
    if(itfac_recruitment == 1){ val22 = "fas fa-check" }
    else{ val22 = "" }
    document.getElementById("itfac_recruitment").className = val22;

    let itfac_vms = $(this).data('itfac_vms');let val23;
    if(itfac_vms == 1){ val23 = "fas fa-check" }
    else{ val23 = "" }
    document.getElementById("itfac_vms").className = val23;
});

//open-history
$(document).on("click", ".open-history", function ()
{
    $(".modal-content #seq").html( $(this).data('seq'));

    $.ajax({
    type: "POST",
    url: "history_ptk.php",
    data:'seq='+$(this).data('seq'),
    success: function(data){
    $("#HASIL_HISTORY").html(data);
    }
    });
});

//open-detailHistory
$(document).on("click", ".open-detailHistory", function ()
{
    $(".modal-header #seq2").html( $(this).data('seq'));
    $(".modal-header #created_by2").html( $(this).data('created_by'));
    $(".modal-header #created_date2").html( $(this).data('created_date'));
    $(".modal-body #nama_department2").html( $(this).data('nama_department'));
    $(".modal-body #nama_divisi2").html( $(this).data('nama_divisi'));
    $(".modal-body #nama_section2").html( $(this).data('nama_section'));
    $(".modal-body #nama_subsection2").html( $(this).data('nama_subsection'));
    $(".modal-body #nama_team2").html( $(this).data('nama_team'));
    $(".modal-body #nama_unit2").html( $(this).data('nama_unit'));
    $(".modal-body #nama_grade2").html( $(this).data('nama_grade'));
    $(".modal-body #nama_level2").html( $(this).data('nama_level'));
    $(".modal-body #type_ptk2").html( $(this).data('type_ptk'));
    $(".modal-body #so_number2").html( $(this).data('so_number'));
    $(".modal-body #education2").html( $(this).data('education'));
    $(".modal-body #major2").html( $(this).data('major'));
    $(".modal-body #work_experience2").html( $(this).data('work_experience'));
    $(".modal-body #qty_submition2").html( $(this).data('qty_submition'));
    $(".modal-body #date_needed2").html( $(this).data('date_needed'));
    $(".modal-body #placement2").html( $(this).data('placement'));
    $(".modal-body #based_salary2").html( $(this).data('based_salary'));
    $(".modal-body #type_salary2").html( $(this).data('type_salary'));
    $(".modal-body #type_contract2").html( $(this).data('type_contract'));
    $(".modal-body #type_worker2").html( $(this).data('type_worker'));
    $(".modal-body #work_location2").html( $(this).data('work_location'));
    $(".modal-body #type_apd2").html( $(this).data('type_apd'));
    $(".modal-body #type_mcu2").html( $(this).data('type_mcu'));
    $(".modal-body #hari_kerja2").html( $(this).data('hari_kerja'));
    $(".modal-body #jam_kerja2").html( $(this).data('jam_kerja'));
    $(".modal-body #employee_remark2").html( $(this).data('employee_remark'));
    $(".modal-body #kriteria2").html( $(this).data('kriteria'));
    $(".modal-body #jobdesc2").html( $(this).data('jobdesc'));
    $(".modal-body #inpitfac_pc2").html( $(this).data('inpitfac_pc'));
    $(".modal-body #inpitfac_laptop2").html( $(this).data('inpitfac_laptop'));
    $(".modal-body #inpitfac_extdisk2").html( $(this).data('inpitfac_extdisk'));
    $(".modal-body #inpitfac_mobilephone2").html( $(this).data('inpitfac_mobilephone'));
    $(".modal-body #inpitfac_email2").html( $(this).data('inpitfac_email'));
    $(".modal-body #inpitfac_finger_access2").html( $(this).data('inpitfac_finger_access'));
    $(".modal-body #inpitfac_facerec_access2").html( $(this).data('inpitfac_facerec_access'));
    $(".modal-body #inpitfac_cctv_access2").html( $(this).data('inpitfac_cctv_access'));
    $(".modal-body #inpitfac_gps_access2").html( $(this).data('inpitfac_gps_access'));
    $(".modal-body #inpitfac_vpn2").html( $(this).data('inpitfac_vpn'));
    $(".modal-body #inpitfac_wifi2").html( $(this).data('inpitfac_wifi'));
    $(".modal-body #inpitfac_fileserv2").html( $(this).data('inpitfac_fileserv'));
    $(".modal-body #inpitfac_acts2").html( $(this).data('inpitfac_acts'));
    $(".modal-body #inpitfac_hrms2").html( $(this).data('inpitfac_hrms'));
    $(".modal-body #inpitfac_cas2").html( $(this).data('inpitfac_cas'));
    $(".modal-body #inpitfac_webbc2").html( $(this).data('inpitfac_webbc'));
    $(".modal-body #inpitfac_tpb2").html( $(this).data('inpitfac_tpb'));
    $(".modal-body #inpitfac_ticketing2").html( $(this).data('inpitfac_ticketing'));
    $(".modal-body #inpitfac_ptk2").html( $(this).data('inpitfac_ptk'));
    $(".modal-body #inpitfac_shipment2").html( $(this).data('inpitfac_shipment'));
    $(".modal-body #inpitfac_spec2").html( $(this).data('inpitfac_spec'));
    $(".modal-body #inpitfac_recruitment2").html( $(this).data('inpitfac_recruitment'));
    $(".modal-body #inpitfac_vms2").html( $(this).data('inpitfac_vms'));

    let file = $(this).data('file');let valfile;
    if(file !=''){ valfile = "fas fa-paperclip fa-lg" }
    else{ valfile = "" }
    document.getElementById("file_icon2").className = valfile;
    document.getElementById("file2").href = file;

    let itfac_pc = $(this).data('itfac_pc');let val;
    if(itfac_pc == 1){ val = "fas fa-check" }
    else{ val = "" }
    document.getElementById("itfac_pc2").className = val;

    let itfac_laptop = $(this).data('itfac_laptop');let val2;
    if(itfac_laptop == 1){ val2 = "fas fa-check" }
    else{ val2 = "" }
    document.getElementById("itfac_laptop2").className = val2;

    let itfac_extdisk = $(this).data('itfac_extdisk');let val3;
    if(itfac_extdisk == 1){ val3 = "fas fa-check" }
    else{ val3 = "" }
    document.getElementById("itfac_extdisk2").className = val3;

    let itfac_mobilephone = $(this).data('itfac_mobilephone');let val4;
    if(itfac_mobilephone == 1){ val4 = "fas fa-check" }
    else{ val4 = "" }
    document.getElementById("itfac_mobilephone2").className = val4;

    let itfac_email = $(this).data('itfac_email');let val5;
    if(itfac_email == 1){ val5 = "fas fa-check" }
    else{ val5 = "" }
    document.getElementById("itfac_email2").className = val5;

    let itfac_finger_access = $(this).data('itfac_finger_access');let val6;
    if(itfac_finger_access == 1){ val6 = "fas fa-check" }
    else{ val6 = "" }
    document.getElementById("itfac_finger_access2").className = val6;

    let itfac_facerec_access = $(this).data('itfac_facerec_access');let val7;
    if(itfac_facerec_access == 1){ val7 = "fas fa-check" }
    else{ val7 = "" }
    document.getElementById("itfac_facerec_access2").className = val7;

    let itfac_cctv_access = $(this).data('itfac_cctv_access');let val8;
    if(itfac_cctv_access == 1){ val8 = "fas fa-check" }
    else{ val8 = "" }
    document.getElementById("itfac_cctv_access2").className = val8;

    let itfac_gps_access = $(this).data('itfac_gps_access');let val9;
    if(itfac_gps_access == 1){ val9 = "fas fa-check" }
    else{ val9 = "" }
    document.getElementById("itfac_gps_access2").className = val9;

    let itfac_vpn = $(this).data('itfac_vpn');let val10;
    if(itfac_vpn == 1){ val10 = "fas fa-check" }
    else{ val10 = "" }
    document.getElementById("itfac_vpn2").className = val10;

    let itfac_wifi = $(this).data('itfac_wifi');let val11;
    if(itfac_wifi == 1){ val11 = "fas fa-check" }
    else{ val11 = "" }
    document.getElementById("itfac_wifi2").className = val11;

    let itfac_fileserv = $(this).data('itfac_fileserv');let val12;
    if(itfac_fileserv == 1){ val12 = "fas fa-check" }
    else{ val12 = "" }
    document.getElementById("itfac_fileserv2").className = val12;

    let itfac_acts = $(this).data('itfac_acts');let val13;
    if(itfac_acts == 1){ val13 = "fas fa-check" }
    else{ val13 = "" }
    document.getElementById("itfac_acts2").className = val13;

    let itfac_hrms = $(this).data('itfac_hrms');let val14;
    if(itfac_hrms == 1){ val14 = "fas fa-check" }
    else{ val14 = "" }
    document.getElementById("itfac_hrms2").className = val14;

    let itfac_cas = $(this).data('itfac_cas');let val15;
    if(itfac_cas == 1){ val15 = "fas fa-check" }
    else{ val15 = "" }
    document.getElementById("itfac_cas2").className = val15;

    let itfac_webbc = $(this).data('itfac_webbc');let val16;
    if(itfac_webbc == 1){ val16 = "fas fa-check" }
    else{ val16 = "" }
    document.getElementById("itfac_webbc2").className = val16;

    let itfac_tpb = $(this).data('itfac_tpb');let val17;
    if(itfac_tpb == 1){ val17 = "fas fa-check" }
    else{ val17 = "" }
    document.getElementById("itfac_tpb2").className = val17;

    let itfac_ticketing = $(this).data('itfac_ticketing');let val18;
    if(itfac_ticketing == 1){ val18 = "fas fa-check" }
    else{ val18 = "" }
    document.getElementById("itfac_ticketing2").className = val18;

    let itfac_ptk = $(this).data('itfac_ptk');let val19;
    if(itfac_ptk == 1){ val19 = "fas fa-check" }
    else{ val19 = "" }
    document.getElementById("itfac_ptk2").className = val19;

    let itfac_shipment = $(this).data('itfac_shipment');let val20;
    if(itfac_shipment == 1){ val20 = "fas fa-check" }
    else{ val20 = "" }
    document.getElementById("itfac_shipment2").className = val20;

    let itfac_spec = $(this).data('itfac_spec');let val21;
    if(itfac_spec == 1){ val21 = "fas fa-check" }
    else{ val21 = "" }
    document.getElementById("itfac_spec2").className = val21;

    let itfac_recruitment = $(this).data('itfac_recruitment');let val22;
    if(itfac_recruitment == 1){ val22 = "fas fa-check" }
    else{ val22 = "" }
    document.getElementById("itfac_recruitment2").className = val22;

    let itfac_vms = $(this).data('itfac_vms');let val23;
    if(itfac_vms == 1){ val23 = "fas fa-check" }
    else{ val23 = "" }
    document.getElementById("itfac_vms2").className = val23;
});

//open-rejection
$(document).on("click", ".open-rejection", function ()
{
    $(".modal-body #app_reject").val( $(this).data('app'));
    $(".modal-body #seq").val( $(this).data('seq'));
});

//open-appmgrbymd
$(document).on("click", ".open-appmgrbymd", function ()
{
    $(".modal-header #seq").html( $(this).data('seq'));
    $(".modal-body #seq").val( $(this).data('seq'));

});

//open-appdirbymd
$(document).on("click", ".open-appdirbymd", function ()
{
    $(".modal-header #seq").html( $(this).data('seq'));
    $(".modal-body #seq").val( $(this).data('seq'));

});

//open-appmd
$(document).on("click", ".open-appmd", function ()
{
    $(".modal-header #seq").html( $(this).data('seq'));
    // $(".modal-body #app_reject").val( $(this).data('app'));
    $(".modal-body #seq").val( $(this).data('seq'));

});


//open-alasan
$(document).on("click", "#open-alasan", function ()
{
    $(".modal-header #seq").html( $(this).data('seq'));
    $(".modal-body #reject_remark2").val( $(this).data('reject_remark'));
});

//open-pemenuhan
$(document).on("click", "#open-pemenuhan", function ()
{
    $(".modal-header #seq").html( $(this).data('seq'));
    $(".modal-body #seq").val( $(this).data('seq'));
});
</script>