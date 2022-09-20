<?php 
require_once ("module/model/koneksi/koneksi.php");
include('assets/phpexcel/PHPExcel.php');

$PERIODE      = $_GET["PERIODE"];
$PERIODE2     = $_GET["PERIODE2"];
$date         = date_create("$PERIODE");
$date2        = date_create("$PERIODE2");

$ID_USER1     = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$dept         = $_SESSION["LOGINDEP_PERSONALIA_BB"];
$div          = $_SESSION["LOGINDIV_PERSONALIA_BB"];
$akses        = $_SESSION["LOGINAKS_PERSONALIA_BB"];
$ptk_view     = $_SESSION["LOGINPTKVIEW_PERSONALIA_BB"];
$where_clause = "";

//filter akses ptk view
if($ptk_view == "All")
{
    $where_clause = "";
}
else if($ptk_view == "Departement")
{
    $where_clause = "and b.kode_departement = '$dept'";
}
else
{
    $where_clause = "and b.kode_divisi = '$div'";
}

$result = GetQuery(
                "select b.*,
                        date_format(b.date_ptk, '%d/%m/%Y') as date_ptk,
                        CASE 
                            WHEN b.status_approval = 0 THEN 'Waiting'
                            WHEN b.status_approval = 1 THEN 'Approved'
                            ELSE 'Rejected'
                        END AS status_approval,
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
                        l.nama_user
                   from t_ptk b
              left join m_departement c ON b.kode_departement = c.kode_departement
              left join m_divisi d ON b.kode_divisi = d.kode_divisi
              left join m_section f ON b.kode_section = f.kode_section
              left join m_subsection g ON b.kode_subsection = g.kode_subsection
              left join m_team h ON b.kode_team = h.kode_team
              left join m_unit i ON b.kode_unit = i.kode_unit
              left join m_level j ON b.kode_level = j.kode_level
              left join m_grade k ON b.kode_grade = k.kode_grade
              left join m_user l ON b.created_by = l.kode_user
              where status_hapus = '0' and 
                    date_ptk between '$PERIODE' and '$PERIODE2'
                    $where_clause
              order by b.seq desc");

$objPHPExcel  =   new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'PTK Code');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Input Date');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Department');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Division');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Section');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Sub Section');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Team');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Unit');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Qty Submit');
$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Qty Accept');
$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Qty Left');
$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Level');
$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Grade');
$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Status');

$objPHPExcel->getActiveSheet()->getStyle("A1:O1")->getFont()->setBold(true);

$rowCount   = 2;
$no         = 0;
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $no++;
    if($row["qty_left"] == 0)
    {
        $row["status_approval"] = "Complete";
    }
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $no);
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['seq']);
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['date_ptk']);
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['nama_departement']);
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['nama_divisi']);
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row['nama_section']);
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row['nama_subsection']);
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $row['nama_team']);
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $row['nama_unit']);
    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $row['qty_submition']);
    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $row['qty_accepted']);
    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $row['qty_left']);
    $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $row['nama_level']);
    $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $row['nama_grade']." ".$row['ket_grade']);
    $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, $row['status_approval']); 
    $rowCount++;
}

header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="Report PTK.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
$objWriter->save('php://output');