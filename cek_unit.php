<?php
	require_once("module/model/koneksi/koneksi.php");
	?>
		<option value="-">Choose Unit</option>
	<?php
	if(!empty($_POST["TEAM"])) 
	{
		$TEAM = $_POST["TEAM"];
		$results = getQuery("select * from m_unit where kode_team = '$TEAM' order by nama_unit asc");
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC))
		{
			?>
				<option value="<?php echo $rowz["kode_unit"]; ?>">
					<?php echo $rowz["nama_unit"]; ?>
				</option>
			<?php
		}
	}
?>
