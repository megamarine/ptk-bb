<?php
	require_once("module/model/koneksi/koneksi.php");
	?>
		<option value="-">Choose Team</option>
	<?php
	if(!empty($_POST["SUBSECTION"])) 
	{
		$SUBSECTION = $_POST["SUBSECTION"];
		$results = getQuery("select * from m_team where kode_subsection = '$SUBSECTION' order by nama_team asc");
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC))
		{
			?>
				<option value="<?php echo $rowz["kode_team"]; ?>">
					<?php echo $rowz["nama_team"]; ?>
				</option>
			<?php
		}
	}
?>
