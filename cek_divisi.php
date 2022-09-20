<?php
	require_once("module/model/koneksi/koneksi.php");
	?>
		<option value="">Choose Division</option>
	<?php
	if(!empty($_POST["DEPARTEMENT"])) 
	{
		$DEPARTEMENT = $_POST["DEPARTEMENT"];
		$results = getQuery("select * from m_divisi where kode_departement = '$DEPARTEMENT' order by nama_divisi asc");
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC))
		{
			?>
				<option value="<?php echo $rowz["kode_divisi"]; ?>">
					<?php echo $rowz["nama_divisi"]; ?>
				</option>
			<?php
		}
	}
?>
