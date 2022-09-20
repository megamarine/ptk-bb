<?php
	require_once("module/model/koneksi/koneksi.php");
	?>
		<option value="">Choose Department</option>
	<?php
	if(!empty($_POST["PERUSAHAAN"])) 
	{
		$PERUSAHAAN = $_POST["PERUSAHAAN"];
		$results = getQuery("select * from m_departement where kode_perusahaan = '$PERUSAHAAN' order by nama_departement asc");
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC)) 
		{
			?>
				<option value="<?php echo $rowz["kode_departement"]; ?>">
					<?php echo $rowz["nama_departement"]; ?>
				</option>
			<?php
		}
	};

?>
