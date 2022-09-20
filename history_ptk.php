<?php 
require_once("module/model/koneksi/koneksi.php");
$seq = $_POST["seq"];

?>
<style type="text/css">
/*.modal-backdrop {
    visibility: hidden !important;
}*/
.modal.in {
    background-color: rgba(0,0,0,0.5);
}
</style>
<div class="modal-body">
    <table class="table table-bordered" id="bergaris" style="font-size: 11px;">
        <tr>
            <th style="background-color:lightgrey;text-align: center;">#</th>
            <th style="background-color:lightgrey;text-align: center;">Tanggal Input / Ubah</th>
            <th style="background-color:lightgrey;text-align: center;">User Input / Ubah</th>
            <th style="background-color:lightgrey;text-align: center;"></th>
        </tr>
        <?php
        $no = 1;
        $result = getQuery("select b.*,
                                   date_format(b.date_needed, '%d %b %Y') as date_needed,
                                   date_format(b.created_date, '%d %b %Y - %H:%i:%s') as created_date,
                                   c.nama_departement,
                                   d.nama_divisi,
                                   f.nama_section,
                                   g.nama_subsection,
                                   h.nama_team,
                                   i.nama_unit,
                                   j.nama_level,
                                   k.nama_grade,
                                   k.ket_grade,
                                   l.nama_user as created_by,
                                   m.worktype_name as type_worker,
                                   n.worktype_name as type_apd,
                                   o.nama as work_location,
                                   p.workexp_name as work_experience,
                                   GROUP_CONCAT(q.jamkerja_name) AS jam_kerja,
                                   r.placement_name as placement,
                                   s.typesalary_name as type_salary,
                                   t.basedsalary_name as based_salary,
                                   u.mcu_name as type_mcu
                              from t_ptk_history b
                         LEFT JOIN m_departement c ON b.kode_departement = c.kode_departement
                         LEFT JOIN m_divisi d ON b.kode_divisi = d.kode_divisi
                         LEFT JOIN m_section f ON b.kode_section = f.kode_section
                         LEFT JOIN m_subsection g ON b.kode_subsection = g.kode_subsection
                         LEFT JOIN m_team h ON b.kode_team = h.kode_team
                         LEFT JOIN m_unit i ON b.kode_unit = i.kode_unit
                         LEFT JOIN m_level j ON b.kode_level = j.kode_level
                         left join m_grade k ON b.kode_grade = k.kode_grade
                         LEFT JOIN m_user l ON b.created_by = l.kode_user
                         LEFT JOIN m_typeworker m ON b.type_worker = m.worktype_code
                         LEFT JOIN m_typeworker n ON b.type_apd = n.worktype_code
                         LEFT JOIN m_worklocation o ON b.work_location = o.seq
                         LEFT JOIN m_workexperience p ON b.work_experience = p.workexp_code
                         left JOIN m_jamkerja q ON b.jam_kerja LIKE CONCAT('%',q.jamkerja_code,'%')
                         LEFT JOIN m_placement r ON b.placement = r.placement_code
                         LEFT JOIN m_typesalary s ON b.type_salary = s.typesalary_code
                         LEFT JOIN m_basedsalary t ON b.based_salary = t.basedsalary_code
                         LEFT JOIN m_typemcu u ON b.type_mcu = u.mcu_code
                             where b.seq = '$seq'
                          group by b.urut, b.jam_kerja");

        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
        ?>
            <tr>
                <td align="center"><?=$no++.".";?></td>
                <td><?=$row["created_date"];?></td>
                <td><?=$row["created_by"];?></td>
                <td align="center" class="button btn-secondary">
                    <a data-toggle="modal" href="#modalDetailHistory" class="btn open-detailHistory" title="Lihat Detail"
                    data-seq="<?=$row['seq'];?>" data-created_by="<?=$row['created_by'];?>" data-created_date="<?=$row['created_date'];?>"
                    data-nama_department="<?=$row['nama_departement'];?>" data-nama_divisi="<?=$row['nama_divisi'];?>" data-nama_section="<?=$row['nama_section'];?>" data-nama_subsection="<?=$row['nama_subsection'];?>" data-nama_team="<?=$row['nama_team'];?>" data-nama_unit="<?=$row['nama_unit'];?>" data-nama_grade="<?=$row['nama_grade'].' '.$row['ket_grade'];?>" data-nama_level="<?=$row['nama_level'];?>"

                    data-type_ptk="<?=$row['type_ptk'];?>" data-so_number ="<?=$row['so_number'];?>" data-file ="<?=$row['file'];?>" data-education="<?=$row['education'];?>" data-major="<?=$row['major'];?>" data-work_experience ="<?=$row['work_experience'];?>" data-qty_submition="<?=$row['qty_submition'];?>" data-date_needed="<?=$row['date_needed'];?>" data-placement="<?=$row['placement'];?>" data-based_salary="<?=$row['based_salary'];?>" data-type_salary="<?=$row['type_salary'];?>" data-type_contract="<?=$row['type_contract'];?>" data-type_worker="<?=$row['type_worker'];?>" data-work_location="<?=$row['work_location'];?>" data-type_apd="<?=$row['type_apd'];?>" data-type_mcu="<?=$row['type_mcu'];?>"  data-hari_kerja="<?=$row['hari_kerja'];?>"  data-shift="<?=$row['shift'];?>"  data-jam_kerja="<?=$row['jam_kerja'];?>" data-employee_remark="<?=$row['employee_remark'];?>" data-kriteria="<?=$row['kriteria'];?>" data-jobdesc="<?=$row['jobdesc'];?>" data-itfac_pc="<?=$row['itfac_pc'];?>" data-inpitfac_pc="<?=$row['inpitfac_pc'];?>" data-itfac_laptop="<?=$row['itfac_laptop'];?>" data-inpitfac_laptop="<?=$row['inpitfac_laptop'];?>" data-itfac_email="<?=$row['itfac_email'];?>" data-inpitfac_email="<?=$row['inpitfac_email'];?>" data-itfac_extdisk="<?=$row['itfac_extdisk'];?>" data-inpitfac_extdisk="<?=$row['inpitfac_extdisk'];?>" data-itfac_cctv_access="<?=$row['itfac_cctv_access'];?>" data-inpitfac_cctv_access="<?=$row['inpitfac_cctv_access'];?>" data-itfac_finger_access="<?=$row['itfac_finger_access'];?>" data-inpitfac_finger_access="<?=$row['inpitfac_finger_access'];?>" data-itfac_gps_access="<?=$row['itfac_gps_access'];?>" data-inpitfac_gps_access="<?=$row['inpitfac_gps_access'];?>" data-itfac_facerec_access="<?=$row['itfac_facerec_access'];?>" data-inpitfac_facerec_access="<?=$row['inpitfac_facerec_access'];?>" data-itfac_vpn="<?=$row['itfac_vpn'];?>" data-inpitfac_vpn="<?=$row['inpitfac_vpn'];?>" data-itfac_wifi="<?=$row['itfac_wifi'];?>" data-inpitfac_wifi="<?=$row['inpitfac_wifi'];?>" data-itfac_fileserv="<?=$row['itfac_fileserv'];?>" data-inpitfac_fileserv="<?=$row['inpitfac_fileserv'];?>" data-itfac_mobilephone="<?=$row['itfac_mobilephone'];?>" data-inpitfac_mobilephone="<?=$row['inpitfac_mobilephone'];?>" data-itfac_acts="<?=$row['itfac_acts'];?>" data-inpitfac_acts="<?=$row['inpitfac_acts'];?>" data-itfac_hrms="<?=$row['itfac_hrms'];?>" data-inpitfac_hrms="<?=$row['inpitfac_hrms'];?>" data-itfac_cas="<?=$row['itfac_cas'];?>" data-inpitfac_cas="<?=$row['inpitfac_cas'];?>" data-itfac_webbc="<?=$row['itfac_webbc'];?>" data-inpitfac_webbc="<?=$row['inpitfac_webbc'];?>" data-itfac_tpb="<?=$row['itfac_tpb'];?>" data-inpitfac_tpb="<?=$row['inpitfac_tpb'];?>" data-itfac_ticketing="<?=$row['itfac_ticketing'];?>" data-inpitfac_ticketing="<?=$row['inpitfac_ticketing'];?>" data-itfac_ptk="<?=$row['itfac_ptk'];?>" data-inpitfac_ptk="<?=$row['inpitfac_ptk'];?>" data-itfac_shipment="<?=$row['itfac_shipment'];?>" data-inpitfac_shipment="<?=$row['inpitfac_shipment'];?>" data-itfac_spec="<?=$row['itfac_spec'];?>" data-inpitfac_spec="<?=$row['inpitfac_spec'];?>" data-itfac_recruitment="<?=$row['itfac_recruitment'];?>" data-inpitfac_recruitment="<?=$row['inpitfac_recruitment'];?>" data-itfac_vms="<?=$row['itfac_vms'];?>" data-inpitfac_vms="<?=$row['inpitfac_vms'];?>"><i class="fas fa-eye fa-lg"></i></a>
                </td>
            </tr>
        <?php
        } 
        ?>
    </table>
</div>