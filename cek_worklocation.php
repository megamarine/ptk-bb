<?php
	require_once("module/model/koneksi/koneksi.php");
?>
<option value="">Choose Lokasi Kerja</option>
<?php
	if(!empty($_POST["TYPE_WORKER"])) 
	{
		$TYPE_WORKER = $_POST["TYPE_WORKER"];
		$results = getQuery("select * from m_worklocation where worktype_code = '$TYPE_WORKER' order by nama asc");
		while ($rowz = $results->fetch(PDO::FETCH_ASSOC))
		{
			?>
				<option value="<?php echo $rowz["seq"]; ?>">
					<?php echo $rowz["nama"]; ?>
				</option>
			<?php
		}
	}
?>
