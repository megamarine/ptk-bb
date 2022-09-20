<?php 
require_once ("module/model/koneksi/koneksi.php");
include('assets/phpexcel/PHPExcel.php');

$PERIODE      = $_GET["PERIODE"];
$PERIODE2     = $_GET["PERIODE2"];
$SEC          = $_GET["SEC"];
$LEV          = $_GET["LEV"];
$date         = date_create("$PERIODE");
$date2        = date_create("$PERIODE2");

$ID_USER1     = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$dept         = $_SESSION["LOGINDEP_PERSONALIA_BB"];
$div          = $_SESSION["LOGINDIV_PERSONALIA_BB"];
$akses        = $_SESSION["LOGINAKS_PERSONALIA_BB"];
$ptk_view     = $_SESSION["LOGINPTKVIEW_PERSONALIA_BB"];
$where_clause = "";
$where_sec    = "";
$where_lev    = "";

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

//filter section
if($_GET["SEC"] != "")
{
    $SEC       = $_GET["SEC"];
    $where_sec = "and b.kode_section = '$SEC'";
}

//filter level
if($_GET["LEV"] != "")
{
    $LEV       = $_GET["LEV"];
    $where_lev = "and b.kode_level = '$LEV'";
}

$result = GetQuery("select  z.*,
                            z.date as date_pemenuhan,
                            b.date_ptk as date_ptk,
                            c.nama_departement,
                            d.nama_divisi,
                            f.nama_section,
                            g.nama_subsection,
                            h.nama_team,
                            i.nama_unit,
                            j.nama_level,
                            k.nama_grade,
                            k.ket_grade,
                            m.nama_user as nama_user_pemenuhan
                       from t_fulfillment z 
                  left join t_ptk b ON z.seq = b.seq
                  left join m_departement c ON b.kode_departement = c.kode_departement
                  left join m_divisi d ON b.kode_divisi = d.kode_divisi
                  left join m_section f ON b.kode_section = f.kode_section
                  left join m_subsection g ON b.kode_subsection = g.kode_subsection
                  left join m_team h ON b.kode_team = h.kode_team
                  left join m_unit i ON b.kode_unit = i.kode_unit
                  left join m_level j ON b.kode_level = j.kode_level
                  left join m_grade k ON b.kode_grade = k.kode_grade
                  left join m_user m ON z.created_by = m.kode_user
                      WHERE (z.date BETWEEN '$PERIODE' AND '$PERIODE2') $where_clause $where_sec $where_lev
                   order by z.seq desc");

$objPHPExcel  =   new PHPExcel();

$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'No');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'PTK Code');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'PTK Date');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Fulfill Date');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'ID Kary');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Name');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'L/P');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Department');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Division');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Section');
$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Sub Section');
$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Level');
$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Grade');

$objPHPExcel->getActiveSheet()->getStyle("A1:M1")->getFont()->setBold(true);

$rowCount   = 2;
$no         = 0;
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $no++;
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $no);
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['seq']);
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['date_ptk']);
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['date_pemenuhan']);
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['id_accepted']);
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row['name_accepted']);
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row['jenis_kelamin']);
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $row['nama_departement']);
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $row['nama_divisi']);
    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $row['nama_section']);
    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $row['nama_subsection']);
    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $row['nama_level']);
    $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $row['nama_grade']." ".$row["ket_grade"]);
    $rowCount++;
}

header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="Report Pemenuhan.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
$objWriter->save('php://output');