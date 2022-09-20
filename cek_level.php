<?php require_once("module/model/koneksi/koneksi.php"); ?>
		<option value="">Choose Grade</option>
	<?php
	if(!empty($_POST["LEVEL"])) 
	{
		$LEVEL   = $_POST["LEVEL"];
		$results = getQuery("select * from m_grade where kode_level = '$LEVEL' order by kode_grade asc");
		// $count   = getQuery("select count(*) from m_grade where kode_level = '$LEVEL' order by kode_grade asc")->fetchColumn();
		// if($count>=1)
		// { ?>
			<!-- <option value="-">Choose Grade</option> -->
			<?php
		//}
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC))
		{
			?>
				<option value="<?php echo $rowz["kode_grade"]; ?>">
					<?php echo $rowz["nama_grade"]." ".$rowz["ket_grade"]; ?>
				</option>
			<?php
		}
	}
?>
