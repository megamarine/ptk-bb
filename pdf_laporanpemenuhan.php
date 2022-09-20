<?php
require_once("module/model/koneksi/koneksi.php");	
require('assets/fpdf/fpdf.php');
   
$PERIODE      = $_GET["PERIODE"];
$PERIODE2     = $_GET["PERIODE2"];
$date         = date_create("$PERIODE");
$date2        = date_create("$PERIODE2");
$datee        = date_format($date,"Ymd");
$datee2       = date_format($date2,"Ymd");

$ID_USER1     = $_SESSION["LOGINIDUS_PERSONALIA_BB"];
$dept         = $_SESSION["LOGINDEP_PERSONALIA_BB"];
$div          = $_SESSION["LOGINDIV_PERSONALIA_BB"];
$akses        = $_SESSION["LOGINAKS_PERSONALIA_BB"];
$ptk_view     = $_SESSION["LOGINPTKVIEW_PERSONALIA_BB"];
$where_clause = "";
$where_sec    = "";
$where_lev	  = "";

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

$result = GetQuery("select  z.*,
							date_format(z.date, '%d %b %Y') as date_pemenuhan,
							date_format(b.date_ptk, '%d %b %Y') as date_ptk,
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

	class PDF extends FPDF
	{
		// Page header
		function Header()
		{	
			$PERIODE  = $_GET["PERIODE"];
			$PERIODE2 = $_GET["PERIODE2"];
			$SEC 	  = $_GET["SEC"];
			$NAMA_SEC = "";
			$result2 = GetQuery("select nama_section from m_section where kode_section = '$SEC'");
			while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) 
			{
				$NAMA_SEC = $row2["nama_section"];
			}
			$datez    = strtotime($PERIODE);
			$date     = date('d M Y',$datez);

			$datez2   = strtotime($PERIODE2);
			$date2    = date('d M Y',$datez2);

			$repdate  = "";
			if($date == $date2)
			{
				$repdate = $date;
			}
			else
			{
				$repdate = $date." - ".$date2;
			}

			$this->SetMargins(5,2);
			$this->SetFont('Arial','B',10);
			$this->Image('assets/image/images/logobb.jpg',15,8,14);
			$this->Cell(22);
	    	$this->Write(0,"PT. BARAMUDA BAHARI");
		    $this->Ln(1);

		    $this->Cell(27);
		    $this->SetFont('Arial','',6);
		    $this->Write(5,"Ds. Wonokoyo - Kec. Beji, Pasuruan 67514 Jawa Timur Indonesia");
		    $this->Ln(4);
		    $this->Cell(27);
		    $this->Write(5,"Phone (62-343) 656513 - 656446 Fax. (62-343) 656195");
		    $this->Ln(4);
		    $this->Cell(27);
		    $this->Write(5,"PO Box. 6135/SBSG, Surabaya 60061 - Indonesia");
		    
		    $this->SetFont('Arial','I',8);
		    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'R');
		    $this->Ln(2);
		    $this->SetFont('Arial','BU',10);
		    $this->Cell(0,5,"Laporan Penempatan Kerja Karyawan || Tanggal : ".$repdate,0,0,"C");
			$this->Ln();
			$this->Cell(0,5,$NAMA_SEC,0,0,"C");
		    $this->Ln();
		    $this->SetFont('Arial','',9);
        	$this->Ln(2);
	      
		    $this->SetFont('Arial','B',6);
		    $this->Cell(6,5,"No",1,0,"C");
		    $this->Cell(20,5,"PTK Code",1,0,"C");
	        $this->Cell(15,5,"PTK Date",1,0,"C");
			$this->Cell(15,5,"Fulfill Date",1,0,"C");
			$this->Cell(10,5,"ID Kary",1,0,"C");
			$this->Cell(30,5,"Name",1,0,"C");
			$this->Cell(5,5,"L/P",1,0,"C");
	        $this->Cell(20,5,"Department",1,0,"C");
	        $this->Cell(30,5,"Division",1,0,"C");
	        $this->Cell(38,5,"Section",1,0,"C");
	        $this->Cell(38,5,"Sub Section",1,0,"C");
	        $this->Cell(20,5,"Level",1,0,"C");
	        $this->Cell(35,5,"Grade",1,0,"C");
	        $this->Ln();
		}

		// Page footer
		function Footer()
		{
			$text = 'Diterima Oleh,                                         Hormat kami,';
			$this->SetY(-50);
			$this->SetFont('Arial', 'B', 8);
			$this->Cell(0);
			$this->Cell(-120, 10, $text, 0, 0, 'C', 0);
			$this->Ln();
			$this->Cell(265.5, 40, "Recruitment", 0, 0, 'R', 0);
			$this->Line(198, 187, 220, 187);
			$this->Line(250, 187, 272, 187);
		}
	}

$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetMargins(5,2,3);

// Echo Value
$no = 0;
while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
{
	$no++;
    extract($row);
    $pdf->SetFont('Arial','',6);
    $pdf->Cell(6,5,$no,1,0,"C");
    $pdf->Cell(20,5,$row["seq"],1,0,"L");
    $pdf->Cell(15,5,$row["date_ptk"],1,0,"L");
	$pdf->Cell(15,5,$row["date_pemenuhan"],1,0,"L");
	$pdf->Cell(10,5,$row["id_accepted"],1,0,"L");
	$pdf->Cell(30,5,substr($row["name_accepted"],0,23),1,0,"L");
	$pdf->Cell(5,5,$row["jenis_kelamin"],1,0,"C");
    $pdf->Cell(20,5,$row["nama_departement"],1,0,"L");
    $pdf->Cell(30,5,substr($row["nama_divisi"],0,29),1,0,"L");
    $pdf->Cell(38,5,substr($row["nama_section"],0,37),1,0,"L");
    $pdf->Cell(38,5,substr($row["nama_subsection"],0,37),1,0,"L");
    $pdf->Cell(20,5,$row["nama_level"],1,0,"L");
    $pdf->Cell(35,5,$row["nama_grade"]." ".$row["ket_grade"],1,0,"L");
    $pdf->Ln();
}

//Output Format
$pdf->Output("Laporan Pemenuhan_".$datee."-".$datee2.".pdf","I");

?>