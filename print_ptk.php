<?php
	require_once("module/model/koneksi/koneksi.php");
	require('assets/fpdf/fpdf.php');

	$ID_USER1 = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
	$dept     = $_SESSION["LOGINDEP_PERSONALIA_BB"];
	$div      = $_SESSION["LOGINDIV_PERSONALIA_BB"];
	$akses    = $_SESSION["LOGINAKS_PERSONALIA_BB"];
	$ptk_view = $_SESSION["LOGINPTKVIEW_PERSONALIA_BB"];
	$seq      = $_GET["seq"];
	$DINO     = date('Y-m-d H:i:s');

	$result = $db1->prepare("select b.*,
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
				                    m.workexp_name as work_experience,
									n.basedsalary_name as based_salary
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
				          left join m_workexperience m ON b.work_experience = m.workexp_code
						  left join m_basedsalary n ON b.based_salary = n.basedsalary_code
				          where b.seq = '$seq'
				          order by b.seq desc");
	$result->execute();

	class PDF extends FPDF
	{
		// Page header
		function Header()
		{
			$seq = $_GET["seq"];
			$this->SetFont('Arial','B',12);
			$this->Image('assets/image/images/logobb.jpg',10,9,18);
			$this->Cell(25);
	      	$this->Write(5,"PT. BARAMUDA BAHARI");

		    $this->Ln(4);
		    $this->Cell(25);
		    $this->SetFont('Arial','',7);
		    $this->Write(5,"Ds. Wonokoyo - Kec. Beji, Pasuruan 67514 Jawa Timur Indonesia");
		    $this->Ln(4);
		    $this->Cell(25);
		    $this->Write(5,"Phone (62-343) 656513 - 656446 Fax. (62-343) 656195");
		    $this->Ln(4);
		    $this->Cell(25);
		    $this->Write(5,"PO Box. 6135/SBSG, Surabaya 60061 - Indonesia");
		    $this->Ln(6);

		    $this->SetFont('Arial','BU',12);
		    $this->Cell(0,5,"Permintaan Tenaga Kerja",0,0,"C");
		    $this->Ln();
		    $this->SetFont('Arial','B',11);
		    $this->Cell(0,5,$seq,0,0,"C");
		    $this->Ln();
		}

		// Page footer
		function Footer()
		{
			$db1 = new PDO('mysql:host=192.168.10.167:3307;dbname=personalia_bb', 'it', 'kabelangka8');
			$seq    = $_GET["seq"];
			$result = $db1->prepare("select a.created_by,
											b.nama_user
						               from t_ptk a
						          LEFT JOIN m_user b ON a.created_by = b.kode_user
						          where a.seq = '$seq'
						          order by a.seq desc");
			$result->execute();
			while ($row = $result->fetch(PDO::FETCH_ASSOC))
			{
				$NAMA_USER = $row["nama_user"];
			}
			
		    $this->SetY(-25);
		    $this->SetX(30);
		    $this->SetFont('Times','B',9);
		    $this->Cell(10,5,"",0,0,"L");
		    $this->Cell(50,5,"Diajukan oleh,",0,0,"L");
		    $this->Cell(50,5,"Disetujui oleh,",0,0,"L");
		    $this->Cell(50,5,"Disetujui oleh,",0,0,"L");
		    $this->Ln(15);

		    $this->SetX(30);
		    $this->Cell(10,5,"",0,0,"L");
		    $this->Cell(50,5,"( $NAMA_USER )",0,0,"L");
		    $this->Cell(50,5,"( Tri Mey Diandono )",0,0,"L");
		    $this->Cell(50,5,"( Rachmat Hartojo )",0,0,"L");
		}
	}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
	$pdf->Cell(20,5,"Bersama ini kami ajukan permintaan tenaga kerja untuk mengisi posisi yang dibutuhkan saat ini, dengan kriteria seperti di bawah ini :",0,0,"L");
    $pdf->Ln(5);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Departement",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(20,5,": " . $row["nama_departement"],0,0,"L");
    $pdf->Ln();

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Divisi",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(20,5,": " . $row["nama_divisi"],0,0,"L");
    $pdf->Ln();

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Section",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(20,5,": " . $row["nama_section"]  ,0,0,"L");
    $pdf->Ln();

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Sub Section",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(20,5,": " . $row["nama_subsection"]  ,0,0,"L");
    $pdf->Ln();

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Team",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(20,5,": " . $row["nama_team"]  ,0,0,"L");
    $pdf->Ln();

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Unit",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(20,5,": " . $row["nama_unit"]  ,0,0,"L");
    $pdf->Ln();

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Level",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(20,5,": " . $row["nama_level"]  ,0,0,"L");
    $pdf->Ln();

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Grade",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(20,5,": " . $row["nama_grade"] . " " . $row["ket_grade"]  ,0,0,"L");
    $pdf->Ln();

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Jumlah permintaan",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(100,5,": " . $row["qty_submition"] . " Orang",0,0,"L");
    $pdf->Ln();

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Tanggal butuh",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(20,5,": " . $row["date_needed"],0,0,"L");
    $pdf->Ln();

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Basis penggajian",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(20,5,": " . $row["based_salary"],0,0,"L");
    $pdf->Ln();

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Type PTK",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(20,5,": " . $row["type_ptk"],0,0,"L");
    $pdf->Ln();

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Pendidikan Minimal",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(20,5,": " . $row["education"],0,0,"L");
    $pdf->Ln();

    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Pengalaman Kerja",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(20,5,": " . $row["work_experience"],0,0,"L");
    $pdf->Ln();    

	$start_awal = $pdf->GetX();
	$get_xxx    = $pdf->GetX();
	$get_yyy    = $pdf->GetY();

	$width_cell  = 0;
	$height_cell = 5;
	$pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Kriteria",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell($width_cell,$height_cell,": " . $row["kriteria"],0,"L");
    $pdf->Ln(2);

	$get_xxx = $pdf->GetX();
	$get_yyy = $pdf->GetY();
	$pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,"Tugas Pokok",0,0,"L");
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell($width_cell,$height_cell,": " . $row["jobdesc"],0,"L");
    $pdf->Ln(2);

	$get_xxx = $pdf->GetX();
	$get_yyy = $pdf->GetY();
	$pdf->SetFont('Arial','BU',9);
    $pdf->Cell(30,5,"Approval Information : ",0,0,"L");
    $pdf->Ln(5);
    $pdf->SetFont('Arial','',9);
	$pdf->Cell(10,5,"",0,0,"R");
    $pdf->Cell(40,5,"Manager ",0,0,"C");
    $pdf->Cell(40,5,"Director ",0,0,"C");
    $pdf->Cell(40,5,"HRM Departement ",0,0,"C");
    $pdf->Cell(40,5,"Managing Director ",0,0,"C");
	$pdf->Ln(5);
	$pdf->Cell(10,5,"",0,0,"R");
	$pdf->Cell(40,5,isset($row["app_mgr_date"]) ? $row["app_mgr_date"] : "-",0,0,"C");
    $pdf->Cell(40,5,isset($row["app_dir_date"]) ? $row["app_dir_date"] : "-",0,0,"C");
    $pdf->Cell(40,5,isset($row["app_hrd_date"]) ? $row["app_hrd_date"] : "-",0,0,"C");
    $pdf->Cell(40,5,isset($row["app_md_date"]) ? $row["app_md_date"] : "-",0,0,"C");

	$get_xxx += $width_cell;
	$pdf->SetXY($get_xxx, $get_yyy);

}
// Format Page Portrait/Landscape, Type of Paper, Rotation
$pdf->Output("assets/pdf/Laporan ".$seq.".pdf","I");
// }
?>