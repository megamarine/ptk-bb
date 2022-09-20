<?php
	require_once("module/model/koneksi/koneksi.php");
	?>
		<option value="-">Choose Sub Section</option>
	<?php
	if(!empty($_POST["SECTION"])) 
	{
		$SECTION = $_POST["SECTION"];
		$results = getQuery("select * from m_subsection where kode_section = '$SECTION' order by nama_subsection asc");
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
		{
			?>
				<option value="<?php echo $rowz["kode_subsection"]; ?>">
					<?php echo $rowz["nama_subsection"]; ?>
				</option>
			<?php
		}
	}
?>