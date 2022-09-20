<?php
	require_once("module/model/koneksi/koneksi.php");
	?>
		<option value="-">Choose Section</option>
	<?php
	if(!empty($_POST["DIVISI"])) 
	{
		$DIVISI = $_POST["DIVISI"];
		$results = getQuery("select * from m_section where kode_divisi = '$DIVISI' order by nama_section asc");
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
		{
			?>
				<option value="<?php echo $rowz["kode_section"]; ?>">
					<?php echo $rowz["nama_section"]; ?>
				</option>
			<?php
		}
	}
?>